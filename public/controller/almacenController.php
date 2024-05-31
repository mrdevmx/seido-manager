<?php
//Llamada al modelo
require_once($path."model/almacenModel.php");
require_once($path."model/usuarioModel.php");
$usuario = new usuariosModel();
$movResumen = new almacenModel();
$almacen = new almacenModel();

if(isset($_POST["modo"])){
    if($_POST["modo"] == 1){
        $saveEntrada = new almacenModel();
        $response = $saveEntrada->saveEntrada($_POST["provid"],$_POST["requi"],$_POST["recibe"],$_POST["productos"]);
        echo $response;
    }else{
        $saveSalida = new almacenModel();
        $response = $saveSalida->saveSalida($_POST["solicitud"],$_POST["solicita"],$_POST["autoriza"],$_POST["entrega"],$_POST["destino"],$_POST["productos"]);
        echo $response;
    }
}else{
    $timelineMovimientosResumen=$movResumen->timelineMovimientosResumen();
    $tableKardex=$almacen->getKardexTable();
    $usuarioSelect=$usuario->getUsuarioSelect();
    //Llamada a la vista
require_once($path."view/almacen/almacen.php");
};

?>
