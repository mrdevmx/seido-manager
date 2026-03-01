<?php
/*
****************************************************************************
** DESCRIPCION: Modelo almacen					                        ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Creó:       Jesus Alberto Martinez Rodriguez						    ****
** Fecha:		03/Abril/2024											****
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
        // reset acumulador para evitar duplicados en llamadas repetidas
        $this->movimientosResumen = array();
        $query=$this->db->query("(select 
                                     Ent_Requic as 'origen'
                                    ,Cpo_NomCome as 'destino'
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
        if ($query && $query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->movimientosResumen[]=$row;
            }
        }else{
            return false;
        }
        return $this->movimientosResumen;
    }

    public function timelineMovimientosResumen(){
        $movimientos=$this->getMovimientosResumen();
        $i=1;
        // reset timeline string
        $this->tMR = '';
        foreach($movimientos as $movimiento){
            $tipo = ($movimiento["tipo"] == 1) ? 'success' : 'danger';

            if($movimiento["tipo"] == 1){
                $this->tMR.= <<< EOT
                            <li>
                                <div class="timeline-badge $tipo"></div>
                                <a class="timeline-panel text-muted" href="javascript:void()">
                                    <span>{$movimiento["fecha"]}</span>
                                    <h6 class="mb-0"><strong>Entrada</strong> de requisición <strong class="text-$tipo">{$movimiento["origen"]}</strong>, del proovedor <strong class="text-$tipo">{$movimiento["destino"]}</strong> con <strong class="text-$tipo">{$movimiento["productos"]}</strong> productos y un total de <strong class="text-$tipo">{$movimiento["total"]}</strong>.</h6>
                                </a>
                            </li>
                EOT;
            }else{
                $destino ='';
                $badge = '';
                foreach(json_decode($movimiento["destino"]) as $index => $destino){
                    $badge .='<span class="badge badge-rounded light badge-info col">'.$destino.'</span>';
                }
    
                $this->tMR.= <<< EOT
                            <li>
                                <div class="timeline-badge $tipo"></div>
                                <a class="timeline-panel text-muted" href="javascript:void()">
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

    public function getKardex(){
            // reset kardex para evitar que llamadas repetidas acumulen filas
            $this->kardex = array();
            $query=$this->db->query("SELECT c.Cri_Id,
                       c.Cri_Descrip AS producto,
                       cun.Cun_NomClav,
                       COALESCE(e.entradas,0) AS entradas,
                       COALESCE(s.salidas,0) AS salidas,
                       (COALESCE(e.entradas,0) - COALESCE(s.salidas,0)) AS existencia,
                       (SELECT MAX(Ent_FecMod) FROM ALENTART WHERE Ent_Produc = c.Cri_Id AND Ent_Estatu = 1) AS last_ent,
                       (SELECT MAX(Sal_FecAlt) FROM ALSALART WHERE Sal_Produc = c.Cri_Id AND Sal_Estatu = 1) AS last_sal
                FROM ALCATART c
                LEFT JOIN ADCATUNI cun ON c.Cri_Unidad = cun.Cun_Id
                LEFT JOIN (
                    SELECT Ent_Produc, SUM(Ent_Cantid) AS entradas
                    FROM ALENTART
                    WHERE Ent_Estatu = 1
                    GROUP BY Ent_Produc
                ) e ON e.Ent_Produc = c.Cri_Id
                LEFT JOIN (
                    SELECT Sal_Produc, SUM(Sal_Cantid) AS salidas
                    FROM ALSALART
                    WHERE Sal_Estatu = 1
                    GROUP BY Sal_Produc
                ) s ON s.Sal_Produc = c.Cri_Id
                ORDER BY c.Cri_Id");

        if ($query && $query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->kardex[]=$row;
            }
        }
        return $this->kardex;
    }

    /**
     * Obtener productos con existencia menor o igual al umbral
     * Retorna un array asociativo: [ ['Cri_Id'=>..., 'producto'=>..., 'entradas'=>..., 'salidas'=>..., 'existencia'=>...], ... ]
     */
    public function getLowStock($threshold = 5){
        $kardex = $this->getKardex();
        $low = array();
        foreach($kardex as $row){
            $exist = isset($row['existencia']) ? intval($row['existencia']) : 0;
            if ($exist <= intval($threshold)){
                $low[] = $row;
            }
        }
        return $low;
    }

    /**
     * Productos con existencia negativa (inconsistencia de datos)
     */
    public function getNegativeStock(){
        $kardex = $this->getKardex();
        $neg = array();
        foreach($kardex as $row){
            $exist = isset($row['existencia']) ? intval($row['existencia']) : 0;
            if ($exist < 0){
                $neg[] = $row;
            }
        }
        return $neg;
    }

    /**
     * Productos con existencia exactamente 0
     */
    public function getZeroStock($limit = 100){
        $kardex = $this->getKardex();
        $zero = array();
        foreach($kardex as $row){
            $exist = isset($row['existencia']) ? intval($row['existencia']) : 0;
            if ($exist === 0){
                $zero[] = $row;
            }
        }
        return $zero;
    }

    /**
     * Entradas pendientes (Ent_Estatu != 1)
     */
    public function getPendingEntries($limit = 10){
        $sql = "SELECT Ent_Requic, Ent_Provee, Cpo_NomCome AS proveedor, Ent_FecEnt, SUM(Ent_Cantid) AS total_items, Ent_Estatu
                FROM ALENTART
                LEFT JOIN ADCATPRO ON Ent_Provee = Cpo_Id
                WHERE Ent_Estatu <> 1
                GROUP BY Ent_Requic, Ent_Provee, Ent_FecEnt, Ent_Estatu
                ORDER BY Ent_FecAlt DESC
                LIMIT " . intval($limit);

        $result = $this->db->query($sql);
        $pend = array();
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $pend[] = $row;
            }
        }
        return $pend;
    }

    /**
     * Productos sin movimiento en los ultimos N dias
     */
    public function getNoMovement($days = 30, $limit = 20){
        // Calcula la última entrada y última salida por producto, y filtra aquellos cuya última actividad
        // (entrada o salida) es anterior a NOW() - INTERVAL $days DAY.
                $sql = "SELECT c.Cri_Id, c.Cri_Descrip AS producto,
                                             e.ultima_ent, s.ultima_sal,
                                             e.ultima_ent AS last_activity
                                FROM ALCATART c
                                LEFT JOIN (SELECT Ent_Produc, MAX(Ent_FecMod) AS ultima_ent FROM ALENTART WHERE Ent_Estatu = 1 GROUP BY Ent_Produc) e ON e.Ent_Produc = c.Cri_Id
                                LEFT JOIN (SELECT Sal_Produc, MAX(Sal_FecAlt) AS ultima_sal FROM ALSALART WHERE Sal_Estatu = 1 GROUP BY Sal_Produc) s ON s.Sal_Produc = c.Cri_Id
                                WHERE e.ultima_ent IS NOT NULL
                                    AND UNIX_TIMESTAMP(e.ultima_ent) < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL " . intval($days) . " DAY))
                                ORDER BY e.ultima_ent ASC
                                LIMIT " . intval($limit);

        $result = $this->db->query($sql);
        $nomv = array();
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $nomv[] = $row;
            }
        }
        return $nomv;
    }

    /**
     * Productos con aumento de consumo: compara salidas del mes actual vs mes anterior.
     * Devuelve productos donde las salidas del mes actual > salidas del mes anterior.
     * @param int $limit max rows to return
     */
    public function getHighConsumption($limit = 200){
        $sql = "SELECT p.Cri_Id, p.Cri_Descrip AS producto,
                       COALESCE(curr.cnt,0) AS current_month_cnt,
                       COALESCE(prev.cnt,0) AS prev_month_cnt
                FROM ALCATART p
                LEFT JOIN (
                    SELECT Sal_Produc, SUM(Sal_Cantid) AS cnt
                    FROM ALSALART
                    WHERE Sal_Estatu = 1
                      AND YEAR(Sal_FecAlt) = YEAR(NOW())
                      AND MONTH(Sal_FecAlt) = MONTH(NOW())
                    GROUP BY Sal_Produc
                ) curr ON curr.Sal_Produc = p.Cri_Id
                LEFT JOIN (
                    SELECT Sal_Produc, SUM(Sal_Cantid) AS cnt
                    FROM ALSALART
                    WHERE Sal_Estatu = 1
                      AND YEAR(Sal_FecAlt) = YEAR(DATE_SUB(NOW(), INTERVAL 1 MONTH))
                      AND MONTH(Sal_FecAlt) = MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH))
                    GROUP BY Sal_Produc
                ) prev ON prev.Sal_Produc = p.Cri_Id
                WHERE COALESCE(curr.cnt,0) > COALESCE(prev.cnt,0)
                ORDER BY (COALESCE(curr.cnt,0) - COALESCE(prev.cnt,0)) DESC
                LIMIT " . intval($limit);

        $result = $this->db->query($sql);
        $high = array();
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $high[] = $row;
            }
        }
        return $high;
    }

    public function getKardexTable(){
        // reset table HTML buffer
        $this->tableKardex = '';
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
