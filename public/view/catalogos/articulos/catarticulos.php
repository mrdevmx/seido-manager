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
<script>
    $("#btn-guarda-articulo").click(function() {
    var modo = $('#modo').val();
    var producto = $('#producto').val();
    var unidad = $('#unidad').val();
    var proveedor = $('#proveedor').val();

    var postData = {
        'modo': modo,
        'producto': producto,
        'unidad': unidad,
        'proveedor': proveedor,
    };
        console.log(postData);
    var formURL = "./catarticulos";
    $.ajax({
        url: formURL,
        type: "POST",
        async: false,
        data: postData,
        success: function(data, textStatus) {
            console.log(data);
            Swal.fire({
                icon: 'success',
                title: 'Se Registró la entrada',
                text: 'Espere un momento...',
                showConfirmButton: false,
                timer: 2000
            }).then((result) => {
                window.location.href = "./catarticulos";
            })

        },
        error: function(jqXHR, textStatus) {
            console.log(textStatus);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Comuniquese con el administrador del sistema',
            })
        }
    });
});
</script>
</html>
