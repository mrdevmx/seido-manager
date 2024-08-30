<?php
//Llamada al modelo
require_once($path."model/loginModel.php");

if(isset($_POST["email"])){
    $login = new loginModel();
    $response = $login->accessUser($_POST["email"], $_POST["pass"]);
    echo $response;
}else{
    //Llamada a la vista
require_once($path."view/auth/login.php");
}
?>
