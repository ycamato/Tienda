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
$nombre=$_GET["nom"];
$apellido=$_GET["ap"];
$telefono=$_GET["tel"];
$direccion=$_GET["dir"];
echo "Se va a eliminar el usuario " . $nombre,  " Si está seguro presione el Botón Eliminar, de lo contrario presione volver";
if(isset($_POST['elimina'])){
    $base_de_datos->query("DELETE FROM cliente WHERE doc_cliente='$id'");
//echo "Se borró el cliente con Cédula ", $id . "<br>";
    header("Location:clientes.php");
}
?>
<form method="post">
<td><input type="submit" name="elimina" id="elimina" value="Eliminar"></td>
<td><a href="clientes.php"><input type="button" name="volver" id="elimina" value="Volver"></a></td>
</form>
</body>
</html>