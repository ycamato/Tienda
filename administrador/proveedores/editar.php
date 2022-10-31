<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../css/editarprov.css">
	<title>Editar proveedores</title>
</head>
<body>
<?php
	
	$busca=$_GET["nit"];


try{
	$base_de_datos=new PDO("mysql:host=localhost;dbname=supertienda", "root", "");//pdo es la clase
	$base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//muestra el tipo de error
	$base_de_datos->exec("set character set utf8");
//echo "Conexión exitosa";
    $sql="SELECT  * from provedor  where nit_proveedor=:id";//consulta con marcador, el marcador es :codigo

    $resultado=$base_de_datos->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
    $resultado->execute(array(":id"=>$busca));

	if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
		
		?>
	        <h4 align="center">ACTUALIZAR</h4>	
		<form action="update.php" method="GET">
        	<h5>Nit del  provedor:</h5><br>
				<input type="text" class="usua" readonly name="nit" value="<?php echo $registro['nit_proveedor']?>">
        	<h5>Nombre del  provedor:</h5><br>
				<input type="text" class="usua" name="nom" value="<?php echo $registro['nom_proveedor']?>">
        	<h5>Telefono:</h5><br>
				<input type="text" class="usua" name="tel" value="<?php echo $registro['telefono']?>"></td></h5></tr>
	        <h5>Dirección:</h5><br>
				<input type="text" class="usua" name="dir"  value="<?php echo $registro['direccion']?>"><br><br>
			
                <input type="submit" class="btn" name="edita" id="ingresa" value="Guardar">
	</form>

<?php
	}else{
		echo "No existe cliente con cédula $busca";
	}

$resultado->closeCursor();

}catch(Exception $e){
	die("Error: ". $e->GetMessage());

}finally{
	$base=null;//vaciar memoria
}


?>

</form>
</body>
</html>