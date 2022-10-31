<?php
    include("../../connection/connection.php");
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
    <title>Registrar cliente</title>
</head>
<body>
    <h1>REGISTRA A TU  CLIENTE</h1>
    <form action="" method="get" name="formulario">
        Documento:<input type="number"  name="id"><br>
        Nombre del  cliente:<input type="varchar" name="nom"><br>
        Apellido del cliente:<input type="varchar" name="apel"><br>
        Telefono:<input type="number" name="tel"><br>
        Direccion:<input type="varchar" name="dir"><br>
        <input type="submit" name="registro" value="registrar">
        <input type="hidden" name="MM_insert" value="formulario">
        <input class="cerrar" type="button" name="cerrar" value="Cerrar" onmouseup="self.close() " >
        
    </form>
    
</body>
</html>