<?php

session_start();
require("../../connection/connection.php");


        $sql3="SELECT MAX(id_est) as last_id FROM estados";
        $sel=$base_de_datos->prepare($sql3);
        $sel->execute(array());
        $estado=$sel->fetch(PDO::FETCH_ASSOC);
        $esta=$estado['last_id'];

        $modi= $_GET['id'];
        $nueva= $_GET['canti'];
        $codi=$_GET['codigo'];
        $detal=$_GET['deta'];
        $canti=$_GET['cantip'];
        

        $tot=$canti + $nueva;




    
    try {   
        


        
        $sql1="UPDATE  factura SET id_est=:can WHERE id_factura=:de";
        $res=$base_de_datos->prepare($sql1);
        $res->execute(array(":de"=>$modi, ":can" => $esta));




        $sql1="UPDATE  producto SET existencia=:can WHERE cod_producto=:de";
        $res=$base_de_datos->prepare($sql1);
        $res->execute(array(":de"=>$codi, ":can" => $tot));



        echo"<script>alert('se anulo correctamente')</script>";
        echo"<script>window.location='../scrud.php'</script>";

        $resulta->closeCursor();
    } catch (Exception $th) {
    echo"No se pudo actualizar";
}finally{
    $base_de_datos=null;
}

?>