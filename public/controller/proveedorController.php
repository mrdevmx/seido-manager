<?php
//Llamada al modelo
require_once($path."model/proveedorModel.php");
require_once($path."model/regimenFiscalModel.php");

$proveedores = new proveedoresModel();
$table=$proveedores->getProveedoresTable();

$regimen = new regimenFiscalModel();
$selectRegimen=$regimen->getRegimenesSelect();

if(isset($_POST["modo"])){
    switch ($_POST["modo"]) {
        case 0:
            $saveProveedor = new proveedoresModel();
            $response = $saveProveedor->saveProveedor($_POST["nomco"],$_POST["raso"],$_POST["rfc"],$_POST["tel"],$_POST["regimen"]);
          break;
        case 1:
            $updateProveedor = new proveedoresModel();
            $response = $updateProveedor->updateProveedor($_POST["id"],$_POST["nomco"],$_POST["raso"],$_POST["rfc"],$_POST["tel"],$_POST["regimen"]);
          break;
        case 2:
            $getProveedor = new proveedoresModel();
            echo $response = json_encode($getProveedor->getProveedorById($_POST["id"]));
          break;
        default:
            $response = false;
    } 
}else{
    //Llamada a la vista
    require_once($path."view/catalogos/proveedores/catproveedores.php");
}
?>
