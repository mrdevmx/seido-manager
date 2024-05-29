<?php
//Llamada al modelo
require_once($path."model/articuloModel.php");
require_once($path."model/unidadModel.php");
require_once($path."model/proveedorModel.php");

$articulos = new articulosModel();
$table=$articulos->getArticulosTable();

$unidades = new unidadesModel();
$selectUnidades=$unidades->getUnidadesSelect();

$proveedores = new proveedoresModel();
$selectProveedores=$proveedores->getProveedoresSelect();

if(isset($_POST["modo"])){
    if($_POST["modo"] == 0){
        $saveProducto = new articulosModel();
        $response = $saveProducto->saveArticulo($_POST["producto"],$_POST["unidad"],$_POST["proveedor"]);
        echo $response;
    }else{
        $updateProducto = new articulosModel();
        $response = $updateProducto->updateArticulo($_POST["solicitud"],$_POST["solicita"],$_POST["autoriza"],$_POST["entrega"],$_POST["destino"],$_POST["productos"]);
        echo $response;
    }
}else{
    //Llamada a la vista
    require_once($path."view/catalogos/articulos/catarticulos.php");
}
?>
