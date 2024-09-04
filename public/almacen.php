<?php
session_start();
if(!isset($_SESSION['userid'])){
    header('Location: ./login');
}else{
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $shortname = $_SESSION['shortname'];
	$shortlastname = $_SESSION['shortlastname'];
    $permisos = $_SESSION['tipous'];
    $company = $_SESSION['company'];
    $pathprincipal = $_SESSION['path'];

    require_once('../vendor/autoload.php');
    require_once("../db/db.php");

    $route = explode("/", $_SERVER['REQUEST_URI']);
    $string = $_SERVER["PHP_SELF"];
    var_dump($string);
    $posicion  = strpos($_SERVER["PHP_SELF"], 'public');
    var_dump($posicion.'<br/>');
    $parte1 = substr($string,$posicion);
    var_dump($parte1.'<br/>');
    $parte2 = str_replace("public/","",$parte1);
    var_dump($parte2.'<br/>');
    $parte3 = str_replace(".php","",$parte2);
    var_dump($parte3.'<br/>');
    require_once("../auth/validate-permissions.php");
    $auth = new validateAuth();
    $validate = $auth->validate_route($permisos, $route[2]);
    var_dump($validate);
    if($validate){
        $path = "./";
        $pathTheme = "./src/";
        require_once("./controller/almacenController.php");
    }else{
        //require_once("./controller/sessionValidateController.php");
    }
}
?>
