<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<?php
require("../../connection/connection.php");

    $nit=$_GET["nit"];
    $nombre=$_GET["nom"];
    $telefono=$_GET["tel"];
	$direccion= $_GET["dir"];
	
    

try{
$sql="UPDATE provedor SET nom_proveedor=:nom, telefono=:tel , direccion=:dir  WHERE nit_proveedor=:nit";
$resultado=$base_de_datos->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":nit"=>$nit, ":nom"=>$nombre, ":tel"=>$telefono, ":dir"=>$direccion ));//asigno las variables a los marcadores
header('Location:proveedores.php');

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