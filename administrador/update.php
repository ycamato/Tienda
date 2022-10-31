<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<?php
require("../connection/connection.php");

    $id=$_GET["id"];
    $nombre=$_GET["nom"];
    $tipo=$_GET["tipo"];
	$correo= $_GET["correo"];
	
    

try{
$sql="UPDATE usuario SET nom_user=:nomb,rol=:tip,correo=:co  WHERE doc_user=:id";
$resultado=$base_de_datos->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":id"=>$id,":nomb"=>$nombre, ":tip"=>$tipo ,":co"=>$correo ));//asigno las variables a los marcadores
header('Location:../scrud.php');

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