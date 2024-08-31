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
    require_once("../auth/validate-permissions.php");
    $auth = new validateAuth();
    $validate = $auth->validate_route($permisos, $route[2]);

    if($validate){
        $path = "./";
        $pathTheme = "./src/";
        require_once("./controller/dashboard.php");
    }else{
        header('Location: ./'.$pathprincipal);
    }
}
?>
