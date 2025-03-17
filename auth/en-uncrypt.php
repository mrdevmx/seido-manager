<?php
function encrypt($data, $key){
    $hash=password_hash($data, PASSWORD_DEFAULT);
    $mitad = strlen($hash ) / 2; //Cantidad de letras en $nombre dividida entre 2
    $parte1 = substr($hash , 0, $mitad);
    $parte2 = substr($hash , $mitad);

    $pass = $parte1.$key.$parte2;
    $passCrypt = rtrim(strtr(base64_encode($pass), '+/', '-_'), '=');

    return $passCrypt;
}

function uncrypt($passEncrypt, $key){
    $uncrypt = base64_decode(str_pad(strtr($passEncrypt, '-_', '+/'), strlen($passEncrypt) % 4, '=', STR_PAD_RIGHT));
    $passUncrypt = str_replace($key, "", $uncrypt);

    return $passUncrypt;
}
?>