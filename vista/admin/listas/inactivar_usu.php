<?php 
    session_start();
    require ("../../../control/concexion.php");
    include ("../../../control/validarsesion.php");
    $db = new Database();
    $con=$db->conectar();
?>

<?php

if($_GET["inactivar"]){
    
    
    $idus = $_GET ['inactivar'];

    $comprobar = $con -> prepare("SELECT * FROM usuarios WHERE documento = $idus AND id_estado =2");
    $comprobar -> execute();
    $comprobado = $comprobar ->fetch(PDO::FETCH_ASSOC);

    if ($comprobado)
    {
        echo '<script>alert ("El usuario ya está inactivo");</script>';    
     
        echo '<script> window.location = "usuarios.php" </script>';
    }else {
        $activar= $con-> prepare("UPDATE usuarios SET id_estado = 2 WHERE usuarios.documento = $idus");
        $activar -> execute();


        ///una ves actualizado el usuario
        echo '<script>alert ("Has INACTIVADO el estado el usuario");</script>';    
        echo '<script> window.location = "usuarios.php" </script>';
    }
}
?>