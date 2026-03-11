<?php
//Aqui hacer sql para ver los datos (No citas) de paciente/doctor
require_once '../conexiondb.php';

$errores = '';

header('Content-Type: application/json');

try{

    $sql = "SELECT 
                id_paciente,
                CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) as paciente,
                CONCAT(SUBSTRING(telefono,1,2), ' ',
                SUBSTRING(telefono,3,4), ' ',
                SUBSTRING(telefono,7,4)) as telefono,
                correo
                FROM paciente
            ORDER BY nombre ASC;";
    
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