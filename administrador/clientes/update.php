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
    $nombre=$_GET["nom"];
    $apellido=$_GET["ap"];
    $telefono=$_GET["tel"];
	$direccion= $_GET["dir"];

	
    

try{
$sql="UPDATE cliente SET nom_cliente=:nom,apel_cliente=:ap,telefono=:tel, direccion=:dir  WHERE doc_cliente=:doc";
$resultado=$base_de_datos->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":doc"=>$id,":nom"=>$nombre, ":ap"=>$apellido ,":tel"=>$telefono ,":dir"=>$direccion));//asigno las variables a los marcadores
header('Location:clientes.php');

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