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
    private $tableView;
 
    public function __construct(){
        $this->db=Conectar::conexion($this->typeConnection);
        $this->entradas=array();
        $this->salidas=array();
        $this->kardex=array();
        $this->movimientosResumen=array();
    }
    public function getMovimientosResumen(){
        $set=$this->db->query("set lc_time_names = 'es_MX'");
        $query=$this->db->query("select 
                                     Ent_Requic as 'origen'
                                    ,Cpo_NomCome as 'destino'
                                    ,case 
                                        when hour(timediff(now(), Ent_FecMod)) > 0 and hour(timediff(now(), Ent_FecMod)) < 12 then concat('Hace ',hour(timediff(now(), Ent_FecMod)),' horas' )
                                        when hour(timediff(now(), Ent_FecMod)) > 11 then concat('Hace ',datediff(now(), Ent_FecMod),' días')
                                        when datediff(now(), Ent_FecMod) > 3 then concat('El ',date_format(Ent_FecMod,'%d %M %Y'))
                                        else concat('Hace ',minute(timediff(now(), Ent_FecMod)),' minutos' ) 
                                     end as 'fecha'
                                    ,count(Ent_Requic) as 'productos'
                                    ,concat('$',format(sum(round(Ent_Total,2)), 2, 'en_US')) as 'total'
                                    ,1 as 'tipo'
                                 from ALENTART 
                                 inner join ADCATPRO on Ent_Provee = Cpo_Id 
                                 where Ent_Estatu = 1 
                                 group by Ent_Requic, Ent_Provee, Ent_FecMod
                                 order by Ent_FecMod desc");
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
            $tipo = ($movimiento["tipo"] == 1) ? 'primary' : 'danger';
            $this->tMR.= <<< EOT
                            <li>
                                <div class="timeline-badge $tipo"></div>
                                <a class="timeline-panel text-muted" href="#">
                                    <span>{$movimiento["fecha"]}</span>
                                    <h6 class="mb-0"><strong>Entrada</strong> de requisición <strong class="text-$tipo">{$movimiento["origen"]}</strong>, del proovedor <strong class="text-$tipo">{$movimiento["destino"]}</strong> con <strong class="text-$tipo">{$movimiento["productos"]}</strong> productos y un total de <strong class="text-$tipo">{$movimiento["total"]}</strong>.</h6>
                                </a>
                            </li>
            EOT;
            $i++;
        }
        return $this->tMR;
    }

	public function guardaEntrada($provid,$requi,$recibe,$productos){

        $sql = "INSERT INTO ALENTART (Ent_Requic, Ent_Provee, Ent_Recibe, Ent_Produc, Ent_Cantid, Ent_PU, Ent_Total, Ent_FecAlt, Ent_FecMod, Ent_Estatu) values ";
        
        foreach ($productos as $index => $producto) {
            if(count($productos) == 1){
                $sql .= "('".$requi."',".$provid.",".$recibe.",".$producto['prodid'].",".$producto['cantidad'].",".$producto['precio'].",".$producto['subtotal'].",now(),now(),1);";
            }else if($index != count($productos) - 1) {
                $sql .= "('".$requi."',".$provid.",".$recibe.",".$producto['prodid'].",".$producto['cantidad'].",".$producto['precio'].",".$producto['subtotal'].",now(),now(),1),";
            }else{
                $sql .= "('".$requi."',".$provid.",".$recibe.",".$producto['prodid'].",".$producto['cantidad'].",".$producto['precio'].",".$producto['subtotal'].",now(),now(),1);";
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
