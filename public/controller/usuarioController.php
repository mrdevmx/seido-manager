<?php
//Llamada al modelo
require_once($path."model/usuarioModel.php");

if(isset($_POST["modo"])){
    $correo = str_replace('@arctec.com.mx','',$_POST["correo"]);
    switch ($_POST["modo"]) {
        case 0:
            $saveUsuario = new usuariosModel();
            $response = $saveUsuario->saveUsuario($_POST["nombre"],$_POST["apellido"],$correo,$_POST["contrasena"],$_POST["tipous"]);
          break;
        case 1:
            $updateUsuario = new usuariosModel();
            $response = $updateUsuario->updateUsuario($_POST["id"],$_POST["nombre"],$_POST["apellido"],$correo,$_POST["tipous"]);
          break;
        case 2:
            $getUsuario = new usuariosModel();
            echo $response = json_encode($getUsuario->getUsuarioById($_POST["id"]));
          break;
        case 3:
            $updateUsuarioContra = new usuariosModel();
            echo $response = $updateUsuarioContra->updateUsuarioContra($_POST["idcontrasenia"],encrypt($_POST["contrasenaid"]));
          break;
        default:
            $response = false;
    } 
}else{
    $usuarios = new usuariosModel();
    $table=$usuarios->getUsuariosTable();
    //Llamada a la vista
    require_once($path."view/usuarios/usuarios.php");
}
?>
