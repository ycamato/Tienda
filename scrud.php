<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/scrud.css">
    <title>Panel de  usuarios</title>
</head>
<body>
    <?php
     include("connection/connection.php");
     
     $registros=3;
     if(isset($_GET["pagina"])){
             if($_GET["pagina"]==1){
                 header("location:index.php");
             }else{
                 $pagina=$_GET["pagina"];
             }
        }else{
              $pagina=1;
        }
        $empieza=($pagina-1)*$registros;
        $sql_total="SELECT * FROM usuario";

        $resultado=$base_de_datos->prepare($sql_total);

        $resultado->execute(array());
        $numfilas=$resultado->rowCount();
        $totalpagina=ceil($numfilas/$registros);

        $registros=$base_de_datos->query("SELECT * FROM usuario LIMIT $empieza,$registros")->fetchALL(PDO::FETCH_OBJ);

        if(isset($_POST['inserta'])) {
            $idu=$_POST['idu'];
            $rol=$_POST['rol'];
            $nombre=$_POST['nomb'];
            $correo=$_POST['correo'];
            $password=$_POST['clave'];
            $pass_cifrado=password_hash($password,PASSWORD_DEFAULT,array("cost"=>12));
            
            
            ?>
            <input type="number" name="idd" value="<?php echo $idu?>">
            <?php
            $sql="INSERT INTO usuario (doc_user, nom_user, rol,correo, contraseña )  VALUES (:id,:nom, :r,:co, :clave)";
            $resultado=$base_de_datos->prepare($sql);
            $resultado->execute(array(":id"=>$idu,  ":r"=>$rol, ":nom"=>$nombre, ":clave"=>$pass_cifrado,":co"=>$correo));

            header("Location:scrud.php");
        }
    ?>
    <h3 >PANEL DE OPCIONES USUARIOS</h3><br>
    <form action=" " method="post" autocomplete="off">
        <table align="center" border="" bordercolor="orange">
			<tr>
				<th>Documento</th>
				<th>Nombre</th>
                <th>correo</th>
				<th>Contraseña</th>
                <th>Rol</th>
				<th colspan="2">Acciones</th>
			</tr>
            <?php
            foreach ($registros as $persona) :?>
            <tr>
				<td><?php echo $persona->doc_user?></td>
				<td><?php echo $persona->nom_user?></td>
                <td><?php echo $persona->correo?></td>
                <td><?php echo/* $persona->contraseña*/'XXXX'?></td>
                <td><?php echo $persona->rol?></td>
				
                

				<?php
				if($persona->rol==1){
					$aux="Administrador"
					?>
					<td><?php echo $aux;?></td>
				<?php
				}elseif($persona->rol==2){
					$aux="Vendedor"
					?>
					<td><?php echo $aux;?></td>
				<?php
				}elseif($persona->rol==3){
					$aux="auditor"
					?>
					<td><?php echo $aux;?></td>
				<?php
                }else{
					$aux="bodeguero"
					?>
					<td><?php echo $aux;?></td>
				<?php
                }
			?>
            <td><a href="./administrador/eliminar.php?id=<?php echo $persona->doc_user?> & nom=<?php echo $persona->nom_user?> & co=<?php echo $persona->correo?> & pas=<?php echo $persona->contraseña?> & tip=<?php echo $persona->rol?>"><input type="button" name="elimina" id="elimina" value="Eliminar"></a></td>
            <td><a href="./administrador/editar.php?id=<?php echo $persona->doc_user?> & nom=<?php echo $persona->nom_user?> & co=<?php echo $persona->correo?> & pas=<?php echo $persona->contraseña?> & tip=<?php echo $persona->rol?>"><input type="button" class="edita" name="edita" value="Editar"></a></td></tr>

            <?php
			endforeach;
		
			?>
			
			<td><input type="text" name="idu"></td>
			<td><input type="text" name="nomb"></td>
            <td><input type="text" name="correo"></td>
			<td><input type="password" name="clave" ></td>
			<td><select name="rol">
			<?php
            $sql= "SELECT * FROM tipo"; 
			$resultado=$base_de_datos->prepare($sql);
			$resultado->execute(array());
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
			?>
			?>
            <option value="<?php echo $registro['rol'];?>"><?php echo $registro['rol_nom']?></option>
				<?php
				}
            ?>
            </select> </td>
            <td colspan="5" align="center"><input  type="submit" id="inserta" name="inserta" value="Insertar" >
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
