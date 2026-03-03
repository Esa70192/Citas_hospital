//Ver datos de doctor/paciente

function cargar_citas(){
    eliminar_tabla();
    let estado = null;
    if(diseño_actual === 6){ //Doctor
        estado = 1; 
    }else if(diseño_actual === 10){ //Paciente
        estado = 2;
    }

    Promise.all([
        fetch('sql/ver_doct_pac.php',{
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
    .then(([ver_d_p, estados]) => {

        if(diseño_actual === 6){ //Doctor
            tabla = $('#tabla_d_p').DataTable({
                data: ver_d_p,
                columns: [
                    { data: 'id_doctor' },
                    { data: 'nombre' },
                    { data: 'especialidad' },
                    { 
                        data: 'id_estado_doctor',
                        render: function(data, type, row){

                            let select = `<select class="form-select estado cambiar-estado" data-id="${row.id_doctor}">`;

                            estados.forEach(function(estado){
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
        }else if(diseño_actual === 10){ //Paciente
            tabla = $('#tabla_d_p').DataTable({
                data: ver_d_p,
                columns: [
                    { data: 'id_paciente' },
                    { data: 'nombre' },
                    { data: 'telefono' },
                    { data: 'correo' },
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