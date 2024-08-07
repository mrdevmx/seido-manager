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
    $("#btn-guarda-proveedor").click(function() {
        if(valida()){
            var modo = $('#modo').val();
            var id = $('#id').val();
            var nomco = $('#nomco').val();
            var raso = $('#raso').val();
            var rfc = $('#rfc').val();
            var tel = $('#tel').val();
            var regimen = $('#regimen').val();

            var postData = {
                'modo': modo,
                'id': id,
                'nomco': nomco,
                'raso': raso,
                'rfc': rfc,
                'tel': tel,
                'regimen': regimen
            };
            console.log(postData);
            var formURL = "./proveedores";
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
                        window.location.href = "./proveedores";
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
        }
    });

function cargardatos(id){
    console.log(id);
    var formURL = "./proveedores";
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
            $('#modo').val(1);
            $('#id').val(data[0].Cpo_Id);
            $('#nomco').val(data[0].Cpo_NomCome);
            $('#raso').val(data[0].Cpo_RazSoci);
            $('#rfc').val(data[0].Cpo_RFC);
            $('#tel').val(data[0].Cpo_Telefon);
            $('#regimen').val(data[0].Cpo_RegFisc);
            $('#btn-guarda-proveedor').html('Editar');
            $("#modalProveedor").modal("show");
        },
        error: function(jqXHR, textStatus) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Comuniquese con el administrador del sistema',
            })
        }
    });
}

$('#modalProveedor').on('hidden.bs.modal', function () {
    $('#modo').val(0);
    $('#id').val(0);
    $('#nomco').val('');
    $('#raso').val('');
    $('#rfc').val('');
    $('#tel').val('');
    $('#regimen').val(0);
    $('#btn-guarda-proveedor').html('Agregar');
});

function valida(){
    if($('#nomco').val() == '' || $('#raso').val() == '' || $('#rfc').val() == '' || $('#tel').val() == ''){
        Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Llene todos los campos',
            })
        return false;
    }

    if($('#regimen').val() == 0){
        Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Seleccione un Regimen Fiscal',
            })
        return false;
    }

    return true;
}

</script>
</html>
