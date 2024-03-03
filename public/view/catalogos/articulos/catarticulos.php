<?php 
$pathTemplate = "./";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $pathTemplate.'view/template/head.php'?>
</head>
<body>
    <?php include $pathTemplate.'view/template/loader.php'?>
    <div id="main-wrapper">
        <?php include $pathTemplate.'view/template/header.php'?>
        <?php include $pathTemplate.'view/template/nav.php'?>
        <?php include 'main.php'?>
    </div>
    <?php include $pathTemplate.'view/template/scripts.php'?>
</body>
</html>
