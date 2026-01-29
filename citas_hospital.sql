CREATE DATABASE CITAS_HOSPITAL;
USE CITAS_HOSPITAL;

CREATE TABLE doctor(
	id_doctor INT AUTO_INCREMENT,
	nombre VARCHAR (50) NOT NULL,
	ap_paterno VARCHAR(50) NOT NULL,
	ap_materno VARCHAR(50),
	id_especialidad INT not null,
	id_estado_doctor INT not null,
	CONSTRAINT pk_doctor PRIMARY KEY (id_doctor)
);
alter table doctor
	add constraint fk_doctor_id_especialidad 
	foreign key (id_especialidad)
	references especialidad(id_especialidad);
alter table doctor
	add constraint fk_doctor_id_estado_doctor 
	foreign key (id_estado_doctor)
	references estado_doctor(id_estado_doctor);


CREATE TABLE horario_doctor(
	id_horario_doctor INT AUTO_INCREMENT,
	id_doctor INT not null,
	dia_semana tinyint not null comment '1=Domingo - 7=Sabado',
	hora_inicio TIME not null,
	hora_fin TIME not null,
	CONSTRAINT pk_horario_doctor PRIMARY KEY (id_horario_doctor)
);
alter table horario_doctor
	add constraint fk_horario_doctor_id_doctor
	foreign key (id_doctor)
	references doctor(id_doctor);


CREATE TABLE horario_doctor_hora(
	id_horario_doctor_hora INT AUTO_INCREMENT,
	id_doctor INT NOT NULL,
	dia_semana TINYINT NOT NULL COMMENT '1=Domingo - 7=Sabado',
	hora TIME NOT NULL,
	CONSTRAINT pk_horario_doctor_hora PRIMARY KEY (id_horario_doctor_hora),
	CONSTRAINT fk_horario_doctor_hora_id_doctor
		FOREIGN KEY (id_doctor)
		REFERENCES doctor(id_doctor),
	CONSTRAINT uq_doctor_dia_hora UNIQUE (id_doctor, dia_semana, hora)
);

CREATE TABLE estado_doctor(
	id_estado_doctor INT AUTO_INCREMENT,
	descripcion VARCHAR(50),
	CONSTRAINT pk_estado_doctor PRIMARY KEY (id_estado_doctor)
);


CREATE TABLE paciente(
	id_paciente INT AUTO_INCREMENT,
	nombre VARCHAR(50) NOT null,
	ap_paterno VARCHAR(50) not null,
	ap_materno VARCHAR(50),
	telefono varchar(20),
	correo VARCHAR(50),
	CONSTRAINT pk_paciente PRIMARY KEY (id_paciente)
);

CREATE TABLE cita(
	id_cita INT AUTO_INCREMENT,
	id_doctor INT not null,
	id_paciente INT not null,
	fecha_registro DATETIME not null default current_timestamp,
	fecha_cita DATETIME not null,
	
	id_estado_cita INT not null,
	pagado BOOL not null default false,
	CONSTRAINT pk_cita PRIMARY KEY (id_cita)
);
alter table cita
	add hora_cita time not null,
	add dia_cita date not null;
alter table cita
	drop column fecha_cita;
alter table cita
	add constraint fk_cita_id_doctor
	foreign key (id_doctor)
	references doctor(id_doctor);
alter table cita
	add constraint fk_cita_id_paciente
	foreign key (id_paciente)
	references paciente(id_paciente);
alter table cita
	add constraint fk_cita_id_estado_cita
	foreign key (id_estado_cita)
	references estado_cita(id_estado_cita);

CREATE TABLE recibo(
	id_recibo INT AUTO_INCREMENT,
	id_cita INT not null,
	fecha_pago DATETIME not null,
	monto decimal(10,2) not null,
	id_metodo_pago INT not null,
	CONSTRAINT pk_recibo PRIMARY KEY (id_recibo)
);
alter table recibo
	add constraint fk_recibo_id_cita
	foreign key (id_cita)
	references cita(id_cita);
alter table recibo
	add constraint fk_recibo_id_metodo_pago
	foreign key (id_metodo_pago)
	references metodo_pago(id_metodo_pago);

CREATE TABLE metodo_pago(
	id_metodo_pago INT auto_increment,
	descripcion VARCHAR(50),
	CONSTRAINT pk_metodo_pago PRIMARY KEY (id_metodo_pago)
);

CREATE TABLE estado_cita(
	id_estado_cita INT AUTO_INCREMENT,
	descripcion VARCHAR(50),
	CONSTRAINT pk_estado_cita PRIMARY KEY (id_estado_cita)
);

CREATE TABLE especialidad(
	id_especialidad INT AUTO_INCREMENT,
	descripcion VARCHAR(50),
	CONSTRAINT pk_especialidad PRIMARY KEY (id_especialidad)
);

insert into especialidad (descripcion) values ('esp2')
insert into metodo_pago (descripcion) values ('debito')
insert into estado_cita (descripcion) values ('no_asistio')
insert into estado_doctor (descripcion) values ('no_disponible')
insert into doctor values (null,'asdeo','gab','per',2,1)
insert into horario_doctor values (null, 1, 6, '16:00:00', '00:00:00')
insert into paciente values (null, 'dylan', 'res', 'mar','551425447','asdo@gmail.com');

select 
	dia_semana,
	hora_inicio,
	hora_fin
from horario_doctor
where id_doctor = 1
order by dia_semana;

SELECT id_doctor, nombre, ap_paterno, ap_materno
FROM doctor
WHERE id_especialidad = 1;

WITH RECURSIVE horas AS ( 
	SELECT hora_inicio AS hora 
	FROM horario_doctor 
	WHERE id_doctor = 1 
	AND dia_semana = 2 
	UNION ALL 
	SELECT ADDTIME(hora, '01:00:00') 
	FROM horas 
	WHERE ADDTIME(hora, '01:00:00') < ( 
		SELECT hora_fin 
		FROM horario_doctor 
		WHERE id_doctor = 1 
		AND dia_semana = 2 
	) 
) 
SELECT hora 
FROM horas;

WITH RECURSIVE numeros AS (
    SELECT 0 AS n
    UNION ALL
    SELECT n + 1 FROM numeros WHERE n < 23
)
INSERT INTO horario_doctor_hora (id_doctor, dia_semana, hora)
SELECT 
    hd.id_doctor,
    hd.dia_semana,
    ADDTIME(hd.hora_inicio, SEC_TO_TIME(n.n * 3600)) AS hora
FROM horario_doctor hd
JOIN numeros n
    ON ADDTIME(hd.hora_inicio, SEC_TO_TIME(n.n * 3600)) < hd.hora_fin
ON DUPLICATE KEY UPDATE hora = hora;

SELECT h.hora
FROM horario_doctor_hora h
LEFT JOIN cita c
    ON c.id_doctor = h.id_doctor
    AND c.dia_cita = '2026-02-01'
    AND c.hora_cita = h.hora
WHERE h.id_doctor = 1
  AND h.dia_semana = DAYOFWEEK('2026-02-01')
  AND c.id_cita IS NULL
ORDER BY h.hora;

