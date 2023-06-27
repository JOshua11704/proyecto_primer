<?php 
    session_start();
    require ("../../../control/concexion.php");
    include ("../../../control/validarsesion.php");
    $db = new Database();
    $con=$db->conectar();
?>

<?php

    $tipodoc = $con -> prepare("SELECT * FROM tip_dpc");
    $tipodoc -> execute();
    $tipode= $tipodoc -> fetch();

    $sql =$con -> prepare ("SELECT * FROM rol");
    $sql-> execute();
    $fila= $sql-> fetch();
?>
<?php
    if((isset($_GET["MM_insert"]))&&($_GET["MM_insert"]=="formreg"))
    {
        $cedula= $_GET['doc'];
        $nombre= $_GET['nom'];
        $usuario= $_GET['user'];
        $clave= $_GET['pass'];
        $telefono= $_GET['tel'];
        $gmail= $_GET['gmail'];
        $idusu= $_GET['idusu'];
        $tipodoc= $_GET['tipodoc'];

        // constante para que cada vez que alguien se registre quede como usuario innactivo

        $est= 1;


        $validar = $con ->prepare( "SELECT * FROM usuarios, rol WHERE documento ='$cedula' or user='$usuario'");
        $validar-> execute();
        $fila1 = $validar-> fetch();

        if ($cedula=="" || $nombre=="" || $usuario=="" || $telefono=="" || $gmail=="" || $clave=="" || $idusu=="")
        {
            echo '<script>alert("EXISTEN CAMPOS VACIOS");</script>';
            echo '<script>windows.location="agregar_usu.php"</script>';
        }
        else if ($fila1) {
            echo '<script>alert("DOCUMENTO O USUARIO EXISTEN //CAMBIELOS//");</script>';
            echo '<script>windows.location="agregar_usu.php"</script>';
        }
        else 
        {
            $encriptar= password_hash($clave, PASSWORD_BCRYPT, ["cost"=> 15]);

            // encriptar contraseña

            $insertsql = $con -> prepare("INSERT INTO usuarios (documento, nombre, user, telefono, email, password, id_rol, id_estado, id_tip_doc) VALUES ('$cedula','$nombre','$usuario','$telefono','$gmail','$encriptar','$idusu','$est','$tipodoc')");

            $insertsql->execute();
            
            echo '<script>alert ("Registro exitoso,Gracias");</script>';
            echo '<script>window.location="usuarios.php"</script>';

        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="imagenes/moto.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <title>Registro</title>
</head>
<body class=" bg-dark d-flex justify-content-center align-items-center vh-100">
<div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 45rem">

            
            <form class="form1" method="GET" name="form1" id="form1" autocomplete="off">

            <!--logo-->
            <div class="imagen d-flex justify-content-center ">
                <img src="../../../imagenes/cliente.png" class="logo" style="height: 9rem; border-radius: 20%; margin-bottom: 2rem; " alt="Avatar Image">
            </div>

            <h1 class="text-center text-dark fs-1 fw-bold">Registro De <br> Usuarios</h1>
            <!--Inserta titulo-->


                <!--crea formularios-->
    
    
                <label for="doc">Documento</label>
                <input class="form-control bg-light" type="number" name="doc" id="doc" placeholder="Digite Numero de Documento">
                
                <label for="docu"> Nombre </label>
                <input class="form-control bg-light" type="text" name="nom" placeholder="Ingrese Nombre completo">

                <label for="docu"> Usuario </label>
                <input class="form-control bg-light" type="text" name="user" placeholder="Ingrese usuario">

                <label for="docu"> Contraseña </label>
                <input class="form-control bg-light" type="password" name="pass" placeholder="Ingrese contraseña">

                <label for="docu"> Telefono </label>
                <input class="form-control bg-light" type="number" name="tel" placeholder="Ingrese telefono">

                <label for="docu"> gmail </label>
                <input class="form-control bg-light" type="text" name="gmail" placeholder="Ingrese correo">

            <select class="form-control bg-light" style="margin-top: 2rem; margin-bottom: 1rem; width: 20rem;" name="tipodoc" required>
                    <option value="0" selected disabled="">Tipo de Documento</option>
                    
                    <?php
                        do {

                     ?>
                    <option value="<?php echo ($tipode ['id_tip_doc'])?>"><?php echo($tipode ['tip_docu'])?></option>
                <?php
                    }while($tipode = $tipodoc-> fetch());
                ?>

            </select>


            <select class="form-control bg-light" style="margin-top: 2rem; margin-bottom: 1rem; width: 20rem;" name="idusu">
              
                 <option value="" selected disabled>Tipo de Usuario</option>
                    <?php
                        do {

                     ?>
                    <option value="<?php echo ($fila ['id_rol'])?>"><?php echo($fila ['rol'])?></option>
                <?php
                    }while($fila = $sql-> fetch());
                ?>
            </select>

            <div class="d-flex gap-1 justify-content-center mt-1"><input class="btn btn-danger text-white mt-4 fw-semibold shadow-sm" style="width: 80%" type="submit" name="validar" value="REGISTRAR USUARIO"></div>

            <input type="hidden" name="MM_insert" value="formreg">
                    
            <br><br>

            <a href="usuarios.php" class="text-decoration-none text-dark fw-semibold fst-italic" style="font-size: 0.9rem;">VOLVER</a>
           
            </form>
        </div>
</html>