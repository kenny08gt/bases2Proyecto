CREATE TABLE IF NOT EXISTS grupo4 (  
	grupo4 int(10) unsigned NOT NULL AUTO_INCREMENT,
	calificacion int,
	punteo_cal int,
	usuario_cal varchar(40),
	servicio_cal int,
	comentario_cal varchar(2),
	caracteristica int,
	nombre_car varchar(30),
	duracion int,
	categoria int,
	dimension_cat int,
	nombre_cat varchar(30),
	servicio_detser int,
	caracteristica_detser int,
	dimension int,
	nombre_dim varchar(20),
	dimension_dimest int,
	establecimiento_dimenst int,
	establecimiento int,
	nombre_est varchar(20),
	posicion varchar(40),
	descripcion_est varchar(120),
	punteo_est int,
	tipoest_est int,
	oficial int,
	reserva int,
	fecha datetime,
	usuario_res varchar(20),
	servicio_res int,
	servicio int,
	cupo int,
	punteo_ser int,
	establecimiento_ser int,
	tiposer_ser int,
	nombre_ser varchar(30),
	tipo_establecimiento int,
	nombre_tipest varchar(20),
	descripcion_tipest varchar(30),
	tipo_servicion int,
	nombre_tipser varchar(30),
	descripcion_tipser varchar(50),
	id_usuario int,
	usuario varchar(30),
	nombre_us varchar(30),
	apellido varchar(20),
	rol int,
	password varchar(20),		
	PRIMARY KEY (grupo4)
);