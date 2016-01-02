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
    <title>Control Panel</title>
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
          
            <h2 class="form-signin-heading">Panel de control</h2>
           
           <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/ABC_usuario.php';" >Usuario</button>
           </br>
            <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/ABC_establecimiento.php';" >Establecimiento</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block"onclick="window.location = '/ABC_categoria.php';" >Categoria</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/ABC_dimension.php';" >Dimension</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block"onclick="window.location = '/ABC_caracteristica.php';" >Caracteristica</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/ABC_servicio.php';" >Servicio</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/ABC_prereserva.php';" >Prereserva</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/ABC_ed.php';" >Establecimiento-Dimension</button>
             </br>
            <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/ABC_es.php';" >Establecimiento-Servicio</button>
             </br>
             <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/bitacora.php';" >Log de Actividad</button>
             </br>
             <button class="btn btn-lg btn-primary btn-block" onclick="window.location = '/info.php';" >Informacion BD</button>
             </br>
             <div id="Formulario">
              <form method="post">
                <button class="btn btn-lg btn-warning btn-block" type="submit" name="reporte">Descargar Archivo csv</button><br>
                <button class="btn btn-lg btn-warning btn-block" type="submit" name="ver">Ver Archivo csv</button>
                <br>
                <br>
              </form>
             </div>
        </div>
        
        <div class="container">
         <div id="CSVTable" class="span3" >
          <br>
         </div>
        </div>
    </body>
    <script type="text/javascript">
      if(1=== <?php echo $mostrar?>){
       $('#CSVTable').CSVToTable('reportes/reporte.csv', 
           { 
              startLine: 0
           }
       ).bind("loadComplete",function() { 
           $('#CSVTable table').each(function(){ 
              this.id='tabla1';  
              $("#tabla1").toggleClass('CSVTable tablesorter');
              $("#tabla1").attr('cellpading', '15px');
              $("#tabla1").attr('cellspacing', '15px');
              $("#tabla1").attr('border', '1');
              $("#tabla1").tablesorter();
           });
       });;
      }
    </script>
</html>