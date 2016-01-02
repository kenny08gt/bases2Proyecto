<?php
session_start();
$tipo = $_GET['t'];
$accion = $_GET['a'];
$sess= $_SESSION["usuario"];
if($tipo=="usuario"){
    switch($accion){
        case "Agregar":
             $nombre=$_POST['nombre'];
                $pass=$_POST['pass'];
                $mail=$_POST['email'];
                $tel=$_POST['tel'];
                $rol=$_POST['rol'];
                $estab=$_POST['estab'];
                echo $rol;
                echo $estab;
                
                if($rol!="especial" && $estab!="0"){
                  header('Location:ABC_usuario.php?m=Conflicto entre rol y establecimiento');  
                }else{
                if($estab=="0")
                    $estab="NULL";
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL usuario_alta('$nombre','$mail',$tel,'$rol',$estab,'$pass');");

                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_usuario.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Usuario','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_usuario.php?m=correcto');
                }
            }
            
            break;
        case "Modificar":
             $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_usuario.php?m=Usuario invalido');
            }else{
                //hacemos la modificacion
                
                $nombre=$_POST['nombre'];
                $pass=$_POST['pass'];
                $mail=$_POST['email'];
                $tel=$_POST['tel'];
                $rol=$_POST['rol'];
                $estab=$_POST['estab'];
                echo $rol;
                echo $estab;
                
                if($rol!="especial" && $estab!="0"){
                  header('Location:ABC_usuario.php?m=Conflicto entre rol y establecimiento');  
                }else{
                if($estab=="0")
                    $estab="NULL";
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL usuario_cambio('$nombre','$mail',$tel,'$rol',$estab,'$pass',$valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_usuario.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Usuario','Modificacion por usuario administrador, Cambio a usuario: $nombre',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_usuario.php?m=correcto');
                }
            }
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_usuario.php?m=Usuario invalido');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL usuario_baja($valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_usuario.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Usuario','Eliminacion por usuario administrador, Eliminacion de Usuario: $valor',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_usuario.php?m=correcto');
                }
            }
            break;
    }
}else if($tipo=="establecimiento"){
    
    switch($accion){
        case "Agregar":
             $nombre=$_POST['nombre'];
                $dir=$_POST['dir'];
                $tipo=$_POST['tipo'];
                $longitud=$_POST['longitud'];
                $latitud=$_POST['latitud'];
                $off=$_POST['off'];

                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL establecimiento_alta('$nombre','$dir','$tipo',$longitud,$latitud,$off);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_establecimiento.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Establecimiento','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_establecimiento.php?m=correcto');
                }
            
            
            break;
        case "Modificar":
             $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_establecimiento.php?m=Establecimiento invalido');
            }else{
                //hacemos la modificacion
                 $nombre=$_POST['nombre'];
                $dir=$_POST['dir'];
                $tipo=$_POST['tipo'];
                $longitud=$_POST['longitud'];
                $latitud=$_POST['latitud'];
                $off=$_POST['off'];
                
                echo $valor;

                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL establecimiento_cambio('$nombre','$dir','$tipo',$longitud,$latitud,$valor,$off);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_establecimiento.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Establecimiento','Modificacion por usuario administrador, Modificacion establecimiento: $nombre',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_establecimiento.php?m=correcto');
                }
            
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_establecimiento.php?m=Establecimiento invalido');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL establecimiento_baja($valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_establecimiento.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Establecimiento','Eliminacion por usuario administrador, Eliminacion establecimiento: $valor',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_establecimiento.php?m=correcto');
                }
            }
            break;
    }
    
}else if($tipo=="dimension"){
     switch($accion){
        case "Agregar":
             $nombre=$_POST['nombre'];
                $desc=$_POST['desc'];
                if($desc=="")
                    $desc="NULL";
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL dimension_alta('$nombre','$desc');");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_dimension.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Dimension','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_dimension.php?m=correcto');
                }
            
            
            break;
        case "Modificar":
             $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_dimension.php?m=Dimension invalida');
            }else{
                //hacemos la modificacion
                 $nombre=$_POST['nombre'];
                $desc=$_POST['desc'];
               if($desc=="")
                    $desc="NULL";
                echo $valor;

                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL dimension_cambio('$nombre','$desc',$valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_dimension.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Dimension','Modificacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_dimension.php?m=correcto');
                }
            
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_dimension.php?m=Dimension invalida');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL dimension_baja($valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_dimension.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Dimension','Eliminacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_dimension.php?m=correcto');
                }
            }
            break;
    }
    
    
}else if($tipo=="categoria"){
    
         switch($accion){
        case "Agregar":
             $nombre=$_POST['nombre'];
                $desc=$_POST['desc'];
                if($desc=="")
                    $desc="NULL";
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL categoria_alta('$nombre','$desc');");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_categoria.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Categoria','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_categoria.php?m=correcto');
                }
            
            
            break;
        case "Modificar":
             $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_categoria.php?m=Categoria invalida');
            }else{
                //hacemos la modificacion
                 $nombre=$_POST['nombre'];
                $desc=$_POST['desc'];
               if($desc=="")
                    $desc="NULL";
                echo $valor;

                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL categoria_cambio('$nombre','$desc',$valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_categoria.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Categoria','Modificacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_categoria.php?m=correcto');
                }
            
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_categoria.php?m=categoria invalida');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL categoria_baja($valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_categoria.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Categoria','Eliminacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_categoria.php?m=correcto');
                }
            }
            break;
    }
    
}else if($tipo=="servicio"){
    
         switch($accion){
        case "Agregar":
             $nombre=$_POST['nombre'];
                $desc=$_POST['desc'];
                if($desc=="")
                    $desc="NULL";
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL servicio_alta('$nombre','$desc');");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_servicio.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Servicio','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_servicio.php?m=correcto');
                }
            
            
            break;
        case "Modificar":
             $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_servicio.php?m=Servicio invalido');
            }else{
                //hacemos la modificacion
                 $nombre=$_POST['nombre'];
                $desc=$_POST['desc'];
               if($desc=="")
                    $desc="NULL";
                echo $valor;

                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL servicio_cambio('$nombre','$desc',$valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_servicio.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Servicio','Modificacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_servicio.php?m=correcto');
                }
            
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_servicio.php?m=servicio invalido');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL servicio_baja($valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_servicio.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Servicio','Eliminacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_servicio.php?m=correcto');
                }
            }
            break;
    }
    
    }else if($tipo=="caracteristica"){
        //---------------------------------------------------
        
        
         switch($accion){
        case "Agregar":
             $nombre=$_POST['nombre'];
                $val=$_POST['val'];
                $serv=$_POST['serv'];
                if($val=="")
                    $val="NULL";
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL caracteristica_alta('$nombre','$val',$serv);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_caracteristica.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Caracteristica','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_caracteristica.php?m=correcto');
                }
            
            
            break;
        case "Modificar":
             $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_caracteristica.php?m=Servicio invalido');
            }else{
                //hacemos la modificacion
                 $nombre=$_POST['nombre'];
                $val=$_POST['val'];
                $serv=$_POST['serv'];
               if($val=="")
                    $val="NULL";
                echo $valor;

                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL caracteristica_cambio('$nombre','$val',$serv,$valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_caracteristica.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Caracteristica','Modificacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_caracteristica.php?m=correcto');
                }
            
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_caracteristica.php?m=caracteristica invalida');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL caracteristica_baja($valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_caracteristica.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Caracteristica','Eliminacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_caracteristica.php?m=correcto');
                }
            }
            break;
    }
    }else if($tipo=="prereserva"){
        switch($accion){
        case "Agregar":
             $fech=$_POST['fech'];
                $hor=$_POST['hor'].":00";
                $fechayhora = $fech." ".$hor;
                $cant=$_POST['cant'];
                $es5=$_POST['esc'];
                $u5=$_POST['usua'];
                if($es5=="0"){
                    header('Location:ABC_prereserva.php?m=Seleciona un establecimiento y servicio');
                }
                if($u5=="0"){
                    header('Location:ABC_prereserva.php?m=Seleciona un usuario');
                }
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL prereserva_alta('$fechayhora',$cant,$es5,$u5);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_prereserva.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Prereserva','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_prereserva.php?m=correcto');
                }
            
            
            break;
        case "Modificar":
             $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_prereserva.php?m=Prereserva invalida');
            }else{
                //hacemos la modificacion
                
                $fech=$_POST['fech'];
                $hor=$_POST['hor'].":00";
                $fechayhora = $fech." ".$hor;
                $cant=$_POST['cant'];
                $es5=$_POST['esc'];
                $u5=$_POST['usua'];
                if($es5=="0"){
                    header('Location:ABC_prereserva.php?m=Seleciona un establecimiento y servicio');
                }
                if($u5=="0"){
                    header('Location:ABC_prereserva.php?m=Seleciona un usuario');
                }
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL prereserva_cambio('$fechayhora',$cant,$es5,$u5,$valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_prereserva.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Prereserva','Modificacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_prereserva.php?m=correcto');
                }
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_prereserva.php?m=prereserva invalida');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL prereserva_baja($valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_prereserva.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Prereserva','Eliminacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_prereserva.php?m=correcto');
                }
            }
            break;
    }
    }else if($tipo=="comentario"){
             switch($accion){
        case "Agregar":
                $con=$_POST['con'];
                $cal=$_POST['cal'];
                $es5=$_POST['esc'];
            
                if($es5=="0"){
                    header('Location:ABC_comentario.php?m=Seleciona un establecimiento y servicio');
                }
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL comentario_alta('$con',$cal,$es5);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_comentario.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Comentario','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_comentario.php?m=correcto');
                }
            
            
            break;
        case "Modificar":
             $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_comentario.php?m=Comentario invalido');
            }else{
                //hacemos la modificacion
            
                $con=$_POST['con'];
                $cal=$_POST['cal'];
                $es5=$_POST['esc'];
            
                if($es5=="0"){
                    header('Location:ABC_comentario.php?m=Seleciona un establecimiento y servicio');
                }
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL comentario_cambio('$con',$cal,$es5,$valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_comentario.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Comentario','Modificacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_comentario.php?m=correcto');
                }
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_comentario.php?m=comentario invalido');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL comentario_baja($valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_comentario.php?m=Transaccion abortada');
                    
                }else{
                 /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Comentario','Eliminacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_comentario.php?m=correcto');
                }
            }
            break;
    }   
    }else if($tipo=="ed"){
             switch($accion){
        case "Agregar":
                $est=$_POST['usr'];
                $dim=$_POST['usr2'];
                $cat=$_POST['usr3'];
            
                if($est=="0"||$dim=="0"||$cat=="0"){
                    header('Location:ABC_ed.php?m=Seleciona un establecimiento o dimension validas');
                }
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL ed_alta($est,$dim,$cat);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_ed.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Establecimiento_Dimension','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_ed.php?m=correcto');
                }
            
           // echo "CALL ed_alta($est,$dim,$cat);";
            
            break;
        case "Modificar":
             $valor = $_POST['usrm'];
             $valor2 = $_POST['usr2m'];
            if($valor=="0"){
                header('Location:ABC_comentario.php?m=Comentario invalido');
            }else{
                //hacemos la modificacion
            
                $estab=$_POST['usrm'];
                $dim=$_POST['usr2m'];
                $cat=$_POST['usr2'];
            
                if($estab=="0"||$dim=="0"||$cat=="0"){
                    header('Location:ABC_ed.php?m=Seleciona una opcion correcta');
                }
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL ed_cambio($estab,$dim,$cat,$valor,$valor2);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_ed.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Establecimiento_Dimension','Modificacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_ed.php?m=correcto');
                }
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            $valor2 = $_POST['usr2'];
            //echo "CALL ed_baja($valor,$valor2);";
            if($valor=="0" || $valor2=="0" ){
                header('Location:ABC_ed.php?m=Seleccion invalida');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL ed_baja($valor,$valor2);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_ed.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Establecimiento_Dimension','Eliminacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_ed.php?m=correcto');
                }
            }
            break;
    }   
        
        
    }else if($tipo=="es"){
         switch($accion){
        case "Agregar":
             $est=$_POST['usr'];
                $serv=$_POST['usr2'];
                if($est=="0"||$serv=="0")
                    header('Location:ABC_es.php?m=Ingrese valores validos');
                    
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL es_alta($est,$serv);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_es.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Establecimiento_Servicio','Inserccion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_es.php?m=correcto');
                }
            
            
            break;
        case "Modificar":
             $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_categoria.php?m=Categoria invalida');
            }else{
                //hacemos la modificacion
                $est=$_POST['estab'];
                $serv=$_POST['serv'];
                if($est=="0"||$serv=="0")
                    header('Location:ABC_es.php?m=Ingrese valores validos');

                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL es_cambio($est,$serv,$valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_es.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Modificar Establecimiento_Servicio','Modificacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_es.php?m=correcto');
                }
            
            }
            break;
        case "Eliminar":
            
            //comprobamos que el usuario que va a eliminar es valido
            
            $valor = $_POST['usr'];
            if($valor=="0"){
                header('Location:ABC_categoria.php?m=categoria invalida');
            }else{
                //correcto
                
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result = mysqli_query($connection,"CALL es_baja($valor);");
                //loop the result set
                
                if (!$result) {
                    header('Location:ABC_es.php?m=Transaccion abortada');
                    
                }else{
                /*BITACORA*/
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('$sess','Eliminar Establecimiento_Servicio','Eliminacion por usuario administrador',now(),NULL);");
                /*BITACORA*/
                 header('Location:ABC_es.php?m=correcto');
                }
            }
            break;
    }
    
    }else{
    echo $tipo;
    //header('Location:ABC_usuario.php');
}

?>