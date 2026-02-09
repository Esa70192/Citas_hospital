<?php
require_once 'conexiondb.php';

$errores = '';

try{
    if (
        empty($_POST['nombre']) ||
        empty($_POST['ap_paterno']) ||
        empty($_POST['ap_materno']) ||
        empty($_POST['telefono']) ||
        empty($_POST['correo'])
    ){
        exit('Faltan datos');
    }

    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $sql = "INSERT INTO paciente VALUES
            (NULL, :nombre, :ap_paterno, :ap_materno, :telefono, :correo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':ap_paterno', $ap_paterno, PDO::PARAM_STR);
    $stmt->bindParam(':ap_materno', $ap_materno, PDO::PARAM_STR);
    $stmt->bindParam(':telefono', $telefono, PDO::PARAM_INT);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmt->execute();
    echo 'ok';
}catch (PDOException $e){
    echo 'Error: ' . $e->getMessage();
}

?>