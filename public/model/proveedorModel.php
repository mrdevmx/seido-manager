<?php
/*
****************************************************************************
** DESCRIPCION: Modelo proveedores					                        ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Creó:       Jesus Alberto Martinez Rodriguez						    ****
** Fecha:		27/Mayo/2024											****
****************************************************************************
*/
class proveedoresModel{
    private $table = 'ADCATPRO';
    private $db;
    private $typeConnection = 2;
    private $proveedores;
    private $tableView;
    private $selectView;
 
    public function __construct(){
        $this->db=Conectar::conexion($this->typeConnection);
        $this->proveedores=array();
    }
    public function getProveedores(){
        $query=$this->db->query("select 
                                     Cpo_Id
                                    ,Cpo_NomCome
                                    ,Cpo_RFC
                                    ,Cpo_RazSoci
                                    ,Cpo_RegFisc
                                    ,Cpo_Telefon
                                    ,Cpo_LimCred
                                    ,convert(Cpo_FecAlta, char(10)) as Cpo_FecAlta
                                    ,convert(Cpo_FecModi, char(10)) as Cpo_FecModi
                                    ,Cpo_Estatus
                                from ".$this -> table);
        if ($query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->proveedores[]=$row;
            }
        }else{
            return false;
        }
        $this->db->close();
        return $this->proveedores;
    }

    public function getProveedorById($id){
		$query=$this->db->query("select * from ".$this->table." where Cpo_Id = ".$id);
        if ($query->num_rows > 0) {
		    while($row=$query->fetch_assoc()){
                $this->proveedores[]=$row;
            }
        }else{
            return false;
        }

		$this->db->close();
        return $this->proveedores;
	}

    public function getProveedoresTable(){
        $proveedores=$this->getProveedores();
        $i=1;
        foreach($proveedores as $proveedor){
            $estatus = ($proveedor["Cri_Estatus"] == 1) ? '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Activo</span>' : '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Inactivo</span>';
            $this->tableView.= <<< EOT
                <tr>
                    <td align="center">$i</td>
                    <td>{$proveedor["Cri_Descrip"]}</td>
                    <td>{$proveedor["Cri_SKU"]}</td>
                    <td>{$proveedor["Cun_NomClav"]}</td>
                    <td>{$proveedor["Cri_PreUnit"]}</td>
                    <td>{$proveedor["Cpo_NomCome"]}</td>
                    <td>$estatus</td>
                    <td class="text-center">
                    <div class="dropdown ml-auto text-center">
                        <div class="btn-link" data-toggle="dropdown">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" onclick=" return cargardatos({$proveedor["Cri_Estatus"]})" href="javascript:void()">Editar</a>
                            <a class="dropdown-item" onclick=" return cargarid({$proveedor["Cri_Estatus"]})" data-toggle="modal" data-target="#modalarticuloContrasenia" href="javascript:void()">Cambiar Contraseña</a>
                        </div>
                    </div>
                    </td>
                </tr>
            EOT;
            $i++;
        }
        return $this->tableView;
    }

    public function getProveedoresSelect(){
        $proveedores=$this->getProveedores();
        $i=1;
        foreach($proveedores as $proveedor){

            $this->selectView.= <<< EOT
                <option value="{$proveedor['Cpo_Id']}">{$proveedor["Cpo_NomCome"]}</option>
            EOT;
            $i++;
        }
        return $this->selectView;
    }
}
?>
