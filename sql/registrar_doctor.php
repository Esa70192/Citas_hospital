<?php
require_once '../conexiondb.php';
/* var_dump($_POST);
exit(); */

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
    $especialidad = $_POST['especialidad'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO doctor VALUES
                (NULL, :nombre, :ap_paterno, :ap_materno, :especialidad, :estado)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':ap_paterno', $ap_paterno, PDO::PARAM_STR);
    $stmt->bindParam(':ap_materno', $ap_materno, PDO::PARAM_STR);
    $stmt->bindParam(':especialidad', $especialidad, PDO::PARAM_INT);
    $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
    $stmt->execute();
    echo 'ok';
}catch (PDOException $e){
    echo 'Error: ' . $e->getMessage();
}

?>