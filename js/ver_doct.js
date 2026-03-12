//Ver datos doctor

function cargar_doct(){

    Promise.all([
        fetch('sql/ver_doct.php',).then(res => res.json()),
        fetch('sql/estado_doct.php').then(res => res.json())
    ])
    .then(([ver_doct, estados_doct]) => {

        tabla = $('#tabla_citas').DataTable({
            data: ver_doct,
            columns: [
                { data: 'id_doctor' },
                { data: 'Doctor' },
                { data: 'Especialidad' },
                { 
                    data: 'id_estado_doctor',
                    render: function(data, type, row){

                        let select = `<select class="form-select estado cambiar-estado-doct" data-id="${row.id_doctor}">`;

                        estados_doct.forEach(function(estado){
                            select += `
                                <option value="${estado.id_estado_doctor}"
                                    ${estado.id_estado_doctor == data ? 'selected' : ''}>
                                    ${estado.descripcion}
                                </option>
                            `;
                        });

                        select += `</select>`;
                        return select;
                    }
                }
                
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
    if(e.target.id === 'ver_doct'){
        e.preventDefault();
        cargar_doct();
    }
});