<?php
require_once 'conexiondb.php';

$errores = '';

try{
    if (isset($_POST['doctor']) && $_POST['doctor'] !== ''){
        $doctor = $_POST['doctor'];
        $sql = "SELECT id_doctor
                FROM doctor 
                 
                AND id_estado_doctor = 1
                ORDER BY nombre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_especialidad', $id_especialidad, PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id_doctor']}'>" .
                htmlspecialchars(
                    $row['ap_paterno'] . ' ' .
                    $row['ap_materno'] . ' ' .
                    $row['nombre']
                ) .
                "</option>";
        }
    }
}catch (PDOException $e){
    $errores = $e->getMessage();
    //echo $errores;
}

?>