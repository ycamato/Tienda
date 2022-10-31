<?php
			session_start();
			include("../connection/connection.php");

			$click=$_GET["id"];

			if(isset($_GET['doc'])){

				$docu=$_GET['doc'];
				$nomc=$_GET['nomc'];
				$apec=$_GET['apec'];
                $te=$_GET['tel'];
                $dir=$_GET['dir'];
				$usu=$_GET['id'];
				$ax=$_GET['ax'];
			}				

			$delete= "DELETE FROM temporal WHERE detalle =:id";
			$resultado=$base_de_datos->prepare($delete);
			$resultado->execute(array(":id"=>$click));
				                    				
			header("Location: detalletemp.php?ide=$docu & nomb=$nomc & ape=$apec & tele=$te & dir=$dir & iduser=$usu & nombaux=$ax");

?>