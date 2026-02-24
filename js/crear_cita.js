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