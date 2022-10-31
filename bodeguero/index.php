<?php
	session_start();
	$_SESSION["iduser"] = 		$registro['doc_user'];
	$_SESSION["usuario"] =   	$nombre;
	$valida=                	$registro['rol'];
	$idu=                    	$registro['doc_user'];
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/vendedor.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>BODEGUERO</title>
</head>
<body>
    <style>
        body{
        
            background-color: #ff920a;
            padding: 15px;
        }
    </style>
    <header class="head">
        <div class="logo">
            <img src="../imag/logo.png">
        </div>
    <nav id="menu">
        <ul>
            <li><a href="../bodeguero/productos/productos.php" target=_blank>Productos</a></li>
            <li class="barra">|</li>
            <button class="cerrar"><a href="../administrador/cerrar.php">Cerrar Sesión</a></button>
        </ul>
    
    </nav>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicaciones -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" <li data-target="#myCarousel" data-slide-to- "0"class="active"></li>
                        Bienvenido></li>
                        <li data-target="#myCarousel" data-slide-to- "2"></li>
                    </ol>
                    <!-- Envolver las imágenes -->
                    <div class="carousel-inner">
                            <div class="item active">
                                <img src="../imag/bienvenida.jpg" alt="Bienvenida" style="width:100%; height:340px;">
                            </div>
                            <div class="item">
                                <img src="../imag/bog.jpg" alt="entrada" style="width:100%; height:340px;"> 
                            </div>
                            <div class="item">
                                <img src="../imag/frutas.jpg" alt="frutas" style="width:100%; height:340px;">
                            </div>
                        </div>
                        <!-- Controles de izquierdayderecha -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
    
</body>
</html>