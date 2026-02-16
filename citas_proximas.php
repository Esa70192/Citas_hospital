<?php

require_once 'conexiondb.php';

$errores = '';

try{
    $sql = "SELECT *
            FROM cita
            WHERE id_estado_cita = 2
            AND hora_cita >= CURRENT_TIME()
            AND dia_cita >= CURRENT_TIME()
            ORDER BY dia_cita;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':doctor', $doctor, PDO::PARAM_INT);
    $stmt->bindParam(':dia', $dia, PDO::PARAM_STR);
    $stmt->execute();
    $horas = $stmt->fetchALL(PDO::FETCH_COLUMN);
    echo json_encode($horas);
}catch(PDOException $e){
    $errores = $e->getMessage();
}

?>