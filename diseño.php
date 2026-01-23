<?php
require_once 'conexiondb.php';
$diseño = $_GET['diseño'] ?? '0';
?>

<?php if ($diseño === '0'):?>
    <button onclick="Diseño(1)">Agendar cita</button>
    <button onclick="Diseño(2)">Registrar paciente</button>

<?php elseif ($diseño === '1'):?>
    <p>diseño</p>
    <form id="selectTabla" method = 'GET' class="form_select_tabla">
        <div class="select_tabla">
            <select class="form-multi-select" id="ms1" data-coreui-search="global">
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
        </div>
    </form>
    <button onclick="Diseño(0)">Regresar</button>
<?php else:?>
    <p>Contenido diseño 2</p>
    <button onclick="Diseño(0)">Regresar</button>
<?php endif;?>