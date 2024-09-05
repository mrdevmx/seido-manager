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
    var id = $('#id').val();
    var producto = $('#producto').val();
    var unidad = $('#unidad').val();
    var proveedor = $('#proveedor').val();

    var postData = {
        'modo': modo,
        'id': id,
        'producto': producto,
        'unidad': unidad,
        'proveedor': proveedor,
    };
        console.log(postData);
    var formURL = "./productos";
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
                window.location.href = "./productos";
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

function cargardatos(id){
    var formURL = "./productos";
    var postData = {
        'modo': 2,
        'id': id,
    };

    $.ajax({
        url : formURL,
        type: "POST",
        datetype: "json",
        async: false,
        data : postData,
        success:function(data,textStatus){
         data = JSON.parse(data);
         console.log(data);
         console.log(data[0].Cri_Id);
            $('#modo').val(1);
            $('#id').val(data[0].Cri_Id);
            $('#producto').val(data[0].Cri_Descrip);
            $('#unidad').val(data[0].Cri_Unidad);
        proveedor = JSON.parse(data[0].Cri_Proveed);
        console.log(proveedor);
            $('#proveedor').val(proveedor);
            $("#modalArticulo").modal("show");
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
}

</script>
</html>
