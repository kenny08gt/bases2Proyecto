<?php
$mensaje="";
if(isset($_GET['m'])){
$mensaje = $_GET['m'];
}
if($mensaje=="correcto"){
    echo "<script type='text/javascript'>alert('Transaccion realizada con exito');</script>";
}

$connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
?>
<!DOCTYPE html>
<html>
    <title>Formulario</title>
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
        <script>
function showUser(str) {
    if (str == "" || str=="0") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","/getusers.php?q="+str+"&&t=ca",true);
        xmlhttp.send();
    }
}
</script>
        
    </head>    
    
    
    <body>
        <div class="container">
          
        <?php  echo "<h2 class=\"form-signin-heading\">Formulario</h2>" ?>
        <?php if($mensaje!="" && $mensaje!="correcto"){ echo "<div class=\"alert alert-warning\"><strong>Error!</strong> ".$mensaje." </div>";} ?>
         <div id="alta">
             
             
             
              
            <h3>Agregar nueva caracteristica</h3>
             <form class="form-signin" method="post"  action="ABC_operaciones.php?t=caracteristica&&a=Agregar">
            Nombre <input type="text"  name="nombre"class="form-control" placeholder="Lavanderia" required autofocus>
            Valor  <textarea name="val" id="val"  class="form-control" cols="40" rows="5" ></textarea></br>
            
            
             
            
             Servicio
             
             <select class="form-control" name="serv">
              <option value="0">Ninguno</option>
               <?php 
            //verificar si existe usuario
            $result = mysqli_query($connection, 
                "CALL select_servicio") or die("Query fail: " . mysqli_error());
                
                 while ($row = mysqli_fetch_array($result)){ 
               echo "<option value=".$row[0].">".$row[1]."</option>";
            }
                ?>
            </select></br>
           <button class="btn btn-lg btn-primary btn-block" type="submit" >Crear</button></br>
            </form>
            </div>
            
            <div id="cambio">
            
                
            <h3>Modificar existente</h3>
            
            
             <form class="form-signin" method="post" action="ABC_operaciones.php?t=caracteristica&&a=Modificar">
            Caracteristica
            <select class="form-control" id="usr" name="usr" onchange="showUser(this.value)">
            <option value="0">Selecciona una opcion</option>    
            <?php
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                  //verificar si existe usuario
            $usuarios = mysqli_query($connection, 
                "CALL select_caracteristica") or die("Query fail: " . mysqli_error());
               
                 while ($row = mysqli_fetch_array($usuarios)){ 
               echo "<option value=".$row[0].">".$row[1]."</option>";
            }
                 ?>
                </select>
                
           
            <div id="txtHint"><b>La informacion se mostrara aqui</b></div></br>
            
             <button class="btn btn-lg btn-primary btn-block" type="submit" >Modificar</button></br>
           
             </form>
             
            </div>
            
        
        
        
        
        
            <div id="baja">
            <h3>Eliminar</h3>
            
              <form class="form-signin" method="post" action="ABC_operaciones.php?t=caracteristica&&a=Eliminar">
            Caracteristica: 
            <select class="form-control" id="usr" name="usr">
            <option value="0">Selecciona una opcion</option>    
            <?php
                 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                  //verificar si existe usuario
             $usuarios = mysqli_query($connection, 
                "CALL select_caracteristica") or die("Query fail: " . mysqli_error());
               
               
                 while ($row = mysqli_fetch_array($usuarios)){ 
               echo "<option value=".$row[0].">".$row[1]."</option>";
            }
                 ?>
                </select></br>
                
           <button class="btn btn-lg btn-primary btn-block" type="submit" >Eliminar</button></br>
           
      
             </form>
            <button class="btn btn-lg btn-warning btn-block" onclick="window.location = '/cpanel.php';" >Regresar</button></br>
            </div>
    </body>  
            
         
           
        </div>
        
</html>