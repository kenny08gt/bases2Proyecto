<?php
header('Content-Type: text/html; charset=utf8_decode'); 
session_start();
if(!isset($_SESSION["usuario"])){
  header ("Location: error.php?mensaje=sesion");
}
?>
<?php

$sess= $_SESSION["usuario"];
  if(isset($_POST["crear_nombre"])){
    $nombre=$_POST["crear_nombre"];
    $direccion=$_POST["crear_direccion"];
    $latitud=$_POST["crear_latitud"];
    $longitud=$_POST["crear_longitud"];
    $esferas=$_POST["numero_esferas"];
    $tipo=$_POST["crear_tipo"];
    //pnombre, pdireccion, ptipo, plongitud, platitud, poficial, pcalificacion
    $connection1 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
    //pnombre, pdireccion, ptipo, plongitud, platitud, poficial, pcalificacion
    $resultado1 = mysqli_query($connection1, "CALL establecimiento_alta_no_oficial('$nombre','$direccion','$tipo',$longitud,$latitud,0,$esferas)") or die("Query fail: " . mysqli_error());
    if(!$resultado1){
      echo "<script>alert('Error al crear el establecimiento');</script>";
    }else{
      echo "<script>alert('Establecimiento creado con exito!');</script>";
      $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
      $result2 = mysqli_query($connection2,"call ad_log('$sess','Insertar Establecimiento','Registro establecimiento no oficial: $nombre',now(),NULL);");
                
    }
  }  
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bienvenido</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/dark.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/esferas.css">
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
                <li><a href="#"><?php  echo    $row[1]; ?></a></li>
                <?php
                  }
                  ?>
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
                <li><a href="#"><?php  echo    $row[0]; ?></a></li>
                <?php
                  }
                  ?>
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
                <li class="dropdown-header"><?php echo $row[0] ?></li>
                <?php
                  }
                  ?>
                <li id="<?php echo $row[0]?>"><a href="#"><?php  echo    $row[1]; ?></a></li>
                <?php
                  }
                  ?>
              </ul>
            </li>
          </ul>
          <a class="navbar-brand" href="/salir.php">Salir</a>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
        <h1>Bienvenido</h1>
        <p></p>
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
       <?php
          $connection122 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
          $resultado122 = mysqli_query($connection122, "CALL select_establecimiento") or die("Query fail: " . mysqli_error());
          echo "<div id='inicial'><table class=\"table\" border=\"1\" cellpading=\"10px\" cellspacing=\"15px\"><tbody>";
          $cont=0;
          while ($row = mysqli_fetch_array($resultado122)){  
      	    if($cont==0){
      			  echo "<tr>";
      			} 
            echo "<td><h2>".$row[1]."</h2> <p>Tipo: ".$row[3]."</p>  <p>Direccion: ".$row[2]."</p> <p><a class=\"btn btn-default\" href=\"establecimiento.php?id=".$row[0]."\" role=\"button\">Ver detalles &raquo;</a></p></td>";
            if($cont==2){
      			  echo "</tr>";
      				$cont=-1;
      			}
      			$cont ++;
            
          }
          echo "</tbody></table></div>";            
        ?>
      <div id="show" class="container">
       <br>
      </div>
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">No encuentras el establecimiento? Crealo!</h3>
        </div>
        <div class="panel-body">
          
          <form class="form-horizontal" method="post">
            <div class="form-group">
              <rating ng-model="rate" max="4" state-on="'orange-star'" state-off="'white-star'"> </rating>
              <label for="ejemplo_email_3" class="col-lg-2 control-label">Nombre</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="crear_nombre" name="crear_nombre"
                       placeholder="El poney pisador" require>
              </div>
            </div>
            <div class="form-group">
              <label for="ejemplo_password_3" class="col-lg-2 control-label">Direccion</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="crear_direccion"  name="crear_direccion"
                       placeholder="2km desde la comarca al sur" require>
              </div>
            </div>
            <div class="form-group">
              <label for="ejemplo_password_3" class="col-lg-2 control-label">Latitud</label>
              <div class="col-lg-10">
                <input type="number" step="0.00001" class="form-control" id="crear_latitud" name="crear_latitud" 
                       placeholder="40.968105" require>
              </div>
            </div>
            <div class="form-group">
              <label for="ejemplo_password_3" class="col-lg-2 control-label">Longitud</label>
              <div class="col-lg-10">
                <input type="number" step="0.00001" class="form-control" id="crear_longitud" name="crear_longitud" 
                       placeholder="-5.6657524" require>
              </div>
            </div>
            <div class="form-group">
              <label for="ejemplo_password_3" class="col-lg-2 control-label">Tipo</label>
              <div class="row" id="otro2">
                <div class="col-lg-6">
                  <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Tipo de Establecimiento
                      <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li onclick="tipo('Hotel')"><a class="glyphicon glyphicon-paperclip" > Hotel</a></li>
                          <li onclick="tipo('Restaurante')"><a class="glyphicon glyphicon-paperclip" > Retaurante</a></li>
                          <li onclick="tipo('Taller')"><a class="glyphicon glyphicon-paperclip" > Taller</a></li>
                        </ul>
                    </div>
                </div>
                <div class"col-lg-2"><input type="text" id="crear_tipo" name="crear_tipo" value="Hotel" readonly="true"></div>
              </div>
            </div>
            <div class="form-group">
              <label for="ejemplo_password_3" class="col-lg-2 control-label">Calificacion General</label>
              <div class="row" id="otro">
                <div class="col-lg-4">
                  <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Esferas del dragon
                    <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li onclick="esferas(1)"><a class="esfera1" >1</a></li>
                        <li onclick="esferas(2)"><a class="esfera2" >2</a></li>
                        <li onclick="esferas(3)"><a class="esfera3" >3</a></li>
                        <li onclick="esferas(4)"><a class="esfera4" >4</a></li>
                        <li onclick="esferas(5)"><a class="esfera5" >5</a></li>
                        <li onclick="esferas(6)"><a class="esfera6" >6</a></li>
                        <li onclick="esferas(7)"><a class="esfera7" >7</a></li>
                      </ul>
                  </div>
                </div>
                <div class"col-lg-2" id="esferas">
                  
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-default">Crear</button>
              </div>
            </div>
            <input type="hidden" name="numero_esferas" value="0" id="numero_esferas"/>
          </form>
        </div>
      </div>
      
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
          dimension+="";
          $("#show").empty();
          $("#show").append("<br>");
          
      });
      
       $("#btn").click(function() {
      
        
          var servicio= $("#servicio").text();
          var tipo =  $("#tipo").text();
          var cat = $("#categoria").text();
          var Nservicio = servicio.split(". ").length;
          var Ntipo = tipo.split(". ").length;
          var Ncat = cat.split(". ").length;
          if(Ncat==1)Ncat=0;
          if(Nservicio==1)Nservicio=0;
          if(Ntipo==1)Ntipo=0;
        
         $("#show").empty();
         $("#inicial").empty();
         document.getElementById("inicial").style.display = 'none';
         
           jQuery.post("select.php", {
      						servicio:servicio,
      						tipo:tipo,
      						cat:cat,
      						Nservicio:Nservicio,
      						Ncat:Ncat,
      						Ntipo:Ntipo,
      						dimension:dimension
      					}, function(data, textStatus){
      					    var array = data.split("|");
      					    if(data.length==0){
      					      $( "#show" ).append("<br><div class=\"alert alert-danger fade in\">"+
      					      "<a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>:(</strong> No hubieron coincidencias para esos parametros!.</div>");
      					    }else{
        					    var cuerpo="";
        					    //AQUI
        					    cuerpo+="<table class=\"table\" border=\"1\" cellpading=\"10px\" cellspacing=\"15px\"><tbody>";
        					    var cont=0;
        					    for (var i =0; i<array.length-1;i++ )
        					    {
        					      if(cont==0){
        					        cuerpo+="<tr>";
        					      } 
        					      var array2 = array[i].split("_");
        					    	cuerpo+="  <td><h2>"+array2[0]+"</h2> <p>Tipo: "+array2[2]+"</p>  <p>Direccion: "+array2[1]+"</p> <p><a class=\"btn btn-default\" href=\"establecimiento.php?id="+array2[3]+"\" role=\"button\">Ver detalles &raquo;</a></p></td>";
        					      if(cont==2){
        					        cuerpo+="</tr>";
        					        cont=-1;
        					      }
        					      cont ++;
        					    }
        					    cuerpo+="</tbody></table>";
        					    $( "#show" ).append(cuerpo);
        					    //FIN
        					    /*for (var i =0; i<array.length-1;i++ )
        					    {
        					      var array2 = array[i].split("_");
        					    	$( "#show" ).append("  <div class=\"col-md-4\"><h2>"+array2[0]+"</h2> <p>Tipo: "+array2[2]+"</p>  <p>Direccion: "+array2[1]+"</p> <p><a class=\"btn btn-default\" href=\"establecimiento.php?id="+array2[3]+"\" role=\"button\">Ver detalles &raquo;</a></p></div>");
        					
        					    }*/
        					   }
      					   });
      
          
      });
      
      });
    </script>
    <script type="text/javascript">
      function esferas(cantidad){
        
        if(cantidad==1){
          document.getElementById("esferas").innerHTML="<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">";
        }else if(cantidad==2){
          document.getElementById("esferas").innerHTML="<img src=\"/esferas/1.png\" width=\"25\" height=\"25\"><img src=\"/esferas/2.png\" width=\"25\" height=\"25\">";
        }else if(cantidad==3){
          document.getElementById("esferas").innerHTML="<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"+"<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">";
        }else if(cantidad==4){
          document.getElementById("esferas").innerHTML="<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"+"<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">";
        }else if(cantidad==5){
          document.getElementById("esferas").innerHTML="<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"+"<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/5.png\" width=\"25\" height=\"25\">";
        }else if(cantidad==6){
          document.getElementById("esferas").innerHTML="<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"+"<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/5.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/6.png\" width=\"25\" height=\"25\">";
        }else if(cantidad==7){
          document.getElementById("esferas").innerHTML="<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"+"<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/5.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/6.png\" width=\"25\" height=\"25\">"+
          "<img src=\"/esferas/7.png\" width=\"25\" height=\"25\">";
        }
        document.getElementById("numero_esferas").value =cantidad;
      }
      function tipo(id){
        
          document.getElementById("crear_tipo").value =id;
      }
    </script>
  </body>
</html>

