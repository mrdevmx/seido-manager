<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './view/template/head.php'?>
</head>
<body>
    <?php include './view/template/loader.php'?>
    <div id="main-wrapper">
        <?php include './view/template/header.php'?>
        <?php include './view/template/nav.php'?>
        <?php include 'main.php'?>
    </div>
    <?php include './view/template/scripts.php'?>
</body>
<script>
    $("#btn-guarda-usuario").click(function() {
        var modo = $('#modo').val();
        var id = $('#id').val();
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var correo = $('#correo').val();
        var contrasena = {'contrasena' : $('#contrasena').val()};
        var tipous = $('#tipous').val() == 'selected' ? '' : $('#tipous').val();

        var objectData = {
                'modo': modo,
                'id': id,
                'nombre': nombre,
                'apellido': apellido,
                'correo': correo,
                'tipous': tipous
            }
        const postData = modo == 0 ? Object.assign({}, objectData, contrasena) : objectData;
        console.log(postData);


        if(valida(postData)){
            var formURL = "./usuarios";
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
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                            }, 100)
                        }
                    }).then((result) => {
                        location.reload()
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
        }else{
            Swal.fire({
                    icon: 'info',
                    title: 'Oops...',
                    text: 'Llene todos los campos',
                });
        }
    });

    function valida(postData){
        var response;
        for (var i in postData) {
            if (postData[i] === '') {
                response = false;
                break;
            }else{
                response = true
            }
        }
    return response
}

$("#btncontrasenia").click(function() {
    var modo = $('#idmodo').val();
    var idcontrasenia = $('#idcontrasenia').val();
    var contrasenaid = $('#contrasenaid').val();


    var postData = {
            'modo': modo,
            'idcontrasenia': idcontrasenia,
            'contrasenaid': contrasenaid
    }
    if(valida(postData)){
        var formURL = "./usuarios";
        $.ajax({
            url : formURL,
                type: "POST",
                async: false,
                data : postData,
            //mientras enviamos el archivo
            beforeSend: function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Trabajando!',
                    text: 'Espere un momento...',
                    showConfirmButton: false,
                });
            },
            success: function(data) {
                if(data){
                    let timerInterval
                    Swal.fire({
                        icon: 'success',
                        title: 'Exito!',
                        html: 'Contraseña actualizada, Espere un momento...',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                            }, 100)
                        }
                    }).then((result) => {
                        location.reload()
                    })
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Contacte a Sistemas',
                    text: data,
                    showConfirmButton: true,
                });
                }
                    
            },
            error: function(jqXHR, textStatus, datos) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: datos,
                    confirmButtonText: 'Ok'
                });
            }
        });
    }else{
        Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Llene todos los campos',
        });
            
        }
    });

function cargardatos(id){
    var formURL = "./usuarios";
    $.ajax({
        url : formURL,
        type: "POST",
        datetype: "json",
        async: false,
        data : {'modo' : 2,
                'id' : id},
        success:function(data,textStatus){
         data = JSON.parse(data);
         var correo = data[0].Usu_Correo.split("@arctec.com.mx").join(''); 
            $('#modo').val(1);
            $('#id').val(id);
            $('#nombre').val(data[0].Usu_Nombre);
            $('#apellido').val(data[0].Usu_Apelli);
            $('#correo').val(correo);
            $('#tipous').val(data[0].Usu_TipUsu);
            $('#hiddencon').hide();
            $('#titleus').text("Editar");
            $('#btn-guarda-usuario').text("Editar");
            $("#modalUsuario").modal("show");
        },
        error: function(jqXHR, textStatus){
            console.log(textStatus);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Comuniquese con el administrador del sistema',
            })
        }
    });
}

function cargarid(id){
    $('#idcontrasenia').val(id);
}

$('#modalUsuario').on('hidden.bs.modal', function () {
    $('#modo').val(0);
    $('#id').val(0);
    $('#nombre').val('');
    $('#apellido').val('');
    $('#correo').val('');
    $('#contrasena').val('');
    $('#tipous').val('selected');
    $('#titleus').text("Agregar Nuevo");
    $('#btn-guarda-usuario').text("Agregar");
});

$('#modalUsuarioContrasenia').on('hidden.bs.modal', function () {
    $('#idcontrasenia').val(0);
    $('#contraseniaid').val('');
});
</script>
</html>
