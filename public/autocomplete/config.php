<?php
try {
require_once('../../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->load();
    define('DB_HOST', $_ENV['DB_HOST']);
    define('DB_USER', $_ENV['DB_USER']);
    define('DB_PASS', $_ENV['DB_PASS']);
    define('DB_DABA', $_ENV['DB_DABA']);
} catch (Exception $e) {
echo 'Excepción capturada: ',  $e->getMessage(), "\n";
var_dump($e->getMessage());
}
?>