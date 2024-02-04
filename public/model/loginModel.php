<?php
/*
****************************************************************************
** DESCRIPCION: Modelo para el login 					                ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Creò:       Jesus Alberto Martinez rodriguez						    ****
** Fecha:		07/Octubre/2023											****
****************************************************************************
*/
class loginModel{
    private $table = 'usuarios';
    private $db;
    private $typeConnection = 1; // 1 controlcentral
    private $usuarios;
 
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
}
?>
