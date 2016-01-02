<?php
header('Content-Type: text/html; charset=utf8_decode'); 
session_start();
if(!isset($_SESSION["usuario"])){
  header ("Location: error.php?mensaje=sesion");
}
?>
<?php

$sess= $_SESSION["usuario"];
  
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Reporte1</title>
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
        <h1>Reporte 1</h1>
        <p></p>
      </div>
      
       <div class="form-group">
      <label class="col-lg-2 control-label">Filtro</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="radio1" value="option1" checked="">
            Cliente
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="radio2" value="option2">
            Establecimiento
          </label>
        </div>
      </div>
    </div>
    
    
      <div id="navbar" class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav">
      <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nombre Establecimiento <span class="caret"></span></a>
              <ul id="myidE" class="dropdown-menu">
                <?php
                  $connection1 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                  $resultado1 = mysqli_query($connection1, "CALL select_establecimiento") or die("Query fail: " . mysqli_error());
                  
                  while ($row = mysqli_fetch_array($resultado1)){  
                  ?>
                <li><a href="#"><?php  echo    $row[1]; ?></a></li>
                <?php
                  }
                  ?>
              </ul>
            </li>
            
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nombre Cliente <span class="caret"></span></a>
              <ul id="myidC" class="dropdown-menu">
                <?php
                  $connection1 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
                  $resultado1 = mysqli_query($connection1, "CALL nombre_usuario_especial") or die("Query fail: " . mysqli_error());
                  
                  while ($row = mysqli_fetch_array($resultado1)){  
                  ?>
                <li><a href="#"><?php  echo    $row[0]; ?></a></li>
                <?php
                  }
                  ?>
              </ul>
            </li>
    
      
              </ul>
        </div>
    
    
    
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Busqueda Personalizada</h3>
        </div>
        
 
        <div class="panel-body">
          <p id ="establecimiento_e"></p>
          <p id ="establecimiento" hidden></p>
          <p id ="cliente_e"></p>
          <p id ="cliente" hidden></p>
        </div>
      </div>
      <a id="btn"  href="#" class="btn btn-success">Buscar</a>
      <a id="btnN"  href="#" class="btn btn-success">Nueva</a>
      <a id="export1"  href="#" class="btn btn-danger">Exportar Parte1 XLS</a>
      <a id="export2"  href="#" class="btn btn-danger">Exportar Parte1 PDF</a>
      <a id="export3"  href="#" class="btn btn-danger">Exportar Parte2 XLS</a>
      <a id="export4"  href="#" class="btn btn-danger">Exportar Parte2 PDF</a>
      <a id="toogle"  href="#" class="btn btn-info">Cambiar Vista</a>
   <div id="show">
     <h3>Establecimiento-PowerUser</h3>
   </div>
   
   
   <div id="ver2">
     <h3>Total Establecimientos</h3>
      <table class="table table-striped table-hover ">
      <thead>
        <tr class="info">
          <th>Filtro</th>
          <th>Numero Establecimientos</th>
        </tr>
      </thead>
      <tbody>
              <?php

      $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
      $result = mysqli_query($connection,"CALL reporte1_2;") or die("Query fail: " . mysqli_error());
            while ($row = mysqli_fetch_array($result)){   
              $clase = "";
              if ($row[1]=="-") $clase = "class=\"text-info\"";
                 
      ?>
        <tr <?php echo $clase; ?>>
          <td><?php echo $row[0]; ?></td>
          <td><?php echo $row[1]; ?></td>
        
        </tr>   
      <?php
      }
      ?>
      </tbody>
    </table>
</div>
      
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script>
      $(document).ready(function(){
        var banderaVer=true;
        $("#ver2").hide();
        
        $("#toogle").click(function() {
          if(banderaVer){
          $("#ver2").show();
          $("#show").hide();
          banderaVer=false;
          }
          else{
            $("#ver2").hide();
          $("#show").show();
          banderaVer =true;
          }
          
          
      });
          $("#myidE li").click(function() {
          var nombre = $(this).text();
           $("#establecimiento_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-primary\">"+nombre+"</span>&nbsp");
          $("#establecimiento").append(nombre+". ");
          
      });
       $("#myidC li").click(function() {
          var nombre = $(this).text();
           $("#cliente_e").append("<span STYLE=\"font-size: 12pt\" class=\"label label-primary\">"+nombre+"</span>&nbsp");
          $("#cliente").append(nombre+". ");
          
      });
       
       $("#btnN").click(function() {
           
          $("#establecimiento").empty();
          $("#cliente").empty();
          $("#establecimiento_e").empty();
          $("#cliente_e").empty();
          $("##show").empty();

          
      });
      
       $("#btn").click(function() {
          var b2 = document.getElementById("radio2").checked;
          var estable= $("#establecimiento").text();
          var cliente =  $("#cliente").text();
          var nestable = estable.split(". ").length;
          var ncliente = cliente.split(". ").length;
          if(nestable==1)nestable=0;
          if(ncliente==1)ncliente=0;
          var filtro = 0;
          if(b2) filtro = 1;
          
          
         
           jQuery.post("select.php", {
      						estable:estable,
      						nestable:nestable,
      						cliente:cliente,
      						ncliente:ncliente,
      						filtro:filtro,
      					}, function(data, textStatus){
      					    var array = data.split("|");
      					    if(data.length==0){
      					      $( "#show" ).append("<br><div class=\"alert alert-danger fade in\">"+
      					      "<a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>:(</strong> No hubieron coincidencias para esos parametros!.</div>");
      					    }else{
        					    var cuerpo="";
        					    //AQUI
        					    cuerpo+="<table id=\"tabla1\" class=\"table table-striped table-hover\"><tbody>";
        					    
        					    for (var i =0; i<array.length-1;i++ )
        					    {
        					        var array2 = array[i].split("_");
                                  if(i==0) {
                                    cuerpo+="<tr class=\"warning\"><th>"+array2[0]+"</th>"+"<th>"+array2[1]+"</th>"+"<th>"+array2[2]+"</th>"+"<th>"+array2[3]+"</th></tr>";
        					    
                                  }else{
        					      
        					    	cuerpo+="<tr><td>"+array2[0]+"</td>"+"<td>"+array2[1]+"</td>"+"<td>"+array2[2]+"</td>"+"<td>"+array2[3]+"</td></tr>";
        					    
                                  }
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

         $("#export3").click(function(e) {

    window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#ver2').html()));

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


<script>
$(function () {

    var specialElementHandlers = {
        '#editor': function (element,renderer) {
            return true;
        }
    };
 $('#export4').click(function () {
   
        var doc = new jsPDF('l','pt', 'a1', true);
        var specialElementHandlers = {
    '#editor': function(element, renderer){
        return true;
    }
};
        doc.fromHTML($('#ver2').get(0), 1, 1, {
    'width': 200, 
    'elementHandlers': specialElementHandlers
});
        doc.save('sample-file.pdf');
    });  
});
  
  
</script>

  </body>
</html>

