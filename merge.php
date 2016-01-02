<?php
	header('Content-Type: text/html; charset=utf8_decode');
	session_start();
	
	if(!isset($_SESSION["usuario"])){
		header ("Location: error.php?mensaje=sesion");
	}

	?>
<?php
 $sess= $_SESSION["usuario"]; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Merge</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/dark.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="src/jquery.table2excel.js"></script>
    <script src="//mrrio.github.io/jsPDF/dist/jspdf.debug.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body role="document">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/salir.php">OutGuat</a>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
        <h1>Merge de Establecimientos</h1>
        <p></p>
      </div>
     
         <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Establecimiento Oficial <span class="caret"></span></a>
              <ul id="myidO" class="dropdown-menu">
                <?php
	$connection1 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
	$resultado1 = mysqli_query($connection1, "CALL select_oficial") or die("Query fail: " . mysqli_error());
	while ($row = mysqli_fetch_array($resultado1)){
		?>
                <li id="<?php  echo$row[0]; ?>"><a href="#"><?php  echo$row[1]; ?></a></li>
                <?php
 } ?>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Establecimiento No Oficial <span class="caret"></span></a>
              <ul id="myidN" class="dropdown-menu">
                <?php
	$connection1 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
	$resultado1 = mysqli_query($connection1, "CALL select_noficial") or die("Query fail: " . mysqli_error());
	while ($row = mysqli_fetch_array($resultado1)){
		?>
                <li id="<?php  echo$row[0]; ?>"><a href="#"><?php  echo$row[1]; ?></a></li>
                <?php
 } ?>
              </ul>
            </li>
                    
          </ul>
        </div>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Busqueda Personalizada</h3>
        </div>
        <div class="panel-body">
          <p>Elija las categorias, servicios o tipos de establecimiento para filtrar una busqueda </p>
          <p id ="oficial_e"></p>
          <p id = "nooficial_e"></p>
          <p id ="oficial" hidden></p>
          <p id = "nooficial" hidden></p>

        </div>
      </div>
     <a id="btn"  href="#" class="btn btn-success">Hacer Merge</a>
     <a id="btnN"  href="#" class="btn btn-success">Nuevo</a>
     <div id = "show"></div>
     </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <script>
      $(document).ready(function(){
          
          var idOficial = 0;
         $("#myidO li").click(function() {
          idOficial = $(this).attr("id");
          var nombre = $(this).text();
           $("#oficial_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-warning\">"+nombre+"</span>&nbsp");

      });
         $("#myidN li").click(function() {
          var nombre = $(this).text();
          var idNoOficial = $(this).attr("id");
           $("#nooficial_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-primary\">"+nombre+"</span>&nbsp");
            $("#nooficial").append(idNoOficial+".");
      });
      
       $("#btnN").click(function() {

      });
       $("#btn").click(function() {
          var oficial= idOficial;
          var nooficial =  $("#nooficial").text();
         
          var Nnooficial = nooficial.split(".").length;
         
          if(Nnooficial==1)Nnooficial=0;
          
           jQuery.post("select.php", {
      						oficial:oficial,
      						nooficial:nooficial,
      						Nnooficial:Nnooficial,
      					}, function(data, textStatus){
      					    alert(data);
      					    $("#show").append("<a class=\"btn btn-default\" href=\"establecimiento.php?id="+idOficial+"\" role=\"button\">Ver detalles del merge &raquo;</a>")
      					   
      					   });
      });

      });
    </script>

  </body>
</html>