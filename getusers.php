<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/login.css" rel="stylesheet">
</head>
<body>

<?php
$t = $_GET['t'];

switch($t){
    case "u":
        $q = intval($_GET['q']);
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_usuario_e('$q');";
$result = mysqli_query($con,$sql);
$establecimiento=0;

while($row = mysqli_fetch_array($result)) {
 echo "Nombre <input type=\"text\"  name=\"nombre\"class=\"form-control\" value=".$row['nombre']." required autofocus>";
 echo  "Password: <input type=\"password\" id=\"pass\" name=\"pass\" class=\"form-control\" value=".$row['password']." required>";
 echo   "Correo: <input type=\"email\" name=\"email\" class=\"form-control\" value=".$row['correo']." required>";
 echo   "Telefono <input type=\"number\"  name=\"tel\"class=\"form-control\" value=".$row['telefono']." required autofocus>";
 
 $rol=$row['rol'];
 
 echo "Rol <select class=\"form-control\" name=\"rol\">";
 if($rol=="normal")
   echo             "<option value=\"normal\" selected>Normal</option>";
  else
 echo             "<option value=\"normal\">Normal</option>";
 
 if($rol=="especial")
  echo             "<option value=\"especial\" selected>Especial</option>";
  else
  echo             "<option value=\"especial\">Especial</option>";
  
 if($rol=="administrador")
 echo             "<option value=\"administrador\" selected>Administrador</option>";
 else
 echo             "<option value=\"administrador\">Administrador</option>";
              
   echo         "</select>";
            
 if($row['id_establecimiento']!=NULL)
 $establecimiento=$row['id_establecimiento'];
}

$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql= "CALL select_establecimiento;";
$result = mysqli_query($con,$sql);
echo "Establecimiento";
             
 echo            "<select class=\"form-control\" name=\"estab\">";
echo  "<option value=\"0\">Ninguno</option>";
while($row = mysqli_fetch_array($result)) {
if($row[0]==$establecimiento)
echo "<option value=".$row[0]." selected>".$row[1]."</option>";
else
echo "<option value=".$row[0].">".$row[1]."</option>";
            }
mysqli_close($con);
break;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
case "e":
      $q = intval($_GET['q']);
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_establecimiento_por_id('$q');";
$result = mysqli_query($con,$sql);
$establecimiento=0;

while($row = mysqli_fetch_array($result)) {
$tipo=$row['tipo'];    
echo "Nombre <input type=\"text\"  name=\"nombre\"class=\"form-control\" value=\"".$row['nombre']."\" required autofocus>";
echo "Direccion <input type=\"text\" id=\"dir\" name=\"dir\" class=\"form-control\" value=\"".$row['direccion']."\" required>";
echo "Tipo <select class=\"form-control\" name=\"tipo\">";
//$tipo=$row['tipo'];
if($tipo=="Taller")
echo "<option value=\"Taller\" selected>Taller</option>";
else
echo "<option value=\"Taller\">Taller</option>";
if($tipo=="Restaurante")
echo "<option value=\"Restaurante\" selected>Restaurante</option>";
else
echo "<option value=\"Restaurante\">Restaurante</option>";
if($tipo=="Hotel")
echo "<option value=\"Hotel\" selected>Hotel</option>";
else
echo "<option value=\"Hotel\">Hotel</option>";
              
echo "</select>";
echo "Longitud: <input type=\"number\" step= \"0.0000001\" name=\"longitud\" class=\"form-control\" value=".$row['longitud']." required>";
echo "Latitud: <input type=\"number\"  step= \"0.0000001\" name=\"latitud\"class=\"form-control\" value=".$row['latitud']." required autofocus>";    


echo  "Oficial";
$off=$row['oficial'];            
echo "<select class=\"form-control\" name=\"off\">";
if($off==0)
echo "<option value=\"0\" selected>No</option>";
else
echo "<option value=\"0\">No</option>";
if($off==1)
echo "<option value=\"1\" selected>Si</option>";
else
echo "<option value=\"1\">Si</option>";
echo "</select></br>";
    
            }
mysqli_close($con);
    
    
    break;
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    case "d":
            $q = intval($_GET['q']);
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_dimension_por_id('$q');";
$result = mysqli_query($con,$sql);
$establecimiento=0;

while($row = mysqli_fetch_array($result)) {
$tipo=$row['tipo'];    
echo "Nombre <input type=\"text\"  name=\"nombre\"class=\"form-control\" value=".$row['nombre']." required autofocus>";
echo "Descripcion  <textarea name=\"desc\" id=\"desc\"  class=\"form-control\" cols=\"40\" rows=\"5\" value=".$row['descripcion']." >".$row['descripcion']."</textarea></br>";
            }
mysqli_close($con);
        
        break;
        
            case "c":
            $q = intval($_GET['q']);
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_categoria_por_id('$q');";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
$tipo=$row['tipo'];    
echo "Nombre <input type=\"text\"  name=\"nombre\"class=\"form-control\" value=\"".$row['nombre']."\" required autofocus>";
echo "Descripcion  <textarea name=\"desc\" id=\"desc\"  class=\"form-control\" cols=\"40\" rows=\"5\" value=".$row['descripcion']." >".$row['descripcion']."</textarea></br>";
            }
mysqli_close($con);
        
        break;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
case "s":
        $q = intval($_GET['q']);
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_servicio_por_id('$q');";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
$tipo=$row['tipo'];    
echo "Nombre <input type=\"text\"  name=\"nombre\"class=\"form-control\" value=\"".$row['nombre']."\" required autofocus>";
echo "Descripcion  <textarea name=\"desc\" id=\"desc\"  class=\"form-control\" cols=\"40\" rows=\"5\" value=".$row['descripcion']." >".$row['descripcion']."</textarea></br>";
            }
mysqli_close($con);
    
    break;
    
    
    case "ca":
         $q = intval($_GET['q']);
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_caracteristica_por_id('$q');";
$result = mysqli_query($con,$sql);
$servic = 0;
while($row = mysqli_fetch_array($result)) {
    
    
echo    "Nombre <input type=\"text\"  name=\"nombre\"class=\"form-control\" value=\"" .$row['nombre']."\" required autofocus>";
echo    "Valor  <textarea name=\"val\" id=\"val\"  class=\"form-control\" cols=\"40\" rows=\"5\" >".$row['valor']."</textarea></br>";
$servic = $row['id_servicio'];
}            
            

$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_servicio;";
$result = mysqli_query($con,$sql);          
            
echo             "Servicio";
echo   "<select class=\"form-control\" name=\"serv\">";
echo    " <option value=\"0\">Ninguno</option>";
while($row = mysqli_fetch_array($result)) {
if($servic==$row['id_servicio'])
echo "<option value=".$row[0]." selected>".$row[1]."</option>";
else
echo "<option value=".$row[0].">".$row[1]."</option>";

}    
echo             "</select></br>";             

        break;
        case "pre":
            $q = intval($_GET['q']);
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_prereserva_por_id($q);";
$result = mysqli_query($con,$sql);
$establecimiento=0;

while($row = mysqli_fetch_array($result)) {
    $fyh=$row['horayfecha'];
    $por=explode(" ",$fyh);
echo    "Fecha <input type=\"date\"  name=\"fech\"class=\"form-control\" value=".$por[0]." required autofocus>";
echo    "Hora <input type=\"time\"  name=\"hor\"class=\"form-control\" value=".$por[1]." required autofocus>";
echo    "Cantidad de personas <input type=\"number\"  name=\"cant\"class=\"form-control\" value=".$row['cantpersonas']." required autofocus>";
$establecimiento=$row['id_establecimiento_servicio'];
$u1=$row['id_usuario'];    
}

echo "Establecimiento-Servicio";
             
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$sql= "CALL select_es_nombre;";
$result = mysqli_query($con,$sql);

echo "<select class=\"form-control\" name=\"esc\">";
echo "<option value=\"0\">Ninguno</option>";

while($row = mysqli_fetch_array($result)) {
if($row[0]==$establecimiento)
echo "<option value=".$row[0]." selected>".$row[2].": ".$row[1]."</option>";
else
echo "<option value=".$row[0].">".$row[2].": ".$row[1]."</option>";
    
}
echo "        </select></br>"; 





 echo "Usuario";
             
echo    "<select class=\"form-control\" name=\"usua\">";
echo "<option value=\"0\">Ninguno</option>";
                
               $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");

            //verificar si existe usuario
            $result = mysqli_query($connection, 
                "CALL select_usuario") or die("Query fail: " . mysqli_error());
                
                 while ($row = mysqli_fetch_array($result)){ 
                     if($u1==$row[0])
                     echo "<option value=".$row[0]." selected>".$row[1]."</option>";
                     else
               echo "<option value=".$row[0].">".$row[1]."</option>";
            }
               
echo "</select></br>";
            


mysqli_close($con);
            break;
            case "com":
                
                            $q = intval($_GET['q']);
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_comentario_por_id($q);";
$result = mysqli_query($con,$sql);
$establecimiento=0;

while($row = mysqli_fetch_array($result)) {
echo    "Contenido <textarea name=\"con\" id=\"con\"  class=\"form-control\" cols=\"40\" rows=\"5\" >".$row['contenido']."</textarea></br>";
echo    "Calificacion <input type=\"number\"  name=\"cal\"class=\"form-control\" min=\"0\" max=\"7\" value=".$row['calificacion']." required autofocus>";
$establecimiento=$row['id_establecimiento_servicio'];
}

echo "Establecimiento-Servicio";
             
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$sql= "CALL select_es_nombre;";
$result = mysqli_query($con,$sql);

echo "<select class=\"form-control\" name=\"esc\">";
echo "<option value=\"0\">Ninguno</option>";

while($row = mysqli_fetch_array($result)) {
if($row[0]==$establecimiento)
echo "<option value=".$row[0]." selected>".$row[2].": ".$row[1]."</option>";
else
echo "<option value=".$row[0].">".$row[2].": ".$row[1]."</option>";
    
}
echo "        </select></br>"; 

mysqli_close($con);

                
                break;
                case "ed":
         $q = intval($_GET['q']); //dimension
         $r = $_GET['r']; //establecimiento
         
         
         
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_ed_por_id($r,$q);";

$result = mysqli_query($con,$sql);
$c = 0;
while($row = mysqli_fetch_array($result)) {
    $c = $row['id_categoria'];
}     

$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_categoria;";
$result = mysqli_query($con,$sql);

echo "Categoria";
echo "<select class=\"form-control\" id=\"usr2\" name=\"usr2\">";
echo "<option value=\"0\">Selecciona una opcion</option>";
while($row = mysqli_fetch_array($result)) {
    if($row[0]==$c)
    echo "<option value=".$row[0]." selected>".$row[1]."</option>";
    else
    echo "<option value=".$row[0].">".$row[1]."</option>";
}

echo "  </select></br>"; 
          
                   
                    break;
                    
                    case "es":
                        
                        $q = intval($_GET['q']);
$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_es_por_id($q);";
$result = mysqli_query($con,$sql);
$servic = 0;
while($row = mysqli_fetch_array($result)) {
$estab = $row['id_establecimiento'];
$servic = $row['id_servicio'];
}            
            

$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_establecimiento;";
$result = mysqli_query($con,$sql);          
            
echo             "Establecimiento";
echo   "<select class=\"form-control\" name=\"estab\">";
echo    " <option value=\"0\">Ninguno</option>";
while($row = mysqli_fetch_array($result)) {
if($estab==$row['id_establecimiento'])
echo "<option value=".$row[0]." selected>".$row[1]."</option>";
else
echo "<option value=".$row[0].">".$row[1]."</option>";

}    
echo             "</select></br>";             


$con = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//mysqli_select_db($con,"ajax_demo");
$sql= "CALL select_servicio;";
$result = mysqli_query($con,$sql);          
            
echo             "Servicio";
echo   "<select class=\"form-control\" name=\"serv\">";
echo    " <option value=\"0\">Ninguno</option>";
while($row = mysqli_fetch_array($result)) {
if($servic==$row['id_servicio'])
echo "<option value=".$row[0]." selected>".$row[1]."</option>";
else
echo "<option value=".$row[0].">".$row[1]."</option>";

}    
echo             "</select></br>";             

                        
                        break;
default:
    echo "hola mundo";
    break;
}

?>

</body>
</html>