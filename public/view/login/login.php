<?php 
    /*session_start(); 
    if(isset($_SESSION['userid'])){ 
        header('Location: ./ ');
    }*/
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>DATA MANING TOOLS</title>
<!-- Favicon icon -->
<link href="<?php echo $pathTheme;?>images/siscontrol_simple_logo.png" rel="icon" type="image/png" sizes="16x16">
<link href="<?php echo $pathTheme;?>css/style.css" rel="stylesheet">
<link href="<?php echo $pathTheme;?>vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body style="height: 100vh !important; background: url('<?php echo $pathTheme;?>images/background_login.jpg') no-repeat fixed bottom; background-size: cover;">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="container">
                                        <div class="row text-center">
                                            <div class="col-lg-7" style="margin: auto">
                                                <img class="img-fluid" src="<?php echo $pathTheme;?>images/siscontrol_logo.svg" alt="">
                                            </div>
                                            <!--<div class="col-lg-6">
                                                <img class="img-fluid" src="./images/svg_deere_logo.svg" alt="">
                                            </div>-->
                                        </div>
                                    </div>
                                    <form method="POST" class="mt-3">
                                        <div class="form-group">
                                            <label class="mb-1 text-black"><strong>USUARIO</strong></label>
                                            <input type="text" id="correo" name="correo" class="form-control" placeholder="SisControl User">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-black"><strong>CONTRASEÑA</strong></label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="··········">
                                        </div>
                                        <!--<div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1">
													<input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
													<label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>-->
                                        <div class="text-center mt-5">
                                            <a type="submit" id="access" name="access" class="btn btn-primary btn-block text-white">Validar</a>
                                        </div>
                                    </form>
                                    <!--<div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="./page-register.html">Sign up</a></p>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Required vendors -->
    <script src="<?php echo $pathTheme;?>vendor/global/global.min.js"></script>
	<script src="<?php echo $pathTheme;?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo $pathTheme;?>js/custom.min.js"></script>
    <script src="<?php echo $pathTheme;?>js/deznav-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.17/sweetalert2.all.min.js"></script>
    <script src="<?php echo $pathTheme;?>js/plugins-init/sweetalert.init.js"></script>
    <script>
    $(document).ready(function(){
            $('#access').click(function(){
             if ( $('#correo').val() != "" && $('#password').val() != "" ){
                  
                 $.ajax({
                     type: 'POST',
                     url: './conexion/funciones/login/access.php',
                     data: 'correo=' + $('#correo').val() + '&password=' + $('#password').val(),
                      
 //si la sesion se inicia correctamente presentamos el mensaje
                     success:function(msj){
                         if ( msj == 1 ){
                            Swal.fire({
                                icon: 'success',
                                title: 'Espere un momento...',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                window.location.href = "./";
                            })

                         }
                          
 //caso contrario los datos son incorrectos
                         else{
                            Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: msj,
                        })
                         }
                         $('#timer').fadeOut(300);
                     },
 //si se pierden los datos presentamos error de ejecucion.
                     error:function(jqXHR, textStatus, datos){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: datos,
                        })
                     }
                 });
                          
 
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Campos vacios.',
                        })
             }
          
         return false;
          
     });
    });
 
    </script>

</body>

</html>