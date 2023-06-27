<?php
 //coneccion
 session_start();
 require ("../../control/concexion.php");
 include ("../../control/validarsesion.php");
 $db = new Database();
 $conectar = $db -> conectar();

?>

<!-- estructura HTML de la página -->          

<?php

    $select = $conectar -> prepare("SELECT * FROM usuarios, rol WHERE user = '" .$_SESSION['user']."' AND usuarios.id_rol = rol.id_rol");
    $select -> execute();
    $usu = $select -> fetch();

?>


<?php

    if(isset($_POST['btncerrar']))
    {
        session_destroy();
        header('location: ../../index.html');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar</title>
    <link rel="icon" type="image/jpg" href="../../controller/image/favi.png">
    <link rel="stylesheet" href="../../estilos/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    
</head>
<body>

    
            <div class="encabezado">
                
                    <h1> Bienvenido al Panel de Control<br><?php echo $usu ['rol'] ?> <?php echo $usu['nombre']?> </h1> 

                    <form method="post">

                    <tr> <br>
                            <td colspan = '2' align="center">
                                <input type="submit" class="btn btn-secondary m-1 shadow-sm" value="Cerrar sesion" name="btncerrar"/>            

                            
                            </td>
                    </tr>
                    </form>    
            
            </div>         

    <div class="contenedor">
        <div class="crear">
            <a href="listas/usuarios.php"><img src="../../imagenes/agregar-usuario.png" alt="agregar-usuario"></a>

        </div>

        <div class= "tipousu">
            <a href="listas/listas.php"><img src="../../imagenes/lista.png" alt="listas"></a>
                

        </div>
          
        <div class="listas">  
            <a href="./listas/predios.php"><img src="../../imagenes/casa.png" alt="Predios"></a>

        </div>
        


        <div class="op_one"><a href="listas/usuarios.php">Usuario</a></div>
            
        <div class="op_two"><a href="crearrol/">Lista de Deudas</a></div>
             
        <div class="op_three"><a href="listas/predios.php">Predios</a></div>
            
                


    </div>

    


</body>
</html>
