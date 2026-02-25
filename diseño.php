<?php
require_once 'conexiondb.php';
$diseño = $_GET['diseño'] ?? '0';
?>

<!-- Diseño original -->
<?php if ($diseño === '0'):?>
    <?php include 'cont_principal.php'; ?>

<!-- Diseño agendar cita -->
<?php elseif ($diseño === '1'):?>
    <div class = "cont prin">
        <div class="registro">
            <form id="form_cita" name="form_cita" method="POST" class = "form_registro">
                <h2>Agendar Cita</h2>
                <!-- PACIENTE -->
                <label class = "label"> Paciente: <br>
                    <select id="paciente" name="paciente" class = "select2 input" data-placeholder="Seleccione al paciente">
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
                </label>

                <!-- ESPECIALIDAD -->
                <label class = "label"> Especialidad: <br>
                    <select id="especialidad" name="especialidad" disabled class = "select2" data-placeholder="Seleccione al paciente">
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
                </label>
            
                <!-- DOCTOR -->
                <label class = "label"> Doctor: <br>
                    <select id="doctor" name="doctor" disabled class = "select2" data-placeholder="Seleccione al paciente">
                        <option value="">Seleccione al doctor</option>
                    </select>
                </label>
                
                <!-- ESCOGER DIA--> 
                <label class = "label"> Dia: <br>
                    <input type = "text" id = "dia" name = "dia" placeholder = "Seleccione un dia" readonly class = "input_s"/>
                </label>

                <!-- ESCOGA UNA HORA -->
                <label class = "label"> Hora: <br>
                    <select id="hora" name="hora" disabled class = "select2" data-placeholder="Seleccione al paciente">
                        <option value="">Seleccione la hora</option>
                    </select>
                </label>

                <button class = "boton boton_verde" id="agendar" name="agendar" type = "submit">Agendar cita</button>
                <button onclick="Diseño(0)" class = "boton boton_azul">Regresar</button>
            </form>
            
        </div>
    </div>
    
<!-- Diseño registrar paciente -->
<?php elseif ($diseño === '2'):?>
    <div class="registro">
        <form id = "form_paciente" name = "form_paciente" method = "POST" class = "form_registro">
            <h2>Registrar Paciente</h2>

            <label class = "label">
                Nombre(s): <br><input type = "text" id = "p_nombre" name = "p_nombre" required class = "input_s">
            </label>
            <label class = "label">
                Apellido Paterno: <br><input type = "text" id = "p_ap_paterno" name = "p_ap_paterno" required class = "input_s">
            </label>
            <label class = "label">
                Apellido Materno: <br><input type = "text" id = "p_ap_materno" name = "p_ap_materno" required class = "input_s">
            </label>
            <label class = "label">
                Numero telefonico: <br><input type = "tel" id = "p_tel" name = "p_tel" pattern = "[0-9]{10}" maxlength = "10" required class = "input_s">
            </label>
            <label class = "label">
                Correo: <br><input type = "email" id = "p_correo" name = "p_correo" required class = "input_s">
            </label>

            <button type = "submit" id = "b_re_paciente" name = "b_re_paciente" class = "boton boton_verde">
                Registrar paciente
            </button>

            <button onclick="Diseño(0)" class = "boton boton_azul">Regresar</button>

        </form>

    </div>

<!-- Diseño ver citas canceladas -->
<?php elseif ($diseño === '3'):?>
    <h2>Citas Canceladas</h2>
    <div class = "cont prin">
        <div class = "botones_p">
            <button id = "ver_citas" type = "button" class = "boton actualizar">Actualizar</button>
            <button onclick="Diseño(0)" class = "boton boton_azul">Regresar</button>
        </div>
        <table id = "tabla_citas" class = "display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha Registro</th>
                    <th>Día de la cita</th>
                    <th>Hora de la cita</th>
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Estado</th>
                    <th>Pagado</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

<!-- Diseño ver citas atendidas -->
<?php elseif ($diseño === '4'):?>
    <h2>Citas Atendidas</h2>
    <div class = "cont prin">
        <div class = "botones_p">
            <button id = "ver_citas" type = "button" class = "boton actualizar">Actualizar</button>
            <button onclick="Diseño(0)" class = "boton boton_azul">Regresar</button>
        </div>
        <table id = "tabla_citas" class = "display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha Registro</th>
                    <th>Día de la cita</th>
                    <th>Hora de la cita</th>
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Estado</th>
                    <th>Pagado</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
<?php elseif ($diseño === '5'):?>
    <h2>Citas donde no asistio el paciente</h2>
    <div class = "cont prin">
        <div class = "botones_p">
            <button id = "ver_citas" type = "button" class = "boton actualizar">Actualizar</button>
            <button onclick="Diseño(0)" class = "boton boton_azul">Regresar</button>
        </div>
        <table id = "tabla_citas" class = "display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha Registro</th>
                    <th>Día de la cita</th>
                    <th>Hora de la cita</th>
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Estado</th>
                    <th>Pagado</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>   
<?php endif;?>