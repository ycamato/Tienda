<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../css/editarclien.css">
	<title>Editar productos</title>
</head>
<body>
<?php
	
	$busca=$_GET["id"];


try{
	$base_de_datos=new PDO("mysql:host=localhost;dbname=supertienda", "root", "");//pdo es la clase
	$base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//muestra el tipo de error
	$base_de_datos->exec("set character set utf8");
//echo "Conexión exitosa";
    $sql="SELECT  * from producto  where cod_producto=:id";//consulta con marcador, el marcador es :codigo

    $resultado=$base_de_datos->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
    $resultado->execute(array(":id"=>$busca));

	if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
		
		?>
	        <h4 align="center">ACTUALIZAR</h4>	
		<form action="update.php" method="GET">
        	<h5>Codigo del producto:</h5><br>
				<input type="text" class="usua" readonly name="id" value="<?php echo $registro['cod_producto']?>">
        	<h5>Nit del proveedor:</h5><br>
				<input type="number" class="usua" name="nit" value="<?php echo $registro['nit_proveedor']?>">
        	<h5>Nombre del  producto:</h5><br>
				<input type="text" class="usua" name="nombre" value="<?php echo $registro['nom_prod']?>"></td></h5></tr>
	        <h5>Cantidad:</h5><br>
				<input type="number" class="usua" readonly name="existencia"  value="<?php echo $registro['existencia']?>">

			<h5>Ingrese Su  nueva  cantidad:</h5><br>
				<input type="number" class="usua"  name="nuevo"  value="">

            <h5>Precio:</h5><br>
				<input type="number" class="usua" name="precio"  value="<?php echo $registro['precio']?>">
            <h5>Fecha:</h5><br>
				<input type="date" class="usua" name="fecha"  value="<?php echo $registro['fecha']?>">
			
                <input type="submit" class="btn" name="edita" id="ingresa" value="Guardar">
	</form>

<?php
	}else{
		echo "No  se  encontro $busca";
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