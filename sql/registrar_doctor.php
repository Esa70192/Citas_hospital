<?php
require_once '../conexiondb.php';
/* var_dump($_POST);
exit(); */

$errores = '';

try{
    if (
        empty($_POST['nombre']) ||
        empty($_POST['ap_paterno']) ||
        empty($_POST['ap_materno']) ||
        empty($_POST['especialidad']) ||
        empty($_POST['estado'])
    ){
        exit('Faltan datos');
    }

    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $especialidad = $_POST['especialidad'];
    $estado = $_POST['estado'];
    $horario = json_decode($_POST['horario'], true);

    $conn->beginTransaction();

    $sql = "INSERT INTO doctor VALUES
                (NULL, :nombre, :ap_paterno, :ap_materno, :especialidad, :estado)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':ap_paterno', $ap_paterno, PDO::PARAM_STR);
    $stmt->bindParam(':ap_materno', $ap_materno, PDO::PARAM_STR);
    $stmt->bindParam(':especialidad', $especialidad, PDO::PARAM_INT);
    $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
    $stmt->execute();

    $id_doctor = $conn->lastInsertId();

    $sql = "INSERT INTO horario_doctor VALUES
                (NULL, :id_doctor, :dia_semana, :hora_inicio, :hora_fin)";
    $stmt = $conn->prepare($sql);
    foreach($horario as $dia => $h){
        if($h['entrada'] && $h['salida']){
            $stmt->execute([
                ':id_doctor' => $id_doctor,
                ':dia_semana' => $dia,
                ':hora_inicio' => $h['entrada'],
                ':hora_fin' => $h['salida']
            ]);
        }
    }
    
    $sql = "INSERT IGNORE INTO horario_doctor_hora
            (id_doctor, dia_semana, hora)
            VALUES (:doctor, :dia, :hora)";

    $stmtHoras = $conn->prepare($sql);

    foreach($horario as $dia => $h){

        if($h['entrada'] && $h['salida']){

            for($i = $h['entrada']; $i < $h['salida']; $i++){

                $stmtHoras->execute([
                    ':doctor' => $id_doctor,
                    ':dia' => $dia,
                    ':hora' => $i
                ]);
            }
        }
    }

    $conn->commit();

    echo "ok";

}catch (PDOException $e){
    $conn->rollBack();
    echo 'Error: ' . $e->getMessage();
    $conn->rollBack();
}

?>