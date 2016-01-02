CREATE TABLE IF NOT EXISTS grupo7 (
	grupo7 int unsigned NOT NULL AUTO_INCREMENT,
	id_usr varchar(10),
	id_tp_user  varchar(10),
	usuario varchar(40),
	contrasena varchar(30),
	id_estabto  varchar(10),
	nombre varchar(60),
	id_tipo_est  varchar(10),
	latitud  varchar(20),
	longitud  varchar(20),
	id_tamano varchar(30),
	id_costo varchar(30),
	PRIMARY KEY (grupo7)
);
