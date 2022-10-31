<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/ver_matricula_ver.css">
    <title>I.E. LOS ALPES</title>
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
								<img src="../foto/logo.PNG">
							</div>

							<div>
								<label>
									<h1> INSTITUCION EDUCATIVA LOS ALPES</h1>
									<h1>Formando el futuro del mañana</h1>
								</label>
							</div>
						</th>
					</tr>
					<?php
                        $busca=$_GET["id"];
						require("../../connection/connection.php");
						//consulta los datos  de la última matricula generada
						$sql="SELECT  * from factura where n_factura=:n";
						$resultado=$base_de_datos->prepare($sql);
						$resultado->execute(array(":n"=>$busca));
						$registro=$resultado->fetch(PDO::FETCH_ASSOC);
						$idestudiante=		$registro['doc_cliente'];
						$date=			    $registro['fecha'];
						$idu=			    $registro['n_factura'];
						//consultar datos del estudiante que corresponde a la última matricula generada
						$sql="SELECT * from cliente where doc_cliente=:id";
						$resultado=$base_de_datos->prepare($sql);
						$resultado->execute(array(":id"=>$idestudiante));
						$registro=$resultado->fetch(PDO::FETCH_ASSOC);
					?>
						
					<tr>
						<td colspan="2">
							<h2>Matricula N° 
								<?php echo $busca?>
							</h2>
							<h2>Fecha 
								<?php echo $date?>
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
							<h3>Funcionario: 
								<?php echo $auxiliar ?>
							</h3>
						</td>
					</tr>
				</table>
				<table class="tabla1">
					<h1>DETALLE DE MATERIAS</h1>
					<tr>
						<th>Código</th>
						<th>Nombre</th>
						<th>Horas</th>
					</tr>
					<tr>
						<?php
							//consulta a la tabla detallefactura
							$registrosdet=$base_de_datos->query("SELECT * from detalles where n_matricula=$busca")->fetchALL(PDO::FETCH_OBJ);
							$cuenta=0;
							foreach ($registrosdet as $materia) :?> 
								<td>
									<?php echo $materia->n_materias?>
								</td>
								<?php
								$codigom=$materia->n_materias;
							
							
							
							//consulto el nombre de la materia en la tabla materia
							$sql="SELECT nombre, horas  from materias where n_materias=:co";
							$resultado=$base_de_datos->prepare($sql);
							$resultado->execute(array(":co"=>$codigom));
							$registrom=$resultado->fetch(PDO::FETCH_ASSOC);
						?>

						<td>
							<?php echo $registrom['nombre'];?>
						</td>
						<td>
							<?php echo $registrom['horas'];?>
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
							<div>Total materias: 
								<?php echo " ", $cuenta;?>
							</div>
						</td>
					</tr>
				</table>
				<table class="tabla2">
					<tr>
						<td>
							<input  type='button' onclick='window.print();' value='Imprimir'>
							
							<a href="index.php?iduser=<?php echo $auxiliar?> & nombaux=<?php echo $auxiliar?>">
								<input type="button" name="vuelve" value="Nueva Matricula">
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