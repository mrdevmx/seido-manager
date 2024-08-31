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
    
    
    header('Location: ./'.$pathprincipal);
}
?>
