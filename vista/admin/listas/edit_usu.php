<?php 
    session_start();
    require ("../../../control/concexion.php");
    include ("../../../control/validarsesion.php");
    $db = new Database();
    $con=$db->conectar();
?>



<?php

$recibir= $_GET['update'];


$select = $con -> prepare("SELECT * FROM usuarios, rol WHERE usuarios.id_rol = rol.id_rol AND usuarios.documento = '".$_GET['update']."'"); 
$select-> execute();
$fila= $select-> fetch(PDO::FETCH_ASSOC);


$sql =$con -> prepare ("SELECT * FROM rol");
$sql-> execute();
$roles= $sql-> fetch();

?>





<?php

if((isset($_GET["actu"]))&&($_GET["escond"]=="ido")){

    $id_person = $_GET['doc'];  
    $name = $_GET['nom'];
    $user = $_GET['user'];
    $cell = $_GET['tel'];
    $mail = $_GET['gmail'];
    $rol = $_GET['idusu'];

    if ($name=="" || $user=="" || $cell=="" || $mail=="" || $rol ==""){
        echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
        echo '<script>window.location="usuarios.php"</script>';
    }

    else{
      $actu = $con -> prepare("UPDATE usuarios SET nombre= '$name', user = '$user', telefono = '$cell' , email = '$mail' , id_rol = '$rol' Where documento = '$id_person'");
      $actu -> execute();
      echo '<script>alert ("Actualizacion Exitosa");</script>';
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
  <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 45rem; overflow:hidden;">

            
        <form class="form1" method="GET" name="form1" id="form1" autocomplete="off">

            <!--logo-->
            <div class="imagen d-flex justify-content-center ">
                <img src="../../../imagenes/cliente.png" class="logo" style="height: 9rem; border-radius: 20%; margin-bottom: 2rem; " alt="Avatar Image">
            </div>

            <h1 class="text-center text-dark fs-1 fw-bold">Edición De <br> Usuarios</h1>
            <!--Inserta titulo-->


                <!--crea formularios-->
    
    
                <input type="hidden" name="doc" id="doc" value="<?php echo $fila['documento'] ?>" placeholder="Digite Numero de Documento">
                
                <label for="docu"> Nombre </label>
                <input class="form-control bg-light" type="text" name="nom" value="<?php echo $fila['nombre'] ?>" placeholder="Ingrese Nombre completo">

                <label for="docu"> Usuario </label>
                <input class="form-control bg-light" type="text" name="user" value="<?php echo $fila['user'] ?>" placeholder="Ingrese usuario">


                <label for="docu"> Telefono </label>
                <input class="form-control bg-light" type="number" name="tel" value="<?php echo $fila['telefono'] ?>" placeholder="Ingrese telefono">

                <label for="docu"> gmail </label>
                <input class="form-control bg-light" type="email" name="gmail" value="<?php echo $fila['email'] ?>" placeholder="Ingrese correo">

            <select class="form-control bg-light" style="margin-top: 2rem; margin-bottom: 1rem; width: 20rem;" name="idusu">  
                 <option value=""selected disabled>Tipo de Usuario</option>
                    <?php
                     do {
                     ?>
                    <option value="<?php echo($roles ['id_rol'])?>"><?php echo($roles ['rol'])?>
                <?php
                     }while($roles = $sql-> fetch());
                ?>
            </select>

            <input type="hidden" name="escond" value="ido">

            <div class="d-flex gap-1 justify-content-center mt-1"><input class="btn btn-danger text-white mt-4 fw-semibold shadow-sm" style="width: 80%" type="submit" name="actu" value="ACTUALIZAR USUARIO"></div>

                     <br><br>
            <div class="row">         
                <a href="usuarios.php" class="text-decoration-none text-dark fw-semibold fst-italic col-lg-6" style="font-size: 0.9rem;">VOLVER</a>
           
            </div>    
        </form>
  </div>
</html>