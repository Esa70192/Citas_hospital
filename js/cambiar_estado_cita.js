document.addEventListener('change', function(e){

    // Verificamos que el elemento tenga la clase
    if(e.target.classList.contains('cambiar-estado')){

        if(!confirm("¿Estás seguro(a) de que deseas cambiar el estado de esta cita?")){
            return;
        }

        let id_cita = e.target.dataset.id;
        let id_estado_cita = e.target.value;
        
        const select_citas = document.getElementById("t_citas");
        let estado = parseInt(select_citas.value);

        fetch('sql/actualizar_estado_cita.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id_cita=${id_cita}&id_estado_cita=${id_estado_cita}`
        })
        .then(response => response.text())
        .then(data => {
            alert("Estado actualizado.");
            cargar_citas(estado);
            // console.log(data);
        })
        .catch(error => {
            alert("Error:" + error);
        });
    }

});