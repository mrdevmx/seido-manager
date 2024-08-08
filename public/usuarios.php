<?php
session_start();
if(!isset($_SESSION['userid'])){
    header('Location: ./login.php');
}else{
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $shortname = $_SESSION['shortname'];
	$shortlastname = $_SESSION['shortlastname'];
    $permisos = $_SESSION['tipous'];
    $company = $_SESSION['company'];

    $path = "./";
    $pathTheme = "./src/";
    require_once('../vendor/autoload.php');
    require_once("../db/db.php");
    require_once("./controller/usuarioController.php");
}
?>
