<?php
require_once 'conexiondb.php';

header('Content-Type: application/json');

if (!isset($_POST['doctor']) || $_POST['doctor'] === '') {
    echo json_encode([]);
    exit;
}

$doctor = (int) $_POST['doctor'];

try {
    $sql = "WITH RECURSIVE fechas AS (
                SELECT CURDATE() AS fecha
                UNION ALL
                SELECT fecha + INTERVAL 1 DAY
                FROM fechas
                WHERE fecha < CURDATE() + INTERVAL 3 MONTH
            )
            SELECT f.fecha
            FROM fechas f
            LEFT JOIN horario_doctor_hora hdh
                ON hdh.id_doctor = :doctor
                AND hdh.dia_semana = DAYOFWEEK(f.fecha)
            LEFT JOIN citas c
                ON c.id_doctor = :doctor
                AND DATE(c.dia_cita) = f.fecha
                AND TIME(c.hora_cita) = hdh.hora
            GROUP BY f.fecha
            HAVING COUNT(hdh.hora) > COUNT(c.id_citas)
            ORDER BY f.fecha";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':doctor', $doctor, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));

} catch (PDOException $e) {
    echo json_encode([]);
}
