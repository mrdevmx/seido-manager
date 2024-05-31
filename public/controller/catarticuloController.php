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

    switch ($_POST["modo"]) {
        case 0:
            $saveProducto = new articulosModel();
            $response = $saveProducto->saveArticulo($_POST["producto"],$_POST["unidad"],$_POST["proveedor"]);
          break;
        case 1:
            $updateProducto = new articulosModel();
            $response = $updateProducto->updateArticulo($_POST["id"],$_POST["producto"],$_POST["unidad"],$_POST["proveedor"]);
          break;
        case 2:
            $getProducto = new articulosModel();
            echo $response = json_encode($getProducto->getArticuloById($_POST["id"]));
          break;
        default:
            $response = false;
    }  
      
}else{
    //Llamada a la vista
    require_once($path."view/catalogos/articulos/catarticulos.php");
}
?>
