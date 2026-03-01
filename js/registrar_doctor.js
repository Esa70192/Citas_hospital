document.addEventListener('submit', function (e){
    if(e.target.id === 'form_doctor'){
        e.preventDefault();

        const nombre = document.getElementById('d_nombre').value;
        const ap_paterno = document.getElementById('d_ap_paterno').value;
        const ap_materno = document.getElementById('d_ap_materno').value;
        const especialidad = document.getElementById('d_especialidad').value;
        const estado = document.getElementById('d_estado').value;

        if(!nombre || !ap_paterno || !ap_materno || !especialidad || !estado) return;
        
        fetch('sql/registrar_doctor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                nombre,
                ap_paterno,
                ap_materno,
                especialidad,
                estado
            })
        })
        .then(res => res.text())
        .then(msg => {
            if (msg === 'ok'){
                alert('Doctor Registrado Correctamente');
                e.target.reset();
            }else {
                alert(msg);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al Registrar Doctor');
        });
    }
})