<?php

require_once 'conexiondb.php';

$errores = '';

header('Content-Type: application/json');

try{
    $sql = "SELECT 
            FROM cita
            WHERE id_estado_cita = 2
            AND hora_cita >= CURRENT_TIME()
            AND dia_cita >= CURRENT_DATE()
            ORDER BY dia_cita ASC, hora_cita ASC;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $citas_p = $stmt->fetchALL(PDO::FETCH_ASSOC);
    echo json_encode($citas_p);
}catch(PDOException $e){
    $errores = $e->getMessage();
}

?>