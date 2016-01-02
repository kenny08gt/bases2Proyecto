<?php
$mostrar=0;
if(isset($_POST["reporte"])){
 $ruta="/home/ubuntu/workspace/reportes/reporte.csv";
 if (file_exists($ruta)) {
  unlink($ruta);
 }
 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
 $result = mysqli_query($connection,  "CALL crear_reporte");
 if (!$result) {
  //error
 }else{//se creo el archivo
  echo "<script>window.location='/reportes/reporte.csv';</script>";
 }
}else if(isset($_POST["ver"])){
 $mostrar=1;
 $ruta="/home/ubuntu/workspace/reportes/reporte.csv";
 if (file_exists($ruta)) {
  unlink($ruta);
 }
 $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
 $result = mysqli_query($connection,  "CALL crear_reporte");
 $ruta="reportes/reporte.csv";
}

?>
<!DOCTYPE html>
<html>
    <title>Reportes</title>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link href="bootstrap/css/dark.min.css" rel="stylesheet">
        <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
        <!--<script type="text/javascript" src="bootstrap/js/jquery-1.4.2.min.js"></script>-->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/jquery.csvToTable.js"></script>
        <link rel="stylesheet" href="bootstrap/js/themes/green/style.css" type="text/css" id="" media="print, projection, screen">
        <script type="text/javascript" src="bootstrap/js/jquery.tablesorter.js"></script> 
    </head>    
    <style type="text/css">
     .span3 {  
         height: 500px !important;
         overflow: scroll;
         color: black;
     }
    </style>
    <body>
        <div class="container">
          
            <h2 class="form-signin-heading">Reportes</h2>
           
           <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/reporte1.php';" >Reporte 1</button>
           </br>
            <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/reporte2.php';" >Reporte 2</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block"onclick="window.location = '/reporte3.php';" >Reporte 3</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/reporte4.php';" >Reporte 4</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block"onclick="window.location = '/reporte5.php';" >Reporte 5</button>
             </br>
   
        </div>
        

    </body>

</html>