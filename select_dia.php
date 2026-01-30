<?php
require_once 'conexiondb.php';

$errores = '';

try{
    if (isset($_POST['doctor']) && $_POST['doctor'] !== ''){
        $doctor = (int) $_POST['doctor'];
        $sql = "WITH RECURSIVE fechas AS (
                    SELECT CURDATE() AS fecha
                    UNION ALL
                    SELECT fecha + INTERVAL 1 DAY
                    FROM fechas
                    WHERE fecha < CURDATE() + INTERVAL 3 MONTH
                )
                SELECT
                    f.fecha,
                    COUNT(hdh.hora) AS total_horas,
                    COUNT(c.id_citas) AS horas_ocupadas,
                    CASE
                        WHEN COUNT(hdh.hora) > COUNT(c.id_citas) THEN 'DISPONIBLE'
                        ELSE 'COMPLETO'
                    END AS estado_dia
                FROM fechas f
                LEFT JOIN horario_doctor_hora hdh
                    ON hdh.id_doctor = :doctor
                    AND hdh.dia_semana = DAYOFWEEK(f.fecha)
                LEFT JOIN citas c
                    ON c.id_doctor = :doctor
                    AND DATE(c.dia_cita) = f.fecha
                    AND TIME(c.hora_cita) = hdh.hora
                GROUP BY f.fecha
                ORDER BY f.fecha";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':doctor', $doctor, PDO::PARAM_INT);
        $stmt->execute();
    }
}catch (PDOException $e){
    $errores = $e->getMessage();
    //echo $errores;
}

?>