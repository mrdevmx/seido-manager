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
    private $table = 'CCUSUARI';
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

    public function accessUser($email, $pass){
        $sql = "select
                     Usu_Id
                    ,Usu_Nombre
                    ,Usu_Apelli
                    ,Usu_Correo
                    ,Usu_Contra
                    ,Usu_TipUsu AS tipous
                    ,Usu_Empres 
                from ".$this->table." where Usu_Correo='".$email."@arctec.com.mx'";

		$query=$this->db->query($sql);
        if ($query->num_rows > 0) {
		    while($row=$query->fetch_assoc()){
                $this->usuarios[]=$row;
                $passEncrypt = $this->usuarios[0]['Usu_Contra'];
                $passUncrypt = uncrypt($passEncrypt);

                if (password_verify($pass, $passUncrypt)) {
                    $sn = explode(" ", $this->usuarios[0]['Usu_Nombre']);
                    $shortName = $sn[0];
        
                    $sl = explode(" ", $this->usuarios[0]['Usu_Apelli']);
                    $shortLastname = $sl[0];
                    
                    session_start();
                    $_SESSION['userid'] = $this->usuarios[0]['Usu_Id'];
                    $_SESSION['username']   = $this->usuarios[0]['nombre'];
                    $_SESSION['shortname']   = $shortName;
                    $_SESSION['shortlastname']   = $shortLastname;
                    $_SESSION['usermail']   = $this->usuarios[0]['Usu_Correo'];
                    $_SESSION['tipous']   = $this->usuarios[0]['tipous'];
                    $_SESSION['company']   = $this->usuarios[0]['Usu_Empres '];
                    $return = true;
                } else {
                    $return = 'Usuario o contraseña incorrecto';
                }
            }
        }else{
            $return = 'Usuario o contraseña incorrecto';
        }

		$this->db->close();
        return $return;
	}
}
?>
