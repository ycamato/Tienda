<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/ver_matriculas.css">
    <title>Visualizacion de la factura</title>
</head>


<body>
	<?php
	
	include("../connection/connection.php");

	
	//--------------paginación-------------
	$registros=4;//indica que se van a ver 3 registro por página
	if(isset($_GET["pagina"])){
		if($_GET["pagina"]==1){
			header("Location:./ver_matricula.php");
		}else{
			$pagina=$_GET["pagina"];
		}
	}else{
		$pagina=1;//muestra página en la que estamos cuando se carga por primera vez
	}
	
	$empieza=($pagina-1)*$registros;//registro desde el cual va a empezar a mostrar
	$sql="SELECT * FROM factura";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base_de_datos->prepare($sql);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base_de_datos->query("SELECT * from factura LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);

	?>

<h3>PANEL DE FACTURAS</h3>
<form action=" " method="post" autocomplete="off">
		<table id="principal">
			<tr>
				<th>N. Facturas</th>
				<th>Id cliente</th>
				<th>Codigo del producto</th>
                <th>Fecha</th>
				<th>Nombre  del cliente</th>
				<th>Apellido  del cliente</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Id vendedor</th>
				<th colspan="2">Acciones</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $usuario) :?> 
			<?php
				$ide=$usuario->doc_user;
				$sql="SELECT * FROM usuario WHERE doc_user=:d";
				$resultado=$base_de_datos->prepare($sql);
				$resultado->execute(array(":d"=>$ide));
				$registroe=$resultado->fetch(PDO::FETCH_ASSOC);
			
				$id=$usuario->n_factura;
				$sql="SELECT * FROM factura WHERE n_factura=:n";
				$resultado=$base_de_datos->prepare($sql);
				$resultado->execute(array(":n"=>$id));
				$registro1=$resultado->fetch(PDO::FETCH_ASSOC);
			?>
			<tr>
			    <td>
					<?php echo $registroe['n_matricula']?>
				</td>
				<td>
					<?php echo $registroe['doc_cliente']?>
				</td>
				<td>
					<?php echo $registroe['cod_producto']?>
				</td>
				<td>
					<?php include ("./fecha/fecha.php"); echo fechas()?>
				</td>
				<td>
					<?php echo $registroe['nom_cliente']?>
				</td>
				<td>
					<?php echo $registroe['apel_cliente']?>
				</td>
				<td>
					<?php echo $registroe['telefono']?>
				</td>
				<td>
					<?php echo $registroe['direccion']?>
				</td>
				<td>
					<?php echo $usuario->doc_user?>
				</td>
				<td>
					<?php echo $registroe['total']?>
				</td>

			<td>
				<a href="ver.php?id=<?php echo $usuario->n_matricula?> & nomb=<?php echo $usuario->id?>">
					<input type="button" name="edita" value="Ver">
				</a>
			</td></tr>			

			
			<?php
			endforeach;
		
			?>
			
			
			<table class="dos">
				<tr>
					<td>
						<input class="enviar" type="button" name="admin" value="Cerrar"onmouseup="window.close()">
					</td>
				</tr>
			</table>
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