document.addEventListener('change', function(e){

    // Verificamos que el elemento tenga la clase
    if(e.target.classList.contains('cambiar-estado')){

        let id_cita = e.target.dataset.id;
        let id_estado_cita = e.target.value;

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
            cargar_citas();
            // console.log(data);
        })
        .catch(error => {
            alert("Error:" + error);
        });
    }

});