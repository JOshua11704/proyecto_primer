<?php 
    session_start();
    require ("../../../control/concexion.php");
    include ("../../../control/validarsesion.php");
    $db = new Database();
    $con=$db->conectar();





    

 
        // se trae la variable recibida por $ GET desede productos.php
    $sql =$con -> prepare("DELETE FROM usuarios WHERE documento='".$_GET['eliminar']."'");
    $sql-> execute();
    echo '<script>alert ("Se elimino el usuario con Exito");</script>';
    echo '<script>window.location="usuarios.php"</script>';
    exit();


?>
