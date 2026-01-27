<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'conexiondb.php';

$errores = '';

try{
    if (isset($_POST['especialidad']) && $_POST['especialidad'] !== ''){
        // $id_especialidad = $_POST['especialidad'];
        // print($id_especialidad);
        // $sql = "SELECT id_doctor, nombre, ap_paterno, ap_materno
        //         FROM doctor 
        //         WHERE id_especialidad = :id_especialidad, id_estado_doctor = 1
        //         ORDER BY nombre";
        // $stmt = $conn->prepare($sql);
        // $stmt->bindParam(':id_especialidad', $id_especialidad, PDO::PARAM_INT);
        // $stmt->execute();
        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //     echo "<option value='{$row['id_doctor']}'>" .
        //         htmlspecialchars(
        //             $row['nombre'] . ' ' .
        //             $row['ap_paterno'] . ' ' .
        //             $row['ap_materno']
        //         ) .
        //         "</option>";
        // }
        echo 'si';
    }else{
        echo 'no';
    }
}catch (PDOException $e){
    $errores = $e->getMessage();
    echo $errores;
}
?>