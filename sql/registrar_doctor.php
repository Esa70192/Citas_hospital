<?php
require_once '../conexiondb.php';

$errores = '';

try{
    if (
        empty($_POST['nombre']) ||
        empty($_POST['ap_paterno']) ||
        empty($_POST['ap_materno']) ||
        empty($_POST['especialidad']) ||
        empty($_POST['estado'])
    ){
        exit('Faltan datos');
    }

    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $telefono = $_POST['especialidad'];
    $correo = $_POST['estado'];

    $sql = "INSERT INTO doctor VALUES
                (NULL, :nombre, :ap_paterno, :ap_materno, :especialidad, :estado)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':ap_paterno', $ap_paterno, PDO::PARAM_STR);
    $stmt->bindParam(':ap_materno', $ap_materno, PDO::PARAM_STR);
    $stmt->bindParam(':especialidad', $telefono, PDO::PARAM_INT);
    $stmt->bindParam(':estado', $correo, PDO::PARAM_INT);
    $stmt->execute();
    echo 'ok';
}catch (PDOException $e){
    echo 'Error: ' . $e->getMessage();
}

?>