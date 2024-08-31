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
    
    switch ($permisos) {
        case 2:
          header('Location: ./admin');
          break;
        case 3:
          header('Location: ./admin');
          break;
        case 4:
          header('Location: ./admin');
          break;
        case 5:
          header('Location: ./admin');
          break;
        case 6:
          header('Location: ./almacen');
          break;  
        default:
         header('Location: ./admin');
    }

    //$path = "./";
    //$pathTheme = "./src/";
    //require_once("./controller/dashboard.php");
}
?>
