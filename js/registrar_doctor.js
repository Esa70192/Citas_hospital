document.addEventListener('submit', function (e){
    if(e.target.id === 'form_doctor'){
        e.preventDefault();

        const nombre = document.getElementById('d_nombre').value;
        const ap_paterno = document.getElementById('d_ap_paterno').value;
        const ap_materno = document.getElementById('d_ap_materno').value;
        const especialidad = document.getElementById('d_especialidad').value;
        const estado = document.getElementById('d_estado').value;

        if(!nombre || !ap_paterno || !ap_materno || !especialidad || !estado) return;
                    
        let dias = ["2","3","4","5","6","7","1"];/*lunes - domingo*/

        let horario = {};

        dias.forEach(dia => {

            let entrada = document.querySelector(`[name="${dia}_en"]`).value;
            let salida = document.querySelector(`[name="${dia}_sa"]`).value;

            horario[dia] = {
                entrada: entrada ? entrada.split(":")[0] : null,
                salida: salida ? salida.split(":")[0] : null
            };

        });

        console.log(horario);
        
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
                estado,
                horario: JSON.stringify(horario)
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