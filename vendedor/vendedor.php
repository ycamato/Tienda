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
    <title>Vendedor</title>
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
            <li><a href="Facturas/factura.php" target=_blank>Facturar</a></li>
            <li class="barra">|</li>
            <button class="cerrar"><a href="../administrador/cerrar.php">Cerrar Sesión</a></button>
        </ul>
    
    </nav>
    <form  action="../factura/index.php">
    <a href="../factura/index.php?iduser=<?php echo $idu?> & nombaux=<?php echo $nombre?>" target="_blank">
		<input class="btn" type="button" name="fact" value="Factura"></a>
        <a href="../administrador/facturas/factura.php" target=_blank"><input class="btn" type="button" name="fact" value="Ver facturas"></a>
    
    </form>
    
</body>
</html>