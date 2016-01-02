	BEGIN
		DECLARE done INT DEFAULT 0;

		declare c_establecimiento int;
		declare c_telefono varchar(20);
		declare c_direccion varchar(80);
		declare c_nombre varchar(40);
		declare c_latitud float(10,10);
		declare c_longitud float(10,10);

		declare c_user varchar(20);
		declare c_correo varchar(40);
		declare c_password varchar(20);
		declare c_tipo int;
		declare c_id int;
		declare c_esta int;

		declare c_nombre_ser varchar(20);
		declare c_descripcion_ser varchar(50);

		declare c_inicio varchar(20);
		declare c_valor int;
		declare c_comentario varchar(50);
		declare c_idc int;
		declare c_idp int;

		declare usert_cur cursor for select distinct username_user_trc, telefono_user_trc, correo_user_trc, password_user_trc, nombre_user_trc, nombre_tipousuariotrc  from grupo6 where username_user_trc is not null;
		declare rc_cur cursor for select distinct inicio_rc, nombre_r_c, establecimiento_trc, valor_rc, comentario_rc, username_user_trc from grupo6 where inicio_rc is not null;
		declare servicio_cur cursor for select distinct nombre_servicio, descripcion_servicio from grupo6 where nombre_servicio is not null;
		declare userc_cur cursor for select distinct username_user_creador, telefono_user_creador, correo_user_creador, password_user_creador, nombre_user_creador, tiponombre_user_creador,establecimiento  from grupo6 where username_user_creador is not null;
		declare esta_cur cursor for select distinct establecimiento, telefono_establecimiento,direccion_establecimiento,nombre_establecimiento,latitud, longitud from grupo6 where establecimiento is not null;

		DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

		open esta_cur;
		set done = 0;
		esta_loop: loop
			fetch esta_cur into c_establecimiento,c_telefono,c_direccion,c_nombre,c_latitud,c_longitud;
			IF done = 1 THEN
				LEAVE esta_loop;
		   	END IF;
			set c_establecimiento=c_establecimiento+500;
			insert into establecimiento(id_establecimiento,nombre,direccion,tipo,longitud,latitud,oficial,calificacion_general) values(c_establecimiento,c_nombre,c_direccion,'',c_longitud,c_latitud,1,-1);

		end loop;
		close esta_cur;

		open userc_cur;
		set done = 0;
		set c_id=500;
		userc_loop: loop
			fetch userc_cur into c_user,c_telefono,c_correo,c_password,c_nombre,c_tipo,c_esta;
			IF done = 1 THEN
				LEAVE userc_loop;
		   	END IF;
			set c_id=c_id+1;
			set c_esta=c_esta+500;
			insert into usuario (id_usuario,Nombre,correo,telefono,Rol,id_establecimiento,password) values (c_id,c_nombre,c_correo,c_telefono,'especial',c_esta,c_password);
		end loop;
		close userc_cur;

		open servicio_cur;
		set done = 0;
		set c_id=500;
		servicio_loop: loop
			fetch servicio_cur into c_nombre_ser,c_descripcion_ser;
			IF done = 1 THEN
				LEAVE servicio_loop;
		   	END IF;
			set c_id=c_id+1;
			insert into servicio (id_servicio,nombre,descripcion) values (c_id,c_nombre_ser,c_descripcion_ser);
		end loop;
		close servicio_cur;

		open rc_cur;
		set done = 0;
		set c_idc=500;
		set c_idp=500;
		insert into establecimiento_servicio(id_establecimiento,id_servicio) values(507,501);
		insert into establecimiento_servicio(id_establecimiento,id_servicio) values(507,502);
		insert into establecimiento_servicio(id_establecimiento,id_servicio) values(507,503);
		rc_loop: loop
			fetch rc_cur into c_inicio,c_nombre,c_establecimiento,c_valor,c_comentario,c_user;
			IF done = 1 THEN
				LEAVE rc_loop;
		   	END IF;
			if c_nombre like 'calificacion' then
				insert into comentario (id_comentario,contenido,calificacion) values (c_idc,c_comentario,c_valor);
				set c_idc=c_idc+1;
			else
					insert into prereserva (id_preresrva,cantpersonas) values (c_idp,c_valor);
				set c_idp=c_idp+1;
			end if;
		end loop;
		close rc_cur;

		open usert_cur;
		set done = 0;
		SELECT 'AUTO_INCREMENT' FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'bases2' AND   TABLE_NAME   = 'usuario' into c_id;
		usert_loop: loop
			fetch usert_cur into c_user,c_telefono,c_correo,c_password,c_nombre,c_tipo;
			IF done = 1 THEN
				LEAVE usert_loop;
		   	END IF;
			set c_id=c_id+1;
			insert into usuario (id_usuario,Nombre,correo,telefono,Rol,password) values (c_id,c_nombre,c_correo,c_telefono,'normal',c_password);
		end loop;
		close usert_cur;
	END
