<?php
$diseño = $_GET['diseño'] ?? '0';
?>

<?php if ($diseño === '0'):?>
    <button onclick="Diseño(1)">Agendar cita</button>
    <button onclick="Diseño(2)">Registrar paciente</button>

<?php elseif ($diseño === '1'):?>
    <p>Contenido diseño 1</p>
    <button onclick="Diseño(0)">Regresar</button>

<?php else:?>
    <p>Contenido diseño 2</p>
    <button onclick="Diseño(0)">Regresar</button>
    
<?php endif;?>
