CREATE DATABASE pase_lista_itsmt COLLATE utf8_spanish_ci;

USE pase_lista_itsmt;

-- -------------------------------------------------------

-- BORRANDO TABLAS EN CASO DE QUE EXISTAN

drop table if exists detalle_asistencia;
drop table if exists asistencia;
drop table if exists asignatura_clase;
drop table if exists asignatura;
drop table if exists impartir_clase;
drop table if exists clase;
drop table if exists estudiante;
drop table if exists grupo;
drop table if exists profesor;
drop table if exists encargar_carrera;
drop table if exists jefe_carrera;
drop table if exists user_admin;
drop table if exists personal_oficina;
drop table if exists personal_escolar;
drop table if exists usuario;
drop table if exists info_personal;
drop table if exists area_itsmt;
drop table if exists asis_presente;
drop table if exists carrera;
drop table if exists modalidad;
drop table if exists semestre;

-- --------------------------------------------------------------------

-- TABLAS QUE NO TIENEN LLAVE FORANEA

CREATE TABLE semestre (
	cveSemestre INT (10) NOT NULL AUTO_INCREMENT,
    num_semestre VARCHAR (50) NOT NULL,
    PRIMARY KEY (cveSemestre)
) ENGINE = InnoDB;

CREATE TABLE modalidad (
	cveModalidad char (1) not null,
    modalidad VARCHAR (30) NOT NULL,
    PRIMARY KEY (cveModalidad)
) ENGINE = InnoDB;

create table carrera (
	cveCarrera VARCHAR (10) NOT NULL,
    nombre_carrera VARCHAR (100) NOT NULL,
    primary key (cveCarrera)
)engine = InnoDB;

CREATE TABLE asis_presente (
	cvePresente INT (10) NOT NULL AUTO_INCREMENT,
    presente VARCHAR (30),
    PRIMARY KEY (cvePresente)
) ENGINE = InnoDB;

CREATE TABLE area_itsmt (
	cveArea INT (10) NOT NULL AUTO_INCREMENT,
    area VARCHAR (40) NOT NULL,
    PRIMARY KEY (cveArea)
) ENGINE = InnoDB;

CREATE TABLE info_personal (
	cveInfoPersonal INT (10) NOT NULL AUTO_INCREMENT,
    correo VARCHAR (100) NOT NULL,
    contra VARCHAR (100) NOT NULL,
    PRIMARY KEY (cveInfoPersonal)
) ENGINE = InnoDB;

CREATE TABLE usuario (
	cvePersona INT (10) NOT NULL AUTO_INCREMENT,
    nombre_persona VARCHAR (40) NOT NULL,
    apellido_pa VARCHAR (40) NOT NULL,
    apellido_ma VARCHAR (40) NOT NULL,
    telefono VARCHAR (10) NOT NULL,
    PRIMARY KEY (cvePersona)
) ENGINE = InnoDB;

-- ----------------------------------------------------------------------
-- CREANDO TABLAS QUE TIENEN LLAVE FORANEA

 CREATE TABLE personal_escolar (
	cvePersona INT (10) NOT NULL,
    cveInfoPersonal INT (10) NOT NULL,
    PRIMARY KEY (cvePersona),
    FOREIGN KEY (cvePersona) REFERENCES usuario (cvePersona) on update cascade on delete cascade,
    FOREIGN KEY (cveInfoPersonal) REFERENCES info_personal (cveInfoPersonal) on update cascade on delete cascade
) ENGINE = InnoDB;

 CREATE TABLE personal_oficina (
	cvePersona INT (10) NOT NULL,
    cveArea INT (10) NOT NULL,
    PRIMARY KEY (cvePersona),
    FOREIGN KEY (cvePersona) REFERENCES personal_escolar (cvePersona) on update cascade on delete cascade,
    FOREIGN KEY (cveArea) REFERENCES area_itsmt (cveArea) on update cascade on delete cascade
 ) ENGINE = InnoDB;
 
 CREATE TABLE user_admin (
	cvePersona INT (10) NOT NULL,
    primary key (cvePersona),
    foreign key (cvePersona) references personal_escolar (cvePersona) on update cascade on delete cascade
 )engine = InnoDB;
 
 create table jefe_carrera (
	cvePersona INT (10) NOT NULL,
    primary key (cvePersona),
    foreign key (cvePersona) references personal_escolar (cvePersona) on update cascade on delete cascade
 )engine = InnoDB;
 
 create table encargar_carrera (
	cveCarrera varchar (10) not null,
    cvePersona int (10) not null,
    primary key (cveCarrera, cvePersona),
    foreign key (cveCarrera) references carrera(cveCarrera) on update cascade on delete cascade,
    foreign key (cvePersona) references jefe_carrera (cvePersona) on update cascade on delete cascade
 ) engine = InnoDB;
 
  create table profesor (
	cvePersona INT (10) NOT NULL,
    primary key (cvePersona),
    foreign key (cvePersona) references personal_escolar (cvePersona) on update cascade on delete cascade
 )engine = InnoDB;
 
 -- TODO LO RELACIONADO CON LOS ESTUDIANTES
 
 create table grupo (
	cveGrupo int (10) not null auto_increment,
    cveSemestre int (10) not null,
    cveModalidad char (1) not null,
    primary key (cveGrupo),
    foreign key (cveSemestre) references semestre (cveSemestre) on update cascade on delete cascade,
    foreign key (cveModalidad) references modalidad (cveModalidad) on update cascade on delete cascade
 );
 
 create table estudiante (
	matricula VARCHAR (8) not null,
	cvePersona INT (10) not null,
    cveGrupo INT (10) not null,
    cveCarrera VARCHAR (10) not null,
    fecha_ingreso date,
    primary key (matricula),
    foreign key (cvePersona) references usuario (cvePersona) on update cascade on delete cascade,
    foreign key (cveGrupo) references grupo (cveGrupo) on update cascade on delete cascade,
    foreign key (cveCarrera) references carrera (cveCarrera) on update cascade on delete cascade
 )engine = InnoDB;
 
 create table clase (
	cveClase int (10) not null auto_increment,
    cveGrupo int (10) not null,
    cveCarrera VARCHAR (10) not null,
    primary key (cveClase),
    foreign key (cveGrupo) references grupo (cveGrupo) on update cascade on delete cascade,
    foreign key (cveCarrera) references carrera (cveCarrera) on update cascade on delete cascade
 )engine = InnoDB;
 
 create table impartir_clase (
	cvePersona INT (10) NOT NULL,
    cveClase INT (10) NOT NULL,
    primary key (cvePersona, cveClase),
    foreign key (cvePersona) references profesor (cvePersona) on update cascade on delete cascade,
    foreign key (cveClase) references clase (cveClase) on update cascade on delete cascade
 ) engine = InnoDB;
 
 CREATE TABLE asignatura (
	cveAsignatura INT (10) NOT NULL AUTO_INCREMENT,
    nombre_asignatura varchar (60) not null,
    cienciaBasica boolean not null,
    cveCarrera varchar (10) null,
    cveSemestre  int (10) not null,
    PRIMARY KEY (cveAsignatura),
    foreign key (cveCarrera) references carrera (cveCarrera) on update cascade on delete cascade,
    foreign key (cveSemestre) references semestre (cveSemestre) on update cascade on delete cascade
) ENGINE = InnoDB;

create table asignatura_clase (
	cveAsignatura int (10) not null,
    cveClase int (10) not null,
    primary key (cveAsignatura, cveClase),
    foreign key (cveAsignatura) references asignatura (cveAsignatura) on update cascade on delete cascade,
    foreign key (cveClase) references clase (cveClase) on update cascade on delete cascade
) engine = InnoDB;
 
 create table asistencia (
	cveAsistencia INT (10) NOT NULL auto_increment,
    cvePersona INT (10) NOT NULL,
    cveClase int (10) not null,
    fecha_asistencia DATE,
    primary key (cveAsistencia),
    foreign key (cvePersona) references profesor (cvePersona) on update cascade on delete cascade,
    foreign key (cveClase) references clase (cveClase) on update cascade on delete cascade
 )engine=InnoDB;
 
 create table detalle_asistencia (
	cveAsistencia INT (10) NOT NULL,
    matricula varchar (8) NOT NULL,
    cvePresente INT (10) NOT NULL,
    primary key (cveAsistencia, matricula),
    foreign key (cveAsistencia) references asistencia (cveAsistencia) on update cascade on delete cascade,
    foreign key (matricula) references estudiante (matricula) on update cascade on delete cascade,
    foreign key (cvePresente) references asis_presente (cvePresente) on update cascade on delete cascade
 ) engine = InnoDB;
 
 -- ---------------------------------------------------------------------------------
 -- ---------------------------------------------------------------------------------
 
 -- -------------------------------------- --
 -- CREACION DE PROCEDIMIENTOS ALMACENADOS  --
 -- -------------------------------------- --
 
 
 # PROCEDIMINETO registrar_admin
 drop procedure if exists registrar_admin;
 DELIMITER $$
 create procedure registrar_admin ( IN d_correo varchar(100), d_clave varchar (100), 
	d_nombre varchar (40), d_pa varchar (40), d_ma varchar (40), d_tel varchar (10) )
 begin
	declare exit handler for sqlexception
    begin
		rollback;
    end;
    
    start transaction;
		set autocommit = 0;
        
		insert into info_personal (correo, contra) values (d_correo, d_clave);
			set @id_info = last_insert_id();
        insert into usuario (nombre_persona, apellido_pa, apellido_ma, telefono) values (d_nombre, d_pa, d_ma, d_tel);
			set @id_user = last_insert_id();
        insert into personal_escolar (cvePersona, cveInfoPersonal) values (@id_user, @id_info);
			set @id_personal = last_insert_id();
        insert into user_admin (cvePersona) values (@id_personal);
        
        commit;
 end $$
 DELIMITER ;
  # FIN PROCEDIMINETO registrar_admin
  
  -- ----------------------------------------------------------------------------------
  
 # PROCEDIMINETO registrar_jefeCarrera
 drop procedure if exists registrar_jefeCarrera;
 DELIMITER $$
 create procedure registrar_jefeCarrera ( IN d_correo varchar(100), d_clave varchar (100), 
	d_nombre varchar (40), d_pa varchar (40), d_ma varchar (40), d_tel varchar (10) )
 begin
	declare exit handler for sqlexception
    begin
		rollback;
    end;
    
    start transaction;
		set autocommit = 0;
        
		insert into info_personal (correo, contra) values (d_correo, d_clave);
			set @id_info = last_insert_id();
        insert into usuario (nombre_persona, apellido_pa, apellido_ma, telefono) values (d_nombre, d_pa, d_ma, d_tel);
			set @id_user = last_insert_id();
        insert into personal_escolar (cvePersona, cveInfoPersonal) values (@id_user, @id_info);
			set @id_personal = last_insert_id();
        insert into jefe_carrera (cvePersona) values (@id_personal);
        
        commit;
 end $$
 DELIMITER ;
  # FIN PROCEDIMINETO registrar_jefeCarrera
  
  -- ----------------------------------------------------------------------------------
  
 # PROCEDIMINETO registrar_personalOficiona
 drop procedure if exists registrar_personalOficina;
 DELIMITER $$
 create procedure registrar_personalOficina ( IN d_correo varchar(100), d_clave varchar (100), 
	d_nombre varchar (40), d_pa varchar (40), d_ma varchar (40), d_tel varchar (10), d_area int )
 begin
	declare exit handler for sqlexception
    begin
		rollback;
    end;
    
    start transaction;
		set autocommit = 0;
        
		insert into info_personal (correo, contra) values (d_correo, d_clave);
			set @id_info = last_insert_id();
        insert into usuario (nombre_persona, apellido_pa, apellido_ma, telefono) values (d_nombre, d_pa, d_ma, d_tel);
			set @id_user = last_insert_id();
        insert into personal_escolar (cvePersona, cveInfoPersonal) values (@id_user, @id_info);
			set @id_personal = last_insert_id();
        insert into personal_oficina (cvePersona, cveArea) values (@id_personal, d_area);
        
        commit;
 end $$
 DELIMITER ;
  # FIN PROCEDIMINETO registrar_personalOficina
  
  -- ----------------------------------------------------------------------------------
  
 # PROCEDIMINETO registrar_profesor
 drop procedure if exists registrar_profesor;
 DELIMITER $$
 create procedure registrar_profesor ( IN d_correo varchar(100), d_clave varchar (100), 
	d_nombre varchar (40), d_pa varchar (40), d_ma varchar (40), d_tel varchar (10) )
 begin
	declare exit handler for sqlexception
    begin
		rollback;
    end;
    
    start transaction;
		set autocommit = 0;
        
		insert into info_personal (correo, contra) values (d_correo, d_clave);
			set @id_info = last_insert_id();
        insert into usuario (nombre_persona, apellido_pa, apellido_ma, telefono) values (d_nombre, d_pa, d_ma, d_tel);
			set @id_user = last_insert_id();
        insert into personal_escolar (cvePersona, cveInfoPersonal) values (@id_user, @id_info);
			set @id_personal = last_insert_id();
        insert into profesor (cvePersona) values (@id_personal);
        
        commit;
 end $$
 DELIMITER ;
  # FIN PROCEDIMINETO registrar_profesor
  
  -- ----------------------------------------------------------------------------------
  
 # PROCEDIMINETO tomar_asistencia
 drop procedure if exists tomar_asistencia;
 DELIMITER $$
 create procedure tomar_asistencia ( IN d_Profesor INT, d_Clase int, d_Estudiante varchar (8), d_Presente INT )
 begin
	declare exit handler for sqlexception
    begin
		rollback;
    end;
    
    start transaction;
		set autocommit = 0;
        
		insert into asistencia (cvePersona, cveClase, fecha_asistencia) values (d_Profesor, d_Clase, NOW());
			set @id_asistencia = last_insert_id();
		insert into detalle_asistencia (cveAsistencia, matricula, cvePresente) values (@id_asistencia, d_Estudiante, d_Presente);
        
        commit;
 end $$
 DELIMITER ;
  # FIN PROCEDIMINETO tomar_asistencia
  
 -- ----------------------------------------------------------------------------------
  
 # PROCEDIMINETO registrar_estudiante
 drop procedure if exists registrar_estudiante;
 DELIMITER $$
 create procedure registrar_estudiante ( IN d_nombre varchar (40), d_pa varchar (40), d_ma varchar (40), d_tel varchar (10),
	d_matricula varchar (8), d_grupo int, d_carrera varchar (10), d_fecha date )
 begin
	declare exit handler for sqlexception
    begin
		rollback;
    end;
    
    start transaction;
		set autocommit = 0;
        
        insert into usuario (nombre_persona, apellido_pa, apellido_ma, telefono) values (d_nombre, d_pa, d_ma, d_tel);
			set @id_user = last_insert_id();
        insert into estudiante (matricula, cvePersona, cveGrupo, cveCarrera, fecha_ingreso) 
			values (d_matricula, @id_user, d_grupo, d_carrera, d_fecha);
        
        commit;
 end $$
 DELIMITER ;
  # FIN PROCEDIMINETO registrar_estudiante
 
 -- ---------------------------------------------------------------------------------
 -- ---------------------------------------------------------------------------------
 
 -- ------------------------------ --
 -- INSERCIÓN DE DATOS TEMPORALES  --
 -- ------------------------------ --
 
 -- DATOS DE LOS SEMESTRES
 insert into semestre (num_semestre) VALUES 
 ('1°'),
 ('2°'),
 ('3°'),
 ('4°'),
 ('5°'),
 ('6°'),
 ('7°'),
 ('8°'),
 ('9°');
 
 -- ----------------------------------------------
 
 -- DATOS DEL TIPO DE MODALIDAD
 insert into modalidad (cveModalidad, modalidad) values 
 ('A', 'Escolarizado'),
 ('B', 'Mixto');
 
-- ----------------------------------------------
 
 -- DATOS DE LAS CARRERAS
 insert into carrera (cveCarrera, nombre_carrera) values 
 ('IIA', 'Ingeniería en Industrial Alimentarias'),
 ('IGE', 'Ingeniería en Gestión Empresarial'),
 ('ISC', 'Ingeniería en Sistemas Computacionales'),
 ('IA', 'Ingeniería en Gestión Empresarial'),
 ('IMT', 'Ingeniería en Mecatrónica');
 
 -- ----------------------------------------------
 
 -- DATOS DE LOS GRUPOS 
 insert into grupo (cveSemestre, cveModalidad) values 
 (1, 'A'),
 (2, 'A'),
 (3, 'A'),
 (4, 'A'),
 (5, 'A'),
 (6, 'A'),
 (7, 'A'),
 (8, 'A'),
 (9, 'A'),
 (1, 'B'),
 (2, 'B'),
 (3, 'B'),
 (4, 'B'),
 (5, 'B'),
 (6, 'B'),
 (7, 'B'),
 (8, 'B'),
 (9, 'B');
 
  -- ----------------------------------------------
 
 -- DATOS DEL TIPO DE ASISTENCIA
 insert into asis_presente (presente) values 
 ('Presente'),
 ('No presente'),
 ('Retardo');
 
 -- -----------------------------------------------
 
 -- DATOS DE LAS ASIGNATURAS
insert into asignatura (nombre_asignatura, cienciaBasica, cveCarrera, cveSemestre) values
('Cálculo Diferencial', 1, 'ISC', 1),
('Fundamentos de Programación', 0, 'ISC', 1),
('Taller de Ética', 0, 'ISC', 1),
('Matemáticas Discreta', 0, 'ISC', 1),
('Taller de Administración', 0, 'ISC', 1),
('Fundamentos de Inventigación', 1, 'ISC', 1),
('Cálculo Integral', 1, 'ISC', 2),
('Programación Orientada a Objetos', 0, 'ISC', 2),
('Contabilidad Financiera', 0, 'ISC', 2),
('Química', 1, 'ISC', 2),
('Álgebra Lineal', 1, 'ISC', 2),
('Probabilidad y Estadistica', 0, 'ISC', 2),
('Cálculo Vectorial', 1, 'ISC', 3),
('Estructura de Datos', 0, 'ISC', 3),
('Cultura Empresarial', 0, 'ISC', 3),
('Investigación de Operaciones', 0, 'ISC', 3),
('Desarrollo Sustentable', 0, 'ISC', 3),
('Física General', 1, 'ISC', 3),
('Ecuaciones Diferenciales', 1, 'ISC', 4),
('Métodos númericos', 0, 'ISC', 4),
('Tópicos Avanzados de Programación', 0, 'ISC', 4),
('Fundamentos de Base de Datos', 0, 'ISC', 4),
('Simulación', 0, 'ISC', 4),
('Principios Eléctricos y Aplicaciones Digitales', 0, 'ISC', 4),
('Graficación', 0, 'ISC', 5),
('Fundamentos de Telecomunicaciones', 0, 'ISC', 5),
('Sistemas Operativos', 0, 'ISC', 5),
('Taller de Base de Datos', 0, 'ISC', 5),
('Fundamentos de Ingeniería de Software', 0, 'ISC', 5),
('Arquitectura de Computadoras', 0, 'ISC', 5),
('Lenguajes y Autómatas I', 0, 'ISC', 6),
('Redes de Compuradoras', 0, 'ISC', 6),
('Talles de Sistemas Operativos', 0, 'ISC', 6),
('Administración de Base de Datos', 0, 'ISC', 6),
('Ingeniería de Software', 0, 'ISC', 6),
('Lenguajes de Interfaz', 0, 'ISC', 6),
('Lenguajes y Autómatas II', 0, 'ISC', 7),
('Conmutación Y Enrutamiento en Redes de Datos', 0, 'ISC', 7),
('Taller de Investigación I', 0, 'ISC', 7),
('Gestión de Proyectos en Software', 0, 'ISC', 7),
('Sistemas Programables', 0, 'ISC', 7);
 
 -- ----------------------------------------------
 
 -- DATOS DE LAS AREAS DEL TEC
 insert into area_itsmt (area) values
 ('Recursos escolares'),
 ('Caja');
 