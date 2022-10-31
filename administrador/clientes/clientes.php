<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/clientes.css">
    <title>Panel de  usuarios</title>
</head>
<body>
    <?php
     include("../../connection/connection.php");
     
     $registros=3;
     if(isset($_GET["pagina"])){
             if($_GET["pagina"]==1){
                 header("location:clientes.php");
             }else{
                 $pagina=$_GET["pagina"];
             }
        }else{
              $pagina=1;
        }
        $empieza=($pagina-1)*$registros;
        $sql_total="SELECT * FROM cliente";

        $resultado=$base_de_datos->prepare($sql_total);

        $resultado->execute(array());
        $numfilas=$resultado->rowCount();
        $totalpagina=ceil($numfilas/$registros);

        $registros=$base_de_datos->query("SELECT * FROM cliente LIMIT $empieza,$registros")->fetchALL(PDO::FETCH_OBJ);

        if(isset($_POST['inserta'])) {
            $idu=$_POST['doc'];
            $nombre=$_POST['nomb'];
            $apellido=$_POST['apel'];
            $telefono=$_POST['telefono'];
            $direccion=$_POST['direccion'];
            
            
            
            ?>
            <input type="number" name="idd" value="<?php echo $idu?>">
            <?php
            $sql="INSERT INTO cliente (doc_cliente, nom_cliente, apel_cliente,telefono, direccion )  VALUES (:doc,:nom, :ap,:tel, :dir)";
            $resultado=$base_de_datos->prepare($sql);
            $resultado->execute(array(":doc"=>$idu,  ":nom"=>$nombre, ":ap"=>$apellido, ":tel"=>$telefono,":dir"=>$direccion));

            header("Location:clientes.php");
        }
    ?>
    <h3 align="center">PANEL DE OPCIONES CLIENTES</h3><br>
    <form action=" " method="post" autocomplete="off">
        <table align="center" border="" bordercolor="orange">
			<tr>
				<th>Documento del cliente</th>
				<th>Nombre del cliente</th>
                <th>Apellido del cliente</th>
				<th>Telefono</th>
                <th>Direccion</th>
				<th colspan="2">Acciones</th>
			</tr>
            <?php
            foreach ($registros as $persona) :?>
            <tr>
				<td><?php echo $persona->doc_cliente?></td>
				<td><?php echo $persona->nom_cliente?></td>
                <td><?php echo $persona->apel_cliente?></td>
                <td><?php echo $persona->telefono?></td>
                <td><?php echo $persona->direccion?></td>
				

            <td><a href="eliminar.php?id=<?php echo $persona->doc_cliente?> & nom=<?php echo $persona->nom_cliente?> & ap=<?php echo $persona->apel_cliente?> & tel=<?php echo $persona->telefono?> & dir=<?php echo $persona->direccion?>"><input type="button" name="elimina" id="elimina" value="Eliminar"></a></td>
            <td><a href="editar.php?id=<?php echo $persona->doc_cliente?> & nom=<?php echo $persona->nom_cliente?> & ap=<?php echo $persona->apel_cliente?> & dir=<?php echo $persona->telefono?> & dir=<?php echo $persona->direccion?>"><input type="button" class="edita" name="edita" value="Editar"></a></td></tr>

            <?php
			endforeach;
		
			?>
			
			<td><input type="text" name="doc"></td>
			<td><input type="text" name="nomb"></td>
            <td><input type="text" name="apel"></td>
            <td><input type="text" name="telefono"></td>
			<td><input type="varchar" name="direccion" ></td>
			
            <td colspan="5" align="center"><input class="inserta" type="submit" id="inserta" name="inserta" value="Insertar" >
            <a href="administrador/index.php"><input type="button" name="admin" class="cerrar" value="Cerrar"onmouseup="window.close()"></a></td>
            </tr>
            <tr>
        </table>
    </form>
    <table border="0" align="center">
        <tr>
    <?php
    for($i=1; $i<=$totalpagina; $i++){
    ?>
        <td><?php echo " <a href='?pagina=" . $i . "'>" . $i . "  </a>  ";?></td>
    <?php
    $base=null;
    }
    ?>
        </tr>
    </table>
</body>
</html>
