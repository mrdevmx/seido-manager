<?php
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
/* Database connection values */
define("DB_HOST", $_ENV['DB_HOST']);
define("DB", $_ENV['DB_NACE']);
define("DB_USER", $_ENV['DB_USER']);
define("DB_PASS", $_ENV['DB_PASS']);

/* Default options */
define("DEFAULT_CONTROLLER", "note");
define("DEFAULT_ACTION", "list");

?>