<?php
			session_start();
			include("../connection/connection.php");

			$click=$_GET["id"];

            if(isset($_GET['id'])){

				$usu=$_GET['id'];
				$nom=$_GET['nomb'];
				
			}	

			$sql="DELETE from temporal WHERE doc_user=:er";
			$resultado=$base_de_datos->prepare($sql); 
			$resultado->execute(array(":er"=>$usu));

			header("Location:index.php?iduser=$usu & nombaux=$nom");
				
			?>