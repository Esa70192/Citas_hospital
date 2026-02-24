// estado de citas: 
// 1 cancelado
// 2 programado
// 3 completada
function cargar_citas(){
    eliminar_tabla();
    let estado = null;
    if(diseño_actual === 3){
        estado = 1; 
    }else if(diseño_actual === 4){
        estado = 3;
    }else{
        estado = 2;
    }

    Promise.all([
        fetch('ver_citas.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                estado
            })
        }).then(res => res.json()),
        fetch('estado_cita.php').then(res => res.json())
    ])
    .then(([citas, estados]) => {

        if(diseño_actual === 3 || diseño_actual === 4){
            tabla = $('#tabla_citas').DataTable({
                data: citas,
                columns: [
                    { data: 'id_cita' },
                    { data: 'fecha_registro' },
                    { data: 'dia_cita' },
                    { data: 'hora_cita' },
                    { data: 'paciente' },
                    { data: 'doctor' },
                    { data: 'estado_cita'},
                    { data: 'pagado' }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        }else{
            tabla = $('#tabla_citas').DataTable({
                data: citas,
                columns: [
                    { data: 'id_cita' },
                    { data: 'fecha_registro' },
                    { data: 'dia_cita' },
                    { data: 'hora_cita' },
                    { data: 'paciente' },
                    { data: 'doctor' },
                    { 
                        data: 'id_estado_cita',
                        render: function(data, type, row){

                            let select = `<select class="form-select estado cambiar-estado" data-id="${row.id_cita}">`;

                            estados.forEach(function(estado){
                                select += `
                                    <option value="${estado.id_estado_cita}"
                                        ${estado.id_estado_cita == data ? 'selected' : ''}>
                                        ${estado.descripcion}
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