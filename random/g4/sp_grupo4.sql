BEGIN
	DECLARE done INT DEFAULT 0;
	
	declare current_id int;
	declare c_usuario varchar(30);
	declare c_nombre_us varchar(30);
	declare c_apellido varchar(30);
	declare c_rol int;
	declare c_password varchar(20);
	declare c_correo varchar(40);
	
	declare c_comentario int;
	declare c_contenido varchar(250);
	declare c_calificacion int;
	declare c_servicio int;

	declare c_nombre_est varchar(40);
	declare c_establecimiento int;
	declare c_tipoest_est int; 
	declare c_posicion varchar (40);
	declare c_tiponombre varchar (40);
	declare c_oficial int;
	declare c_punteo_est int;
	declare c_longitud float(10,10);
	declare c_latitud float(10,10);

	declare c_caracteristica int;
	declare c_nombre_car varchar(20);
	declare c_duracion varchar(10);

	declare c_categoria int;
	declare c_nombre_cat varchar(20);

	declare c_dimension int;
	declare c_nombre_dim varchar(20);

	declare c_reserva int;
	declare c_fecha datetime;
	declare c_usuario_res int;
	declare c_servicio_res int;

	declare c_nombre_ser varchar(20);
	
	declare c_dimension_cat int;

	declare c_prereserva int;

	declare uppre_cur cursor for select distinct reserva, servicio_res from grupo4 where reserva is not null;
	declare upcat_cur cursor for select distinct servicio_detser, caracteristica_detser from grupo4 where servicio_detser is not null;
	declare cate2_cur cursor for select distinct categoria, dimension_cat from grupo4 where categoria is not null;
	declare cal2_cur cursor for select distinct calificacion from grupo4 where calificacion is not null;
	declare estser_cur cursor for select distinct establecimiento_ser, tiposer_ser from grupo4 where establecimiento_ser is not null;
	declare dimest_cur cursor for select distinct dimension_dimest, establecimiento_dimenst from grupo4 where dimension_dimest is not null;
	declare servicio_cur cursor for select distinct servicio,nombre_ser from grupo4 where servicio is not null;
	declare reserva_cur cursor for select distinct reserva, fecha, usuario_res,servicio_res from grupo4 where reserva is not null;
	declare dim_cur cursor for select distinct dimension, nombre_dim from grupo4 where dimension is not null;
	declare cate_cur cursor for select distinct categoria, nombre_cat from grupo4 where categoria is not null;
	declare cara_cur cursor for select distinct caracteristica, nombre_car, duracion from grupo4 where caracteristica is not null;
	declare establecimiento_cur cursor for select distinct establecimiento,nombre_est,tipoest_est,posicion,nombre_tipest,oficial,punteo_est from grupo4 where establecimiento is not null and tipoest_est=tipo_establecimiento; 	
	declare calificacion_cur cursor for select distinct calificacion,punteo_cal,servicio_cal,comentario_cal from grupo4 where calificacion is not null;
	declare cur cursor for select distinct id_usuario,usuario,nombre_us,apellido,rol,password from grupo4 WHERE id_usuario IS NOT NULL;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	open cur;
	set done = 0;
	start_loop: loop	
		fetch cur into current_id,c_usuario,c_nombre_us,c_apellido,c_rol,c_password;	
		IF done = 1 THEN
			LEAVE start_loop;
	   	END IF;		
		set current_id=current_id+100;
		set c_nombre_us=CONCAT(c_nombre_us," ",c_apellido);
		set c_correo=CONCAT(c_usuario,'_',c_apellido,'@correo.com');
		insert into usuario (id_usuario,Nombre,correo,telefono,Rol,id_establecimiento,password) values (current_id,c_nombre_us,c_correo,112233,'normal',NULL,c_password);
	end loop;
	close cur;

	open calificacion_cur;
	set done=0;
	calificacion_loop: loop	
		fetch calificacion_cur into c_comentario,c_calificacion,c_servicio,c_contenido;
		IF done = 1 THEN
			LEAVE calificacion_loop;
	   	END IF;		
		set c_comentario=c_comentario+100;
		insert into comentario (id_comentario,contenido,calificacion) values (c_comentario,c_contenido,c_calificacion);
	end loop;
	close calificacion_cur;

	open establecimiento_cur;
	set done=0;
	esta_loop:loop
		fetch establecimiento_cur into c_establecimiento,c_nombre_est,c_tipoest_est, c_posicion,c_tiponombre,c_oficial,c_punteo_est;
		IF done = 1 THEN
			LEAVE esta_loop;
	   	END IF;		
		set c_establecimiento=c_establecimiento+100;
		select SUBSTRING_INDEX(c_posicion,',',-1) into c_longitud;
		select SUBSTRING_INDEX(c_posicion,',',1) into c_latitud;
		insert into establecimiento (id_establecimiento,nombre,tipo,longitud,latitud,oficial,calificacion_general) values(c_establecimiento,c_nombre_est,c_tiponombre,c_longitud+0,c_latitud+0,c_oficial,c_punteo_est);
	end loop;
	close establecimiento_cur;

	open cara_cur;
	set done = 0;
	cara_loop: loop	
		fetch cara_cur into c_caracteristica, c_nombre_car,c_duracion;
		IF done = 1 THEN
			LEAVE cara_loop;
	   	END IF;		
		set c_caracteristica=c_caracteristica+100;
		insert into caracteristica (id_caracteristica,nombre,valor) values (c_caracteristica,c_nombre_car,c_duracion);
	end loop;
	close cara_cur;

	open cate_cur;
	set done = 0;
	cate_loop: loop	
		fetch cate_cur into c_categoria, c_nombre_cat;
		IF done = 1 THEN
			LEAVE cate_loop;
	   	END IF;		
		set c_categoria=c_categoria+100;
		insert into categoria (id_categoria,nombre) values (c_categoria,c_nombre_cat);
	end loop;
	close cate_cur;

	open dim_cur;
	set done = 0;
	dim_loop: loop	
		fetch dim_cur into c_dimension, c_nombre_dim;
		IF done = 1 THEN
			LEAVE dim_loop;
	   	END IF;		
		set c_dimension=c_dimension+100;
		insert into dimension (id_dimension,nombre) values (c_dimension,c_nombre_dim);
	end loop;
	close dim_cur;

	open reserva_cur;
	set done = 0;
	reserva_loop: loop	
		fetch reserva_cur into c_reserva, c_fecha,c_usuario_res,c_servicio_res;
		IF done = 1 THEN
			LEAVE reserva_loop;
	   	END IF;		
		set c_reserva=c_reserva+100;
		select id_usuario from (select distinct id_usuario,usuario from grupo4 where id_usuario is not null and usuario =(select distinct usuario from (select distinct reserva,usuario_res as 'usuario' from grupo4 where reserva is not null )aw) )awe into c_usuario_res;
		set c_usuario_res=c_usuario_res+100;
		insert into prereserva (id_preresrva,horayfecha,id_usuario) values (c_reserva,c_fecha,c_usuario_res);
	end loop;
	close reserva_cur;

	open servicio_cur;
	set done = 0;
	servicio_loop: loop	
		fetch servicio_cur into c_servicio, c_nombre_ser;
		IF done = 1 THEN
			LEAVE servicio_loop;
	   	END IF;		
		set c_servicio=c_servicio+100;
		insert into servicio (id_servicio,nombre) values (c_servicio,c_nombre_ser);
	end loop;
	close servicio_cur;

	open dimest_cur;
	set done = 0;
	dimest_loop: loop	
		fetch dimest_cur into c_dimension,c_establecimiento;
		IF done = 1 THEN
			LEAVE dimest_loop;
	   	END IF;		
		set c_dimension=c_dimension+100;
		set c_establecimiento=c_establecimiento+100;
		insert into establecimiento_dimension (id_establecimiento,id_dimension) values (c_establecimiento,c_dimension);
	end loop;
	close dimest_cur;

	open estser_cur;
	set done = 0;
	estser_loop: loop	
		fetch estser_cur into c_establecimiento,c_servicio;
		IF done = 1 THEN
			LEAVE estser_loop;
	   	END IF;		
		set c_servicio=c_servicio+100;
		set c_establecimiento=c_establecimiento+100;
		insert into establecimiento_servicio (id_establecimiento,id_servicio) values (c_establecimiento,c_servicio);
	end loop;
	close estser_cur;

	set done = 0;
	open cal2_cur;
	start_loop: loop	
		fetch cal2_cur into c_calificacion;
		IF done = 1 THEN
			LEAVE start_loop;
	   	END IF;		
		set c_calificacion=c_calificacion+100;
		call update_comentario(c_calificacion);	
	end loop;
	close cal2_cur;

	open cate2_cur;
	set done = 0;
	cate2_loop: loop	
		fetch cate2_cur into c_categoria,c_dimension_cat;
		IF done = 1 THEN
			LEAVE cate2_loop;
	   	END IF;		
		set c_categoria=c_categoria+100;
		set c_dimension_cat=c_dimension_cat+100;
		update establecimiento_dimension set id_categoria=c_categoria where id_dimension=c_dimension_cat;
	end loop;
	close cate2_cur;

	open upcat_cur;
	set done = 0;
	upcat_loop: loop	
		fetch upcat_cur into c_servicio,c_caracteristica;
		IF done = 1 THEN
			LEAVE upcat_loop;
	   	END IF;		
		set c_servicio=c_servicio+100;
		set c_caracteristica=c_caracteristica+100;
		update caracteristica set id_servicio=c_servicio where id_caracteristica=c_caracteristica;
	end loop;
	close upcat_cur;

	open uppre_cur;
	set done = 0;
	uppre_loop: loop	
		fetch uppre_cur into c_prereserva,c_servicio;
		IF done = 1 THEN
			LEAVE uppre_loop;
	   	END IF;		
		set c_prereserva=c_prereserva+100;
		set c_servicio=c_servicio+100;
		update prereserva set id_establecimiento_servicio=(select id_establecimiento_servicio from establecimiento_servicio where id_servicio=c_servicio limit 1) where id_preresrva=c_prereserva;
	end loop;
	close uppre_cur;
END
