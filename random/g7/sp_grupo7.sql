BEGIN
  DECLARE done INT DEFAULT 0;

  declare c_id_est int;
  declare c_nombre varchar(40);
  declare c_tipo_e1 int;
  declare c_latitud float (18,18);
  declare c_longitud float(18,18);
  declare c_id_tam int;
  declare c_id_costo int;
  declare c_tp2 int;
  declare c_tipo varchar(50);

  declare c_contrasena varchar(30);
  declare c_correo varchar(40);
  declare c_user_id int;
  declare c_tp_user int;
  declare c_esta int;
  declare c_user varchar(40);

  declare c_id_serv int;
  declare c_id_estabto int;
  declare c_precio int;

  declare c_id_cal int;
  declare c_calificacion int;
  declare c_id_usr int;

  declare c_id_reserva int;
  declare c_fecha varchar(50);
  declare c_hora varchar(50);
  declare c_estser int;
  declare c_cantidad int;

  declare c_tefono varchar(50);

  declare upu_cur cursor for select id_usr, usuario as 'nombre',nombre as 'telefono' from grupo7 where grupo7 BETWEEN 140 and 157;
  declare reserva2_cur cursor for select id_usr as 'id_reserva',id_tp_user as 'id_estabto',usuario as 'id_user', contrasena as 'fecha', id_estabto as 'hora',nombre as 'cantidad' from grupo7 where grupo7 BETWEEN 122 and 137;
  declare reserva_cur cursor for select id_usr as 'id_reserva',id_tp_user as 'id_estabto',usuario as 'id_user', id_estabto as 'fecha', nombre as 'hora' from grupo7 where grupo7 BETWEEN 93 and 120;
  declare estser_cur cursor for select distinct nombre as 'id_estabto',latitud as 'id_srv' from grupo7 where grupo7 BETWEEN 43 and 73;
  declare cal_cur cursor for select id_estabto as 'id_clf',nombre as 'id_estabto',id_tipo_est as 'calificacion',latitud as 'id_srv', longitud as 'id_usr' from grupo7 where grupo7 BETWEEN 43 and 73;
  declare serv_cur cursor for select id_usr as 'id_srv',id_tp_user as 'tipo',usuario as 'id_estabto',contrasena as 'precio' from grupo7 where grupo7 BETWEEN 43 and 73;
  declare user_cur cursor for select g1.*,s.* from (SELECT id_usr, id_tp_user, usuario, contrasena,id_estabto FROM grupo7  WHERE grupo7 BETWEEN 10 AND 40)g1 left join (SELECT id_usr as 'id2', id_tp_user FROM grupo7 WHERE grupo7 BETWEEN 2 and 9 ) s on g1.id_tp_user=s.id2;
  declare esta_cur cursor for select distinct g1.id_estabto, g1.*,s.* from (SELECT id_estabto,nombre,id_tipo_est,latitud,longitud,id_tamano,id_costo FROM grupo7  WHERE grupo7 BETWEEN 10 AND 40)g1 left join (SELECT usuario as 'id_tp_estabto',contrasena as 'tipo' FROM grupo7 WHERE grupo7 BETWEEN 2 and 9 ) s on g1.id_tipo_est=s.id_tp_estabto;

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

  open esta_cur;
  set done = 0;
  esta_loop: loop
    fetch esta_cur into c_id_est,c_id_est,c_nombre,c_tipo_e1,c_latitud,c_longitud,c_id_tam,c_id_costo,c_tp2,c_tipo;
    IF done = 1 THEN
      LEAVE esta_loop;
      END IF;
    set c_id_est=c_id_est+900;
    if c_tipo like 'hospedaje' then
      insert into establecimiento(id_establecimiento,nombre,direccion,tipo,longitud,latitud,oficial,calificacion_general) values(c_id_est,c_nombre,'','hotel',c_longitud,c_latitud,1,-1);
    elseif c_tipo like '' then
      select c_nombre;
    else
      insert into establecimiento(id_establecimiento,nombre,direccion,tipo,longitud,latitud,oficial,calificacion_general) values(c_id_est,c_nombre,'',c_tipo,c_longitud,c_latitud,1,-1);
    end if;
  end loop;
  close esta_cur;

	open user_cur;
  set done = 0;
  user_loop: loop
    fetch user_cur into c_user_id,c_tp_user,c_user,c_contrasena,c_esta,c_tp2,c_tipo;
    IF done = 1 THEN
      LEAVE user_loop;
    END IF;
    set c_user_id=c_user_id+900;
    set c_correo=concat(c_user,'@correo.com');
    if c_tipo like 'administra' then
      insert into usuario (id_usuario,Nombre,correo,telefono,Rol,id_establecimiento,password) values (c_user_id,c_user,c_correo,1111111,'especial',c_esta+900,c_contrasena);
    elseif c_tipo like 'usuario' then
      insert into usuario (id_usuario,Nombre,correo,telefono,Rol,id_establecimiento,password) values (c_user_id,c_user,c_correo,1111111,'normal',NULL,c_contrasena);
    else
      insert into usuario (id_usuario,Nombre,correo,telefono,Rol,id_establecimiento,password) values (c_user_id,c_user,c_correo,1111111,'administrador',NULL,c_contrasena);
    end if;
  end loop;
  close user_cur;

  open serv_cur;
  set done = 0;
  serv_loop: loop
    fetch serv_cur into c_id_serv,c_tipo,c_id_estabto,c_precio;
    IF done = 1 THEN
      LEAVE serv_loop;
      END IF;
    set c_id_serv=c_id_serv+900;
    if c_tipo like '' then
      select c_id_serv;
    else
      insert into servicio (id_servicio,nombre,descripcion) values (c_id_serv,c_tipo,'');
    end if;
  end loop;
  close serv_cur;

  open estser_cur;
  set done = 0;
  estser_loop: loop
    fetch estser_cur into c_id_estabto,c_id_serv;
    IF done = 1 THEN
      LEAVE estser_loop;
      END IF;
    set c_id_serv=c_id_serv+900;
    set c_id_estabto=c_id_estabto+900;
    IF EXISTS (SELECT * from establecimiento where id_establecimiento=c_id_estabto) then
      insert into establecimiento_servicio (id_establecimiento,id_servicio) values (c_id_estabto,c_id_serv);
    ELSE
      select c_id_serv;
    END if;
  end loop;
  close estser_cur;

  open cal_cur;
  set done = 0;
  cal_loop: loop
    fetch cal_cur into c_id_cal,c_id_estabto,c_calificacion,c_id_serv,c_id_usr;
    IF done = 1 THEN
      LEAVE cal_loop;
      END IF;
    set c_id_serv=c_id_serv+900;
    set c_id_cal=c_id_cal+900;
    if c_calificacion like '0' then
      select c_id_cal;
    else
      select id_establecimiento_servicio from establecimiento_servicio where id_servicio=c_id_serv limit 1 into c_id_serv;
      insert into comentario (id_comentario,contenido,calificacion,id_establecimiento_servicio) values (c_id_cal,'',c_calificacion,c_id_serv);
    end if;
  end loop;
  close cal_cur;

  open reserva_cur;
  set done = 0;
  reserva_loop: loop
    fetch reserva_cur into c_id_reserva,c_id_estabto,c_id_usr,c_fecha,c_hora;
    IF done = 1 THEN
      LEAVE reserva_loop;
      END IF;
    set c_id_reserva=c_id_reserva+900;
    set c_id_estabto=c_id_estabto+900;
    set c_id_usr=  c_id_usr+900;
    set c_hora=concat(c_fecha,' - '+c_hora);
    IF EXISTS (SELECT * from establecimiento where id_establecimiento=c_id_estabto) then
      select id_establecimiento_servicio from establecimiento_servicio where id_establecimiento=c_id_estabto limit 1 into c_estser;
      insert into prereserva (id_preresrva,horayfecha,id_establecimiento_servicio,id_usuario) values (c_id_reserva,c_hora,c_estser,c_id_usr);
    ELSE
      select c_id_serv;
    END if;
  end loop;
  close reserva_cur;

  open reserva2_cur;
  set done = 0;
  SELECT 'AUTO_INCREMENT' FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'bases2' AND   TABLE_NAME   = 'prereserva' into c_id_reserva;
  reserva2_loop: loop
    fetch reserva2_cur into c_id_reserva,c_id_estabto,c_id_usr,c_fecha,c_hora,c_cantidad;
    IF done = 1 THEN
      LEAVE reserva2_loop;
      END IF;
    set c_id_estabto=c_id_estabto+900;
    set c_id_usr=  c_id_usr+900;
    set c_hora=concat(c_fecha,' - '+c_hora);

    IF EXISTS (SELECT * from establecimiento where id_establecimiento=c_id_estabto) then
      select id_establecimiento_servicio from establecimiento_servicio where id_establecimiento=c_id_estabto limit 1 into c_estser;
      insert into prereserva (id_preresrva,horayfecha,id_establecimiento_servicio,id_usuario,cantpersonas) values (c_id_reserva,c_hora,c_estser,c_id_usr,c_cantidad);
    ELSE
      select c_id_serv;
    END if;
    set c_id_reserva=c_id_reserva+1;
  end loop;
  close reserva2_cur;

  open upu_cur;
  set done = 0;
  upu_loop: loop
    fetch upu_cur into c_id_usr,c_nombre,c_telefono;
    IF done = 1 THEN
      LEAVE upu_loop;
      END IF;
    set c_id_usr=  c_id_usr+900;

    IF EXISTS (SELECT * from usuario where id_usuario=c_id_usr) then
      update usuario set nombre=c_nombre, telefono=c_telefono where id_usuario=c_id_usr;
    ELSE
      select c_id_usr;
    END if;
  end loop;
  close upu_cur;
END
