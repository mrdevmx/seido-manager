<?php
//Llamada al modelo
require_once($path."model/loginModel.php");
$login = new loginModel();
//$table=$usuarios->getUsuariosTable();


//Llamada a la vista
require_once($path."view/login/login.php");
?>
