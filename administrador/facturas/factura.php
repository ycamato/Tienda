<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../css/proveedores.css">
	<title></title>
</head>
<body>
	<?php
	
	include("../../connection/connection.php");

	
	//--------------paginación-------------
	$registros=3;//indica que se van a ver 3 registro por página
	if(isset($_GET["pagina"])){
		if($_GET["pagina"]==1){
			header("Location:factura.php");
		}else{
			$pagina=$_GET["pagina"];
		}
	}else{
		$pagina=1;//muestra página en la que estamos cuando se carga por primera vez
	}
	
	$empieza=($pagina-1)*$registros;//registro desde el cual va a empezar a mostrar
	$sql_total="SELECT * FROM factura";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base_de_datos->prepare($sql_total);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base_de_datos->query("SELECT * from factura,estados WHERE factura.id_est= estados.id_est  LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);
	

	?>
	
<h3 align="center">PANEL DE  FACTURAS</h3><br>
<form action=" " method="post" autocomplete="off">
		<table align="center" border="" bordercolor="orange">
			<tr>
				<th>Id factura</th>
				<th>Fecha</th>
                <th>Id. cliente</th>
				<th>Id. vendedor</th>
				<th>Estado</th>
				<th>Valor total</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $materia) :?> 
			<tr>
				<td><?php echo $materia->id_factura?></td>
				<td><?php echo $materia->fecha?></td>
                <td><?php echo $materia->doc_cliente?></td>
				<td><?php echo $materia->doc_user?></td>
				<td><?php echo $materia->nombre?></td>
                <td><?php echo $materia->valor_total?></td>
                <td><a href="verfact.php?id=<?php echo $materia->id_factura?> & fech=<?php echo $materia->fecha?> & doc=<?php echo $materia->doc_cliente?> "><input type="button" name="ver" value="ver"></a>
			

			
			<?php
			endforeach;
		
			?>
				<td colspan="5" align="center">
				<a href="../../administrador/index.php"><input type="button" class="cerrar" name="admin" value="Cerrar"onmouseup="window.close()"></a></td>
			</tr>
		
			
	</tr>
				
				
	
		</table>
</form>

<table class="contador" border="0" >
	<tr>	
<?php
for($i=1; $i<=$totalpagina; $i++){
	?>
	 <td><?php echo " <a href='?pagina=" . $i . "'>" . $i . "  </a>  ";?></td>
		
<?php
	
$base_de_datos=null;//vaciar los datos de conexión 
}
?>

</tr>
</table>
</body>
</html>