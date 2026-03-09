<?php
require_once 'conexiondb.php';
$diseño = $_GET['diseño'] ?? '0';
?>

<!-- **********
    DISEÑO INDEX
    **********  -->
<?php if ($diseño === '0'):?>
    <?php include 'cont_principal.php'; ?>

<!-- **********
    DISEÑO APARTIR DE "AGENDAR CITA"
    **********  -->
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
                <button onclick="Diseño(0)" class = "boton b_nara">Regresar</button>
            </form>
            
        </div>
    </div>
    
<!-- **********
    DISEÑO APARTIR DE "PACIENTES"
    **********  -->
<?php elseif ($diseño === '10'):?>
    <h2>Pacientes</h2>
    <div class = "cont prin">
        
        <div class = "botones_p">
            <button onclick="Diseño(2)" class = "boton boton_azul">Registrar Paciente</button>
            <!-- <button onclick="Diseño(8)" class = "boton actualizar">Actualizar datos</button> -->
            <button onclick="Diseño(0)" class = "boton b_nara">Regresar</button>
            <button id = "ver_pac" type = "button" class = "boton actualizar">Actualizar</button>
        </div>
        
        <table id = "tabla_citas" class = "display">
            <thead>
                <tr>
                    <th>ID de Paciente</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    
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

            <button onclick="Diseño(10)" class = "boton b_nara">Regresar</button>

        </form>

    </div>

<!-- **********
    DISEÑO APARTIR DE "DOCTORES"
    **********  -->
<!-- Diseño botones registrar/estado -->
<?php elseif ($diseño === '6'):?>
    <h2>Doctores</h2>
    <div class = "cont prin">
        
        <div class = "botones_p">
            <button onclick="Diseño(7)" class = "boton boton_azul">Registrar Doctor</button>
            <!-- <button onclick="Diseño(8)" class = "boton actualizar">Actualizar datos</button> -->
            <button onclick="Diseño(0)" class = "boton b_nara">Regresar</button>
            <button id = "ver_doct" type = "button" class = "boton actualizar">Actualizar</button>
        </div>

        <table id = "tabla_citas" class = "display">
            <thead>
                <tr>
                    <th>ID Doctor</th>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
<!-- Diseño registrar Doctor -->
<?php elseif ($diseño === '7'):?>
    <div class="registro">
        <form id = "form_doctor" name = "form_doctor" method = "POST" class = "form_registro">
            <h2>Registrar Doctor</h2>

            <label class = "label">
                Nombre(s): <br><input type = "text" id = "d_nombre" name = "d_nombre" required class = "input_s">
            </label>
            <label class = "label">
                Apellido Paterno: <br><input type = "text" id = "d_ap_paterno" name = "d_ap_paterno" required class = "input_s">
            </label>
            <label class = "label">
                Apellido Materno: <br><input type = "text" id = "d_ap_materno" name = "d_ap_materno" required class = "input_s">
            </label>
            <label class = "label"> Especialidad: <br>
                <select id="d_especialidad" name="d_especialidad" class = "select2" data-placeholder="Seleccione al paciente">
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
            <label class = "label"> Estado: <br>
                <select id="d_estado" name="d_estado" class = "select2" data-placeholder="Seleccione el estado">
                    <option value="">Seleccione el estado</option>
                    <?php
                    $sql = "SELECT id_estado_doctor, descripcion FROM estado_doctor ORDER BY descripcion";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id_estado_doctor']}'>" .
                            htmlspecialchars($row['descripcion']) .
                            "</option>";
                    }
                    ?>
                </select>
            </label>
            
            <label class = "label"> Horario<br>Lunes: De 
                <select id="h_lunes_en" name="h_lunes_en" class = "select_c" data-placeholder="Seleccione el estado">
                    <option value="">--</option>
                    <option value="00">00:00 hrs</option>
                    <option value="01">01:00 hrs</option>
                </select>
                A 
                <select id="h_lunes_sa" name="h_lunes_sa" class = "select_c" data-placeholder="Seleccione el estado">
                    <option value="">--</option>
                    <option value="00">00:00 hrs</option>
                    <option value="01">01:00 hrs</option>
                </select>
            </label>

            <button type = "submit" id = "b_re_doctor" name = "b_re_doctor" class = "boton boton_verde">
                Registrar Doctor
            </button>

            <button onclick="Diseño(6)" class = "boton b_nara">Regresar</button>

        </form>

    </div>
<!-- Diseño actaulizar datos doctor -->
<?php elseif ($diseño === '8'):?>
    <div class="registro">
        <form id = "form_doctor" name = "form_doctor" method = "POST" class = "form_registro">
            <h2>Actualizar datos de Doctor</h2>

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
                Especialidad: <br><input type = "tel" id = "p_tel" name = "p_tel" pattern = "[0-9]{10}" maxlength = "10" required class = "input_s">
            </label>
            <label class = "label">
                Estado: <br><input type = "email" id = "p_correo" name = "p_correo" required class = "input_s">
            </label>

            <button type = "submit" id = "b_re_doctor" name = "b_re_doctor" class = "boton boton_verde">
                Registrar Doctor
            </button>

            <button onclick="Diseño(6)" class = "boton b_nara">Regresar</button>

        </form>

    </div>
<?php endif;?>