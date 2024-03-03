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
        $query=$this->db->query("select * from ".$this -> table);
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
		$query=$this->db->query("select * from ".$this->table." where Cri_Id = ".$id);
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
                    <td align="center">{$articulo["Cri_SKU"]}</td>
                    <td align="center">{$articulo["Cri_Unidad"]}</td>
                    <td align="center">{$articulo["Cri_FecAlta"]}</td>
                    <td>$estatus</td>
                    <td class="text-center">
                    <div class="dropdown ml-auto text-center">
                        <div class="btn-link" data-toggle="dropdown">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" onclick=" return cargardatos({$articulo["Cri_Estatus"]})" href="javascript:void()">Editar</a>
                            <a class="dropdown-item" onclick=" return cargarid({$articulo["Cri_Estatus"]})" data-toggle="modal" data-target="#modalarticuloContrasenia" href="javascript:void()">Cambiar Contraseña</a>
                        </div>
                    </div>
                    </td>
                </tr>
            EOT;
            $i++;
        }
        return $this->tableView;
    }
}
?>
