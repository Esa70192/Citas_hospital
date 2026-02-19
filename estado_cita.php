<?php
include 'conexiondb.php';

try{
    $sql = "SELECT *
            FROM estado_cita;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $estados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($estados);
}catch (PDOException $e){
    $errores = $e->getMessage();
}
?>
