<?php
//Llamada al modelo
require_once($path."model/almacenModel.php");
$almacen = new almacenModel();
//$table=$usuarios->getUsuariosTable();

if(isset($_POST["provid"])){
    $response = $almacen->guardaEntrada($_POST["provid"],$_POST["requi"],$_POST["recibe"],$_POST["productos"]);
    echo $response;
}else{
    //Llamada a la vista
require_once($path."view/almacen/almacen.php");
};

?>
