<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="">
	<title>Ver Factura</title>
</head>
<body>
<form method="get">
	<table>
		
		<tr>
			<td>
				<table class="tabla">
					<tr>
						<th colspan="3">
								
							<div id="logotipo">
								<img src="">
							</div>

							<div>
								<label>
									<h1>SUPERMERCADO LA QUINTA</h1>
									<h1>La tienda que conisgues todo</h1>
								</label>
							</div>
						</th>
					</tr>
					<?php
						require("../../connection/connection.php");
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
						
					<tr>
						<td colspan="2">
							<h2>Matricula N° 
								<?php echo $numatricula ?>
							</h2>
							<h2>Fecha: 
								<?php echo $date ?>
							</h2>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h3>DATOS DEL CLIENTE</h3>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h3>Identificación: 
								<?php echo $registro['doc_cliente']?>
							</h3>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h3>Nombre: 
								<?php echo $registro['nom_cliente']?>
							</h3>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h3>Apellido: 
								<?php echo $registro['apel_cliente']?>
							</h3>
						</td>
						<td colspan="2">
							<h3>Telefono: 
								<?php echo $registro['telefono']?>
							</h3>
						</td>
						<td colspan="2">
							<h3>Direccion: 
								<?php echo $registro['direccion']?>
							</h3>
						</td> 
					</tr>
					<?php 
						$sql="SELECT  * from usuario where doc_user=:ie";
						$resultadou=$base_de_datos->prepare($sql);
						$resultadou->execute(array(":ie"=>$idu));
						$registrou=$resultadou->fetch(PDO::FETCH_ASSOC);
						
						$auxiliar=$registrou['nom_user'];
					?>
					<tr>
						<td>
							<h3>Vendedor: 
								<?php echo $auxiliar ?>
							</h3>
						</td>
					</tr>
				</table>
				<table class="tabla1">
					<h1>DETALLES DE PRODUCTOS</h1>
					<tr>
						<th>Código</th>
						<th>Nombre Producto</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th>Total</th>
					</tr>
					<tr>
						<?php
							//consulta a la tabla detallefactura
							$registrosdet=$base_de_datos->query("SELECT * from detalles where id_factura=$numatricula ")->fetchALL(PDO::FETCH_OBJ);
							$cuenta=0;
							foreach ($registrosdet as $detalles) :?> 
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

						<td align="center">
							<?php echo $registrom['nom_prod'];?>
						</td>
						<td align="center">
							<?php echo $registrom['precio'];?>
						</td>
						<td align="center">
							<?php echo $detalles->cantidad;?>
						</td>
						<td align="center">
							<?php echo $detalles->precio_comple;?>
						</td>
						<?php
							$cuenta=$cuenta+1
						?>
					</tr>
							
						<?php
							endforeach;
						?>
					<tr>
						<td colspan="4">
							<div>Total Productos: 
								<?php echo " ", $cuenta;?>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div>Total a Pagar: 
								<?php echo " ", $total;?>
							</div>
						</td>
					</tr>
				</table>
				<table class="tabla2">
					<tr>
						<td>
							<input  type='button' onclick='window.print();' value='Imprimir'>
							
							<a href="index.php?iduser=<?php echo $auxiliar?> & nombaux=<?php echo $auxiliar?>">
								<input type="button" name="vuelve" value="Nueva Factura">
							</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>	
</form>
</body>
</html>