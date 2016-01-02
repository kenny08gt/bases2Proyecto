<?php
header('Content-Type: text/html; charset=utf8_decode'); 
session_start();
if(!isset($_SESSION["usuario"])){
  header ("Location: error.php?mensaje=sesion");
}
?>
<?php
  $usuario=$_SESSION["usuario"];
  $id_establecimiento=$_SESSION["establecimiento"]     ;
  //echo "user ".$usuario;
  //echo "establecimiento ".$id_establecimiento;
  $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
        //run the store proc
        
  $result = mysqli_query($connection,"CALL select_establecimiento_por_id($id_establecimiento);") or die("Query fail: " . mysqli_error());
  //echo "CALL select_establecimiento_por_id(".$id_establecimiento.")";
  while ($row = mysqli_fetch_array($result)){  
    $latidud=$row[5];
    $longitud=$row[4];
  }
  $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
  $result = mysqli_query($connection,"CALL select_establecimiento_por_id($id_establecimiento);") or die("Query fail: " . mysqli_error());
  $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
  $result2= mysqli_query($connection,"CALL select_prereserva_por_establecimiento($id_establecimiento);") or die("Query fail: " . mysqli_error());
       // echo "CALL select_establecimiento_por_id(".$id_establecimiento.")";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido <?php echo $usuario?></title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/dark.min.css" rel="stylesheet">
    <!-- GOOGLE MAPS
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
    var myCenter=new google.maps.LatLng(<?php echo $latidud?>,<?php echo $longitud?>);
    function initialize() {
      var mapProp = {
        center:myCenter,
        zoom:14,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
      var marker=new google.maps.Marker({
        position:myCenter,
        });
      
      marker.setMap(map);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    -->
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
          <a class="navbar-brand" href="#">OutGuat</a>
        </div>
      </div>
    </nav>

      <div class="container theme-showcase" role="main">
            <div class="jumbotron">
        <h1>Bienvenido <?php echo $usuario?></h1>
        <p></p>
      </div>
        <div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Establecimiento(s) de <?php echo $usuario?></h3>
  </div>
</div>
        
     
        <?php
          while ($row = mysqli_fetch_array($result)){   
            echo"  <div ><h2>".$row[1]."</h2> <p>Tipo: ".$row[3]."</p>  <p>Direccion:".$row[2]."</p> <p><a class=\"btn btn-default\" href=\"establecimiento.php?id=".$row[6]."\" role=\"button\">Ver detalles &raquo;</a></p></div>";
            //GOOGLE MAPS
            //echo "<div id=\"googleMap\" style=\"width:500px;height:380px;\"></div>";

            echo"
             <div class=\"bs-docs-section\">
                  <div class=\"panel panel-danger\">
                    <div class=\"panel-heading\">
                      <h3 class=\"panel-title\">Pre Reservas</h3>
                    </div>
                  </div>
                  </div>"; 
            echo "<div id=\"establecimiento_".$row[6]."\"  style=\"display: block\">";
         
            if($row[3]=="Hotel"){
              ?><table class="table"><thead><tr><th>Fecha y Hora</th><th>Tipo de habitación</th><th>Usuario</th><th>Email</th></tr></thead>
              <?php
            }else if($row[3]=="Restaurante"){
              ?><table class="table"><thead><tr><th>Fecha y Hora</th><th>Cantidad de personas</th><th>Usuario</th><th>Email</th></tr></thead>
              <?php
            }
              ?>
            <tbody><?php
            while($row2 = mysqli_fetch_array($result2)){
               
              ?>
              <tr class="success"><td><?php echo $row2[1] ?></td><td><?php echo $row2[2] ?></td><td><?php echo $row2[9] ?></td><td><?php echo $row2[10] ?></td></tr>
              <?php
            }
            ?>
            </tbody>
            </table>
            <?php
            echo "</div>";
          }
        ?>
      </div>
  


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    </script>
    <button class="btn btn-lg btn-warning btn-block" onclick="window.location = '/principal.php';" >Principal</button></br>
  </body>
</html>