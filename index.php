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
                  fetch('diseño.php?diseño=' + num)
                    .then(res => res.text())         
                    .then(html => {
                      document.getElementById('contenido').innerHTML = html; 
                    });
                }
            </script>

            <script>
                document.addEventListener('change', function (e) {
                    //Verificar si se selecciono paciente y especialidad
                    if (e.target.id === 'paciente'){
                        const paciente = e.target;
                        const especialidad = document.getElementById('especialidad');
                        const doctor = document.getElementById('doctor');

                        if (!especialidad || !doctor) return;

                        especialidad.disabled = paciente.value === '';
                        doctor.disabled = true;
                        doctor.selectedIndex = 0;

                    }

                    //De la especialidad, extraer los doctores
                    if (e.target.id === 'especialidad'){
                        const especialidad = e.target.value;
                        const doctor = document.getElementById('doctor');
                        if (!doctor) return;
                        
                        doctor.innerHTML = '<option value="">Cargando...</option>';
                        doctor.disabled = true;

                        if(especialidad === ''){
                            doctor.innerHTML = '<option value="">Selecione al doctor</option>';
                            return;
                        }

                        fetch('select_doctor.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                especialidad: especialidad
                            })
                        })
                        .then(res => res.text())
                        .then(html => {
                            doctor.innerHTML = '<option value="">Seleccione al doctor</option>' + html;
                            doctor.disabled = false;
                        });
                    }

                    //Mostrar dia actual en adelante 
                    if(e.target.id === 'dia'){
                        const hoy = new Date().toLocaleDateString('en-CA');
                        document.getElementById('dia').min = hoy;
                    }

                    //Del doctor, mostrar dias con horas disponibles
                    if(e.target.id === 'doctor'){
                        const doctor = e.target.value;
                        const dia = document.getElementById('dia');
                        if(!dia) return;

                        fetch('select_dia.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                doctor: doctor
                            })
                        })
                        .then(res => res.json())
                        .then(html => {
                            dia.min = data.min;
                            dia.max = dia.max;
                            dia.value = '';
                            dia.disabled = false;
                        });
                    }


                });
                
            </script>

        <?php endif; ?>
    </body>
</html>