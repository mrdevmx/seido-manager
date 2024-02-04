<?php
//Llamada al modelo
require_once($path."model/usuarioModel.php");
$usuarios = new usuariosModel();
$table=$usuarios->getUsuariosTable();


//Llamada a la vista
require_once($path."view/usuarios/usuarios.php");
?>
