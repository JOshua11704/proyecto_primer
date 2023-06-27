<?php 
    session_start();
    require ("../../../control/concexion.php");
    include ("../../../control/validarsesion.php");
    $db = new Database();
    $con=$db->conectar();
?>


<?php
    $select = $con -> prepare ("SELECT predio.ficha_cat, usuarios.nombre, deuda.valor_actu, estrato.estrato, tipo_predio.tip_predio, destinacion.tipo FROM predio INNER JOIN deuda INNER JOIN usuarios INNER JOIN tipo_predio INNER JOIN estrato INNER JOIN destinacion ON predio.ficha_cat = deuda.ficha_cat WHERE predio.documento = usuarios.documento AND predio.id_tip_predio= tipo_predio.id_tip_predio AND predio.id_estrato = estrato.id_estrato AND predio.id_destina = destinacion.id_destina");
    $select -> execute();

?>


<!DOCTYPE html>
    <html>
    <head>
        <title>Listado de Productos</title>
        <link rel="stylesheet" href="../../../estilos/tabla_pred.css">
        <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="../../../imagenes/moto.png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />

    </head>
        <body class=" d-flex justify-content-center align-items-center vh-100" style="background-color: #9e9a9a;">
        <div class="main-container rounded-5 text-secondary" style="width: 70rem">

            <h2 class="text-center text-dark fs-1 fw-bold" style="margin-right: 25%;">Listado de Predios</h2>
            <br>

            <div class="row">
                <div class="col-lg-6">
                    <form action="../formatos/exel_predio.php">
                        <div ><button type="submit" class="btn btn-outline-dark m-1" >Descargar EXEL</button></div> 
                    </form>
               
            </div>


            


            <br>
            <div class="row">
                <div class="col-lg-6">
                    <form action="../index.php">
                        <div ><button type="submit" class="btn btn-dark m-1 shadow-sm" >VOLVER</button></div> 
                    </form>
                </div>

                <div class="col-lg-6">
                    <form action="./agregar_pre.php">
                        <button type="submit" class="btn btn-dark m-1 shadow-sm">CREAR PREDIO</button>
                    </form>
                </div>
            </div>
   
            <br><br><br>

            <table>
                <tr>
                    <thead>
                        <th>Ficha</th>
                        <th>Propietario</th>
                        <th>Deuda Actual</th>
                        <th>Estrato</th>
                        <th>tipo de predio</th>
                        <th>Destinacion</th>
                        <th colspan= "2" style="text-align: center;"> Accion</th>
                    </thead>
                
                <tbody>
                    <?php
                        foreach($select as $producto){

                    ?>
                        <tr>
                            <td><?=$producto['ficha_cat']?></td>
                            <td><?=$producto['nombre']?></td>
                            <td><?=$producto['valor_actu']?></td>
                            <td><?=$producto['estrato']?></td>
                            <td><?=$producto['tip_predio']?></td>
                            <td><?=$producto['tipo']?></td>

                            <td style="text-align: center;">
                                <form action= "edit_product.php" method="get">
                                    <input type="hidden" name="producto" value= "<?=$producto['ficha_cat']?>">
                                    <button type= "submit" class="btn btn-dark text-white w-60 mt-4 fw-semibold shadow-sm" name = "actualizar">Editar</button>
                                </form>

                            </td>
                            <td style="text-align: center;">
                                <form action= "./eliminar_produc.php" method="get">
                                    <input type="hidden" name="eliminar" value= "<?=$producto['ficha_cat']?>">
                                    <button type="submit" class="btn btn-dark text-white w-60 mt-4 fw-semibold shadow-sm"  onclick="return confirm ('¿Desea eliminar este producto?');">Eliminar</button>
                                </form>
                            </td>
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

