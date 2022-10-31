<?php


    
    session_start();
    $_SESSION["usuario"]=$nombre;
    $valida=$registro['rol'];
    $id=$registro['doc_user'];
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title class="titulo" >ADMINISTRADOR</title>
</head>
  <h4></h4>
<body>
    <style>
        body{
        
            background-color: #ff920a;
            padding: 15px;
        }
    </style>
    <header class="head">
        <div class="logo">
            <img src="../imag/Supertienda.png">
           
        </div>

        <nav id="menu">
            <ul>
                <li><a href="../scrud.php"  target=_blank>Usuarios</a></li>
                <li class="barra">|</li>
                <li><a href="../administrador/proveedores/proveedores.php" target=_blank>Proveedores</a></li>
                <li class="barra">|</li>
                <li><a href="../administrador/productos/productos.php" target=_blank>Productos</a></li>
                <li class="barra">|</li>
                <li><a href="../administrador/clientes/clientes.php" target=_blank>listas de clientes</a></li>
                <li class="barra">|</li>
                <li><a href="../administrador/facturas/factura.php" target=_blank">listas de facturas</a></li>
                <li class="barra">|</li>
                <button class="cerrar"><a href="../administrador/cerrar.php">Cerrar Sesión</a></button>
            </ul>
        </nav>

    </header>
        <form  class="form" method="post" action="">
                <?php 
                include("connection/connection.php");
                ?>

        </form>
            <h4>Bienvenido <?php echo $nombre;?> </h4>
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
                                <img src="../imag/productos.jpg" alt="Supertienda" style="width:100%; height:340px;">
                            </div>
                            <div class="item">
                                <img src="../imag/super.jpg" alt="Supertienda" style="width:100%; height:340px;"> 
                            </div>
                            <div class="item">
                                <img src="../imag/mercado.jpg" alt="Supertienda" style="width:100%; height:340px;">
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