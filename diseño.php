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
                <?php
                    if (!empty($_POST['especialidad'])){
                        $id_especialidad = $_POST['especialidad'];

                        $sql = "SELECT id_doctor, nombre, ap_paterno, ap_materno
                                FROM doctor 
                                WHERE id_especialidad = :id_especialidad 
                                ORDER BY nombre";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_especialidad', $id_especialidad, PDO::PARAM_INT);
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$row['id_doctor']}'>" .
                                    htmlspecialchars(
                                        $row['nombre'] . ' ' .
                                        $row['ap_paterno'] . ' ' .
                                        $row['ap_materno']
                                    ) .
                                    "</option>";
                        }
                    }
                ?>
        </select>
    </form>
    
    <script>
        console.log('dentro de script');
        document.addEventListener('DOMContentLoaded', () => {
            const paciente = document.getElementById('paciente');
            console.log('Paciente', paciente);
            const especialidad = document.getElementById('especialidad');
            const doctor = document.getElementById('doctor');
        
            paciente.addEventListener('change', ()=>{
                especialidad.disabled = paciente.value === '';
                doctor.disabled = true;
                doctor.selectedIndex = 0;
                console.log('Paciente cambiado a', paciente.value);
            });

            especialidad.addEventListener('change', ()=>{
                doctor.disabled = especialidad.value === '';
            });
        });
    </script>

    <button onclick="Diseño(0)">Regresar</button>

<!-- Diseño registrar paciente -->
<?php else:?>
    <p>Contenido diseño 2</p>
    <button onclick="Diseño(0)">Regresar</button>
<?php endif;?>