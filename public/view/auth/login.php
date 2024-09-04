<?php 
    session_start(); 
    if(isset($_SESSION['userid'])){ 
        $userid = $_SESSION['userid'];
        $username = $_SESSION['username'];
        $shortname = $_SESSION['shortname'];
	    $shortlastname = $_SESSION['shortlastname'];
        $permisos = $_SESSION['tipous'];
        $company = $_SESSION['company'];
        $pathprincipal = $_SESSION['path'];
    
    
        //header('Location: ./'.$pathprincipal);
    }
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>DATA MANING TOOLS</title>
<!-- Favicon icon -->
<link rel="icon" sizes="any" type="image/svg+xml" href="<?php echo $pathTheme;?>images/favicon_negro_verde.svg">
<link href="<?php echo $pathTheme;?>css/style.css" rel="stylesheet">
<link href="<?php echo $pathTheme;?>vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<style>
    .swal2-popup .swal2-styled.swal2-confirm {
        background-color: #1C1C1B !important;
    }
    #myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%;
  min-height: 100%;
}
</style>
<body style="height: 100vh !important; background: #1C1C1B ;">
    <video autoplay muted loop id="myVideo">
      <source src="https://firebasestorage.googleapis.com/v0/b/web-page-4e788.appspot.com/o/electronic-circuit-board.3840x2160.mp4?alt=media&token=ff79169a-935c-44ab-b5c2-f211340953d8" type="video/mp4">
    </video>
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6" style="max-width: 35%;">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="container">
                                        <div class="row text-center">
                                            <div class="col-lg-7" style="margin: auto;padding-bottom: 20px;">
                                                <img class="img-fluid" style="width: 30%" src="https://firebasestorage.googleapis.com/v0/b/web-page-4e788.appspot.com/o/isotipo-kontrol.png?alt=media&token=519d6cf2-ccc7-4af5-b2da-0b5a5a1d413b" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" class="mt-3">
                                        <div class="form-group">
                                            <label class="mb-1" style="color:#1C1C1B !important;"><strong>USUARIO</strong></label>
                                            <input type="text" id="correo" name="correo" class="form-control" placeholder="" style="height: 40px !important;">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1" style="color:#1C1C1B !important;"><strong>CONTRASEÑA</strong></label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="" style="height: 40px !important;">
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
                                            <a type="submit" id="access" name="access" class="btn btn-success btn-block text-white" style="background-color:#1C1C1B !important;border-color:#1C1C1B !important;">Validar</a>
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
        var path = '<?php echo $pathprincipal;?>';
        if('<?php echo $pathprincipal;?>' != ''){
            window.location.href = "./<?php echo $pathprincipal;?>";
        }else{
            console.log('vacio');
        }
    });

    $('#access').click(function(){
             if ( $('#correo').val() != "" && $('#password').val() != "" ){
                  var data = 'email=' + $('#correo').val() + '&pass=' + $('#password').val();
                 $.ajax({
                     type: 'POST',
                     url: './login.php',
                     data: data,
                     success:function(msj){
                        console.log(msj);
                         if (msj == true){
                            Swal.fire({
                                icon: 'success',
                                title: 'Espere un momento...',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                location.reload()
                            })

                         }
                         else{
                            Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: msj,
                        })
                         }
                         $('#timer').fadeOut(300);
                     },
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
    </script>

</body>

</html>