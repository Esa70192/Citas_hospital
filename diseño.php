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
    <form method="POST" class="form_select_tabla">

        <!-- PACIENTE -->
        <select id="paciente" name="paciente">
            <option value="">Seleccione al paciente</option>
            <?php
            $sql = "SELECT id_paciente, nombre, ap_paterno, ap_materno FROM paciente ORDER BY ap_paterno";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id_paciente']}'>" .
                    htmlspecialchars(
                        $row['ap_paterno'] . ' ' .
                        $row['ap_materno'] . ' ' .
                        $row['nombre']
                    ) . 
                    "</option>";
            }
            ?>
        </select>

        <!-- ESPECIALIDAD -->
        <select id="especialidad" name="especialidad" disabled>
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
    
        <!-- DOCTOR -->
        <select id="doctor" name="doctor" disabled>
            <option value="">Seleccione al doctor</option>
        </select>

        <!-- ESCOGER DIA--> 
        <input type = "text" id = "dia" name = "dia" placeholder = "Seleccione un dia" readonly/>

        <!-- ESCOGA UNA HORA -->
        <select id="hora" name="hora" disabled>
            <option value="">Seleccione la hora</option>
        </select>

        <button id="agendar" name="agendar" type = "submit">Agendar cita</button>

    </form>

    <button onclick="Diseño(0)">Regresar</button>

<!-- Diseño registrar paciente -->
<?php else:?>
    <p>Contenido diseño 2</p>
    <button onclick="Diseño(0)">Regresar</button>
<?php endif;?>