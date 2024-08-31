<?php
/*
****************************************************************************
** DESCRIPCION: Clase para validar los permisos de usuario					    ****
****************************************************************************
** REFERENCIAS:                                                         ****
****************************************************************************
** Creó: Jesus Alberto Martinez Rodriguez						                    ****
** Fecha: 24/Agosto/2024											                          ****
****************************************************************************
*/
class validateAuth{
    private $rutas = 'CCCATRUT';
    private $db;
    private $typeConnection = 1;
    private $permisos;

    public function __construct(){
      $this->db=Conectar::conexion($this->typeConnection);
      $this->permisos=array();
    }

    public function validate_route($permiso, $route){
      $sql = "select Cru_IdPermi from ".$this->rutas." where Cru_Ruta = '".$route."'";
      $query=$this->db->query($sql);
        if ($query->num_rows > 0) {
		    while($row=$query->fetch_assoc()){
                $this->permisos[]=$row;
                $data = json_decode($this->permisos[0]["Cru_IdPermi"]);
                $validate = in_array($permiso, $data) ? true : false;
            }
        }else{
            return false;
        }

		    $this->db->close();
        return $validate;
    }

    public function validate_module($permisos, $route){
        $validate = $this->validate_route($permisos, $route[2]);
        var_dump($validate);
        switch ($permisos) {
            case 2:
              $validate == true ? exit() : header('Location: ./admin');
              break;
            case 3:
              $validate == true ? exit() : header('Location: ./admin');
              break;
            case 4:
              $validate == true ? exit() : header('Location: ./admin');
              break;
            case 5:
              $validate == true ? exit() : header('Location: ./admin');
              break;
            case 6:
              $validate == true ? exit() : header('Location: ./almacen');
              break;  
            default:
            $validate == true ? exit() : header('Location: ./admin');
        }
        //return $module;
    }
}
?>