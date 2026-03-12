let tabla;

document.addEventListener("click", function(e){
    if(e.target && e.target.id === "ver_citas"){

        const select_citas = document.getElementById("t_citas");
        let estado = parseInt(select_citas.value);

        if (isNaN(estado)) {
            alert("Seleccione un tipo de cita");
            return;
        }

        const titulo = document.querySelector("h2");
        switch(estado){
            case 0:
                titulo.innerText = "Todas las Citas";
                break;
            case 1:
                titulo.innerText = "Citas Canceladas";
                break;
            case 2:
                titulo.innerText = "Próximas Citas";
                break;
            case 3:
                titulo.innerText = "Citas Completadas";
                break;
            case 4:
                titulo.innerText = "Paciente No Asistió";
                break;
        }
        cargar_citas(estado);
    }
})

// estado de citas: 
// 0 todas las citas 
// 1 cancelado
// 2 programado
// 3 completada
function cargar_citas(estado){
    //console.log(estado);

    Promise.all([
        fetch('sql/ver_citas.php',{
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

        let columnas;

        if(estado !== 2){
            
            columnas = [
                    { 
                        data: null,          // no viene del JSON
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // devuelve 1,2,3,...
                        },
                        title: "#"           // título de la columna
                    },
                    { data: 'id_cita' },
                    { data: 'fecha_registro' },
                    { data: 'dia_cita' },
                    { data: 'hora_cita' },
                    { data: 'paciente' },
                    { data: 'doctor' },
                    { data: 'estado_cita'},
                    { data: 'pagado' }
                ];

        }else{
            columnas = [
                { 
                    data: null,          // no viene del JSON
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // devuelve 1,2,3,...
                    },
                    title: "#"           // título de la columna
                },
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
            ];
        }

        tabla = $('#tabla_citas').DataTable({
            destroy: true, 
            stateSave: true,
            stateDuration: -1,
            data: citas,
            columns: columnas,
            language: {
                url:  'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
        // Para poner estilo especifico a columnas poner abajo de columns: columnas
        // columnDefs: [
        //     { targets: 3 o [0,1,2,3], className: 'text-center o se puede usar estilo de css' }  columna 4 (index 3)
        // ]
        // O
        // { data: 'pagado', className: 'text-center' }

        /*Para solo actualizar datos quitar destroy:true 
        tabla.clear();
        tabla.rows.add(citas);
        tabla.draw();*/

    })
    .catch(error => {
        console.error('Error', error);
    });
}
