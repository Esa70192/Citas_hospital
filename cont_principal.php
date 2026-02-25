<div class = "botones_p">
    <button onclick="Diseño(1)" class = "boton boton_azul">Agendar Cita</button>
    <button onclick="Diseño(2)" class = "boton boton_azul">Registrar Paciente</button>
    <button onclick="Diseño(2)" class = "boton boton_azul">Registrar Doctor</button>
    <button onclick="Diseño(4)" class = "boton b_verde">Citas Atendidas</button>
    <button onclick="Diseño(3)" class = "boton b_rojo">Citas Canceladas</button>
    <button onclick="Diseño(5)" class = "boton b_gris">Citas donde no asistio el paciente</button>
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