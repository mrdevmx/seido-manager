<?php
//Llamada al modelo
require_once($path."model/articuloModel.php");
$articulos = new articulosModel();
$table=$articulos->getArticulosTable();


//Llamada a la vista
require_once($path."view/catalogos/articulos/catarticulos.php");
?>
