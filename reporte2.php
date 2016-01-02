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
    <title>Reporte2</title>
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
        <h1>Reporte 2</h1>
        <p></p>
      </div>
      <form>
       <div class="form-group">
      <label class="col-lg-2 control-label">Calificacion</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="radio1" value="option1" checked="">
            General
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="radio2" value="option2">
            Servicios
          </label>
        </div>
      </div>
    </div>
    </form>
        <div class="form-group">
      <label class="col-lg-2 control-label">Limite</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="radio3" value="option1" checked="">
            Top 10
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="radio4" value="option2">
            Todos
          </label>
        </div>
      </div>
    </div>
    <label class="col-lg-2 control-label">Filtro</label>
    <div class="col-lg-10">
     <div class="checkbox">
            <label>
            <input id="ft"  type="checkbox"> Tipo Establecimiento
            </label>
         </div>
         <div class="checkbox">
            <label>
            <input  id="fc" type="checkbox"> Categoria
            </label>
         </div>
         <div class="checkbox">
            <label>
            <input id="fs" type="checkbox"> Servicio
            </label>
         </div>
         </div>
<div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Servicio <span class="caret"></span></a>
              <ul id="myidS" class="dropdown-menu">
                <?php
	$connection1 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
    $resultado1 = mysqli_query($connection1, "CALL select_servicio") or die("Query fail: " . mysqli_error());
    while ($row = mysqli_fetch_array($resultado1)){
        ?>
                <li><a href="#"><?php  echo$row[1]; ?></a></li>
                <?php
 } ?>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Establecimiento <span class="caret"></span></a>
              <ul id="myidT" class="dropdown-menu">
                <?php 
    $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
    $resultado = mysqli_query($connection, "CALL select_tipo") or die("Query fail: " . mysqli_error());
    while ($row = mysqli_fetch_array($resultado)){
        ?>
                <li><a href="#"><?php  echo$row[0]; ?></a></li>
                <?php
 } ?>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categoria <span class="caret"></span></a>
              <ul id="myidC" class="dropdown-menu">
                <?php 
    $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
    $resultado = mysqli_query($connection, "CALL select_categoriaydimension") or die("Query fail: " . mysqli_error());
    $dimensionAnterior = "";
    while ($row = mysqli_fetch_array($resultado)){
        
        if($dimensionAnterior!=$row[0]){
            $dimensionAnterior=$row[0] ?>
                <li  role="separator" class="divider"></li>
                <li class="dropdown-header"><?php  echo $row[0]  ?></li>
                <?php
 } ?>
                <li id="<?php  echo $row[0] ?>"><a href="#"><?php  echo$row[1]; ?></a></li>
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
          <p id ="tipo_e"></p>
          <p id = "servicio_e"></p>
          <p id = "categoria_e"></p>
          <p id ="tipo" hidden></p>
          <p id = "servicio" hidden></p>
          <p id = "categoria" hidden></p>
        </div>
      </div>
      <a id="btn"  href="#" class="btn btn-success">Buscar</a>
      <a id="btnN"  href="#" class="btn btn-success">Nueva</a>
      <a id="export1"  href="#" class="btn btn-danger">Exportar  XLS</a>
      <a id="export2"  href="#" class="btn btn-danger">Exportar  PDF</a>
  <div id="show"></div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script>
      $(document).ready(function(){
           var dimension="";
         $("#myidT li").click(function() {
          var nombre = $(this).text();
           $("#tipo_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-warning\">"+nombre+"</span>&nbsp");
           $("#tipo").append(nombre+". ");
      });
         $("#myidS li").click(function() {
          var nombre = $(this).text();
           $("#servicio_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-danger\">"+nombre+"</span>&nbsp");
            $("#servicio").append(nombre+". ");
      });
       $("#myidC li").click(function() {
          var nombre = $(this).text();
           $("#categoria_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-primary\">"+nombre+"</span>&nbsp");
          dimension+= $(this).attr("id")+". ";
          $("#categoria").append(nombre+". ");
      });
       $("#btnN").click(function() {
          var nombre = $(this).text();
           $("#servicio").empty();
            $("#tipo").empty();
           $("#categoria").empty();
           $("#servicio_e").empty();
            $("#tipo_e").empty();
           $("#categoria_e").empty();
          $("#show").empty();
          dimension = "";
      });
       $("#btn").click(function() {
          var fs = document.getElementById("fs").checked;
          var fc = document.getElementById("fc").checked;
          var ft = document.getElementById("ft").checked;
          var r2 = document.getElementById("radio2").checked;
          var r3 = document.getElementById("radio3").checked;
          var servicio= $("#servicio").text();
          var tipo =  $("#tipo").text();
          var cate = $("#categoria").text();
          var Nservicio = servicio.split(". ").length;
          var Ntipo = tipo.split(". ").length;
          var Ncat = cate.split(". ").length;
          if(Ncat==1)Ncat=0;
          if(Nservicio==1)Nservicio=0;
          if(Ntipo==1)Ntipo=0;
          if(fs)fs=1;
          if(fc)fc=1;
          if(ft)ft=1;
          var filtroc=0;
          if(r2) filtroc=1;
          var filtrotop=0;
          if(r3)filtrotop=1;
           jQuery.post("select.php", {
      						servicio:servicio,
      						tipo:tipo,
      						cate:cate,
      						Nservicio:Nservicio,
      						Ncat:Ncat,
      						Ntipo:Ntipo,
      						filtrotop:filtrotop,
      						filtroc:filtroc,
      						fs:fs,
      						fc:fc,
      						ft:ft,
      						dimension:dimension,
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
        					      if(filtroc==0){
        					          if(i==0) {
        					              cuerpo+="<tr class=\"warning\"><th>"+array2[1]+"</th><th>"+array2[2]+"</th>";
        					              
        					          }
        					          else{
        					          cuerpo+="<tr><td>"+array2[1]+"</td><td>"+array2[2]+"</td>";
        					          }
                var pos = 2;
                if(fs==1) {
                    pos = pos +1;
                   cuerpo+="<td>"+array2[pos]+"</td>";
                }
                if(ft==1) {
                    pos = pos +1;
                    cuerpo+="<td>"+array2[pos]+"</td>";
                }
                if(fc==1){
                    pos = pos +1;
                    cuerpo+="<td>"+array2[pos]+"</td>";
                    pos = pos +1;
                    cuerpo+="<td>"+array2[pos]+"</td>";
                }
                }
                else{
                    if(i==0) {
                        cuerpo+="<tr class = \"warning\"><th>"+array2[1]+"</th><th>"+array2[2]+"</th><th>"+array2[3]+"</th>";
                    }
                    else{
                        cuerpo+="<tr><td>"+array2[1]+"</td><td>"+array2[2]+"</td><td>"+array2[3]+"</td>";
                    }
                    pos = 3;
                    if(ft==1) {
                        pos = pos +1;
                        cuerpo+="<td>"+array2[pos]+"</td>";
                    }
                    if(fc==1) {
                        pos = pos +1;
                        cuerpo+="<td>"+array2[pos]+"</td>";
                        pos = pos +1;
                        cuerpo+="<td>"+array2[pos]+"</td>";
                    }
                }
                
                if(i>0) {
                    cuerpo+="<td><a class=\"text-warning\" href=\"establecimiento.php?id="+array2[0]+"\">Sitio del establecimiento</a></td>";
                }
                else{
                    
                    cuerpo+="<td>"+array2[0]+"</td>"
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