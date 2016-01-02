<?php

        if(isset($_POST["prueba"])){
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
             $tipo=$_POST["tipo"];

            $result = mysqli_query($connection, "CALL select_tipo_est(\"$tipo\")") or die("Query fail: " . mysqli_error());

            while ($row = mysqli_fetch_array($result)){   
                echo $row[0]."_".$row[1]."_".$row[2]."_".$row[3]."|"; 
            }
             
        }
      if(isset($_POST["cat"])){
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $tipo=$_POST["tipo"];
            $Ntipo=$_POST["Ntipo"];
            $servicio=$_POST["servicio"];
            $Nservicio=$_POST["Nservicio"];
            $cat= $_POST["cat"];
            $Ncat= $_POST["Ncat"];
            $dimension=$_POST["dimension"];
            
            $result = mysqli_query($connection, "CALL busqueda_filtrada(0,\"$tipo\",\"$Ntipo\",\"$servicio\",
            \"$Nservicio\",\"$dimension\",\"$Ncat\",\"$cat\")")
            or die("Query fail: " . mysqli_error());

            while ($row = mysqli_fetch_array($result)){   
                echo $row[1]."_".$row[2]."_".$row[3]."_".$row[0]."|"; 
            }
             
        }
        
         if(isset($_POST["puntos"])){
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $comentario = $_POST["comentario"];
            $idES= $_POST["idES"];
            $puntos = $_POST["puntos"];
            $usuario = $_POST["usuario"];
            $IDest = $_POST["IDest"];
            $result = mysqli_query($connection, "CALL comentario_alta(\"$comentario\",$puntos,$idES)")
            or die("Query fail: " . mysqli_error());

           $connection2 = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
           $result2 = mysqli_query($connection2,"call ad_log('$usuario','Insertar Comentario','Calificacion por usuario cliente, $puntos esferas ".$row[4]."',now(),$IDest);");
                
             
        }
   
         
        if(isset($_POST["cliente"])){
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $cliente=$_POST["cliente"];
            $ncliente=$_POST["ncliente"];
            $estable=$_POST["estable"];
            $nestable=$_POST["nestable"];
            $filtro= $_POST["filtro"];
            
            if($filtro=="0"){
                echo "Usuario_Establecimiento_Direccion_Tipo|"; 
                }
                else{
                    echo "Establecimiento_Usuario_Telefono_Email|"; 
                }
            
            
            $result = mysqli_query($connection, "CALL reporte1_1(\"$filtro\",\"$cliente\",\"$estable\",
            \"$ncliente\",\"$nestable\",0)")
            or die("Query fail: " . mysqli_error());
            
            while ($row = mysqli_fetch_array($result)){   
                if($filtro=="0"){
                echo $row[0]."_".$row[1]."_".$row[2]."_".$row[3]."|"; 
                }
                else{
                    
                    echo $row[0]."_".$row[1]."_".$row[2]."_".$row[3]."|"; 
                }
                
            }
             
        }
     
  
  
         if(isset($_POST["filtrotop"])){
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $filtrotop=$_POST["filtrotop"];
            $filtroc=$_POST["filtroc"];
            $fs=$_POST["fs"];
            $fc=$_POST["fc"];
            $ft= $_POST["ft"];
            $tipo=$_POST["tipo"];
            $Ntipo=$_POST["Ntipo"];
            $servicio=$_POST["servicio"];
            $Nservicio=$_POST["Nservicio"];
            $cate= $_POST["cate"];
            $Ncat= $_POST["Ncat"];
            $dimension=$_POST["dimension"];
            echo "Link_";
            if($filtroc=="0"){
                echo "Establecimiento_Calificacion General"; 
                if($fs=="1") echo "_Servicio";
                if($ft=="1") echo "_Tipo";
                if($fc=="1") echo "_Dimension_Categoria";
                echo "|";
                }
                else{
                    echo "Establecimiento_Servicio_Calificacion"; 
                    if($ft=="1") echo "_Tipo";
                    if($fc=="1") echo "_Dimension_Categoria";
                    echo "|";
                }
            
            
            $result = mysqli_query($connection, "CALL reporte2(0,\"$servicio\",\"$Nservicio\",\"$cate\",
            \"$Ncat\",\"$tipo\",\"$Ntipo\",\"$filtrotop\",\"$filtroc\",\"$dimension\",
            \"$fs\",\"$ft\",\"$fc\")")
            or die("Query fail: " . mysqli_error());
            
            while ($row = mysqli_fetch_array($result)){   
                if($filtroc=="0"){
                echo $row[0]."_".$row[1]."_".$row[2]; 
                $pos = 2;
                if($fs=="1") {
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                }
                if($ft=="1") {
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                }
                if($fc=="1"){
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                }
                echo "|";
                }
                else{
                    echo $row[0]."_".$row[1]."_".$row[2]."_".$row[3];
                    $pos = 3;
                    if($ft=="1") {
                        $pos = $pos +1;
                        echo "_".$row[$pos];
                    }
                    if($fc=="1") {
                        $pos = $pos +1;
                        echo "_".$row[$pos];
                        $pos = $pos +1;
                        echo "_".$row[$pos];
                    }
                    
                    echo "|";
                }
                
            }
             
        }    

          
        if(isset($_POST["fcc"])){
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $fcc=$_POST["fcc"];
            $fd=$_POST["fd"];
            $fn= $_POST["fn"];
            $fe= $_POST["fe"];
            $fs=$_POST["fs"];
            $fc=$_POST["fc"];
            $ft= $_POST["ft"];
            $tipo=$_POST["tipo"];
            $Ntipo=$_POST["Ntipo"];
            $servicio=$_POST["servicio"];
            $Nservicio=$_POST["Nservicio"];
            $cate= $_POST["cate"];
            $Ncat= $_POST["Ncat"];
            $nombre=$_POST["nombre"];
            $Nnombre=$_POST["Nnombre"];
            $esfera=$_POST["esfera"];
            $Nesfera=$_POST["Nesfera"];
            $direccion= $_POST["direccion"];
            $Ndireccion= $_POST["Ndireccion"];
            $comentario= $_POST["comentario"];
            $Ncomentario= $_POST["Ncomentario"];
            $dimension=$_POST["dimension"];
            $cerca=$_POST["cerca"];
            
                echo "Link_";
                echo "Establecimiento"; 
                if($fs=="1") echo "_Servicio";
                if($ft=="1") echo "_Tipo";
                if($fc=="1") echo "_Dimension_Categoria";
                if($fd=="1") echo "_Direccion";
                if($fe=="1") echo "_Esferas";
                if($fcc=="1") echo "_Comentario";
                if($cerca=="1"|| $cerca=="2") echo "_Distancia en Km";
                
                echo "|";
                
            
            
            $result = mysqli_query($connection, "CALL reporte3(0,\"$servicio\",\"$Nservicio\",\"$tipo\",\"$Ntipo\",\"$cate\",
            \"$Ncat\",\"$dimension\",\"$nombre\" ,\"$Nnombre\",\"$direccion\",\"$Ndireccion\",\"$esfera\",\"$Nesfera\",\"$comentario\",
            \"$Ncomentario\",\"$fs\",\"$ft\",\"$fc\",\"$fe\",\"$fn\",\"$fd\",\"$fcc\",\"$cerca\")")
            or die("Query fail: " . mysqli_error());
            
            while ($row = mysqli_fetch_array($result)){   
                echo $row[0]."_".$row[1];
                $pos =1;
                if($fs=="1") {
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                }
                if($ft=="1") {
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                }
                if($fc=="1"){ 
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                }
                if($fd=="1"){
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                }
                if($fe=="1"){ 
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                }
                if($fcc=="1"){
                    $pos = $pos +1;
                    echo "_".$row[$pos];
                }
                if($cerca=="1"||$cerca=="2"){
                    $pos = $pos +1;
                    echo "_".round($row[$pos],2);
                }
                echo "|";
                
                
                
            }
             
        }   
        
        
            if(isset($_POST["accion"])){
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $accion=$_POST["accion"];
            $usuario=$_POST["usuario"];
            $estable=$_POST["estable"];
            $Naccion=$_POST["Naccion"];
            $Nusuario=$_POST["Nusuario"];
            $Nestable=$_POST["Nestable"];
            $Nfecha=$_POST["Nfecha"];
            $dias= $_POST["dias"];
            $meses= $_POST["meses"];
            $anios=$_POST["anios"];
            
            echo "Usuario_Accion_Descripcion_Fecha_Establecimiento Involucrado|";
            
            $result = mysqli_query($connection, "CALL reporte4(0,\"$usuario\",\"$Nusuario\",\"$estable\",
            \"$Nestable\",\"$accion\",\"$Naccion\",\"$Nfecha\",\"$dias\",\"$meses\",\"$anios\" )")
            or die("Query fail: " . mysqli_error());

            while ($row = mysqli_fetch_array($result)){   
                echo $row[0]."_".$row[1]."_".$row[2]."_".$row[3]."_".$row[4]."|"; 
            }
             
        }
        
        if(isset($_POST["oficial"])){
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "bases2", "3306");
            $oficial = $_POST["oficial"];
            $nooficial= $_POST["nooficial"];
            $Nnooficial = $_POST["Nnooficial"];
            $result = mysqli_query($connection, "CALL hacer_merge(\"$oficial\",\"$Nnooficial\",\"$nooficial\",0)")
            or die("Query fail: " . mysqli_error());
             
        }
    
?>