<?php
//Llamada al modelo
require_once($path."model/articuloModel.php");
require_once($path."model/unidadModel.php");

$articulos = new articulosModel();
$table=$articulos->getArticulosTable();

$unidades = new unidadesModel();
$selectUnidades=$unidades->getUnidadesSelect();

//Llamada a la vista
require_once($path."view/catalogos/articulos/catarticulos.php");
?>
