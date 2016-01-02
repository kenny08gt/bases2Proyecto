<?php
// Start the session
session_start();

if(isset($_POST["accion"])){
    $accion=$_POST["accion"];
    if($accion==="Login"){
        echo '<script>window.location="/login.php";</script>';
    }elseif($accion==="Registro"){
        echo '<script>window.location="/registro.php";</script>';
    }
    elseif($accion==="Principal"){
        echo '<script>window.location="/principal.php";</script>';
    }
}

?>
<!DOCTYPE html>
<html>
    <title>Inicio</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/dark.min.css" rel="stylesheet">
    <!--<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
    <style>
      .carousel-inner > .item > img,
      .carousel-inner > .item > a > img {
          width: 50%;
          margin: auto;
      }
    </style>
    <body>
        <div class="container theme-showcase" role="main">
            <div class="jumbotron">
                <h1>Inicio</h1>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Bienvenido</h3>
                </div>
                <div class="panel-body">
                    <p>Bienvenido a la pagina principal de outguat</p>
                    <p>Debes <a href="/login.php">iniciar sesion</a> o crear una <a href="/registro.php">nueva cuenta</a> para aprovechar al maximo nuestra aplicacion</p>                    
                </div>
            </div>            

            <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Como inicio?</h3>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <input type="submit" value="Login" name="accion"/>
                        <input type="submit" value="Registro" name="accion"/>
                         <input type="submit" value="Principal" name="accion"/>
                    </form>                  
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Visita Guatemala!</h3>
                </div>
                <div class="panel-body">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                      </ol>
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                          <img src="/rsc/img1.jpg" alt="pana">
                          <div class="carousel-caption">
                            <h3>Panajachel</h3>
                            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                          </div>
                        </div>
                    
                        <div class="item">
                          <img src="/rsc/img2.jpg" alt="Chania">
                          <div class="carousel-caption">
                            <h3>Semuc Champey</h3>
                            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                          </div>
                        </div>
                        
                        <div class="item active">
                          <img src="/rsc/img3.jpg" alt="semuc">
                          <div class="carousel-caption">
                            <h3>Volcanes de Guatemala</h3>
                            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                          </div>
                        </div>                
        
                        <div class="item active">
                          <img src="/rsc/img4.jpg" alt="semuc">
                          <div class="carousel-caption">
                            <h3>Volcanes</h3>
                            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                          </div>
                        </div>                
                      </div>
                    
                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  
                </div>
            </div>          
        </div>
    </body>
</html>