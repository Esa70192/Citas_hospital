<?php

require_once '../conexiondb.php';

$errores = '';

header('Content-Type: application/json');

$estado = $_POST['estado'];

try{
    $sql = "SELECT 
                c.id_cita,
                c.fecha_registro,
                c.dia_cita,
                c.hora_cita,
                CONCAT(p.nombre, ' ', p.ap_paterno, ' ', p.ap_materno) as paciente,
                CONCAT(d.nombre, ' ', d.ap_paterno, ' ', d.ap_materno) as doctor,
                c.id_estado_cita,
                e.descripcion as estado_cita,
                case 
            	    when c.pagado = 1 then 'Si'
            	    when c.pagado = 0 then 'No'
                end as pagado
            FROM cita c
            INNER JOIN paciente p ON c.id_paciente = p.id_paciente
            INNER JOIN doctor d ON c.id_doctor = d.id_doctor
            INNER JOIN estado_cita e ON c.id_estado_cita = e.id_estado_cita
            WHERE c.id_estado_cita = :estado
            AND (c.dia_cita > CURRENT_DATE()
                OR (c.dia_cita = CURRENT_DATE() AND c.hora_cita >= CURRENT_TIME()))
            ORDER BY c.dia_cita ASC, c.hora_cita ASC;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
    $stmt->execute();
    $citas_p = $stmt->fetchALL(PDO::FETCH_ASSOC);
    echo json_encode($citas_p);
}catch(PDOException $e){
    // $errores = $e->getMessage();
    echo json_encode([
        "error" => true,
        "mensaje" => $e->getMessage()
    ]);
}

?>