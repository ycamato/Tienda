<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php
include("../../connection/connection.php");
$nombre=$_GET["nomb"];
$codigo=$_GET["codigo"];
$cantidad=$_GET["cantidad"];
$total=$_GET["total"];

echo "Se va a cancelar la factura de " . $nombre,  " Si está seguro presione el Botón aceptar, de lo contrario presione volver";
if(isset($_POST['aceptar'])){
    $base_de_datos->query("DELETE FROM temporal ");
//echo "Se borró el cliente con Cédula ", $id . "<br>";
    header("Location:index.php");
}
?>
<form method="post">
<td><input type="submit" name="aceptar" id="aceptar" value="aceptar"></td>
<td><a href="index.php"><input type="button" name="volver" id="volver" value="Volver"></a></td>
</form>
</body>
</html>