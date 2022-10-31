<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../css/editarclien.css">
	<title>Editar clientes</title>
</head>
<body>
<?php
	
	$busca=$_GET["id"];


try{
	$base_de_datos=new PDO("mysql:host=localhost;dbname=supertienda", "root", "");//pdo es la clase
	$base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//muestra el tipo de error
	$base_de_datos->exec("set character set utf8");
//echo "Conexión exitosa";
    $sql="SELECT  * from cliente  where doc_cliente=:id";//consulta con marcador, el marcador es :codigo

    $resultado=$base_de_datos->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
    $resultado->execute(array(":id"=>$busca));

	if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
		
		?>
	        <h4 align="center">ACTUALIZAR</h4>	
		<form action="update.php" method="GET">
        	<h5>Documento :</h5><br>
				<input type="text" class="usua" readonly name="id" value="<?php echo $registro['doc_cliente']?>">
        	<h5>Nombre:</h5><br>
				<input type="text" class="usua" name="nom" value="<?php echo $registro['nom_cliente']?>">
        	<h5>Apellido:</h5><br>
				<input type="text" class="usua" name="ap" value="<?php echo $registro['apel_cliente']?>"></td></h5></tr>
	        <h5>Documento:</h5><br>
				<input type="number" class="usua" name="tel"  value="<?php echo $registro['telefono']?>">
            <h5>Direccion:</h5><br>
				<input type="text" class="usua" name="dir"  value="<?php echo $registro['direccion']?>"><br>
            
			
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