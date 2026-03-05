<!-- **********
    DISEÑO INDEX
    **********  -->

<div class = "botones_p">
    <button onclick="Diseño(1)" class = "boton boton_azul">Agendar Cita</button>
    <button onclick="Diseño(10)" class = "boton b_azul2">Pacientes</button>
    <button onclick="Diseño(6)" class = "boton b_azul2">Doctores</button>
</div>

<div class = "cont prin">

    <div class = "botones_p">
        <p>Seleccione el tipo de cita: </p> 
        <select id="t_citas" name="t_citas" class = " select_c" data-placeholder="Seleccione el tipo de cita">
            <option value="">Seleccione el tipo de cita</option>
            <option value="0">Todas las Citas</option>
            <option value="1">Citas Canceladas</option>
            <option value="2">Proximas Citas</option>
            <option value="3">Completada</option>
            <option value="4">Paciente No Asistio</option>
        </select>
        <button id = "ver_citas" type = "button" class = "boton actualizar">Actualizar</button>
    </div>

    <h2 id = "titulo_citas"></h2>
    <table id = "tabla_citas" class = "display">
        <thead>
            <tr>
                <th>ID CITA</th>
                <th>Fecha Registro</th>
                <th>Día de la cita</th>
                <th>Hora de la cita</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Estado</th>
                <th>Pagado</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>