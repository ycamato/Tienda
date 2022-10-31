<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/factex.css">
	<title>Factura</title>
</head>

<body>
	<h1>hola</h1>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
<?php
	if(!isset($_GET["buscar"])){
 		$idu=$_GET['iduser'];
 		$auxiliar=$_GET['nombaux'];
	
 	}else{
 		$idu=$_GET['iduser'];
 		$auxiliar=$_GET['nombaux'];
}

include("../../connection/connection.php");

 ?>
	<div id="logotipo">
        <img src="../../imag/logo1.png">
    </div>
	    <h2 class="fecha">Usted  ingreso el
				<?php include ("../../fecha/fecha.php"); echo fechas();?>
        </h2>
			
		</tr>
	</table>

	<input type="hidden" name="iduser" value="<?php echo $idu?>">
	<input type="hidden" name="nombaux" value="<?php echo $auxiliar?>">
	
	
	<h3 class="fac">FACTURA</h3>
    <h2 class="usu">Usuario: 
		<?php echo $auxiliar?>
	</h2>
	<table class="separado">
		
		<tr>
			<td>
				<h3 class="dato">Datos del Cliente</h3>
			</td>
		</tr>
		<tr>
			<td>
				Identificación:
				<input class="id" type="text" name="ide" required><br>

				<input id="bus" type="submit" name="buscar" value="Buscar">
			</td>
		</tr>
	</table>	
<?php
require('../../connection/connection.php');
	if(isset($_GET["buscar"])){
		$busqueda=$_GET['ide'];
		$sql="SELECT  * from cliente  where doc_cliente=:id";
			$resultado=$base_de_datos->prepare($sql);
			$resultado->execute(array(":id"=>$busqueda));
		if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
	
			$idcliente=				$registro['doc_cliente'];
			$nombre=				$registro['nom_cliente'];
			$apellido=				$registro['apel_cliente'];
			$telefono=				$registro['telefono'];
			$direccion=				$registro['direccion'];
			$idu=					$_GET['iduser'];
   			$auxiliar=				$_GET['nombaux'];
		

	 ?>
	 </form>

	<form  action="detalletemp.php" method="get">
		<table class="dat">
			<tr>
				<td>Nombre:
					<input class="nom" type="text" name="nomb" readonly  value="<?php echo $nombre?>">
				</td>
			</tr>
			<tr>
				<td>Apellido:
					<input class="ap" type="text" name="ape" readonly value="<?php echo $apellido?>">
				</td>
			</tr>
			<tr>
				<td>Identificación:
					<input class="iden" type="text" name="ide" readonly value="<?php echo $idcliente?>">
				</td>
			</tr>
			<tr>
				<td>Telefono:
					<input class="tel" type="text" name="tele" readonly value="<?php echo $telefono?>">
				</td>
			</tr>
			<tr>
				<td>Direccion:
					<input class="dir" type="text" name="dir" readonly value="<?php echo $direccion?>">
				</td>
			</tr>
			<input type="hidden" name="iduser" value="<?php echo $idu?>">
			<tr>
				<td>Vendedor:
					<input class="ven" type="text" name="nombaux" readonly value="<?php echo $auxiliar?>">
				</td>
			</tr>
		</table>
   
	
	
     <?php

	}else{
		echo"<script>alert('Esto  documento no se encontro $busqueda.Por favor registrelo')</script>";
        echo'<script>window.location="registrarcliente.php"</script>';

	}
}

?>
 
	<br>
	<h3 class="agre">Agregar  Productos</h3>
	<table class="final">
		<tr>
			<td>
				<input class="cargar" type="submit" name="cargar" 
			</td>
			<td>
				<input class="cerrar" type="button" name="cerrar" value="Cerrar" onmouseup="self.close() " >
			</td>
		</tr>
	
	<?php
	

	?>

</table>	
</form>
</form>
</body>
</html>