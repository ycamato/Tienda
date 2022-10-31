<?php
require("../connection/connection.php");
ini_set("default_charset", "utf-8");

if(!isset($_SESSION["usuario"]) and !isset($_POST["envia"])){
    header("Location:index.php");
    
}
else if(isset($_POST["envia"])){


try{

$login=         htmlentities(addslashes($_POST["doc"]));
$password=      htmlentities(addslashes($_POST["clave"]));
$contador=0;


    $sql="SELECT * FROM usuario WHERE doc_user= :id";
    $resultado=$base_de_datos->prepare($sql);
    $resultado->execute(array(":id"=>$login));//marcador login se corresponde con lo que el usuario introdujo en el cuadro de texto login
    if ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
        
        if(password_verify($password, $registro['contraseña'])){
        
        $valida=        $registro['rol'];
        $nombre=        $registro['nom_user'];
        $idu=           $registro['doc_user'];
                $contador++;
            }
        }
        
        if ($contador>0){
            
                if($valida==1){
                      require("../admin.php");
                }
                elseif($valida==2){   
                    require("../vendedor/vendedor.php");
                }
                elseif($valida==3){   
                    require("../auditor/index.php");
                }
                elseif($valida==4){   
                    require("../bodeguero/index.php");
                }
        }
        else{
            echo "Usuario no registrado";
            require("../loginerror.php");
        }
        $resultado->closecursor();
        $base_de_datos->exec("set character set utf8");
       
        
}catch(Exception $e){
    die("error" . $e->getMessage());

}
}

?>