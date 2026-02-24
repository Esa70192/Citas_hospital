<?php

require_once '../conexiondb.php';

$errores = '';

try{
    if (
        empty($_POST['doctor']) ||
        empty($_POST['paciente']) ||
        empty($_POST['dia']) ||
        empty($_POST['hora'])
    ){
        exit('Faltan datos');
    }

    $doctor = (int) $_POST['doctor'];
    $paciente = (int) $_POST['paciente'];
    $dia = $_POST['dia'];
    $hora = $_POST['hora'];

    $sql = "INSERT INTO cita VALUES
            (NULL, :doctor, :paciente, CURRENT_TIMESTAMP, 2, FALSE, :hora, :dia)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':doctor', $doctor, PDO::PARAM_INT);
    $stmt->bindParam(':paciente', $paciente, PDO::PARAM_INT);
    $stmt->bindParam(':dia', $dia, PDO::PARAM_STR);
    $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
    $stmt->execute();
    echo 'ok';
}catch (PDOException $e){
    echo 'Error: ' . $e->getMessage();
}

?>