<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php
include("../../connection/connection.php");

$id=$_GET["id"];
$nombre=$_GET["nomb"];
$cantidad=$_GET["can"];
$precio=$_GET["pre"];
$fecha=$_GET["fech"];
echo "Se va a eliminar el usuario " . $nombre,  " Si está seguro presione el Botón Eliminar, de lo contrario presione volver";
if(isset($_POST['elimina'])){
    $base_de_datos->query("DELETE FROM producto WHERE cod_producto='$id'");
//echo "Se borró el cliente con Cédula ", $id . "<br>";
    header("Location:productos.php");
}
?>
<form method="post">
<td><input type="submit" name="elimina" id="elimina" value="Eliminar"></td>
<td><a href="productos.php"><input type="button" name="volver" id="elimina" value="Volver"></a></td>
</form>
</body>
</html>