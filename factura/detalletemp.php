<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/detalletemp.css">
	<link rel="icon" href="/img/principal-removebg-preview.png">
	<title>Detalle temporal</title>
</head>
<body> 

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" autocomplete="off">

	<?php
	require("../connection/connection.php");
	if(!isset($_GET["buscarm"]) and !isset($_GET['agr'])){
	$idcliente=	$_GET['ide'];
	$idc=		$_GET['ide'];
	$nombre=		$_GET['nomb'];
	$nom=			$_GET['nomb'];
	$apellido=		$_GET['ape'];
	$apel=			$_GET['ape'];
	$telefono=		$_GET['tele'];
	$direccion=		$_GET['dir'];
	$idu=			$_GET['iduser'];
	$id=			$_GET['iduser'];
	$auxiliar=		$_GET['nombaux'];
	$aux=		$_GET['nombaux'];
	}else{
	$idcliente=		$_GET['ide'];
	$idc=			$_GET['ide'];
	$nombre=		$_GET['nomb'];
	$nom=			$_GET['nomb'];
	$apellido=		$_GET['ape'];
	$apel=			$_GET['ape'];
	$telefono=		$_GET['tele'];
	$direccion=		$_GET['dir'];
	$idu=			$_GET['iduser'];
	$id=			$_GET['iduser'];
	$auxiliar=		$_GET['nombaux'];
	$aux=			$_GET['nombaux'];	
	}
	
	?>
	<div id="logotipo">
        <img src="../imag/logo1.png">
    </div>
	<table class="datos">
		<tr>
			<td>
				<h3>DATOS DEL CLIENTE</h3><br><br>
			</td>
		</tr>
		<tr>
			<td>Identificación:
				<input type="text" name="ide" class="iden" readonly value="<?php echo $idcliente?>">
			</td>
		</tr>
		<tr>
			<td>Nombre
				<input type="text" name="nomb" class="nom" readonly value="<?php echo $nombre?>">
			</td>
		</tr>
		<tr>
			<td>Apellido
				<input type="text" name="ape" class="ap" readonly value="<?php echo $apellido?>">
			</td>
		</tr>
		<tr>
			<td>Telefono:
				<input type="text" name="tele" class="tel" readonly value="<?php echo $telefono?>">
			</td>
		</tr>
		<tr>
			<td>Direccion:
				<input type="text" name="dir" class="dir" readonly value="<?php echo $direccion?>">
			</td>
		</tr>

		<input type="hidden" name="iduser" value="<?php echo $idu?>">

		<tr>
			<td>Vendedor
				<input type="text" name="nombaux" class="ven" value="<?php echo $auxiliar?>">
			</td>
			
		</tr>
	</table>
    <table class="entrada">
		<tr>
			<td>
				<h3>PRODUCTOS</h3><br>
			</td>
		</tr>
		<tr>
			<td>
				Código:
				<input class="cod" type="text" name="codi" >
				
				<input class="buscar" type="submit" name="buscarm" value="Buscar">

				<input type="hidden" name="codpro">
			</td>
		</tr>
	</table>
	<table class="cuenta">
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
						<input class="nombre" type="text"  name="nomb" value=" <?php echo $registro['nom_prod'];?>" disabled>
					</td>
					<td>
						<input class="precio" type="text" name="hora" value=" <?php echo $registro['precio'];?>" >
					</td>
					<td>
						<input class="cantidad" type="number" name="can" placeholder="Ingrese Cantidad">
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
    	
			$idu;
    	
    		$codigo=		$_GET['codm'];
    		$nombrem=		$_GET['nomb'];
			$prec=			$_GET['hora'];
			$cant=			$_GET['can']; //cambie aca//
			$valorT=$prec*$cant;

			$cost="SELECT * FROM producto WHERE cod_producto= :id";
        	$r=$base_de_datos->prepare($cost);
        	$r->execute(array(":id"=>$codigo));
        	$reg=$r->fetch(PDO::FETCH_ASSOC);

        	$exist = $reg['existencia'];

        if($exist<$cant){
            ?>
            	<script>alert('Esta cantidad <?php echo $cant ?> .No  es permitida, por favor asegurese de  que  este correcta.' )</script>;
            
        	<?php
        }else{
		
		
        	$sql="INSERT INTO temporal (cod_producto, cantidad, precio_comple,doc_user) values (:co,:ca, :pre, :usu)";
			$resultado=$base_de_datos->prepare($sql);//$base es el nombre de la conexión
			$resultado->execute(array(":co"=>$codigo, ":ca"=>$cant, ":pre"=>$valorT , ":usu"=>$idu));
		}
		
		}
			$registros=$base_de_datos->query("SELECT * from temporal")->fetchALL(PDO::FETCH_OBJ);
			?>
				<table class="facturacion">
				<th>Código</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Valor Total</th>
			
			
			<?php
			
				$contador=0;
				$total=0;
	        	foreach ($registros as $temporal) :
				
					if($idu == $temporal->doc_user and $temporal->precio_comple){	///$total =$total + $temporal->precio_comple * $temporal->cantidad;
				?> 

					
			
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
  
		}endforeach;
	
		?>
	
	
	</table><br>
	<table class="facturacion">
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
				<h5 class="mensaje"><?php echo"El número  de la factura es $contador ,para el cliente $nombre, expedida por :$auxiliar, si desea facturar de click en  facturar sino  en  Regresar."?><br>
				<a href="matricular.php?id=<?php echo $idcliente?> & nomb=<?php echo $nombre?>  & contador=<?php echo $contador?> & iduser=<?php echo $idu?> & nombaux=<?php echo $auxiliar?> & total=<?php echo $total?> & cantidad=<?php echo $cant?>"><input class="facturar" type="button" name="matricular" value="Facturar"></a>

				<a href="del1.php?id=<?php echo $id?> & nomb=<?php echo $aux?>"><input type="button" name="volver" class="volver" id="elimina" value="Volver"></a>
				</h5>
			</td>
			
		</tr>
	</table>
	
	
	
</form>
</body>
</html>