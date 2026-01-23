<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, 'conf.env');
$dotenv->load();

$DB_HOST=$_ENV['DB_HOST'];
$DB_NAME=$_ENV['DB_NAME'];
$DB_USER=$_ENV['DB_USER'];
$DB_PASS=$_ENV['DB_PASS'];
$DB_PORT=$_ENV['DB_PORT'];

try{
    $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;port=$DB_PORT;charset=utf8mb4";

    $conn = new PDO($dsn, $DB_USER, $DB_PASS);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $estado_conexion = TRUE;
      
}catch (PDOException $e) {
    $estado_conexion = FALSE;
    $error_db = $e->getMessage();
}

?>