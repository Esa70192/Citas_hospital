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