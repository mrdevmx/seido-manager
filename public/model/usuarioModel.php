<?php
/*
****************************************************************************
** DESCRIPCION: Modelo usuarios para login						        ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Creò:       Jesus Alberto Martinez rodriguez						    ****
** Fecha:		31/Agosto/2023											****
****************************************************************************
*/
class usuariosModel{
    private $table = 'usuarios';
    private $db;
    private $typeConnection = 1;
    private $usuarios;
    private $tableView;
 
    public function __construct(){
        $this->db=Conectar::conexion($this->typeConnection);
        $this->usuarios=array();
    }
    public function getUsuarios(){
        $query=$this->db->query("select * from ".$this -> table);
        if ($query->num_rows > 0) {
            while($row=$query->fetch_assoc()){
                $this->usuarios[]=$row;
            }
        }else{
            return false;
        }
        $this->db->close();
        return $this->usuarios;
    }

    public function getUsuarioById($id){
		$query=$this->db->query("select * from ".$this->table." where id = ".$id);
        if ($query->num_rows > 0) {
		    while($row=$query->fetch_assoc()){
                $this->usuarios[]=$row;
            }
        }else{
            return false;
        }

		$this->db->close();
        return $this->usuarios;
	}

    public function getUsuariosTable(){
        $usuarios=$this->getUsuarios();
        $i=1;
        foreach($usuarios as $usuario){
            $estatus = ($usuario["estatus"] == 1) ? '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Activo</span>' : '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Inactivo</span>';
            $this->tableView.= <<< EOT
                <tr>
                    <td align="center">$i</td>
                    <td>{$usuario["nombre"]} {$usuario["apellido"]}</td>
                    <td align="center">{$usuario["correo"]}</td>
                    <td>$estatus</td>
                    <td class="text-center">
                    <div class="dropdown ml-auto text-center">
                        <div class="btn-link" data-toggle="dropdown">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" onclick=" return cargardatos({$usuario["id"]})" href="javascript:void()">Editar</a>
                            <a class="dropdown-item" onclick=" return cargarid({$usuario["id"]})" data-toggle="modal" data-target="#modalUsuarioContrasenia" href="javascript:void()">Cambiar Contraseña</a>
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
