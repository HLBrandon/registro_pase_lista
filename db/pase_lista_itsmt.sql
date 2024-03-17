CREATE DATABASE pase_lista_itsmt COLLATE utf8_spanish_ci;

USE pase_lista_itsmt;

-- -------------------------------------------------------

-- BORRANDO TABLAS EN CASO DE QUE EXISTAN

drop table if exists detalle_asistencia;
drop table if exists asistencia;
drop table if exists impartir_clase;
drop table if exists clase;
drop table if exists estudiante;
drop table if exists carrera;
drop table if exists profesor;
drop table if exists jefe_carrera;
drop table if exists user_admin;
drop table if exists personal_oficina;
drop table if exists personal_escolar;
drop table if exists usuario;
drop table if exists info_personal;
drop table if exists area_itsmt;
drop table if exists asignatura;
drop table if exists asis_presente;
drop table if exists modalidad;
drop table if exists semestre;

-- --------------------------------------------------------------------

-- TABLAS SECUNDARIAS QUE NO TIENEN LLAVE FORANEA

CREATE TABLE semestre (
	cveSemestre INT (10) NOT NULL AUTO_INCREMENT,
    num_semestre VARCHAR (50) NOT NULL,
    PRIMARY KEY (cveSemestre)
) ENGINE = InnoDB;

CREATE TABLE modalidad (
	cveModalidad INT (10) NOT NULL AUTO_INCREMENT,
    modalidad VARCHAR (30) NOT NULL,
    PRIMARY KEY (cveModalidad)
) ENGINE = InnoDB;

CREATE TABLE asis_presente (
	cvePresente INT (10) NOT NULL AUTO_INCREMENT,
    presente VARCHAR (30),
    PRIMARY KEY (cvePresente)
) ENGINE = InnoDB;

CREATE TABLE asignatura (
	cveAsignatura INT (10) NOT NULL AUTO_INCREMENT,
    asignatura VARCHAR (40) NOT NULL,
    PRIMARY KEY (cveAsignatura)
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

-- CREANDO LA TABLA USUARIOS

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
 
  create table profesor (
	cvePersona INT (10) NOT NULL,
    primary key (cvePersona),
    foreign key (cvePersona) references personal_escolar (cvePersona) on update cascade on delete cascade
 )engine = InnoDB;
 
 create table carrera (
	cveCarrera INT (10) NOT NULL auto_increment,
    nombre_carrera VARCHAR (30) NOT NULL,
    siglas_carrera varchar (10) not null,
    cvePersona int (10) not null,
    primary key (cveCarrera),
    foreign key (cvePersona) references jefe_carrera (cvePersona) on update cascade on delete cascade
 )engine = InnoDB;
 
 -- TODO LO RELACIONADO CON LOS ESTUDIANTES
 
 create table estudiante (
	cvePersona INT (10) not null,
    cveSemestre int (10) not null,
    cveModalidad int (10) not null,
    cveCarrera int (10) not null,
    fecha_ingreso date,
    primary key (cvePersona),
    foreign key (cvePersona) references usuario (cvePersona) on update cascade on delete cascade,
    foreign key (cveSemestre) references semestre (cveSemestre) on update cascade on delete cascade,
    foreign key (cveCarrera) references carrera (cveCarrera) on update cascade on delete cascade
 )engine = InnoDB;
 
 create table clase (
	cveClase int (10) not null auto_increment,
    cveAsignatura int (10) not null,
    cveCarrera int (10) not null,
    primary key (cveClase),
    foreign key (cveAsignatura) references asignatura (cveAsignatura) on update cascade on delete cascade,
    foreign key (cveCarrera) references carrera (cveCarrera) on update cascade on delete cascade
 )engine = InnoDB;
 
 create table impartir_clase (
	cvePersona INT (10) NOT NULL,
    cveClase INT (10) NOT NULL,
    primary key (cvePersona, cveClase),
    foreign key (cvePersona) references profesor (cvePersona) on update cascade on delete cascade,
    foreign key (cveClase) references clase (cveClase) on update cascade on delete cascade
 ) engine = InnoDB;
 
 create table asistencia (
	cveAsistencia INT (10) NOT NULL auto_increment,
    cveProfesor INT (10) NOT NULL,
    cveClase int (10) not null,
    fecha_asistencia DATE,
    primary key (cveAsistencia),
    foreign key (cveProfesor) references profesor (cvePersona) on update cascade on delete cascade,
    foreign key (cveClase) references clase (cveClase) on update cascade on delete cascade
 )engine=InnoDB;
 
 create table detalle_asistencia (
	cveAsistencia INT (10) NOT NULL,
    cveEstudiante INT (10) NOT NULL,
    cvePresente INT (10) NOT NULL,
    primary key (cveAsistencia, cveEstudiante),
    foreign key (cveAsistencia) references asistencia (cveAsistencia) on update cascade on delete cascade,
    foreign key (cveEstudiante) references estudiante (cvePersona) on update cascade on delete cascade,
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
 create procedure tomar_asistencia ( IN d_Profesor INT, d_Clase INT, d_Estudiante INT, d_Presente INT )
 begin
	declare exit handler for sqlexception
    begin
		rollback;
    end;
    
    start transaction;
		set autocommit = 0;
        
		insert into asistencia (cveProfesor, cveClase, fecha_asistencia) values (d_Profesor, d_Clase, NOW());
			set @id_asistencia = last_insert_id();
		insert into detalle_asistencia (cveAsistencia, cveEstudiante, cvePresente) values (@id_asistencia, d_Estudiante, d_Presente);
        
        commit;
 end $$
 DELIMITER ;
  # FIN PROCEDIMINETO tomar_asistencia
 
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
 insert into modalidad (modalidad) values 
 ('Escolarizado'),
 ('Mixto');
 
  -- ----------------------------------------------
 
 -- DATOS DEL TIPO DE ASISTENCIA
 insert into asis_presente (presente) values 
 ('Presente'),
 ('No presente'),
 ('Retardo');
 
 -- ----------------------------------------------
 
 -- DATOS DEL TIPO DE ASISTENCIA
 insert into asignatura (asignatura) values 
 ('Cálculo Diferencial'),
 ('Cálculo Integral'),
 ('Cálculo Vectorial'),
 ('Fundamentos de programación'),
 ('Taller de Ética');
 
 -- ----------------------------------------------
 
 -- DATOS DE LAS AREAS DEL TEC
 insert into area_itsmt (area) values
 ('Recursos escolares'),
 ('Caja');
 