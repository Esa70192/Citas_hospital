<?php
require_once 'conexiondb.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Citas Hospital</title>
        
        <!--SELECT2-->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!--Estilo-->
        <link rel="preload" href="estilo.css" as="style">
        <link rel="stylesheet" href="estilo.css">

        <!--Font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
        
        <!-- Flatpickr Calendario -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- Tabla citas -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </head>
    <body>
        <?php if ($estado_conexion == FALSE):?>
            <?= "Error de conexion a DB";?>
        <?php else:?>
            <nav class = "nav">
                <div class="medio"><!--Izquierda-->
                    <img src="logo_alcaldia.png" alt="logoMH">
                </div>
                <h1>Citas hospital</h1>
            </nav>

            <div class = "cont cont_index" id="contenido">
                <?php include 'cont_principal.php'; ?>
            </div>

            <footer class = "card card_footer">
                <!-- Inicio del pie de página -->
                <p style="font-weight:bold; font-size:1.4rem;"> ALCALDÍA MIGUEL HIDALGO</p>
                <p>&copy; 2025 Alcaldia Miguel Hidalgo. Todos los derechos reservados.</p>
                <p>Parque Lira No. 94 Col. Observatorio C.P. 11860. CDMX (55) 5276-7700</p>
                <p>
                    Síguenos en: 
                    <a href="https://www.facebook.com/DelegacionMH/?locale=es_LA"
                    target = "_blank"
                    rel = "noopener noreferrer">
                    Facebook</a> 
                    |
                    <a href="https://x.com/AlcaldiaMHmx"
                    target = "_blank"
                    rel = "noopener noreferrer">
                    Twitter</a>
                </p>
            </footer>
            
            <!-- Diseño de pagina -->
            <script src = "js/disenio.js"></script>

            <!-- SELECCIONAR DATOS PARA CITA -->
            <script src = "js/select_datos_cita.js"></script>

            <!-- CREAR CITA -->
            <script src = "js/crear_cita.js"></script>
            
            <!-- Registrar paciente -->
            <script src = "js/registrar_paciente.js"></script>

            <!-- VER CITAS DATA TABLE -->
            <script src = "js/ver_citas.js"></script>

            <!-- Destruir tablas js -->
            <script>
                function eliminar_tabla(){
                    if($.fn.DataTable.isDataTable('#tabla_citas')){
                        tabla.destroy();
                    }
                }
            </script>

            <!-- Cambiar estado de cita -->
            <script src = "js/cambiar_estado_cita.js"></script>

            <!-- DATA TABLE -->
            <!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> -->
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <?php endif; ?>
    </body>
</html>