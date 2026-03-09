<?php

include '../conexiondb.php';

// Verificamos si los datos llegan
if (empty($_POST['id_doct']) || empty($_POST['id_estado_doct'])) {
    die("Error: No se recibieron los datos por POST");
}

$id_doct = $_POST['id_doct'];
$id_estado_doct = $_POST['id_estado_doct'];

try{
    $sql = "UPDATE doctor
            SET id_estado_doctor = :id_estado_doct 
            WHERE id_doctor = :id_doct;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_doct", $id_doct, PDO::PARAM_INT);
    $stmt->bindParam(":id_estado_doct", $id_estado_doct, PDO::PARAM_INT);
    $stmt->execute();

}catch (PDOException $e){
    echo "Error de PDO: " . $e->getMessage();
}

?>