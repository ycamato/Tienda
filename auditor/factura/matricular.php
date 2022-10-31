<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/matricular.css">
	<title>Factura de la Tienda </title>
</head>
<body>


<?php 
	
	include("../../connection/connection.php");
	
	$cantidad=$_GET['cantidad'];
	$codigopr=$_GET['codigo'];
   	$idcliente=$_GET['id'];
	$nombre=$_GET['nomb'];
	$contador=$_GET['contador'];
	$idu=$_REQUEST['iduser'];
	$auxiliar=$_GET['nombaux'];	
	$total=$_GET['total'];
    
    if(isset($_POST['si'])){
	$sql="INSERT INTO factura (doc_cliente, doc_user, valor_total) values (:dc, :ds, :tot)";
	$resultado=$base_de_datos->prepare($sql);
	$resultado->execute(array(":dc"=>$idcliente, ":ds"=>$idu, ":tot"=>$total));
	//consultar el número de matricula generado
	$sql = "SELECT MAX(id_factura) as last_id FROM factura";
    $resultado=$base_de_datos->prepare($sql);
    $resultado->execute(array());
    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
    $numatricula=$registro['last_id'];
   

	//ingresar el número de matricula en la tabla detalletemp
	$sql="UPDATE temporal SET id_factura='$numatricula'";
	$resultado=$base_de_datos->prepare($sql); 
    $resultado->execute(array());

    // copia todos los registrso de detalletemp en detalle
    $sql="INSERT into detalles (id_factura, cod_producto, cantidad, precio_comple) select  id_factura, cod_producto, cantidad, precio_comple  from temporal";
    $resultado=$base_de_datos->prepare($sql);
    $resultado->execute(array());

	//consulta a la tabla temp
                            
	$fi=$base_de_datos->query("SELECT * from temporal where id_factura=$numatricula ")->fetchALL(PDO::FETCH_OBJ);
                        
	foreach ($fi as $temporal) :
		$codp= $temporal->cod_producto;
		$cantp= $temporal->cantidad;

		$sql="SELECT * from producto where cod_producto=:cod";
		$existencia=$base_de_datos->prepare($sql);
		$existencia->execute(array(":cod"=>$codp));
		$exist=$existencia->fetch(PDO::FETCH_ASSOC);
		$antes=$exist['existencia'];
  
		$actual=$antes - $cantp;
			
		$sql="UPDATE producto set existencia =:qu WHERE cod_producto =:co";
		$resultado=$base_de_datos->prepare($sql); 
		$resultado->execute(array(":co"=>$codp, ":qu"=>$actual));                                
	endforeach;

    //borra todos los regisros de la tabla detalletemp
    $sql="DELETE from temporal";
	$resultado=$base_de_datos->prepare($sql); 
    $resultado->execute(array());
	header("Location:vermatricula.php");

	$sql="SELECT * from detalles where codigo_producto=:cod_1";
        $existencia=$base_de_datos->prepare($sql);
        $existencia->execute(array(":cod_1"=>$codigopr));
        $existencia1=$existencia->fetch(PDO::FETCH_ASSOC);
        $existencia2=$existencia1['existencia'];
        $existencia3=$existencia2 - $cantidad;
        $sql="UPDATE productos set existencia='$existencia3' WHERE codigo_producto :co";
        $resultado=$base->prepare($sql); 
        $resultado->execute(array(":co"=>$codigopr));
	
	}

?>
<form  name="form1" method="post" action=" ">
	<div id="logotipo">
        <img src="">
    </div>
	<table class="tabla">
		</tr>

			<h3>
				<?php echo"Se va a generar la Factura con $contador Productos, al Cliente $nombre, el que Vendio su producto fue $auxiliar, si está seguro presione Si de lo contrario Volver"?>;
			</h3>
			
		
			<td>
				<input type="submit" name="si"  value="Si">
				<input type="button" name="vuelve" value="Volver" onmouseup="self.close()">
			</td>
		</tr>

	</table>
</form>
</body>
</html>
