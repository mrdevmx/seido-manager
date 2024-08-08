<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){
    include '../../conexion_control.php';
    include './en-uncrypt.php';

    $email = $_POST['correo']."@dimasur.com.mx";
    $pass = $_POST['password'];
    
    $sql = "SELECT id
                ,nombre
                ,apellido
                ,correo
                ,contrasena
                ,id_tipoUsuario AS tipous 
            FROM usuarios 
            WHERE correo='".$email."'";  
             
    $result = $conectar->query($sql);

    if ($result->num_rows > 0) {
        $user = @mysqli_fetch_array($result);

        $passEncrypt = $user['contrasena'];

        $passUncrypt = uncrypt($passEncrypt);

        if (password_verify($pass, $passUncrypt)) {
            $sn = explode(" ", $user['nombre']);
            $shortName = $sn[0];

            $sl = explode(" ", $user['apellido']);
            $shortLastname = $sl[0];

            $_SESSION['userid'] = $user['id'];
            $_SESSION['username']   = $user['nombre'];
            $_SESSION['shortname']   = $shortName;
            $_SESSION['shortlastname']   = $shortLastname;
            $_SESSION['usermail']   = $user['correo'];
            $_SESSION['tipous']   = $user['tipous'];
            echo 1;
        } else {
            echo 'La contraseña no es válida.';
        }
    }else {
        echo "Usuario no regsitrado.";
    }
    $conectar->close();
}else{
    echo 0;
}
?>
