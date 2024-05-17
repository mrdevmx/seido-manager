<?php
//Llamada al modelo
require_once($path."model/almacenModel.php");
$movResumen = new almacenModel();
$almacen = new almacenModel();

if(isset($_POST["modo"])){
    if($_POST["modo"] == 1){
        $response = $almacen->guardaEntrada($_POST["provid"],$_POST["requi"],$_POST["recibe"],$_POST["productos"]);
        echo $response;
    }else{
        $response = $almacen->guardaSalida($_POST["solicitud"],$_POST["solicita"],$_POST["autoriza"],$_POST["entrega"],$_POST["destino"],$_POST["productos"]);
        echo $response;
    }
}else{
    $timelineMovimientosResumen=$movResumen->timelineMovimientosResumen();
    $tableKardex=$almacen->getKardexTable();
    //Llamada a la vista
require_once($path."view/almacen/almacen.php");
};

?>
