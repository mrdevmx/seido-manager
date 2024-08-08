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
                                <a class="timeline-panel text-muted" href="javascript:void()">
                                    <span>{$movimiento["fecha"]}</span>
                                    <h6 class="mb-0"><strong>Entrada</strong> de requisición <strong class="text-$tipo">{$movimiento["origen"]}</strong>, del proovedor <strong class="text-$tipo">{$movimiento["destino"]}</strong> con <strong class="text-$tipo">{$movimiento["productos"]}</strong> productos y un total de <strong class="text-$tipo">{$movimiento["total"]}</strong>.</h6>
                                </a>
                            </li>
                EOT;
            }else{
                $destino ='';
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
