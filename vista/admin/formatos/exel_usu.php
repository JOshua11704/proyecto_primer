<?php
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment;filename= Usuarios.xls");
?>


<!-- cambiar el filename en el formato qen el que estemos -->
<?php 
session_start();
require ("../../../control/concexion.php");
include ("../../../control/validarsesion.php");
$db = new Database();
$con=$db->conectar();
?>

<?php
    $sql = $con -> prepare("SELECT * FROM usuarios INNER JOIN rol INNER JOIN estado ON usuarios.id_rol = rol.id_rol WHERE usuarios.id_estado = estado.id_estado ORDER BY rol.rol ASC");
    $sql -> execute();
    

?>

<!DOCTYPE html>
    <html>
    <head>    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <title>Listado de usuarios</title>

    </head>
        <body class=" d-flex justify-content-center align-items-center vh-100" style="background-color: #9e9a9a;">
        <div class="main-container rounded-5 text-secondary" style="width: 70rem">

            <h2 class="text-center text-dark fs-1 fw-bold" style="margin-right: 25%;">Listado de Usuarios</h2>

            <br><br><br>

            <table>
                <tr>
                    <thead>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Estado</th>
                
                    </thead>
                </tr>

                
                <tbody>
                    <?php
                        foreach($sql as $sq){

                    ?>
                    
                        <tr>
                            <td><?=$sq['documento']?></td>
                            <td><?=$sq['nombre']?></td>
                            <td><?=$sq['user']?></td>
                            <td><?=$sq['rol']?></td>
                            <td><?=$sq['estado']?></td>
                            
                            
                        </tr>   
                        
                        

                    
                </tbody>
                <?php
                }

                ?>
            </table>    
            <br>
                
        

        </div>           
        <body>
    </html>
