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
        <!-- Flatpickr Calendario -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
                let calendario = null;
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
                                  
                    //Del doctor, mostrar dias con horas disponibles
                    if(e.target.id === 'doctor'){
                        const doctor = e.target.value;
                        console.log(doctor);
                        if(!doctor) return;

                        if (!calendario) {
                            const inputDia = document.getElementById('dia');
                            if (!inputDia) return;

                            calendario = flatpickr("#dia", {
                                dateFormat: "Y-m-d",
                                minDate: "today",
                                enable: [],

                                onChange: function(selectedDates, dateStr, instance) {
                                // console.log("Selected Dates Array:", selectedDates);
                                // console.log("Selected Date String:", dateStr);

                                // Aquí podrías hacer fetch de horas disponibles para esa fecha
                                if (selectedDates.length > 0) {
                                    const fecha = dateStr; // "YYYY-MM-DD"
                                    console.log("Usuario eligió:", fecha);
                                }
                            }
                            });
                        }
                        
                        fetch('prueba.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                doctor: doctor
                            })
                        })
                        .then(res => res.json())
                        .then(fechasDisponibles => {
                            calendario.clear();
                            calendario.set('enable', fechasDisponibles);
                        });
                        console.log(calendario.selectedDates);
                    }

                    //Selecionar la hora
                    if(e.target.id === 'dia'){
                        const doctor = document.getElementById('doctor').value;
                        const dia = e.target.value;
                        const hora = document.getElementById('hora');

                        if(!dia || !doctor) return;

                        fetch('select_hora.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                doctor: doctor,
                                dia: dia
                            })
                        })
                        .then(res => res.json())
                        .then(horasDisponibles => {
                            let html = '<option value="">Seleccione la hora</option>';
                            horasDisponibles.forEach(h=>{
                                html += `<option value="${h}">${h.substring(0,5)}</option>`;
                            });
                            hora.innerHTML = html;
                            hora.disabled = false;
                        })
                        .catch(err=>{
                            console.error('Error cargarndo horas:',err);
                        });
                        
                    }
                    // console.log(hora.value);
                    
                });
                
            </script>

            <script>
                 //Crear cita 
                document.addEventListener('DOMContentLoaded', function(){
                    const form = document.getElementById('form_cita');
                    console.log('Dentro');
                    if(!form) return;
                    console.log('dentro 2');
                    form.addEventListener('submit', function(e){
                        
                        e.preventDefault();
                        console.log('SUMBIT OK');
                        const doctor = document.getElementById('doctor').value;
                        const dia = document.getElementById('dia').value;
                        const paciente = document.getElementById('paciente').value;
                        const hora = document.getElementById('hora').value;

                        if(!dia || !doctor || !paciente || !hora) return;

                        fetch('agendar_cita.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                doctor,
                                dia,
                                paciente,
                                hora
                            })
                        })
                        .then(res => res.text())
                        .then(msg => {
                            if (msg === 'ok') {
                                alert('Cita agendada correctamente');
                            } else {
                                alert(msg);
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Error al agendar cita');
                        });
                    });
                });
            </script>            

        <?php endif; ?>
    </body>
</html>