<?php
header('Content-Type: text/html; charset=utf8_decode'); 
session_start();
if(!(isset($_SESSION['usuario'])&& $_SESSION['usuario']!= '')){
  //echo "<script>window.location=\"error.php?mensaje=sesion\"</script>";
  header ("Location: error.php?mensaje=sesion");
}else{
  /*$_SESSION["usuario"]=$row[1];
                $_SESSION["id_usuario"]=$row[0];
                $_SESSION["establecimiento"]=$row[5];
                $_SESSION["correo"]=$row[2];*/
  $usuario=$_SESSION["usuario"];
  $id_usuario=$_SESSION["id_usuario"];
}
?>
<?php
  $bandera_prereserva=0;
  if(isset($_GET["prereserva"])){
    $bandera_prereserva=1;
    $inputC=$_POST["inputC"];
    $date=$_POST["date"];
    $time=$_POST["time"];
    $id=$_GET["id"];
    $ides=$_GET["ides"];
    $fecha=$date." ".$time.":00";
    $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
    $result = mysqli_query($connection,"CALL prereserva_alta('$fecha',$inputC,$ides,$id_usuario);") or die("Query fail: " . mysqli_error());
    if($result){
     echo "<script>alert('Pre reserva enviada con exito!');</script>";
   
      $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
      $result2 = mysqli_query($connection2,"call ad_log('$usuario','Insertar Prereserva','Creacion por usuario cliente',now(),$id);");
                
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bienvenido</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/dark.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/esferas.css">
    <script type="text/javascript" src="bootstrap/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <?php
        $id=$_GET["id"];
        $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
        $result = mysqli_query($connection,"CALL select_establecimiento_por_id($id);") or die("Query fail: " . mysqli_error());
        while ($row = mysqli_fetch_array($result)){   
              $latidud=$row[5];
              $longitud=$row[4];
        }
    ?>
    <script>
    var myCenter=new google.maps.LatLng(<?php echo $latidud.','. $longitud?>);
    function initialize() {
      var mapProp = {
        center:myCenter,
        zoom:14,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
      var marker=new google.maps.Marker({
        position:myCenter,
        draggable: false,
        });
      
      marker.setMap(map);
    }
    google.maps.event.addDomListener(window, 'resize', initialize);
    google.maps.event.addDomListener(window, 'load', initialize);
    
    </script>
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
          <a class="navbar-brand" href="/principal.php">OutGuat</a>
          <a class="navbar-brand" href="/salir.php">Salir</a>
        </div>
      </div>
    </nav>
    <div class="container theme-showcase" role="main">
    <div class="jumbotron" id="<?php if($bandera_prereserva===0){echo  $_GET["id"]; }else echo $id;?>">
      <h2>
      <?php     
        if($bandera_prereserva===0)
          $id=$_GET["id"];
        $es_oficial;
        $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
        $result = mysqli_query($connection,"CALL select_establecimiento_por_id($id);") or die("Query fail: " . mysqli_error());
        while ($row = mysqli_fetch_array($result)){   
              echo $row[1];
              $es_oficial=$row[6];
              $calificacion=$row[7];
        } ?></h2>
      <p></p>
    </div>
    <div class="panel panel-info" id="<?php echo  $_SESSION["usuario"]; ?>" >
      <div class="panel-heading">
        <h3 class="panel-title">Informacion</h3>
      </div>
      <div class="panel-body"><!-- GOOGLE MPAS -->
        <div id="googleMap" style="width:100%;height:300px;"></div>
      </div>
      <div class="panel-body">
        <p>Calificacion: 
         <?php
         if($es_oficial==1){
            $id=$_GET["id"];
            $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $result2 = mysqli_query($connection2,"CALL promedio_establecimiento($id);") or die("Query fail: " . mysqli_error());
            //SIN ROW
            $connection3 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $result2 = mysqli_query($connection3,"CALL select_establecimiento_por_id($id);") or die("Query fail: " . mysqli_error());
            $row2 = mysqli_fetch_array($result2) ;
            $calificacion = $row2[7]; 
            echo round($calificacion,1). " ";
         }
            if($calificacion>=1 and $calificacion<2){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">";
            }
            else if($calificacion>=2 and $calificacion<3){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\"><img src=\"/esferas/2.png\" width=\"25\" height=\"25\">";
            
            }
            else if($calificacion>=3 and $calificacion<4){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">";
            
            }
            else if($calificacion>=4 and $calificacion<5){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">";
            }
            else if($calificacion>=5 and $calificacion<6){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/5.png\" width=\"25\" height=\"25\">";
            }
            else if($calificacion>=6 and $calificacion<7){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/5.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/6.png\" width=\"25\" height=\"25\">";
            }
            else if($calificacion==7){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/5.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/6.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/7.png\" width=\"25\" height=\"25\">";
            }
          ?>
        
        </p>
        <p>Direccion:
         <?php     
          $tipo="";
          if($bandera_prereserva===0)
            $id=$_GET["id"];
          $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
          $result = mysqli_query($connection,"CALL select_establecimiento_por_id($id);") or die("Query fail: " . mysqli_error());
          while ($row = mysqli_fetch_array($result)){   
              echo $row[2];
              $tipo=$row[3];
          } 
          ?>
        </p>
        <p>Alias:
        <?php     
          if($bandera_prereserva===0)
            $id=$_GET["id"];
          $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
          $result = mysqli_query($connection,"CALL select_alias($id);") or die("Query fail: " . mysqli_error());
          $counter =0;
          while ($row = mysqli_fetch_array($result)){   
                if($counter>0) echo ",";
                echo $row[0];
                $counter = $counter +1;
          }
       ?>
        
        </p>
          <?php     
          if($bandera_prereserva===0)
            $id=$_GET["id"];
          $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
          $result = mysqli_query($connection,"CALL select_establecimiento_por_id($id);") or die("Query fail: " . mysqli_error());
          while ($row = mysqli_fetch_array($result)){   
                $oficial = $row[6];
          }
          if($oficial==1){?>
            <p>Sitio Oficial</p>
          <?php
            $_GET["OFICIAL"]=1;
          }
          else{
            $_GET["OFICIAL"]=0;
          }
          ?>
        
      </div>
    </div>
    <table class="table table-striped table-hover ">
      <thead>
        <tr class="danger">
          <th>#</th>
          <th>Servicio</th>
          <th>Calificacion</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
              <?php
      $contador =1;
      if($bandera_prereserva===0)
        $id=$_GET["id"];
      $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
      $result = mysqli_query($connection,"CALL select_serviciodeestablecimiento($id);") or die("Query fail: " . mysqli_error());
            while ($row = mysqli_fetch_array($result)){   
                  $idS = $row[1];
                  $idC = $row[2];
      ?>
        <tr>
          <td><?php echo $contador; 
          $contador = $contador+1; ?></td>
          <td><?php echo $row[0]; ?></td>
          <td>
          <?php
          if($bandera_prereserva===0)
            $id=$_GET["id"];
            $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $result2 = mysqli_query($connection2,"CALL promedio_servicio($idS,$id);") or die("Query fail: " . mysqli_error());
            $row2 = mysqli_fetch_array($result2) ;
             $calificacion = $row2[0]; 
            echo round($calificacion,1). " ";
            if($calificacion>=1 and $calificacion<2){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">";
            }
            else if($calificacion>=2 and $calificacion<3){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\"><img src=\"/esferas/2.png\" width=\"25\" height=\"25\">";
            
            }
            else if($calificacion>=3 and $calificacion<4){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">";
            
            }
            else if($calificacion>=4 and $calificacion<5){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">";
            }
            else if($calificacion>=5 and $calificacion<6){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/5.png\" width=\"25\" height=\"25\">";
            }
            else if($calificacion>=6 and $calificacion<7){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/5.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/6.png\" width=\"25\" height=\"25\">";
            }
            else if($calificacion==7){
              echo "<img src=\"/esferas/1.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/2.png\" width=\"25\" height=\"25\">"."<img src=\"/esferas/3.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/4.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/5.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/6.png\" width=\"25\" height=\"25\">".
            "<img src=\"/esferas/7.png\" width=\"25\" height=\"25\">";
            }

          ?>
          
          
          </td>
          <td>
            <a href="#" id ="<?php echo $idC;   ?>" onclick="comentar(<?php echo $idC; ?>,'<?php echo $usuario; ?>', <?php echo $id; ?>)" class="btn btn-primary btn-xs">Comentar</a>
            <?php
            if($_GET["OFICIAL"]==1){
              
              echo " <a href=\"#\"   onclick=\"reservar($idC)\"     class=\"btn btn-warning btn-xs\">Hacer Pre-Reserva</a> ";
            }
            ?>
            
          </td>
        </tr>
      <?php
      }
      ?>
      </tbody>
    </table>
    <div id="alerta">
      <div class="col-lg-4">
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Listo!</strong> Gracias por tu comentario
        </div>
      </div>
    </div>
    <div id="alerta2">
      <div class="col-lg-4">
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Listo!</strong> Se ha realizado la reserva
        </div>
      </div>
    </div>

    <div id="fcalificar">
      <form class="form-horizontal">
        <fieldset>
          <legend>Calificar Servicio</legend>
          <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Comentario</label>
            <div class="col-lg-10">
              <textarea class="form-control" rows="3" id="textArea"></textarea>
              <span class="help-block"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label for="dropdown" class="col-lg-2 control-label">Calificacion</label>
            <div class="row">
              <div class="col-lg-4">
                <rating ng-model="rate" max="4" state-on="'orange-star'" state-off="'white-star'"> </rating>
                <input id="select" type="hidden">
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
              <div class="col-lg-4">
                <div id="esferas"></div>
              </div>
            </div>
          </div>
          <div class="form-group">
          </div>
        </fieldset>
      </form>
 <a id="EnviarComentario" href="#" class="btn btn-primary">Enviar</a>

    </div>
    
    
    <!---FORMULARIO DE RESERVAAS-->
    <div id ="freserva">
      <div class="col-lg-6 col-lg-offset-0">  
        <form method="post" action="establecimiento.php?prereserva=ok&id=<?php echo $id?>&ides=<?php echo $idC?>">
        <?php
          if($tipo=="Hotel"){
            echo "<p id = \"inputL\">Tipo de Habitación(Ej: Sencilla, doble, triple, etc)</p>".
            "<input type=\"text\" id=\"inputC\" name=\"inputC\" readonly='true'  style=\"display = 'none' \">".
            "<div id=\"inputC2\"class=\"dropdown\"><button id=\"buton_hotel\"class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">Elija el tipo de habitacion".
            "<span class=\"caret\"></span></button><ul class=\"dropdown-menu\"><li><a onclick='drop(1)'>Sencilla</a></li><li><a onclick='drop(2)'>Doble</a></li><li><a onclick='drop(3)'>Triple</a></li></ul></div>".
            "<p id = \"inputF\">Fecha</p><input type=\"date\" id=\"date\" name=\"date\">".
            "<p id = \"inputG\">Hora</p><input type=\"time\" id=\"time\" name=\"time\">";
          }else if($tipo=="Restaurante"){
            echo "<p id = \"inputL\">Cantidad de personas</p>".
            "<input class=\"form-control input-sm\" type=\"number\" id=\"inputC\" name=\"inputC\">".
            "<p id = \"inputF\">Fecha</p><input type=\"date\" id=\"date\" name=\"date\">".
            "<p id = \"inputG\">Hora</p><input type=\"time\" id=\"time\" name=\"time\">";
          }else{
            echo "<h2>No se pueden realizar pre reservas para este tipo de establecimiento por el momento.</h2>";
          }
        ?>
          <input  type="submit" class="btn btn-danger" id="enviarR" value="Enviar"/>
        </form>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
        <script>
          var idFormulario="";
          var usuario ="";
          var IDest="";

      $(document).ready(function(){
      
         $("#EnviarComentario").click(function() {
          var comentario=$("#textArea").val();
          var puntos =$("#select").val();
          var idES= idFormulario;
            jQuery.post("select.php", {
      						idES:idES,
      						puntos:puntos,
      						comentario:comentario,
      						usuario:usuario,
      						IDest:IDest,
      					}, function(data, textStatus){
      					    });
	    
      		$("#fcalificar").hide();
           $("#textArea").val("");
           $("#select").val("");
           $("#alerta").show();
           
      });
      
      
      
         

          
      });
      
        
        
        $("#fcalificar").hide();
       $("#alerta").hide();
       $("#alerta2").hide();
       $("#inputC").hide();
       $("#inputC2").hide();
        $("#inputL").hide();
        $("#enviarR").hide();
        $("#inputF").hide();
        $("#inputG").hide();
        $("#date").hide();
        $("#time").hide();
        
        
        
        
      function comentar(id,user, estable){
          $("#fcalificar").show();
          idFormulario = id;
          usuario = user;
          IDest = estable;
          document.getElementById("alerta").style.display = 'none';
        
      }
      
       function reservar(id){
          idFormulario = id;
            $("#inputC").show();
            $("#inputC2").show();
            $("#inputL").show();
            $("#inputF").show();
            $("#inputG").show();
            $("#date").show();
            $("#time").show();
            $("#enviarR").show();
              document.getElementById("alerta2").style.display = 'none';
             
      }
      
      function drop(id){
        document.getElementById("inputC").value = id;
         document.getElementById("inputC").style.display = 'none';
        if(id==1)
          document.getElementById("buton_hotel").innerHTML = "Sencilla";
        else if(id==2)
          document.getElementById("buton_hotel").innerHTML = "Doble";
        else if(id==3)
          document.getElementById("buton_hotel").innerHTML = "Triple";          
      }
    </script>
    <script type="text/javascript">
      function esferas(cantidad){
        document.getElementById("select").value =cantidad;
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
      }
      </script>
  </body>
</html>

