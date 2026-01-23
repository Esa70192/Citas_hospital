<?php
require_once 'conexiondb.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Citas Hospital</title>
        <!--Bootstrap-->
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.21.1/dist/css/coreui.min.css" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.21.1/dist/js/coreui.bundle.min.js"></script>-->
        <!--Estilo-->
        <link rel="preload" href="estilo.css" as="style">
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <?php if ($estado_conexion == FALSE):?>
            <?= "Error de conexion a DB";?>
        <?php else:?>
            <h1>Citas hospital</h1>
            <div id="contenido">
                <button onclick="Diseño(1)">Agendar cita</button>
                <button onclick="Diseño(2)">Registrar paciente</button>
            </div>
            
            <script>
                function Diseño(num) {
                  fetch('diseño.php?diseño=' + num) // hace la petición al servidor
                    .then(res => res.text())         // toma la respuesta como texto
                    .then(html => {
                      document.getElementById('contenido').innerHTML = html; // actualiza el div
                    });
                }
            </script>

        <?php endif; ?>
    </body>
</html>