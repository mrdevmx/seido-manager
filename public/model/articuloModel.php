<?php
/*
****************************************************************************
** DESCRIPCION: Modelo articulos					                    ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Creó:       Jesus Alberto Martinez Rodriguez						    ****
** Fecha:		03/Marzo/2024											****
****************************************************************************
*/
class articulosModel{
    private $table = 'ALCATART';
    private $db;
    private $typeConnection = 2;
    private $articulos;
    private $tableView;
 
    public function __construct(){
        $this->db=Conectar::conexion($this->typeConnection);
        $this->articulos=array();
    }
    public function getarticulos(){
        $query=$this->db->query("select 
                                     Cri_Id
                                    ,Cri_Descrip
                                    ,Cun_NomClav
                                    ,convert(Cri_FecAlta, char(10)) as Cri_FecAlta
                                    ,Cri_Estatus
                                from ".$this -> table." 
                                inner join ADCATUNI on Cun_Id  = Cri_Unidad");
        if ($query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->articulos[]=$row;
            }
        }else{
            return false;
        }
        $this->db->close();
        return $this->articulos;
    }

    public function getArticuloById($id){
		$query=$this->db->query("select
                                     Cri_Id
                                    ,Cri_Descrip
                                    ,Cri_Unidad
                                    ,Cri_Proveed
                                    ,Cri_Familia
                                    ,convert(Cri_FecAlta, char(10)) as Cri_FecAlta
                                    ,convert(Cri_FecModi, char(10)) as Cri_FecModi
                                    ,Cri_Estatus 
                                from ".$this->table." where Cri_Id = ".$id);
        if ($query->num_rows > 0) {
		    while($row=$query->fetch_assoc()){
                $this->articulos[]=$row;
            }
        }else{
            return false;
        }

		$this->db->close();
        return $this->articulos;
	}

    public function getArticulosTable(){
        $articulos=$this->getarticulos();
        $i=1;
        foreach($articulos as $articulo){
            $estatus = ($articulo["Cri_Estatus"] == 1) ? '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Activo</span>' : '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Inactivo</span>';
            $this->tableView.= <<< EOT
                <tr>
                    <td align="center">$i</td>
                    <td>{$articulo["Cri_Descrip"]}</td>
                    <td>{$articulo["Cun_NomClav"]}</td>
                    <td>$estatus</td>
                    <td class="text-center">
                    <div class="dropdown ml-auto text-center">
                        <div class="btn-link" data-toggle="dropdown">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" onclick=" return cargardatos({$articulo["Cri_Id"]})" href="javascript:void()">Editar</a>
                        </div>
                    </div>
                    </td>
                </tr>
            EOT;
            $i++;
        }
        return $this->tableView;
    }

    public function saveArticulo($producto,$unidad,$proveedores){

        $sql = "INSERT INTO ALCATART (Cri_CodBarr, Cri_Descrip, Cri_Unidad, Cri_FecAlta, Cri_FecModi, Cri_Estatus, Cri_Familia, Cri_Proveed) values ";
        $sql .= "(0,'".$producto."',".$unidad.",now(),now(),1,0, '".json_encode($proveedores)."');";

        $result = $this->db->query($sql); 

        if(!$result) {
            $response = "Error en la inserción: ";
        }else{
            $response = ($result) ? true : false;
        }

        $this->db->close();
		return $response;	
    }

    public function updateArticulo($id,$producto,$unidad,$proveedores){

        $sql = "UPDATE ALCATART SET  Cri_CodBarr = 0, Cri_Descrip = '".$producto."', Cri_Unidad = ".$unidad.", Cri_Proveed = '".json_encode($proveedores)."' where Cri_Id = ".$id;

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
