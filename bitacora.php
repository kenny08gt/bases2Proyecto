<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <title>Bitacora</title>
    <head>
        <style>
table, th, td {
    border: 1px solid orange;
    border-collapse: collapse;
}
th, td {
    padding: 1px;
}
</style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link href="bootstrap/css/dark.min.css" rel="stylesheet">
        
    </head>    
    <body>
        <div class="container">
          
            <h2 class="form-signin-heading">Bitacora</h2>
            <button class="btn btn-lg btn-warning btn-block" onclick="window.location = '/cpanel.php';" >Regresar</button></br>
           
           <table class="form-signin-heading" style="width:75%">
  <tr>
    <th>Usuario</th>
    <th>Accion</th>		
    <th>Fecha</th>
  </tr>
  <?php 
  $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
   $result = mysqli_query($connection, 
                "CALL select_bitacora") or die("Query fail: " . mysqli_error());
                 while ($row = mysqli_fetch_array($result)){ 
                echo "<tr>";
    echo"<td>".$row['usuario']."</td>";
    echo "<td>".$row['accion']."</td>";		
    echo "<td>".$row['fecha']."</td>";
  echo "</tr>";
            }
  
  
  ?>

</table>
           
        </div>
    </body>
</html>