<?php
require_once 'conexiondb.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Citas Hospital</title>
        
        <!--SELECT2-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            
            <script>
                function Diseño(num) {
                  fetch('diseño.php?diseño=' + num)
                    .then(res => res.text())         
                    .then(html => {
                        document.getElementById('contenido').innerHTML = html; 

                        $('.select2').each(function() {
                            $(this).select2({
                                placeholder: $(this).data('placeholder'),
                                allowClear: true,
                                width: '100%'
                            });
                        });
                    });
                }
            </script>

            <script>
                //SELECIONAR PRIMERO PACIENTE Y DESPUES HABILIDAR ESPECIALIDAD
                $(document).on('change', '#paciente', function () {
                    //Verificar si se selecciono paciente y especialidad
                    const paciente = this;
                    const especialidad = document.getElementById('especialidad');
                    //const doctor = document.getElementById('doctor');
                    if (!especialidad || !doctor) return;
                    especialidad.disabled = paciente.value === '';
                    // doctor.disabled = true;
                    // doctor.selectedIndex = 0;
                });

                //DE LA ESPECIALIDAD ELEJIR DOCTOR
                $(document).on('change', '#especialidad', function(){
                    const especialidad = this.value;
                    const doctor = document.getElementById('doctor');
                    if (!especialidad) return;

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
                });
                
                //DEL DOCTOR MOSTRAR DIAS DISPONIBLES 
                $(document).on('change', '#doctor', function (){
                    let calendario = null;
                    const doctor = this.value;
                    if(!doctor) return;
                    if (!calendario) {
                        const inputDia = document.getElementById('dia');
                        if (!inputDia) return;
                        calendario = flatpickr("#dia", {
                            dateFormat: "Y-m-d",
                            minDate: "today",
                            enable: [],
                            onChange: function(selectedDates, dateStr, instance) {
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
                })    

                //DEL DIA SELECCIONADO MOSTRAR HORAS DISPONIBLES
                $(document).on('change', '#dia', function(){
                    const dia = this.value;
                    const doctor = document.getElementById('doctor').value;
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
                })
                   
            </script>

            <script>
                 //Crear cita 
                document.addEventListener('submit', function(e){
                    if(e.target.id === 'form_cita'){
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
                                e.target.reset();
                                $('#paciente').val(null).trigger('change');
                                $('#especialidad').val(null).trigger('change');
                                $('#doctor').val(null).trigger('change');
                                $('#hora').val(null).trigger('change');
                            } else {
                                alert(msg);
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Error al agendar cita');
                        });
                    }            
                });
            </script> 
            
            <script>
                //Registrar paciente
                document.addEventListener('submit', function (e){
                    if(e.target.id === 'form_paciente'){
                        e.preventDefault();

                        const nombre = document.getElementById('p_nombre').value;
                        const ap_paterno = document.getElementById('p_ap_paterno').value;
                        const ap_materno = document.getElementById('p_ap_materno').value;
                        const telefono = document.getElementById('p_tel').value;
                        const correo = document.getElementById('p_correo').value;

                        if(!nombre || !ap_paterno || !ap_materno) return;
                        
                        fetch('registrar_paciente.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                nombre,
                                ap_paterno,
                                ap_materno,
                                telefono,
                                correo
                            })
                        })
                        .then(res => res.text())
                        .then(msg => {
                            if (msg === 'ok'){
                                alert('Paciente Registrado Correctamente');
                                e.target.reset();
                            }else {
                                alert(msg);
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Error al Registrar Paciente');
                        });
                    }
                })
            </script>

            <!-- VER CITAS PROXIMAS  DATA TABLE-->
            <script>
                document.addEventListener('click', function (e){
                    if(e.target.id === 'ver_citas'){
                        e.preventDefault();
                        
                        fetch('citas_proximas.php')
                        .then(response => response.json())
                        .then(data => {

                            if($.fn.DataTable.isDataTable('#tabla_citas')){
                                tabla.destroy();
                            }

                            tabla = $('#tabla_citas').DataTable({
                                data: data,
                                columns: [
                                    { data: 'id_cita' },
                                    { data: 'fecha_registro' },
                                    { data: 'dia_cita' },
                                    { data: 'hora_cita' },
                                    { data: 'paciente' },
                                    { data: 'doctor' },
                                    { data: 'estado_cita' },
                                    { data: 'pagado' }
                                ],
                                language: {
                                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                                }
                            });

                        })
                        .catch(error => {
                            console.error('Error', error);
                        });
                    }
                });
            </script>

            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <?php endif; ?>
    </body>
</html>