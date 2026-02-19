<?php
include 'conexiondb.php';

$id_cita = $_POST['id_cita'];
$id_estado_cita = $_POST['id_estado_cita'];

try{
    $sql = "UPDATE cita 
            SET id_estado_cita = :id_estado_cita 
            WHERE id_cita = :id_cita;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
    $stmt->bindParam(":id_estado_cita", $id_estado_cita, PDO::PARAM_INT);
    $stmt->execute();

}catch (PDOException $e){
    $errores = $e->getMessage();
}

?>