<?php
    include("../connection/connection.php");
    if ((isset($_GET['MM_insert']))&&($_GET['MM_insert']=='formulario'))
    {
        $cedula= $_GET['id'];
        $nombre= $_GET['nom'];
        $apellido= $_GET['apel'];
        $telefono=  $_GET['tel'];
        $direccion= $_GET['dir'];

        $sql="INSERT INTO cliente (doc_cliente, nom_cliente, apel_cliente,telefono,direccion) values (:dc, :n, :ap, :t,:d)";
	    $resultado=$base_de_datos->prepare($sql);
	    $resultado->execute(array(":dc"=>$cedula, ":n"=>$nombre, ":ap"=>$apellido, ":t"=>$telefono, ":d"=>$direccion));

        
    if($resultado){
        echo"<script>alert('Registro exitoso.')</script>";
        echo "<script >window.close();</script>";
    }
    }
      
      
    
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registroc.css">
    <title>Registrar cliente</title>
</head>
<body>
    <h1>REGISTROS  DE  CLIENTES</h1>
    <form action="" method="get" name="formulario">
        <br>
        Documento:<input type="number" class="doc" name="id"><br><br>
        Nombre del  cliente:<input type="varchar" class="nom" name="nom"><br><br>
        Apellido del cliente:<input type="varchar" class="apel" name="apel"><br><br>
        Telefono:<input type="number"class="tel" name="tel"><br><br>
        Direccion:<input type="varchar" class="dir" name="dir"><br><br>
        <input type="submit" name="registro" value="registrar">
        <input type="hidden" name="MM_insert" value="formulario">
        <input class="cerrar" type="button" name="cerrar" value="Cerrar" onmouseup="self.close() " >
        
    </form>
    
</body>
</html>