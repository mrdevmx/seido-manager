<?php
//Llamada al modelo
require_once($path."model/almacenModel.php");
require_once($path."model/usuarioModel.php");
require_once($path."model/andadoresModel.php");
$usuario = new usuariosModel();
$movResumen = new almacenModel();
$almacen = new almacenModel();
$andadores = new andadoresModel();

if(isset($_POST["modo"])){
    if($_POST["modo"] == 1){
        $saveEntrada = new almacenModel();
        $response = $saveEntrada->saveEntrada($_POST["provid"],$_POST["fecentra"],$_POST["requi"],$_POST["recibe"],$_POST["productos"]);
        echo $response;
    }else{
        $saveSalida = new almacenModel();
        $response = $saveSalida->saveSalida($_POST["solicitud"],$_POST["solicita"],$_POST["autoriza"],$_POST["entrega"],$_POST["fecsale"],$_POST["destino"],$_POST["productos"]);
        echo $response;
    }
}else{
    $timelineMovimientosResumen=$movResumen->timelineMovimientosResumen();
    $tableKardex=$almacen->getKardexTable();
    // Notificaciones: agrupar y preparar resumen por tipo
    $neg = $almacen->getNegativeStock();
    // Reemplazamos la notificación de "entradas pendientes" por productos con existencia 0
    $zeroStockItems = $almacen->getZeroStock(200);
    $lowStockItems = $almacen->getLowStock(5);
    // Mapear solo los campos que queremos mostrar en el modal para 'low_stock'
    $lowStockForView = array();
    if(!empty($lowStockItems)){
        foreach($lowStockItems as $it){
            $existVal = isset($it['existencia']) ? intval($it['existencia']) : 0;
            // Omitir productos con existencia exactamente 0 (productos obsoletos o sin uso)
            if ($existVal === 0) continue;

            $lowStockForView[] = array(
                'producto' => isset($it['producto']) ? $it['producto'] : '',
                'existencia' => $existVal,
                'ultima_entrada' => !empty($it['last_ent']) ? $it['last_ent'] : '',
                'ultima_salida' => !empty($it['last_sal']) ? $it['last_sal'] : ''
            );
        }
    }
    // High consumption: comparar mes actual vs mes anterior
    $high = $almacen->getHighConsumption(200);
    // No-movement: productos sin actividad en los ultimos 30 dias
    $nomv = $almacen->getNoMovement(30,200);

    // Datos crudos para el modal (se pasan a la vista como JSON)
    // Mapear zero stock para la vista (mostrar producto y existencia + fechas)
    $zeroForView = array();
    if(!empty($zeroStockItems)){
        foreach($zeroStockItems as $it){
            $zeroForView[] = array(
                'id' => isset($it['Cri_Id']) ? $it['Cri_Id'] : '',
                'producto' => isset($it['producto']) ? $it['producto'] : '',
                'existencia' => isset($it['existencia']) ? intval($it['existencia']) : 0,
                'ultima_entrada' => !empty($it['last_ent']) ? $it['last_ent'] : '',
                'ultima_salida' => !empty($it['last_sal']) ? $it['last_sal'] : ''
            );
        }
    }

    $notificationsData = array(
        'negative' => $neg,
        'zero_stock' => $zeroForView,
        'low_stock' => $lowStockForView,
        'high_consumption' => $high,
        'no_movement' => $nomv
    );

    // Formatear fechas en todas las notificaciones a formato: YYYY mmm DD (mes abreviado en español)
    $dateKeys = array('last_ent','last_sal','ultima_entrada','ultima_salida','ultima_ent','ultima_sal','last_activity','Ent_FecEnt','Ent_FecAlt','Sal_FecAlt','Ent_FecMod');
    $months = array(1=>'ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic');
    $formatDate = function($d) use ($months){
        if(empty($d)) return '';
        try{
            $dt = new DateTime($d);
        }catch(Exception $e){
            return $d;
        }
        $y = $dt->format('Y');
        $m = intval($dt->format('n'));
        $day = $dt->format('d');
        $mstr = isset($months[$m]) ? $months[$m] : $dt->format('M');
        return sprintf('%s %s %s', $y, $mstr, $day);
    };

    foreach($notificationsData as $gkey => $group){
        if(!is_array($group)) continue;
        foreach($group as $idx => $item){
            foreach($dateKeys as $dk){
                if(isset($item[$dk]) && !empty($item[$dk])){
                    $notificationsData[$gkey][$idx][$dk] = $formatDate($item[$dk]);
                }
            }
            // also handle possible keys with different naming (normalize to ultima_entrada/ultima_salida)
            if(isset($item['last_ent']) && !empty($item['last_ent'])){
                $notificationsData[$gkey][$idx]['ultima_entrada'] = $formatDate($item['last_ent']);
            }
            if(isset($item['last_sal']) && !empty($item['last_sal'])){
                $notificationsData[$gkey][$idx]['ultima_salida'] = $formatDate($item['last_sal']);
            }
            // Fallback: para 'no_movement' asegurar que haya una fecha de 'ultima_ent' mostrando la ultima actividad si no hay entrada
            if($gkey === 'no_movement'){
                $hasEnt = !empty($notificationsData[$gkey][$idx]['ultima_ent']) || !empty($notificationsData[$gkey][$idx]['last_ent']);
                $hasSal = !empty($notificationsData[$gkey][$idx]['ultima_sal']) || !empty($notificationsData[$gkey][$idx]['last_sal']);
                if(empty($notificationsData[$gkey][$idx]['ultima_ent'])){
                    if(!empty($notificationsData[$gkey][$idx]['ultima_sal'])){
                        $notificationsData[$gkey][$idx]['ultima_ent'] = $notificationsData[$gkey][$idx]['ultima_sal'];
                    }elseif(!empty($notificationsData[$gkey][$idx]['last_activity'])){
                        $notificationsData[$gkey][$idx]['ultima_ent'] = $notificationsData[$gkey][$idx]['last_activity'];
                    }
                }
            }
        }
    }

    // Resumen agrupado (muestra un item por grupo con contador y botón ojo)
    $notifications = '';
    $groups = array(
        'negative' => array('icon'=>'la-times-circle-o','label'=>'Existencia negativa','class'=>'media-danger'),
        'zero_stock' => array('icon'=>'la-minus-circle','label'=>'Existencia 0','class'=>'media-info'),
        'low_stock' => array('icon'=>'la-exclamation','label'=>'Baja existencia','class'=>'media-warning'),
        'high_consumption' => array('icon'=>'la-line-chart','label'=>'Aumento de consumo','class'=>'media-warning'),
        'no_movement' => array('icon'=>'la-clock-o','label'=>'Sin movimiento','class'=>'media-info')
    );

    foreach($groups as $key => $meta){
        $count = isset($notificationsData[$key]) ? count($notificationsData[$key]) : 0;
        $label = $meta['label'];
        $icon = $meta['icon'];
        $cls = $meta['class'];

        $notifications .= "<li>".
                          "<div class=\"timeline-panel\">".
                          "<div class=\"media mr-2 $cls\">".
                          "<i class=\"la $icon\"></i>".
                          "</div>".
                          "<div class=\"media-body\">".
                          "<h5 class=\"mb-1\">$label</h5>".
                          "<small class=\"d-block\">$count notificación(es)</small>".
                          "</div>".
                          "<div class=\"dropdown\">".
                          "<button type=\"button\" class=\"btn btn-light btn-sm view-notif\" data-type=\"$key\" data-toggle=\"modal\" data-target=\"#notifModal\">".
                          "<i class=\"la la-eye\"></i>".
                          "</button>".
                          "</div>".
                          "</div>".
                          "</li>";
    }

    $usuarioSelect=$usuario->getUsuarioSelect();
    $andadorSelect=$andadores->getCasAndSelect();
    //Llamada a la vista
require_once($path."view/almacen/almacen.php");
}

?>
