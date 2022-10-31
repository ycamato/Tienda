<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="">
    <link rel="icon" href="../imag/logo.png">
    <title>Acceso  directo  a  facturas</title>
</head>
<body>
    <?php
    
    include("../connection/connection.php");

    
    //--------------paginación-------------
    $registros=3;//indica que se van a ver 3 registro por página
    if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1){
            header("Location:scrud.php");
        }else{
            $pagina=$_GET["pagina"];
        }
    }else{
        $pagina=1;//muestra página en la que estamos cuando se carga por primera vez
    }
    
    $empieza=($pagina-1)*$registros;//registro desde el cual va a empezar a mostrar
    $sql_total="SELECT * FROM usuario, detalles, factura, cliente  WHERE detalles.id_factura=factura.id_factura and  factura.doc_user=usuario.doc_user  and factura.doc_cliente=cliente.doc_cliente";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

    $resultado=$base_de_datos->prepare($sql_total);

    $resultado->execute(array());
    $numfilas=$resultado->rowCount();//cuantos registros hay en total
    $totalpagina=ceil($numfilas/$registros);

    $registros=$base_de_datos->query("SELECT * from usuario, detalles, factura, cliente, producto, estados WHERE detalles.id_factura=factura.id_factura and  factura.doc_user=usuario.doc_user  and factura.doc_cliente=cliente.doc_cliente and detalles.cod_producto=producto.cod_producto and factura.id_est=estados.id_est LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);

    ?>
    
<h3 align="center">PANEL  DE  ACCESO  FACTURAS</h3>
<form action=" " method="post" autocomplete="off">
        <table align="center" border="" bordercolor="orange">
            <tr>
            <th align="center">Id. Producto</th>
            <th align="center">Nombre del Cliente</th>
            <th align="center">Fecha </th>
            <th align="center">Vendedor</th>
            <th align="center">Cantidad</th>
            <th align="center">Estado</th>
            <th align="center">Valor total factura</th>
            <th align="center">Accion</th>
            </tr>
            <?php
            //por cada objeto que hay dentro del array repite el código
            foreach ($registros as $fac) :?> 
            <tr>
                <td><?php echo $fac->cod_producto?></td>
                <td><?php echo $fac->nom_cliente?> <?php echo $fac->apel_cliente?></td>
                <td><?php echo $fac->fecha?></td>
                <td><?php echo $fac->nom_user?></td>
                <td><?php echo $fac->cantidad?></td>
                <td><?php echo $fac->nombre?></td>
                <td><?php echo $fac->valor_total?></td>

     

            
                    
            <td><a href="factura/anular.php?id=<?php echo $fac->id_factura?>   & deta=<?php echo $fac->detalle?>  & codigo=<?php echo $fac->cod_producto?> & canti=<?php echo $fac->cantidad?> & cantip=<?php echo $fac->existencia?>"><input type="button" name="elimina" id="elimina" value="Anular"></a></td>
            <td><a href="factura/verfact.php?id=<?php echo $fac->id_factura?> & nomb=<?php echo $fac->nom_cliente?>  & ape=<?php echo $fac->apel_cliente?>  & vende=<?php echo $fac->nom_user?>"><input type="button" name="edita" value="Ver Factura"></a></td>
            <td colspan="5" align="right"><a href="admi/admi.php"><input type="button" name="admin" value="Cerrar"onmouseup="window.close()"></a></td>
        

            
            <?php
            endforeach;
        
            ?>
                </td>
            </tr>
        
            
    </tr>
                
                
    
        </table>
</form>

<table border="0" align="center">
    <tr>    
<?php
for($i=1; $i<=$totalpagina; $i++){
    ?>
     <td><?php echo " <a href='?pagina=" . $i . "'>" . $i . "  </a>  ";?></td>
        
<?php
    
$base_de_datos=null;//vaciar los datos de conexión 
}
?>
