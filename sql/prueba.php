<?php
require_once '../conexiondb.php';

header('Content-Type: application/json');

if (!isset($_POST['doctor']) || $_POST['doctor'] === '') {
    echo json_encode([]);
    exit;
}

$id_doctor = (int) $_POST['doctor'];

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
            where exists (
	            select 1
	            from horario_doctor_hora hdh 
	            where hdh.id_doctor = :id_doctor
	            	and hdh.dia_semana = DAYOFWEEK(f.fecha)
	            	and not exists  (
	            		select 1
	            		from cita c
	            		where c.id_doctor = hdh.id_doctor 
	            			and DATE(c.dia_cita) = f.fecha
	            			and time(c.hora_cita) = hdh.hora 
	            	)
	        )
            ORDER BY f.fecha";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));

} catch (PDOException $e) {
    echo json_encode([]);
}
