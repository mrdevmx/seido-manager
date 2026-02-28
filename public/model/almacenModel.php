<?php
/*
****************************************************************************
** DESCRIPCION: Modelo almacen					                        ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Modificó:    Jazmín Martínez Rodríguez  						        ****
** Fecha:       27/Febrero/2026											****
** Descripción: Se agregó el método saveSalida para guardar las salidas ****
**              de productos del almacén.							    ****
****************************************************************************
** Creó:        Jesus Alberto Martinez Rodriguez						****
** Fecha:       03/Abril/2024											****
****************************************************************************
*/
class almacenModel{
    private $table = 'ALENTART';
    private $db;
    private $typeConnection = 2;
    private $entradas;
    private $salidas;
    private $kardex;
    private $movimientosResumen;
    private $tMR;
    private $tableKardex;
 
    public function __construct(){
        $this->db=Conectar::conexion($this->typeConnection);
        $this->entradas=array();
        $this->salidas=array();
        $this->kardex=array();
        $this->movimientosResumen=array();
    }
    public function getMovimientosResumen(){
        $set=$this->db->query("set lc_time_names = 'es_MX'");
        $query=$this->db->query("(select 
                                     Ent_Requic as 'origen'
                                    ,Cpo_NomCome as 'destino'
                                    ,Ent_Requic as 'id'
                                    ,case
                                        when datediff(now(), Ent_FecMod) > 3 then concat('El ',date_format(Ent_FecMod,'%d %M %Y'))
                                        when minute(timediff(now(), Ent_FecMod)) < 3 then 'Recien' 
                                        when hour(timediff(now(), Ent_FecMod)) > 0 and hour(timediff(now(), Ent_FecMod)) < 12 then concat('Hace ',hour(timediff(now(), Ent_FecMod)),' horas' )
                                        when hour(timediff(now(), Ent_FecMod)) > 11 then concat('Hace ',datediff(now(), Ent_FecMod),' días')
                                        else concat('Hace ',minute(timediff(now(), Ent_FecMod)),' minutos' ) 
                                     end as 'fecha'
                                    ,count(Ent_Requic) as 'productos'
                                    ,concat('$',format(sum(round(Ent_Total,2)), 2, 'en_US')) as 'total'
                                    ,1 as 'tipo'
                                    ,Ent_FecMod as 'orden'
                                 from ALENTART 
                                 inner join ADCATPRO on Ent_Provee = Cpo_Id 
                                 where Ent_Estatu = 1 
                                 group by Ent_Requic, Ent_Provee, Ent_FecMod)
                                 union
                                (select
                                     Sal_SolPer as 'origen'
                                    ,Sal_Destin as 'destino'
                                    ,Sal_Solici as 'id'
                                    ,case 
                                        when datediff(now(), Sal_FecAlt) > 3 then concat('El ',date_format(Sal_FecAlt,'%d %M %Y'))
                                        when minute(timediff(now(), Sal_FecAlt)) < 2 then 'Recien'
                                        when hour(timediff(now(), Sal_FecAlt)) > 0 and hour(timediff(now(), Sal_FecAlt)) < 12 then concat('Hace ',hour(timediff(now(), Sal_FecAlt)),' horas' )
                                        when hour(timediff(now(), Sal_FecAlt)) > 11 then concat('Hace ',datediff(now(), Sal_FecAlt),' días' )
                                        else concat('Hace ',minute(timediff(now(), Sal_FecAlt)),' minutos' ) 
                                     end as 'fecha'
                                    ,count(Sal_Solici) as 'productos'
                                    ,0 as 'total'
                                    ,2 as 'tipo'
                                    ,Sal_FecAlt as 'orden'
                                from ALSALART 
                                where Sal_Estatu = 1 
                                group by Sal_Solici,Sal_SolPer,Sal_Destin,Sal_FecAlt)
                                order by orden desc");
        if ($query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->movimientosResumen[]=$row;
            }
        }else{
            return false;
        }
        $this->db->close();
        return $this->movimientosResumen;
    }

    public function timelineMovimientosResumen(){
        $movimientos=$this->getMovimientosResumen();
        $i=1;
        foreach($movimientos as $movimiento){
            $tipo = ($movimiento["tipo"] == 1) ? 'success' : 'danger';
            if($movimiento["tipo"] == 1){
                $this->tMR.= <<< EOT
                    <li>
                        <div class="timeline-badge $tipo"></div>
                        <a class="timeline-panel text-muted detalle-movimiento" href="javascript:void(0)" data-tipo="{$movimiento['tipo']}" data-id="{$movimiento['id']}">
                            <span>{$movimiento["fecha"]}</span>
                            <h6 class="mb-0"><strong>Entrada</strong> de requisición <strong class="text-$tipo">{$movimiento["origen"]}</strong>, del proovedor <strong class="text-$tipo">{$movimiento["destino"]}</strong> con <strong class="text-$tipo">{$movimiento["productos"]}</strong> productos y un total de <strong class="text-$tipo">{$movimiento["total"]}</strong>.</h6>
                        </a>
                    </li>
                EOT;
            }else{
                $destino ='';
                $badge = '';
                $db = Conectar::conexion($this->typeConnection);
                foreach(json_decode($movimiento["destino"]) as $index => $destino){
                    // formatear destino: convertir "xxx-yy" a "Casa xxx, Andador yyy"
                    $formattedDestino = $destino;
                    $parts = explode('-', $destino);
                    if(count($parts) == 2){
                        $codCasa = $db->real_escape_string($parts[0]);
                        $codAnd = $db->real_escape_string($parts[1]);
                        $qdest = $db->query("select CAS.Cnd_CodCas, CA.Can_NomAnd from ADCASAND CAS inner join ADCATAND CA on CAS.Cnd_CodAnd = CA.Can_CodAnd where CAS.Cnd_CodCas = '".$codCasa."' and CAS.Cnd_CodAnd = '".$codAnd."' limit 1");
                        if($qdest && $rd = $qdest->fetch_assoc()){
                            $formattedDestino = 'Casa '.$rd['Cnd_CodCas'].', '.$rd['Can_NomAnd'];
                        }
                    }
                    $badge .='<span class="badge badge-rounded light badge-info col">'.$formattedDestino.'</span>';
                }
                $db->close();
    
                $this->tMR.= <<< EOT
                    <li>
                        <div class="timeline-badge $tipo"></div>
                        <a class="timeline-panel text-muted detalle-movimiento" href="javascript:void(0)" data-tipo="{$movimiento['tipo']}" data-id="{$movimiento['id']}">
                            <span>{$movimiento["fecha"]}</span>
                            <h6 class="mb-0"><strong>Salida</strong> de <strong class="text-$tipo">{$movimiento["productos"]}</strong> productos, Solicitado por <strong class="text-$tipo">{$movimiento["origen"]}</strong>, con destino 
                            <div class="bootstrap-badge row">{$badge}</div></h6>
                        </a>
                    </li>
                EOT;
            }
            
            $i++;
        }
        return $this->tMR;
    }

    // ------------------------------------------------------------------
    // detail helpers for timeline modal
    // ------------------------------------------------------------------
    public function getDetalleEntrada($requi){
        $db = Conectar::conexion($this->typeConnection);
        $detalle = ['tipo'=>1,'header'=>[], 'productos'=>[]];
        // obtener encabezado desde DATMANTOOLS, incluyendo id del usuario que recibe
        $sql = "select a.Ent_Requic, a.Ent_FecEnt, a.Ent_Recibe as recibe_id,
                       p.Cpo_NomCome as proveedor
                from ALENTART a
                left join ADCATPRO p on a.Ent_Provee = p.Cpo_Id
                where a.Ent_Requic = '".$requi."' limit 1";

        $q = $db->query($sql);
        $recibeId = null;
        if($q && $row = $q->fetch_assoc()){
            $recibeId = $row['recibe_id'];
            $detalle['header']=[
                'requisicion'=>$row['Ent_Requic'],
                'fecha'=>$row['Ent_FecEnt'],
                'recibe'=>'',
                'proveedor'=>$row['proveedor']
            ];
        }
        // si hay id de usuario, buscar nombre en la BD CONCENT (tipo 1)
        if(!empty($recibeId)){
            $dbConcent = Conectar::conexion(1);
            $uSql = "select concat(Usu_Nombre,' ',Usu_Apelli) as nombre from CCUSUARI where Usu_Id = ".intval($recibeId);
            $uq = $dbConcent->query($uSql);
            if($uq && $ur = $uq->fetch_assoc()){
                $detalle['header']['recibe'] = $ur['nombre'];
            }
            $dbConcent->close();
        }

        $sql2 = "select a.Ent_Produc, c.Cri_Descrip, a.Ent_Cantid, a.Ent_PU, a.Ent_Total
                 from ALENTART a
                 inner join ALCATART c on a.Ent_Produc = c.Cri_Id
                 where a.Ent_Requic = '".$requi."'";
        $q2 = $db->query($sql2);
        if($q2){
            while($p = $q2->fetch_assoc()){
                $detalle['productos'][]=[
                    'producto'=>$p['Cri_Descrip'],
                    'cantidad'=>$p['Ent_Cantid'],
                    'pu'=>$p['Ent_PU'],
                    'total'=>$p['Ent_Total']
                ];
            }
        }
        $db->close();
        return $detalle;
    }

    public function getDetalleSalida($solicitud){
        $db = Conectar::conexion($this->typeConnection);
        $detalle = ['tipo'=>2,'header'=>[], 'productos'=>[]];
        // obtener encabezado desde DATMANTOOLS (Sal_SolPer y Sal_Autori son strings con nombres)
        $sql = "select s.Sal_Solici, s.Sal_FecSal, s.Sal_SolPer as solicitante,
                       s.Sal_Autori as autorizado, s.Sal_Entreg as entregado_id, s.Sal_Destin
                from ALSALART s
                where s.Sal_Solici = '".$solicitud."' limit 1";
        $q = $db->query($sql);
        $entregadoId = null;
        if($q && $row = $q->fetch_assoc()){
            $entregadoId = $row['entregado_id'];
            // formatear destino: almacenar el valor original y crear una versión legible
            $rawDestino = $row['Sal_Destin'];
            $formattedDestino = $rawDestino;
            $destinosArr = json_decode($rawDestino, true);
            if(is_array($destinosArr)){
                $formattedList = [];
                foreach($destinosArr as $destItem){
                    $parts = explode('-', $destItem);
                    $codCasa = isset($parts[0]) ? $db->real_escape_string($parts[0]) : '';
                    $codAnd = isset($parts[1]) ? $db->real_escape_string($parts[1]) : '';
                    $qdest = $db->query("select CAS.Cnd_CodCas, CA.Can_NomAnd from ADCASAND CAS inner join ADCATAND CA on CAS.Cnd_CodAnd = CA.Can_CodAnd where CAS.Cnd_CodCas = '".$codCasa."' and CAS.Cnd_CodAnd = '".$codAnd."' limit 1");
                    if($qdest && $rd = $qdest->fetch_assoc()){
                        $formattedList[] = 'Casa '. $rd['Cnd_CodCas'] .', '. $rd['Can_NomAnd'];
                    } else {
                        $formattedList[] = $destItem;
                    }
                }
                $formattedDestino = implode(', ', $formattedList);
            }

            $detalle['header']=[
                'solicitud'=>$row['Sal_Solici'],
                'fecha'=>$row['Sal_FecSal'],
                'solicitante'=>$row['solicitante'],
                'autorizado'=>$row['autorizado'],
                'entregado'=>'',
                'destino'=>$formattedDestino
            ];
        }
        // buscar nombre del usuario entregado en la BD CONCENT (tipo 1) si existe ID
        if(!empty($entregadoId)){
            $dbConcent = Conectar::conexion(1);
            $uq = $dbConcent->query("select concat(Usu_Nombre,' ',Usu_Apelli) as nombre from CCUSUARI where Usu_Id = ".intval($entregadoId));
            if($uq && $ur = $uq->fetch_assoc()) $detalle['header']['entregado'] = $ur['nombre'];
            $dbConcent->close();
        }
        $sql2 = "select a.Sal_Produc, c.Cri_Descrip, a.Sal_Cantid, a.Sal_Coment
                 from ALSALART a
                 inner join ALCATART c on a.Sal_Produc = c.Cri_Id
                 where a.Sal_Solici = '".$solicitud."'";
        $q2 = $db->query($sql2);
        if($q2){
            while($p = $q2->fetch_assoc()){
                $detalle['productos'][]=[
                    'producto'=>$p['Cri_Descrip'],
                    'cantidad'=>$p['Sal_Cantid'],
                    'comentario'=>$p['Sal_Coment']
                ];
            }
        }
        $db->close();
        return $detalle;
    }

    public function getKardex(){
         $query=$this->db->query("select 
                     Cri_Id
                    ,Cri_Descrip as 'producto'
                    ,Cun_NomClav
                    ,ifnull((select sum(ifnull(Ent_Cantid,0)) as 'entradas' from ALENTART where Ent_Produc = Cri_Id group by Ent_Produc),0) as 'entradas'
                    ,ifnull((select sum(ifnull(Sal_Cantid,0)) as 'salidas' from ALSALART where Sal_Produc = Cri_Id group by Sal_Produc),0) as 'salidas'
                    ,ifnull((select sum(ifnull(Ent_Cantid,0)) as 'entradas' from ALENTART where Ent_Produc = Cri_Id group by Ent_Produc),0)
                         -
                    ifnull((select sum(ifnull(Sal_Cantid,0)) as 'salidas' from ALSALART where Sal_Produc = Cri_Id group by Sal_Produc),0) as 'existencia'
                from ALCATART 
                right join ALENTART on Ent_Produc = Cri_Id
                left join ALSALART on Sal_Produc = Cri_Id
                inner join ADCATUNI on Cri_Unidad = Cun_Id
                group by Cri_Id
                order by Cri_Id");

        if ($query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->kardex[]=$row;
            }
        }else{
            return false;
        }
        $this->db->close();
        return $this->kardex;
    }

    public function getKardexTable(){
        $kardexs=$this->getKardex();

        foreach($kardexs as $kardex){
            
            $this->tableKardex.= <<< EOT
                <tr>
                    <td>{$kardex["producto"]}</td>
                    <td align="center">{$kardex["entradas"]}</td>
                    <td align="center">{$kardex["salidas"]}</td>
                    <td align="center">{$kardex["existencia"]}</td>
                    <td class="text-center">
                    <div class="dropdown ml-auto text-center">
                        <div class="btn-link" data-toggle="dropdown">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void()">Editar</a>
                        </div>
                    </div>
                    </td>
                </tr>
            EOT;

        }
        return $this->tableKardex;
    }

	public function saveEntrada($provid,$fecentra,$requi,$recibe,$productos){
        $sql = "INSERT INTO ALENTART (Ent_Requic, Ent_Provee, Ent_FecEnt, Ent_Recibe, Ent_Produc, Ent_Cantid, Ent_PU, Ent_Total, Ent_FecAlt, Ent_FecMod, Ent_Estatu) values ";
        
        foreach ($productos as $index => $producto) {
            if(count($productos) == 1){
                $sql .= "('".$requi."',".$provid.",'".$fecentra."',".$recibe.",".$producto['prodid'].",".$producto['cantidad'].",".$producto['precio'].",".$producto['subtotal'].",now(),now(),1);";
            }else if($index != count($productos) - 1) {
                $sql .= "('".$requi."',".$provid.",'".$fecentra."',".$recibe.",".$producto['prodid'].",".$producto['cantidad'].",".$producto['precio'].",".$producto['subtotal'].",now(),now(),1),";
            }else{
                $sql .= "('".$requi."',".$provid.",'".$fecentra."',".$recibe.",".$producto['prodid'].",".$producto['cantidad'].",".$producto['precio'].",".$producto['subtotal'].",now(),now(),1);";
            }                
        }
        $result = $this->db->query($sql); 

        if(!$result) {
            $response = "Error en la inserción: ";
        }else{
            $response = ($result) ? true : false;
        }

        $this->db->close();
		return $response;	

	}
    public function saveSalida($solicitud,$solicita,$autoriza,$entrega,$fecsale,$destino,$productos){
        $sql = "INSERT INTO ALSALART (Sal_Solici, Sal_SolPer, Sal_Autori, Sal_Entreg, Sal_FecSal, Sal_Destin, Sal_Produc, Sal_Cantid, Sal_Coment, Sal_FecAlt, Sal_FecMod, Sal_Estatu) values ";

        foreach ($productos as $index => $producto) {
            if(count($productos) == 1){
                $sql .= "(concat('".$solicitud."/',replace(date_format(now(), '%Y-%m-%d %T'), ' ', '/')),'".$solicita."','".$autoriza."',".$entrega.",'".$fecsale."', '".json_encode($destino)."',".$producto['prodid'].",".$producto['cantidad'].",'".$producto['comentario']."',now(),now(),1);";
            }else if($index != count($productos) - 1) {
                $sql .= "(concat('".$solicitud."/',replace(date_format(now(), '%Y-%m-%d %T'), ' ', '/')),'".$solicita."','".$autoriza."',".$entrega.",'".$fecsale."', '".json_encode($destino)."',".$producto['prodid'].",".$producto['cantidad'].",'".$producto['comentario']."',now(),now(),1),";
            }else{
                $sql .= "(concat('".$solicitud."/',replace(date_format(now(), '%Y-%m-%d %T'), ' ', '/')),'".$solicita."','".$autoriza."',".$entrega.",'".$fecsale."', '".json_encode($destino)."',".$producto['prodid'].",".$producto['cantidad'].",'".$producto['comentario']."',now(),now(),1);";
            }       
        }
        
        $result = $this->db->query($sql); 

        if(!$result) {
            $response = "Error en la inserción: ";
        }else{
            $response = ($result) ? true : false;
        }

        $this->db->close();
		return $response;	
    }
}
?>
