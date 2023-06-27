<?php
    session_start();
    require_once("control/concexion.php");
    $db = new Database();
    $con = $db->conectar();
?>
<?php
    $sql =$con -> prepare ("SELECT * FROM rol WHERE id_rol=2");
    $sql-> execute();
    $fila= $sql-> fetch();
?>
<?php
    if($_GET["btnregistrarx"]);
{
    $documento= $_GET["doc"];
    $usuario= $_GET["usuario"];
    $clave= $_GET["contra"];
    $tip_doc= $_GET["tipodoc"];
    $idusu= 3;
    $est= 1;



        $validar = $con ->prepare("SELECT * FROM usuarios, rol WHERE user ='$usuario' or password='$clave'");
        $validar-> execute();
        $fila1 = $validar-> fetch();

        if ($usuario==""|| $clave=="" || $idusu=="")
        {
            echo '<script>alert("EXISTEN CAMPOS VACIOS");</script>';
            echo '<script>windows.location="index.html"</script>';
        }
        else if ($fila1) {
            echo '<script>alert("DOCUMENTO O USUARIO EXISTEN //CAMBIELOS//");</script>';
            echo '<script>windows.location="index.html"</script>';
        }
        else 
        {
            $encriptar= password_hash($clave, PASSWORD_BCRYPT, ["cost"=> 15]);

            // encriptar contraseña

            $insertsql = $con -> prepare("INSERT INTO usuarios (documento ,user, password, id_tip_doc, id_rol, id_estado) VALUES ('$documento','$usuario','$encriptar','$tip_doc','$idusu','$est')");

            $insertsql->execute();
            
            echo '<script>alert ("Registro exitoso,Gracias");</script>';
            echo '<script>window.location="index.html"</script>';

        }

    }