<?php
require_once 'conexiondb.php';

$errores = '';

try{
    if (!isset($_POST['doctor']) || $_POST['doctor'] === ''){
        exit;
    }
    if(!isset($_POST['dia']) || $_POST['dia'] === ''){
        exit;
    }
    $doctor = (int) $_POST['doctor'];
    $dia = $_POST['dia'];

    $sql = "SELECT h.hora
            FROM horario_doctor_hora h
            LEFT JOIN cita c
                ON c.id_doctor = h.id_doctor
                AND c.dia_cita = :dia
                AND c.hora_cita = h.hora
            WHERE h.id_doctor = :doctor
                AND h.dia_semana = DAYOFWEEK(:dia)
                AND c.id_cita IS NULL
            ORDER BY h.hora";
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