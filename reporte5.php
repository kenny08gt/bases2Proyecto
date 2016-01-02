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
    <title>Reporte5</title>
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
        <h1>Reporte 5</h1>
        <p></p>
      </div>
      
      
         <a id="export1"  href="#" class="btn btn-danger">Exportar  XLS</a>
      <a id="export2"  href="#" class="btn btn-danger">Exportar  PDF</a>
      
      <div id="show">
      <table class="table table-striped table-hover ">
      <thead>
        <tr class="info">
          <th>id</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Telefono</th>
          <th>Rol</th>
          <th>Password</th>
        </tr>
      </thead>
      <tbody>
              <?php

      $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
      $result = mysqli_query($connection,"CALL select_usuario;") or die("Query fail: " . mysqli_error());
            while ($row = mysqli_fetch_array($result)){   
                 
      ?>
        <tr>
          <td><?php echo $row[0]; ?></td>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td><?php echo $row[3]; ?></td>
          <td><?php echo $row[4]; ?></td>
          <td><?php echo $row[6]; ?></td>
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

          

            $("#export1").click(function(e) {

    window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#show').html()));

    e.preventDefault();

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
