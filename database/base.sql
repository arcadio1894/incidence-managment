DROP DATABASE if exists bd_incidence;
CREATE DATABASE bd_incidence;
	use bd_incidence;

CREATE TABLE usuario (
	idUsuario int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fullname char(50),
	username char(50),
	email varchar(100),
	password varchar(50),
	type varchar(50),
	created_at date,
	enable char(1)
);

INSERT INTO usuario(fullname, username, email, password, type, created_at, enable) VALUES ('Jorge Gonzales', 'George', 'joryes1894@gmail.com', 'asd', 'Admin', '2016/10/18', '1');

CREATE TABLE proyecto (
	idProyecto int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(200),
	state varchar(200),
	created_at date,
	visibility varchar(100),
	description varchar(200),
	enable char(1)
);
INSERT INTO proyecto(name, state, created_at, visibility, description, enable) VALUES ('Infraestructura de TI', 'Estable', '2016/10/18', 'Privado', 'Pryecto de prueba', '1');

CREATE TABLE perfil (
	idPerfil int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(200),
	nivel int,
	created_at date,
	enable char(1)
);
INSERT INTO perfil(name, nivel, created_at, enable) VALUES ('Manager', '90', '2016/10/18', '1');
/*
	INSERTS POSTERIORES
	Manager 90-100
	Desarrollador 70-90
	Actualizador 50-70
	Informador 30-50
	Expectador 10-30
*/

CREATE TABLE categoria (
	idCategoria int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(200),
	idProyecto int NOT NULL,
	FOREIGN KEY (idProyecto) REFERENCES proyecto(idProyecto),
	created_at date,
	enable char(1)
);

CREATE TABLE nivel (
	idNivel int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idCategoria int NOT NULL,
	FOREIGN KEY (idCategoria) REFERENCES categoria(idCategoria),
	idPerfil int NOT NULL,
	FOREIGN KEY (idPerfil) REFERENCES perfil(idPerfil),
	idUsuario int NOT NULL,
	FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
	created_at date,
	enable char(1)
);

/*Nuevo, Mas datos, Aceptado, Asignado, Resuelto, Cerrado*/

CREATE TABLE incidencia (
	idIncidencia int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idProyecto int NOT NULL,
	FOREIGN KEY (idProyecto) REFERENCES proyecto(idProyecto),
	idCategoria int NOT NULL,
	FOREIGN KEY (idCategoria) REFERENCES categoria(idCategoria),
	reproductibilidad varchar(50),
	severidad varchar(50),
	prioridad varchar(50),
	resumen varchar(100),
	descripcion varchar(300),
	infoAdicional varchar(300),
	pasosReproducir varchar(300),
	visibilidad varchar(100),
	plataforma varchar(100),
	so varchar(100),
	version_so varchar(100),
	idUsuario int NOT NULL,
	FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
	state varchar(50), 
	result varchar(500),
	created_at date,
	enable char(1)
);

CREATE TABLE incidencia_asignada (
	idIncidenciaAsignada int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idIncidencia int NOT NULL,
	FOREIGN KEY (idIncidencia) REFERENCES incidencia(idIncidencia),
	idUsuario int NOT NULL,
	FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
	orden int,
	created_at date,
	enable char(1)
);

CREATE TABLE incidenciaAtendida (
	idIncidenciaAtendida int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idIncidenciaAsignada int NOT NULL,
	FOREIGN KEY (idIncidenciaAsignada) REFERENCES incidencia_asignada(idIncidenciaAsignada),
	created_at date,
	enable char(1)
);


/*CREATE TABLE perspectivas (
	idPerspectiva int NOT NULL AUTO_INCREMENT,
	ruc char(11) NOT NULL,
	perspectiva varchar(150) NOT NULL,
	FOREIGN KEY (ruc) REFERENCES empresa(ruc),
	PRIMARY KEY (idPerspectiva,ruc)
);*/


