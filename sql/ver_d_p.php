<?php

require_once '../conexiondb.php';

$errores = '';

header('Content-Type: application/json');

try{
    if($estado === 1){ //Doctor
        $sql = "SELECT 
                    d.id_doctor,
                    CONCAT(d.nombre, d.ap_paterno, d.ap_materno) as Doctor,
                    ep.descripcion as Especialidad,
                    es.descripcion as Estado
                FROM doctor d
                INNER JOIN especialidad ep on d.id_especialidad = ep.id_especialidad
                INNER JOIN estado_doctor es on d.id_estado_doctor = es.id_estado_doctor
                ORDER BY doctor ASC;";
    }else if($estado === 2){ //Paciente
        $sql = "SELECT 
                    c.id_cita,
                    c.fecha_registro,
                    CONCAT(d.nombre, d.ap_paterno, d.ap_materno) as doctor,
                    CONCAT(p.nombre, p.ap_paterno, p.ap_materno) as paciente,
                    e.descripcion as estado,
                    case
                        when c.pagado = 0 then 'No pagado'
                        when c.pagado = 1 then 'Pagado'
                    end as pagado,
                    c.dia_cita,
                    c.hora_cita
                FROM cita c
                INNER JOIN doctor d on c.id_doctor = d.id_doctor
                INNER JOIN paciente p on c.id_paciente = p.id_paciente
                inner join estado_cita e on c.id_estado_cita = e.id_estado_cita 
                ORDER BY paciente ASC;";
    }
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