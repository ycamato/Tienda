<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/verfactura.css">
	<title>Ver Factura</title>
</head>
<body>
<form method="get">
		
							<div class="logo">
								<img src="../imag/logo.png">
							</div>

									<h1 class="titulo">SUPERTIENDA  XZY</h1></br>
									<h3 class="publicidad">Ofrecemos  nuestros mejores servicios  de atencion  y productos</h3><br>

					
					<?php
						require("../connection/connection.php");
						//consuta el último número de matricula generado
						$sql = "SELECT MAX(id_factura) as last_id FROM factura";
						$resultado=$base_de_datos->prepare($sql);
						$resultado->execute(array());
						$registro=$resultado->fetch(PDO::FETCH_ASSOC);
						$numatricula=$registro['last_id'];
						//consulta los datos  de la última matricula generada
						$sql="SELECT  * from factura where id_factura=:nm";
						$resultado=$base_de_datos->prepare($sql);
						$resultado->execute(array(":nm"=>$numatricula));
						$registro=$resultado->fetch(PDO::FETCH_ASSOC);
						
						$date=				$registro['fecha'];
						$idcliente=		$registro['doc_cliente'];
						$idu=				$registro['doc_user'];
						$total=				$registro['valor_total'];
					
						//consultar datos del estudiante que corresponde a la última matricula generada
						$sql="SELECT * from cliente where doc_cliente=:id";
						$resultado=$base_de_datos->prepare($sql);
						$resultado->execute(array(":id"=>$idcliente));
						$registro=$resultado->fetch(PDO::FETCH_ASSOC);
// cambie				
				
					
					?>
				<table  class="factura">
						<tr>
							<h2><td>Matricula N°</td> 
								<td><?php echo $numatricula ?></td>
							</h2>

						</tr>
					
							<h2><td>Fecha: </td>
								<td><?php echo $date ?></td>
							</h2>
						
						
							<tr><td>DATOS DEL CLIENTE<td></tr></h2>
						
					
						<tr>
							<h3><td>Identificación:</td> 
								<td><?php echo $registro['doc_cliente']?></td>
							</h3>
						</tr>
					
						<tr>
							<h3><td>Nombre:</td> 
								<td><?php echo $registro['nom_cliente']?></td>
							</h3>
						</tr>
						<tr>
							<h3><td>Apellido: </td>
								<td><?php echo $registro['apel_cliente']?></td>
							</h3>
						</tr>
					
						<tr>	
							<h3><td>Telefono:</td> 
								<td><?php echo $registro['telefono']?></td>
							</h3>
						</tr>
						<tr>
							<h3><td>Direccion:</td> 
								<td><?php echo $registro['direccion']?></td>
							</h3>
						</tr>
						
						
				
					<?php 
						$sql="SELECT  * from usuario where doc_user=:ie";
						$resultadou=$base_de_datos->prepare($sql);
						$resultadou->execute(array(":ie"=>$idu));
						$registrou=$resultadou->fetch(PDO::FETCH_ASSOC);
						
						$auxiliar=$registrou['nom_user'];
					?>
					
					<tr>	
							<h3><td>Vendedor: </td>
								<td><?php echo $auxiliar ?></td>
							</h3>
					</tr>
				</table>
				<br>	
				<table class="informacion">
					<h1 class="detalles">DETALLES DE PRODUCTOS</h1><br>
					<tr class="datos">
						<td>Código</td>
						<td>Nombre Producto</td>
						<td>Precio</td>
						<td>Cantidad</td>
						<td>Total</td>
					</tr>
					<tr>
						<?php
							//consulta a la tabla detallefactura
							$registrosdet=$base_de_datos->query("SELECT * from detalles where id_factura=$numatricula ")->fetchALL(PDO::FETCH_OBJ);
							$cuenta=0;
							foreach ($registrosdet as $detalles) :
							
							?> 
								<td>
									<?php echo $detalles->cod_producto?>
								</td>
								<?php
								$codi=$detalles->cod_producto;
							
							
							
							//consulto el nombre de la materia en la tabla materia
							$sql="SELECT nom_prod, precio from producto where cod_producto=:co";
							$resultado=$base_de_datos->prepare($sql);
							$resultado->execute(array(":co"=>$codi));
							$registrom=$resultado->fetch(PDO::FETCH_ASSOC);

						
						?>

						<td>
							<?php echo $registrom['nom_prod'];?>
						</td>
						<td >
							<?php echo $registrom['precio'];?>
						</td>
						<td>
							<?php echo $detalles->cantidad;?>
						</td>
						<td>
							<?php echo $detalles->precio_comple;?>
						</td>
						<?php
							$cuenta=$cuenta+1
						?>
					
							
						<?php
							endforeach;
						?>
					

				</table>
							<div class="total">
								<h3>Total Productos: 
									<?php echo " ", $cuenta;?>
								</h3>
								<h3>Total a Pagar: 
									<?php echo " ", $total;?><br>
								</h3>
								<br>
							</div>
							<a href="fact/verfact.php?num=<?php echo $numatricula ?>&id=<?php echo $auxiliar?> & nombaux=<?php echo $auxiliar ?>"><input class="imprimir"  type="button" name="edita" value="Ver Factura"></a></td>

							<a href="index.php?iduser=<?php echo $auxiliar?> & nombaux=<?php echo $auxiliar?>">
								<input  type="button" class="nueva" name="vuelve" value="Nueva Factura">
					
		
</form>
</body>
</html>