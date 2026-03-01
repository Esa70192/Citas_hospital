function cargar_citas(){
    eliminar_tabla();

    Promise.all([
        fetch('sql/ver_doctores.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                estado
            })
        }).then(res => res.json()),
        fetch('sql/estado_cita.php').then(res => res.json())
    ])
    .then(([citas, estados]) => {
        {
            tabla = $('#tabla_citas').DataTable({
                data: citas,
                columns: [
                    { data: 'id_doctor' },
                    { data: 'doctor' },
                    { data: 'especialidad' },
                    { 
                        data: 'estado',
                        render: function(data, type, row){

                            let select = `<select class="form-select estado_doctor cambiar-estado_doctor" data-id="${row.id_doctor}">`;

                            estados.forEach(function(estado_doctor){
                                select += `
                                    <option value="${estado_doctor.id_estado_doctor}"
                                        ${estado_doctor.id_estado_cita == data ? 'selected' : ''}>
                                        ${estado_doctor.descripcion}
                                    </option>
                                `;
                            });

                            select += `</select>`;
                            return select;
                        }
                    },
                    { data: 'pagado' }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        }
    })
    .catch(error => {
        console.error('Error', error);
    });
}

document.addEventListener('click', function (e){
    if(e.target.id === 'ver_citas'){
        e.preventDefault();
        cargar_citas();
    }
});