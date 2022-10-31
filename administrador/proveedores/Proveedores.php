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
			header("Location:proveedores.php");
		}else{
			$pagina=$_GET["pagina"];
		}
	}else{
		$pagina=1;//muestra página en la que estamos cuando se carga por primera vez
	}
	
	$empieza=($pagina-1)*$registros;//registro desde el cual va a empezar a mostrar
	$sql_total="SELECT * FROM provedor";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base_de_datos->prepare($sql_total);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base_de_datos->query("SELECT * from provedor LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);
	
	if(isset($_POST['inserta'])){
		$id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $telefono=$_POST['telefono'];
		$direccion=$_POST['direccion'];
		?>
		<input type="number" name="idd" value="<?php echo $id?>">
		<?php 
		$sql="INSERT INTO provedor (nit_proveedor,nom_proveedor,telefono,direccion) values ( :nit,:nomp,:tel,:dir)";
		$resultado=$base_de_datos->prepare($sql);//$base es el nombre de la conexión
		$resultado->execute(array( ":nit"=>$id,  ":nomp"=>$nombre , ":tel"=>$telefono ,":dir"=>$direccion));

		header("Location:Proveedores.php");
	}

	?>
	
<h3 align="center">PANEL DE PROVEEDORES</h3><br>
<form action=" " method="post" autocomplete="off">
		<table align="center" border="" bordercolor="orange">
			<tr>
				<th>Nit del proveedor</th>
				<th>Nombre del  proveedor</th>
                <th>Telefono</th>
				<th>Dirrecion</th>
				<th colspan="2">Acciones</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $materia) :?> 
			<tr>
				<td><?php echo $materia->nit_proveedor?></td>
				<td><?php echo $materia->nom_proveedor?></td>
                <td><?php echo $materia->telefono?></td>
				<td><?php echo $materia->direccion?></td>

				
					
			<td><a href="eliminar.php?nit=<?php echo $materia->nit_proveedor?>& nom=<?php echo $materia->nom_proveedor?>& tel=<?php echo $materia->telefono?> & dir=<?php echo $materia->direccion?>"><input type="button" name="elimina" id="elimina" value="Eliminar"></a></td>
			<td><a href="editar.php?nit=<?php echo $materia->nit_proveedor?>& nom=<?php echo $materia->nom_proveedor?>& tel=<?php echo $materia->telefono?> & dir=<?php echo $materia->direccion?>"><input type="button" name="edita" class="edita" value="Editar"></a></td></tr>
			

			
			<?php
			endforeach;
		
			?>
			
			<td><input type="number" name="id"></td>
			<td><input type="varchar" name="nombre"></td>
            <td><input type="number" name="telefono"></td>
			<td><input type="varchar" name="direccion"></td>
			

				<td colspan="5" align="center"><input  type="submit" class="inserta"  name="inserta" value="Insertar" >
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