<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<?php
require("../../connection/connection.php");

    $id=$_GET["id"];
    $nit=$_GET["nit"];
    $nombre=$_GET["nombre"];
    $cant=$_GET["existencia"];
    $nuevo=$_GET["nuevo"];
	$precio= $_GET["precio"];
    $fecha= $_GET["fecha"];
	
    $ingreso=$cant + $nuevo;

try{
$sql="UPDATE producto SET nit_proveedor=:nit,nom_prod=:nom,existencia=:exis, precio=:pre, fecha=:f  WHERE cod_producto=:cod";
$resultado=$base_de_datos->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":cod"=>$id,":nit"=>$nit, ":nom"=>$nombre ,":exis"=>$ingreso ,":pre"=>$precio,":f"=>$fecha ));//asigno las variables a los marcadores
header('Location:productos.php');

$resultado->closeCursor();
}catch(Exception $e){
    //die("Error: ". $e->GetMessage());
    echo "F " . $id;
}finally{
    $base=null;//vaciar memoria
}


?>
</body>
</html>