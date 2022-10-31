<?php
	session_start();
	include("../connection/connection.php");

	$cantidad=$_GET['cantidad'];
	//$codigopr=$_GET['codigo'];
   	$idcliente=$_GET['id'];
	$nombre=$_GET['nomb'];
	$contador=$_GET['contador'];
	$idu=$_REQUEST['iduser'];
	$auxiliar=$_GET['nombaux'];	
	$total=$_GET['total'];
?>
<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/mensaje.css">
	<title>Facturación </title>
</head>
<body>
<form  name="form1" method="post" action=" ">
<h4 class="tot">Total Productos a Facturar:</br><?php echo $contador;?></h4>


<h4 class="pagar">Total a Pagar de la Factura:</br> <?php echo $total;?></h4>


<input type="int"  class="input" name="dinero" placeholder="Efectivo de  entrada"></br>
<input type="submit" class="btn"  name="si"  value="Si">
<a href="eliminar.php"><input type="button" class="boton"  name="regresar" value="volver" >
</form>

<?php 

    
    if(isset($_POST['si'])){

		$efectivo=0;
		$efectivo=$_POST['dinero'];
		$entrega= $efectivo - $total;
		
		echo"<script>alert('Tus devueltas son: $entrega.')</script>";
        echo'<script>window.location="vermatricula.php"</script>';
		
		$sql="INSERT INTO factura (doc_cliente, doc_user, valor_total, id_est) values (:dc, :ds, :tot, 1)";
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
    	$sql="INSERT into detalles (id_factura, cod_producto, cantidad, precio_comple,doc_user) select  id_factura, cod_producto, cantidad, precio_comple,doc_user  from temporal WHERE doc_user=$idu";
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
   		$sql="DELETE from temporal WHERE doc_user=:id";
		$resultado=$base_de_datos->prepare($sql); 
    	$resultado->execute(array(":id"=>$idu));
		//header("Location:vermatricula.php");

		$sql="SELECT * from detalles where cod_producto=:co";
        $existencia=$base_de_datos->prepare($sql);
        $existencia->execute(array(":co"=>$codigopr));
        $existencia1=$existencia->fetch(PDO::FETCH_ASSOC);
        $existencia2=$existencia1['existencia'];
        $existencia3=$existencia2 - $cantidad;
        $sql="UPDATE productos set existencia='$existencia3' WHERE codigo_producto :co";
        $resultado=$base_de_datos->prepare($sql); 
        $resultado->execute(array(":co"=>$codigopr));
	
		
	}

?>

</body>
</html>
