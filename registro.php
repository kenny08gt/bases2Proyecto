<?php
    if(isset($_POST["nombre"])){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $telefono=$_POST["telefono"];
        $pass=$_POST["pass"];
        $pass2=$_POST["pass2"];
        if($pass2!=$pass){
            echo "<div class=\"alert alert-warning\"><strong>Error!</strong> No coinciden las contraseñas!.</div>";
        }else{
            $bandera=0;
            //connect to database
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            //verificar si existe usuario
            $result = mysqli_query($connection, 
                "CALL select_usuario") or die("Query fail: " . mysqli_error());
            $email2=$email;
            while ($row = mysqli_fetch_array($result)){ 
                if($email2===$row[2]) {
                    echo "<div class=\"alert alert-warning\"><strong>Error!</strong> Correo ya registrado!.</div>";
                    $bandera=1;
                    break;
                }
            }
            if($bandera==0){
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                //run the store proc
                //pnombre, pcorreo, ptelefono, prol, ppassword
                //echo "CALL usuario_alta('$nombre','$email',$telefono,'normal',0,'$pass')";
                $result = mysqli_query($connection,"CALL usuario_alta('$nombre','$email',$telefono,'normal',0,'$pass');");
                //loop the result set
                
                if (!$result) {
                    die('Invalid query: ' . mysql_error());
                }else{
                    echo "<div class=\"alert alert-success\"><strong>Exito!</strong> Registro exitoso!.</div>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <title>Registro</title>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/login.css" rel="stylesheet">
    </head>    
    <body>
        <div class="container">
          <form class="form-signin" method="post">
            <h2 class="form-signin-heading">Registrate!</h2>
            Nombre: <input type="text"  name="nombre"class="form-control" placeholder="Bilbo Bolson" required autofocus>
            Correo: <input type="email" name="email" class="form-control" placeholder="smaug@robamos_oro.com" required>
            Telefono: <input type="number" name="telefono" class="form-control" placeholder="77778888" required>
            Password: <input type="password" id="pass" name="pass" class="form-control" placeholder="gema_del_arca" required>
            Confirma Password: <input type="password" id="pass2"name="pass2" class="form-control" placeholder="gema_del_arca" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" >Registrarme</button>
          </form>
            <button class="btn btn-lg btn-primary btn-block" onclick="window.location='/index.php'">Regresar</button>
        </div>
    </body>
</html>