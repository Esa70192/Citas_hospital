document.addEventListener('change', function(e){

    // Verificamos que el elemento tenga la clase
    if(e.target.classList.contains('cambiar-estado-doct')){

        if(!confirm("¿Estás seguro(a) de que deseas cambiar el estado del doctor?")){
            cargar_doct();
            return;
        }

        let id_doct = e.target.dataset.id;
        let id_estado_doct = e.target.value;

        fetch('sql/actualizar_estado_doct.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id_doct=${id_doct}&id_estado_doct=${id_estado_doct}`
        })
        .then(response => response.text())
        .then(data => {
            alert("Estado actualizado.");
            cargar_doct();
            // console.log(data);
        })
        .catch(error => {
            alert("Error:" + error);
        });
    }

});