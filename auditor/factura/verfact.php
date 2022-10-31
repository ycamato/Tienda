<?php
  //ini_set("default_charset", "UTF-8");
  require '../../fpdf/fpdf.php';
  	
	require("../../connection/connection.php");      
	include("../../connection/connection.php");
	$id=$_GET["id"];       
	       
    		$sql="SELECT  * from factura where id_factura=:nf";
        	$resultado=$base_de_datos->prepare($sql);
        	$resultado->execute(array(":nf"=>$id));
	   		$registro=$resultado->fetch(PDO::FETCH_ASSOC);
	   		$nufactura=$registro['id_factura'];
	   		$idcliente=$registro['doc_cliente'];
	   		$date=$registro['fecha'];
	   		$total=$registro['valor_total'];
	   		$usuario=$registro['doc_user'];
            $estado=$registro['id_est'];
	   		//consultar datos del cliente que corresponde a la última factura generada
	   		$sql="SELECT * from cliente where doc_cliente=:id";
	   		$resultado=$base_de_datos->prepare($sql);
	   		$resultado->execute(array(":id"=>$idcliente));
	   		$registro=$resultado->fetch(PDO::FETCH_ASSOC);

	   		
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(70,15);//alinea la próxima celda a 50 p sobre el eje X y a 50 p sobre el eje y
$pdf->Image('./logo.png',15,10,30);
$pdf->Cell(50, 10, 'SUPERTIENDA XYZ',0, 1, 'R');//celda de ancho 30, alto 10 relleno 1 con un salto de línea texto alineado a la derecha
$pdf->SetFont('Arial','',10);
$pdf->SetXY(72,20);
$pdf->Cell(50, 10,'VIVERES Y ABARROTES',0, 1,'C');
$pdf->SetXY(120,30);
$pdf->Cell(50, 10, 'FACTURA No',0, 0, 'R');
$pdf->SetXY(120,30);
$pdf->Cell(55, 10, $nufactura,0, 1, 'R');
$pdf->SetXY(110,40);
$pdf->Cell(50,10, 'FECHA',0, 0, 'R');
$pdf->Cell(35, 10, $date,0, 1, 'R');
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(72,50);
$pdf->Cell(50, 10,'DATOS DEL CLIENTE',0, 1,'C');
$pdf->SetFont('Arial','',12);
$pdf->SetXY(20,60);
$pdf->Cell(50, 10,utf8_decode('Identificación:'),0, 0,'C');
$pdf->Cell(1, 10,$registro['doc_cliente'],0, 1,'R');
$pdf->SetXY(14,65);
$pdf->Cell(52, 10,'Nombre:',0, 0,'C');
$pdf->Cell(1, 10,utf8_decode($registro['nom_cliente']),0, 0,'R');
$pdf->Cell(70, 10,'Apellido:',0, 0,'C');
$pdf->Cell(1, 10,$registro['apel_cliente'],0, 1,'R');
$pdf->SetXY(14,70);
$pdf->Cell(55, 10,utf8_decode('Dirección:'),0, 0,'C');
$pdf->Cell(1, 10,$registro['direccion'],0, 0,'R');
$pdf->Cell(65, 10,utf8_decode('Teléfono:'),0, 0,'C');
$pdf->Cell(2, 10,$registro['telefono'],0, 1,'R');
$sql="SELECT  * from usuario where doc_user=:iu";
$resultado=$base_de_datos->prepare($sql);
$resultado->execute(array(":iu"=>$usuario));
$registrou=$resultado->fetch(PDO::FETCH_ASSOC);
$pdf->Cell(42, 8,('Vendedor:'),0, 0,'R');
$pdf->Cell(15, 8,$registrou['nom_user'],0, 1,'R');
$pdf->SetFont('Arial','B',14);
$pdf->setXY(72,80);

$pdf->Cell(50,30,'DETALLE DE PRODUCTOS',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->setXY(10,85);
$pdf->Cell(55, 45,utf8_decode('Código'),0, 0,'C');
$pdf->Cell(1, 45,('Nombre'),0, 0,'C');
$pdf->Cell(55, 45,('Cantidad'),0, 0,'C');
$pdf->Cell(10, 45,('V/Unitario'),0, 0,'C');
$pdf->Cell(40, 45,('V/Total'),0, 1,'C');
$pdf->setXY(10,112);
$registrosdet=$base_de_datos->query("SELECT * from detalles where detalle=$nufactura ")->fetchALL(PDO::FETCH_OBJ);		
foreach ($registrosdet as $producto) :
$codigo=$producto->cod_producto;
$cantidad=$producto->cantidad;
$precio_venta=$producto->precio_comple;			
$pdf->SetFont('Arial','',12);
//$pdf->Cell(50, 8, $producto->codproducto,0, 0,'C');
$sql="SELECT nom_prod, precio  from producto where cod_producto=:co";
$resultado=$base_de_datos->prepare($sql);
$resultado->execute(array(":co"=>$codigo));
$registrop=$resultado->fetch(PDO::FETCH_ASSOC);
$nombre=$registrop['nom_prod'];

$precio=$registrop['precio'];
//$pdf->Cell(12, 8, $registrop['nombre'],0, 1,'C');
//$pdf->Cell(89,1, $producto->cantidad,0,0,'R');
//$pdf->Cell(30,1, $registrop['precio'],0,1,'R');
//$pdf->Cell(150,1,$producto->precio_venta,0,1,'R');
$pdf->Cell(50, 8, $codigo,0, 0,'C');
$pdf->Cell(12, 8, $nombre,0, 0,'C');
$pdf->Cell(42, 8, $cantidad,0, 0,'C');
$pdf->Cell(25, 8, $precio,0, 0,'C');
$pdf->Cell(25, 8, $precio_venta,0, 1,'C');


endforeach; 

$pdf->Cell(133,10,'Valor Total',0,0,'R');
$pdf->Cell(15,10, '$'. $total, 0,1,'C');
$sql="SELECT  * from estados where id_est=:iu";
$resultado=$base_de_datos->prepare($sql);
$resultado->execute(array(":iu"=>$estado));
$registrou=$resultado->fetch(PDO::FETCH_ASSOC);
$pdf->Cell(42, 8,('Estado'),0, 0,'R');
$pdf->Cell(35, 8,$registrou['nombre'],0, 1,'R');
$pdf->Output();
?>
	
		