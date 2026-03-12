//Ver datos doctor

function cargar_pac(){

    Promise.all([
        fetch('sql/ver_pac.php',).then(res => res.json())])
    .then(([ver_pac]) => {

        tabla = $('#tabla_citas').DataTable({
            data: ver_pac,
            columns: [
                { data: 'id_paciente' },
                { data: 'paciente' },
                { data: 'telefono' },
                { data: 'correo' }
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
        
    })
    .catch(error => {
        console.error('Error', error);
    });
}

document.addEventListener('click', function (e){
    if(e.target.id === 'ver_pac'){
        e.preventDefault();
        cargar_pac();
    }
});