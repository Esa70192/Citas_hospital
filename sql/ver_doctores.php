<?php

require_once '../conexiondb.php';

$errores = '';

header('Content-Type: application/json');

try{
    $sql = "SELECT 
                d.id_doctor,
                CONCAT(d.nombre, d.ap_paterno, d.ap_materno) as Doctor,
                ep.descripcion as Especialidad,
                es.descripcion as Estado
            FROM doctor d
            INNER JOIN especialidad ep on d.id_especialidad = ep.id_especialidad
            INNER JOIN estado_doctor es on d.id_estado_doctor = es.id_estado_doctor
            ORDER BY doctor ASC;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $doctores = $stmt->fetchALL(PDO::FETCH_ASSOC);
    echo json_encode($doctores);
}catch(PDOException $e){
    // $errores = $e->getMessage();
    echo json_encode([
        "error" => true,
        "mensaje" => $e->getMessage()
    ]);
}

?>