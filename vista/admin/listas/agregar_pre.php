<?php 
    session_start();
    require ("../../../control/concexion.php");
    include ("../../../control/validarsesion.php");
    $db = new Database();
    $con=$db->conectar();
?>

<?php
    $user = $con -> prepare("SELECT documento, nombre FROM usuarios");
    $user -> execute();
    $propiet= $user -> fetch();

    $tipodoc = $con -> prepare("SELECT * FROM tipo_predio");
    $tipodoc -> execute();
    $tipode= $tipodoc -> fetch();

    $sql =$con -> prepare ("SELECT * FROM estrato");
    $sql-> execute();
    $fila= $sql-> fetch();

    $destina =$con -> prepare ("SELECT * FROM destinacion");
    $destina-> execute();
    $destinacion= $destina-> fetch();
?>
<?php
    if((isset($_GET["MM_insert"]))&&($_GET["MM_insert"]=="formreg"))
    {
        $ficha= $_GET['ficha'];
        $nombre= $_GET['prop'];
        $usuario= $_GET['user'];
        $taman= $_GET['tam'];
        $avaluo= $_GET['Avaluo'];
        $prediotip= $_GET['tipopred'];
        $estrato= $_GET['predio'];
        $destin= $_GET['destina'];


        $validar = $con ->prepare( "SELECT * FROM predio WHERE ficha_cat ='$ficha''");
        $validar-> execute();
        $fila1 = $validar-> fetch();

        if ($ficha=="" || $nombre=="" || $usuario=="" || $taman=="" || $avaluo=="" || $prediotip=="" || $estrato=="" || $destin=="")
        {
            echo '<script>alert("EXISTEN CAMPOS VACIOS");</script>';
            echo '<script>windows.location="agregar_pred.php"</script>';
        }
        else if ($fila1) {
            echo '<script>alert("LA PROPIEDAD YA EXISTE //CAMBIELOS//");</script>';
            echo '<script>windows.location="agregar_pred.php"</script>';
        }
        else 
        {

            $insertsql = $con -> prepare("INSERT INTO `predio` (`direccion`, `tamaño`, `Avaluo_actu`, `id_tip_predio`, `id_estrato`, `ficha_cat`, `documento`, `id_destina`) VALUES ('$usuario', '$taman', '$avaluo', '$prediotip', '$estrato', '$ficha', '$nombre','$destin')");

            $insertsql->execute();
            
            echo '<script>alert ("Registro exitoso,Gracias");</script>';
            echo '<script>window.location="predios.php"</script>';

        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="../../../imagenes/favicon-16x16.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <!-- estilos select2 -->
    <link rel="stylesheet" type="text/css" href="../formatos/select2.min.css">

    <!-- javascript de select2 -->
    <script src="select2.min.js"></script>

    <!-- boostrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <title>Registro</title>
</head>
<body class=" bg-dark d-flex justify-content-center align-items-center vh-100">
<div class="bg-white p-5 rounded-5 text-secondary shadow " style="width: 45rem; margin-top: 20%; padding: 10%;">

            
            <form class="form1" method="GET" name="form1" id="form1" autocomplete="off">

            <!--logo-->
            <div class="imagen d-flex justify-content-center ">
                <img src="../../../imagenes/cliente.png" class="logo" style="height: 9rem; border-radius: 20%; margin-bottom: 2rem; " alt="Avatar Image">
            </div>

            <h1 class="text-center text-dark fs-1 fw-bold">Registro De <br> Predios</h1>
            <!--Inserta titulo-->


                <!--crea formularios-->
    
    
                <label for="ficha">Ficha Catastral</label>
                <input class="form-control bg-light" type="text" name="ficha" id="ficha" placeholder="Ingrese Ficha Catastral">
                
                <select class="form-control bg-light" style="margin-top: 2rem; margin-bottom: 1rem; width: 20rem;" name="prop" id="controlBuscador" required>
                    <option value="0" selected disabled="">Propietario</option>
                    
                    <?php
                        do {
                     ?>
                    <option value="<?php echo ($propiet ['documento'])?>"><?php echo($propiet ['nombre'])?></option>
                <?php
                    }while($propiet = $user-> fetch());
                ?>

            </select>

                <label for="direc"> Dirección </label>
                <input class="form-control bg-light" type="text" name="user" placeholder="Ingrese Direccion"><br>

                <label for="tam"> Tamaño de predio </label>
                <input class="form-control bg-light" type="text" name="tam" placeholder="Ingrese Tamaño"><br>

                <label for="Avaluo"> Avaluo </label>
                <input class="form-control bg-light" type="number" name="Avaluo" placeholder="Ingrese Avaluo Actual">
            
            <div class="row gap-2">    

                <select class="form-control bg-light col-lg-6" style="margin-top: 2rem; margin-bottom: 1rem; width: 12rem;" name="tipopred" required>
                        <option value="0" selected disabled="">Tipo de Predio</option>
                        
                        <?php
                            do {

                        ?>
                        <option value="<?php echo ($tipode ['id_tip_predio'])?>"><?php echo($tipode ['tip_predio'])?></option>
                    <?php
                        }while($tipode = $tipodoc-> fetch());
                    ?>

                </select>

                       
                <select class="form-control bg-light" style="margin-top: 2rem; margin-bottom: 1rem; width: 12rem;" name="predio">
                
                    <option value="" selected disabled>Estrato del Predio</option>
                        <?php
                            do {

                        ?>
                        <option value="<?php echo ($fila ['id_estrato'])?>"><?php echo($fila ['estrato'])?></option>
                    <?php
                        }while($fila = $sql-> fetch());
                    ?>
                </select>


                <select class="form-control bg-light col-lg-6" style="margin-top: 2rem; margin-bottom: 1rem; width: 15rem;" name="destina">
                
                    <option value="" selected disabled>Destinación del Predio</option>
                        <?php
                            do {

                        ?>
                        <option value="<?php echo ($destinacion ['id_destina'])?>"><?php echo($destinacion ['tipo'])?></option>
                    <?php
                        }while($destinacion= $destina-> fetch());
                    ?>
                </select>
            </div> 

            <div class="d-flex gap-1 justify-content-center mt-1"><input class="btn btn-danger text-white mt-4 fw-semibold shadow-sm" style="width: 80%" type="submit" name="validar" value="REGISTRAR USUARIO"></div>

            <input type="hidden" name="MM_insert" value="formreg">
                    
            <br><br>

            <a href="usuarios.php" class="text-decoration-none text-dark fw-semibold fst-italic" style="font-size: 0.9rem;">VOLVER</a>
           
            </form>
        </div>
</html>

<!-- script para la barra de autocompletado de busqueda -->
<script type="text/javascript">
    $(document).ready(function(){
       $('#controlBuscador').select2(); 
    });
</script>