<?php
require_once 'conexiondb.php';
$diseño = $_GET['diseño'] ?? '0';
?>

<!-- Diseño original -->
<?php if ($diseño === '0'):?>
    <button onclick="Diseño(1)">Agendar cita</button>
    <button onclick="Diseño(2)">Registrar paciente</button>

<!-- Diseño agendar cita -->
<?php elseif ($diseño === '1'):?>
    <p>diseño</p>
    <form class="form_select_tabla">
        <select>
            <option value="">Seleccione al paciente</option>
            <?php
            $sql = "SELECT id_paciente, nombre FROM paciente ORDER BY nombre";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id_paciente']}'>" .
                     htmlspecialchars($row['nombre']) .
                     "</option>";
            }
            ?>
        </select>
    </form>

    <form class="form_select_tabla">
        <select>
            <option value="">Seleccione la especialidad</option>
            <?php
            $sql = "SELECT id_especialidad, descripcion FROM especialidad ORDER BY descripcion";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id_especialidad']}'>" .
                     htmlspecialchars($row['descripcion']) .
                     "</option>";
            }
            ?>
        </select>
    </form>

    <form class="form_select_tabla">
        <select name="especialidad">
            <option value="">Seleccione al doctor</option>
            <?php
            if (isset($_POST['especialidad']) && $_POST['especialidad'] != ''){
                $id_especialidad = $_POST['especialidad'];
            }
            $sql = "SELECT id_doctor, nombre, ap_paterno, ap_materno WHERE id_especialidad = " " FROM doctor ORDER BY nombre";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id_doctor']}'>" .
                     htmlspecialchars($row['nombre', "ap_paterno", "ap materno"]) .
                     "</option>";
            }
            ?>
        </select>
    </form>

    <button onclick="Diseño(0)">Regresar</button>

<!-- Diseño registrar paciente -->
<?php else:?>
    <p>Contenido diseño 2</p>
    <button onclick="Diseño(0)">Regresar</button>
<?php endif;?>