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