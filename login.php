<?php
session_start();
?>
<?php
        /*$server= mysql_connect('127.0.0.1', 'ingeusac', '');
        $db = mysql_select_db('bases2', $server);
        $result = mysql_query( 'CALL test()' );
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['id_establecimiento'] ;
        }*/
    if(isset($_POST["user"])&& isset($_POST["pass"])){
        $user=$_POST["user"];
        $pass=$_POST["pass"];
        
        //connect to database
        $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");

        //run the store proc
        $result = mysqli_query($connection, 
            "CALL select_usuario") or die("Query fail: " . mysqli_error());

        //loop the result set
        $bandera=0;
        while ($row = mysqli_fetch_array($result)){   
            //echo "correo ".$row[2]."- pass ".$row[6]; 
            if($user===$row[2] && $pass===$row[6]){
                $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                $result2 = mysqli_query($connection2,"call ad_log('".$row[1]."','Ingreso al sistema','Usuario ".$row[4]."',now(),NULL);");
                
                if($row[4]==="administrador")
                    echo "<script>window.location=\"/cpanel.php\"</script>";
                else if($row[4]==="normal")
                    echo "<script>window.location=\"/principal.php\"</script>";
                else if($row[4]==="especial")
                    echo "<script>window.location=\"/especial.php\"</script>";
                $_SESSION["usuario"]=$row[1];
                $_SESSION["id_usuario"]=$row[0];
                $_SESSION["establecimiento"]=$row[5];
                $_SESSION["correo"]=$row[2];
                $bandera=1;
                
                break;

            }
        }
        if($bandera==0)
            echo "<div class=\"alert alert-warning\"><strong>Error!</strong> Contraseña o correo no coinciden!.</div>";
    }
?>

<!DOCTYPE html>
<html>
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
    <title>Login</title>
    <body>
    <div class="container">
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Inicia sesion</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        Usuario<input type="email" id="inputEmail" name="user"class="form-control" placeholder="son_7_anillos" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        Passowrd <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="1_para_gobernar_a_todos" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
        <button class="btn btn-lg btn-primary btn-block" onclick="window.location='/index.php'">Regresar</button>
    </div> 
    
    <!-- /container -->
        <!--<form method="post">
            <table>
                <tr>
                    <td>Usuario</td><td>Password</td>
                </tr>
                <tr>
                    <td><input type="text" name="user" placeholder="son_7_anillos" /></td>
                    <td><input type="password" name="pass" placeholder="1_para_gobernar_a_todos"/></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Entrar"/></td>
                </tr>
            </table>
        </form>-->
    </body>
</html>