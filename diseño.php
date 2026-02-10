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
    <div class="registro">
        <form id="form_cita" name="form_cita" method="POST" class = "form_registro">

            <!-- PACIENTE -->
            <label class = "label"> Paciente: <br>
                <select id="paciente" name="paciente" class = "input_s">
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
                </select><br>
            </label>

            <!-- ESPECIALIDAD -->
            <label class = "label"> Especialidad: <br>
                <select id="especialidad" name="especialidad" disabled class = "input_s">
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
                </select><br>
            </label>
        
            <!-- DOCTOR -->
            <label class = "label"> Doctor: <br>
                <select id="doctor" name="doctor" disabled class = "input_s">
                    <option value="">Seleccione al doctor</option>
                </select><br>
            </label>
            
        <!-- ESCOGER DIA--> 
            <label class = "label"> Dia: <br>
                <input type = "text" id = "dia" name = "dia" placeholder = "Seleccione un dia" readonly class = "input_s"/><br>
            </label>

            <!-- ESCOGA UNA HORA -->
            <label class = "label"> Hora: <br>
                <select id="hora" name="hora" disabled class = "input_s">
                    <option value="">Seleccione la hora</option>
                </select><br>
            </label>

            <button class = "boton" id="agendar" name="agendar" type = "submit" class = "input_s">Agendar cita</button>
            <button onclick="Diseño(0)" class = "boton_r">Regresar</button>
        </form>
        
    </div>
    
<!-- Diseño registrar paciente -->
<?php else:?>
    <div class="registro">

        <form id = "form_paciente" name = "form_paciente" method = "POST">

            <label class = "label">
                Nombre(s): <br><input type = "text" id = "p_nombre" name = "p_nombre" required><br>
            </label>
            <label class = "label">
                Apellido Paterno: <br><input type = "text" id = "p_ap_paterno" name = "p_ap_paterno" required><br>
            </label>
            <label class = "label">
                Apellido Materno: <br><input type = "text" id = "p_ap_materno" name = "p_ap_materno" required><br>
            </label>
            <label class = "label">
                Numero telefonico: <br><input type = "tel" id = "p_tel" name = "p_tel" pattern = "[0-9]{10}" maxlength = "10" required><br>
            </label>
            <label class = "label">
                Correo: <br><input type = "email" id = "p_correo" name = "p_correo" required><br>
            </label>

            <button type = "submit" id = "b_re_paciente" name = "b_re_paciente" class = "boton">
                Registrar paciente
            </button>

            <button onclick="Diseño(0)" class = "boton_r">Regresar</button>

        </form>

        
    </div>
<?php endif;?>