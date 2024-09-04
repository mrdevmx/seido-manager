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

    require_once("../auth/validate-permissions.php");
    $auth = new validateAuth();
    $validate = $auth->validate_route($permisos, $_SERVER["PHP_SELF"]);

    if($validate){
        $path = "./";
        $pathTheme = "./src/";
        require_once("./controller/proveedorController.php");
    }else{
        require_once("./controller/sessionValidateController.php");
    }
    
}
?>
