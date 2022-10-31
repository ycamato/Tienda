<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/productos.css">
    <title>BODEGUERO</title>
</head>


<body>
	<?php
	
	include("../../connection/connection.php");

	
	//--------------paginación-------------
	$registros=3;//indica que se van a ver 3 registro por página
	if(isset($_GET["pagina"])){
		if($_GET["pagina"]==1){
			header("Location:productos.php");
		}else{
			$pagina=$_GET["pagina"];
		}
	}else{
		$pagina=1;//muestra página en la que estamos cuando se carga por primera vez
	}
	
	$empieza=($pagina-1)*$registros;//registro desde el cual va a empezar a mostrar
	$sql_total="SELECT * FROM producto ";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base_de_datos->prepare($sql_total);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base_de_datos->query("SELECT * FROM producto LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);
	
	if(isset($_POST['Inserta'])){

		$idu=               $_POST['id'];
		$nombre=            $_POST['nom'];
        $existencia=          $_POST['cant'];
        $precio=           	$_POST['precio'];    
		$fecha=             $_POST['fecha'];
		$proveedor=         $_POST['nit'];
		

		?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql="INSERT INTO producto ( cod_producto,nom_prod,precio,existencia,fecha,nit_proveedor) values (:cod,:nom,:pre,:exis, :f,:nit)";
		$resultado=$base_de_datos->prepare($sql);//$base es el nombre de la conexión
		$resultado->execute(array(":cod"=>$idu,":nit"=>$proveedor,":nom"=>$nombre,":exis"=>$existencia,":pre"=>$precio,":f"=>$fecha));

		header("Location:productos.php");
	}

	?>
	
<h3>PANEL DE PRODUCTOS</h3>
<form action=" " method="post" autocomplete="off">
		<table id="principal">
			<tr>

				<th>codigo  del  producto</th>
				<th>Nombre del producto</th>
                <th>Existencia</th>
				<th>Precio</th>
				<th>Fecha</th>
                <th>nit del  producto</th>
				
				<th colspan="2">Acciones</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $usuario) :?>
			<?php
				$idp=$usuario->nit_proveedor;
				$sql="SELECT * FROM provedor WHERE nit_proveedor=:id";
				$resultado=$base_de_datos->prepare($sql);
				$resultado->execute(array(":id"=>$idp));
				$registro1=$resultado->fetch(PDO::FETCH_ASSOC);
			?> 
			<tr>
				<td><?php echo $usuario->cod_producto?></td>
				<td><?php echo $usuario->nom_prod?></td>
                <td><?php echo $usuario->existencia?></td>
                <td><?php echo $usuario->precio?></td>
				<td><?php echo $usuario->fecha?></td>
				<td><?php echo $registro1['nom_proveedor']?></td>
	
				<td>
					<a href="eliminar.php?id=<?php echo $usuario->cod_producto?> & nomb=<?php echo $usuario->nom_prod?> & can=<?php echo $usuario->existencia?> & pre=<?php echo $usuario->precio?> & fech=<?php echo $usuario->fecha?>">
						<img src="../../imag/borrar.png" alt="modificar">
					</a>
				</td>
				<td>
					<a href="editar.php?id=<?php echo $usuario->cod_producto?> & nomb=<?php echo $usuario->nom_prod?> & can=<?php echo $usuario->existencia?> & pre=<?php echo $usuario->precio?> & fech=<?php echo $usuario->fecha?>">
						<img src="../../imag/lapiz.png" alt="modificar">
					
					</a>
				</td>
			</tr>			

			
			<?php
			endforeach;
		
			?>

			<td><input type="number" name="id"  /></td>
			<td><input type="text" name="nom" /></td>
			<td><input type="number" name="cant"  /></td>
			<td><input type="number" name="precio"  /></td>
			<td><input type="date"  name="fecha"></td>
			<td><select name="nit">
			<?php
			$sql= "SELECT * FROM provedor where nit_proveedor>=1"; 
			$resultado=$base_de_datos->prepare($sql);
			$resultado->execute(array());
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
			?>
			?>
				<option value="<?php echo $registro['nit_proveedor'];?>"><?php echo $registro['nom_proveedor']?></option>
				<?php
				}
			 

				?>
				</select> </td>

				<td colspan="5" align="center">
					<input  class="inserta" type="submit" name="Inserta"  value="Insertar" >
					<a href="../Administrador/index.php">
						<input type="image" src="../../imag/cerrar.png" onmouseup="window.close()">
					</a>
				</td>
			</tr>
		
			
	</tr>
				
				
	
		</table>
</form>

<table class="uno">
	<tr>	
<?php
for($i=1; $i<=$totalpagina; $i++){
	?>
	 <td><?php echo "<a href='?pagina=" . $i . "'>" . $i . "  </a>  ";?></td>
		
<?php
	
$base_de_datos=null;//vaciar los datos de conexión 
}
?>

</tr>
</table>
</body>
</html>