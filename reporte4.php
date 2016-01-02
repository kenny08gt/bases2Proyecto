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
    <title>Reporte4</title>
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
        <h1>Reporte 4</h1>
        <p></p>
      </div>
      <label class="col-lg-2 control-label">Filtro</label>
         <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Establecimiento <span class="caret"></span></a>
              <ul id="myidE" class="dropdown-menu">
                <?php
	$connection1 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
	$resultado1 = mysqli_query($connection1, "CALL distinct_establecimiento") or die("Query fail: " . mysqli_error());
	while ($row = mysqli_fetch_array($resultado1)){
		?>
                <li><a href="#"><?php  echo$row[0]; ?></a></li>
                <?php
 } ?>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accion <span class="caret"></span></a>
              <ul id="myidA" class="dropdown-menu">
                <?php 
	$connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
	$resultado = mysqli_query($connection, "CALL distinct_accion") or die("Query fail: " . mysqli_error());
	while ($row = mysqli_fetch_array($resultado)){
		?>
                <li><a href="#"><?php  echo$row[0]; ?></a></li>
                <?php
 } ?>
              </ul>
            </li>
                        <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuario <span class="caret"></span></a>
              <ul id="myidU" class="dropdown-menu">
                <?php 
	$connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
	$resultado = mysqli_query($connection, "CALL select_usuario") or die("Query fail: " . mysqli_error());
	while ($row = mysqli_fetch_array($resultado)){
		?>
                <li><a href="#"><?php  echo$row[1]; ?></a></li>
                <?php
 } ?>
              </ul>
            </li>
                                    <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fecha <span class="caret"></span></a>
              <ul id="myidF" class="dropdown-menu">
                <?php 
	$connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
	$resultado = mysqli_query($connection, "CALL select_fecha") or die("Query fail: " . mysqli_error());
	while ($row = mysqli_fetch_array($resultado)){
		?>
                <li><a href="#"><?php  echo$row[0]; ?>/<?php  echo$row[1]; ?>/<?php  echo$row[2]; ?></a></li>
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
          <p id ="estable_e"></p>
          <p id = "accion_e"></p>
          <p id = "usuario_e"></p>
          <p id = "fecha_e"></p>
          <p id ="estable" hidden></p>
          <p id = "accion" hidden></p>
          <p id = "usuario" hidden></p>
          <p id = "fecha" hidden></p>
        </div>
      </div>
     <a id="btn"  href="#" class="btn btn-success">Buscar</a>
      <a id="btnN"  href="#" class="btn btn-success">Nueva</a>
      <a id="export1"  href="#" class="btn btn-danger">Exportar  XLS</a>
      <a id="export2"  href="#" class="btn btn-danger">Exportar  PDF</a>
  <div id="show"></div>
     </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <script>
      $(document).ready(function(){
         $("#myidE li").click(function() {
          var nombre = $(this).text();
           $("#estable_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-warning\">"+nombre+"</span>&nbsp");
           $("#estable").append(nombre+". ");
      });
         $("#myidA li").click(function() {
          var nombre = $(this).text();
           $("#accion_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-danger\">"+nombre+"</span>&nbsp");
            $("#accion").append(nombre+". ");
      });
       $("#myidU li").click(function() {
          var nombre = $(this).text();
           $("#usuario_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-primary\">"+nombre+"</span>&nbsp");
          $("#usuario").append(nombre+". ");
      });
      $("#myidF li").click(function() {
          var nombre = $(this).text();
           $("#fecha_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-success\">"+nombre+"</span>&nbsp");
          $("#fecha").append(nombre+". ");
      });
       $("#btnN").click(function() {
          $("#estable").empty();
          $("#usuario").empty();
          $("#accion").empty();
          $("#fecha").empty();
          $("#estable_e").empty();
          $("#usuario_e").empty();
          $("#accion_e").empty();
          $("#fecha_e").empty();
          $("#show").empty();
      });
       $("#btn").click(function() {
          var estable= $("#estable").text();
          var usuario =  $("#usuario").text();
          var accion = $("#accion").text();
          var fecha = $("#fecha").text();
          var Nestable = estable.split(". ").length;
          var Nusuario = usuario.split(". ").length;
          var Nfecha = fecha.split(". ").length;
          var Naccion = accion.split(". ").length;
alert(fecha);
          if(Nusuario==1)Nusuario=0;
          if(Nfecha==1)Nfecha=0;
          if(Nestable==1)Nestable=0;
          if(Naccion==1)Naccion=0;
          var arrayfechas = fecha.split(". ");
          var dias="";
          var meses="";
          var anios="";
          for(var i =0; i< Nfecha-1; i++){
            var actual = arrayfechas[0];
            var splitactual = actual.split("/");
            dias += splitactual[0]+". ";
            meses += splitactual[1]+". ";
            anios += splitactual[2]+". ";
          }
          alert(dias+"_"+meses+"_"+anios);
           jQuery.post("select.php", {
      						estable:estable,
      						Nestable:Nestable,
      						usuario:usuario,
      						Nusuario:Nusuario,
      						Naccion:Naccion,
      						accion:accion,
      						Nfecha:Nfecha,
      						dias:dias,
      						meses:meses,
      						anios:anios,
      					}, function(data, textStatus){
      					    var array = data.split("|");
      					    if(data.length==0){
      					      $( "#show" ).append("<br><div class=\"alert alert-danger fade in\">"+
      					      "<a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>:(</strong> No hubieron coincidencias para esos parametros!.</div>");
      					    }else{
        					    var cuerpo="";
        					    //AQUI
        					    cuerpo+="<table class=\"table table-striped table-hover\"><tbody>";
        					    for (var i =0; i<array.length-1;i++ )
        					    {
        					      var array2 = array[i].split("_");
        					          if(i==0) {
        					              cuerpo+="<tr class=\"warning\"><th>"+array2[0]+"</th><th>"+array2[1]+"</th><th>"+array2[2]+"</th><th>"+array2[3]+"</th><th>"+array2[4]+"</th>";
        					          }
        					          else{
        					          cuerpo+="<tr><td>"+array2[0]+"</td><td>"+array2[1]+"</td><td>"+array2[2]+"</td><td>"+array2[3]+"</td><td>"+array2[4]+"</td>";
        					          }
                
        					    	cuerpo+="</tr>"
        					    }
        					    cuerpo+="</tbody></table>";
        					    $( "#show" ).append(cuerpo);
        					   }
      					   });
      });
            $("#export1").click(function(e) {
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#show').html()));
    e.preventDefault();
});
      });
    </script>
<script>
$(function () {
    var specialElementHandlers = {
        '#editor': function (element,renderer) {
            return true;
        }
    };
 $('#export2').click(function () {
        var doc = new jsPDF('l','pt', 'a1', true);
        var specialElementHandlers = {
    '#editor': function(element, renderer){
        return true;
    }
};
        doc.fromHTML($('#show').get(0), 1, 1, {
    'width': 200, 
    'elementHandlers': specialElementHandlers
});
        doc.save('sample-file.pdf');
    });  
});
</script>
  </body>
</html>