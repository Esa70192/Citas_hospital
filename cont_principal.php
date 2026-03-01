<!-- **********
    DISEÑO INDEX
    **********  -->
<div class = "botones_p">
    <button onclick="Diseño(1)" class = "boton boton_azul">Agendar Cita</button>
    <button onclick="Diseño(10)" class = "boton b_azul2">Pacientes</button>
    <button onclick="Diseño(6)" class = "boton b_azul2">Doctores</button>
    <button onclick="Diseño(9)" class = "boton b_verde">Otras citas</button>
</div>

<div class = "cont prin">
    <h2>Proximas Citas</h2>
    <button id = "ver_citas" type = "button" class = "boton actualizar">Actualizar</button>
    <table id = "tabla_citas" class = "display">
        <thead>
            <tr>
                <th>ID</th>
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