<?php
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
class Conectar{
    public static function conexion($typeConnection){

        if($typeConnection == 1){
            $DB_HOST=$_ENV['DB_CEHO'];
            $DB_USER=$_ENV['DB_CEUS'];
            $DB_PASS=$_ENV['DB_CEPA'];
            $DB_DABS=$_ENV['DB_CEDB'];
        }else{
            $DB_HOST=$_ENV['DB_HOST'];
            $DB_USER=$_ENV['DB_USER'];
            $DB_PASS=$_ENV['DB_PASS'];
            $DB_DABS=$_ENV['DB_DABA'];
        }
        
        try {
            $conexion=new mysqli(
                $DB_HOST,
                $DB_USER,
                $DB_PASS,
                $DB_DABS
            );
            $conexion->query("SET NAMES 'utf8'");
        } catch (Exception $e) {
            printf('Caught exception: '.  $e->getMessage());
        }
        
        return $conexion;
    }
}
?>
