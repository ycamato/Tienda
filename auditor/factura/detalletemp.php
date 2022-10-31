<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/detalletemp.css">
	<link rel="icon" href="/img/principal-removebg-preview.png">
	<title>Detalle temporal</title>
</head>
<body> 

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" autocomplete="off">

	<?php
	require("../../connection/connection.php");
	if(!isset($_GET["buscarm"]) and !isset($_GET['agr'])){
	$idcliente=	$_GET['ide'];
	$nombre=		$_GET['nomb'];
	$apellido=		$_GET['ape'];
	$telefono=		$_GET['tele'];
	$direccion=		$_GET['dir'];
	$idu=			$_GET['iduser'];
	$auxiliar=		$_GET['nombaux'];
	}else{
	$idcliente=		$_GET['ide'];
	$nombre=			$_GET['nomb'];
	$apellido=			$_GET['ape'];
	$telefono=		$_GET['tele'];
	$direccion=		$_GET['dir'];
	$idu=				$_GET['id'];
	$auxiliar=			$_GET['nombre'];	
	}
	
	?>
	<div id="logotipo">
        <img src="../../imag/logo1.png">
    </div>
	<table class="tabla">
		<tr>
			<td>
				<h3>DATOS DEL CLIENTE</h3><br><br>
			</td>
		</tr>
		<tr>
			<td>Identificación:
				<input type="text" name="ide" readonly value="<?php echo $idcliente?>">
			</td>
		</tr>
		<tr>
			<td>Nombre
				<input type="text" name="nomb" readonly value="<?php echo $nombre?>">
			</td>
		</tr>
		<tr>
			<td>Apellido
				<input type="text" name="ape" readonly value="<?php echo $apellido?>">
			</td>
		</tr>
		<tr>
			<td>Telefono:
				<input type="text" name="tele" readonly value="<?php echo $telefono?>">
			</td>
		</tr>
		<tr>
			<td>Direccion:
				<input type="text" name="dir" readonly value="<?php echo $direccion?>">
			</td>
		</tr>

		<input type="hidden" name="id" value="<?php echo $idu?>">

		<tr>
			<td>Vendedor
				<input type="text" name="nombre"value="<?php echo $auxiliar?>">
			</td>
			
		</tr>
	</table>
    <table class="tabla1">
		<tr>
			<td>
				<h3>PRODUCTOS</h3><br>
			</td>
		</tr>
		<tr>
			<td>
				Código:
				<input id="dos" type="text" name="codi" >
				
				<input id="uno" type="submit" name="buscarm" value="Buscar">

				<input type="hidden" name="codpro">
			</td>
		</tr>
	</table>
	<table id="tabla">
		<?php
	        if(isset($_GET['buscarm'])){
					$busca=	$_GET['codi'];
					$sql="SELECT  * from producto  where cod_producto=:co";
        			$resultado=$base_de_datos->prepare($sql);
        			$resultado->execute(array(":co"=>$busca));
	   			if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
		?>
				<tr>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>

					<th colspan="2">Acción</th>
				</tr>
				<tr>
					<td>
						<input type="text"  name="nomb" value=" <?php echo $registro['nom_prod'];?>" disabled>
					</td>
					<td>
						<input type="text" name="hora" value=" <?php echo $registro['precio'];?>" >
					</td>
					<td>
						<input type="number" name="can" placeholder="Ingrese cantidad">
					</td>
					<td>
						<input class="agregar" type="submit" name="agr" value="Agregar">
					</td>
				</tr>
	</table>
		
				<input type="hidden" name="codm" value="<?php echo $registro['cod_producto'];?>">
		<?php
		}
    	}
    	if(isset($_GET['agr'])){
    	
    	
    		$codigo=		$_GET['codm'];
    		$nombrem=		$_GET['nomb'];
			$prec=			$_GET['hora'];
			$cant=			$_GET['can']; //cambie aca//
			$valorT=$prec*$cant;

			$skos="SELECT * FROM producto WHERE cod_producto =:co";
			$resultado1=$base_de_datos->prepare($skos);
			$registro1->execute(array(":co"=>$codigo));
			$p=$registro1->fetch(PDO::FETCH_ASSOC);

			$exist = $p['existencia'];

			if($exist<$cant){
				?>
				<div class="mensaje">
					<<h3>Esta Cantidad no fue aceptada </h3>
				</div>
			<?php
			}else{
		
			$sql="INSERT INTO temporal (cod_producto, cantidad, precio_comple) values (:co,:ca, :pre)";
			$resultado=$base_de_datos->prepare($sql);//$base es el nombre de la conexión
				$resultado->execute(array(":co"=>$codigo, ":ca"=>$cant, ":pre"=>$valorT));
			}
		
        	
		
		
		}
			$registros=$base_de_datos->query("SELECT * from temporal")->fetchALL(PDO::FETCH_OBJ);
			?>
				<table class="tabla2">
				<th>Código</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Valor Total</th>
			
			<?php
			
				$contador=0;
				$total=0;
	        	foreach ($registros as $temporal) :?> 
			
			
			<tr>
				<?php $cod_pro=$temporal->cod_producto;
					$sql="SELECT nom_prod, precio from producto WHERE cod_producto = :co";
					$resultado=$base_de_datos->prepare($sql);
	            	$resultado->execute(array(":co"=>$cod_pro));
	            	$registrocant=$resultado->fetch(PDO::FETCH_ASSOC);


					$detalle=$temporal->detalle;
					$sql="SELECT cod_producto, precio_comple, cantidad from temporal WHERE detalle = :de";
					$resultado=$base_de_datos->prepare($sql);
	            	$resultado->execute(array(":de"=>$detalle));
	            	$registro1=$resultado->fetch(PDO::FETCH_ASSOC);

					$total = $total + $registro1['precio_comple'];

	            ?>
			
				<td><?php echo $temporal->cod_producto?></td>

	            <td align="center"><?php echo $registrocant['nom_prod'];?></td>
				<td align="center"><?php echo $registrocant['precio'];?></td>
				<td align="center"><?php echo $registro1['cantidad'];?></td>
				<td align="center"><?php echo $registro1['precio_comple'];?></td>
	                               
				<?php $contador=$contador+1;?>
			</tr>
			<tr>


				
		<?php 
  
		endforeach;
	
		?>
	
	
	</table><br>
	<table class="tabla3">
		<tr>
			<th colspan="4">Total Productos a Facturar:</th>
			<td colspan="3">
			<?php echo $contador;?>
			</td>
		</tr>
		<tr>
			<th colspan="4">Total a Pagar de la Factura:</th>
			<td colspan="3">
			<?php echo $total;?>
			</td>
		</tr>
	
		<tr>
			<td> 
				<a href="matricular.php?id=<?php echo $idcliente?> & nomb=<?php echo $nombre?>  & contador=<?php echo $contador?> & iduser=<?php echo $idu?> & nombaux=<?php echo $auxiliar?> & total=<?php echo $total?> & codigo=<?php echo$codigo?> & cantidad=<?php echo $cant?>">
					<input id="uno" type="button" name="matricular" value="Facturar">
				</a>
			</td>
			<td> 
				<a href="cancelar.php?id=<?php echo $idcliente?> & nomb=<?php echo $nombre?>  & contador=<?php echo $contador?> & iduser=<?php echo $idu?> & nombaux=<?php echo $auxiliar?> & total=<?php echo $total?> & codigo=<?php echo$codigo?> & cantidad=<?php echo $cant?>">
					<input id="uno" type="button" name="cancelar" value="cancelar">
				</a>
			</td>
		</tr>
	</table>
	
	
	
</form>
</body>
</html>