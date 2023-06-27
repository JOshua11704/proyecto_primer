<?php

    require("control/concexion.php");
    $db = new Database();
    $conectar = $db->conectar();
    session_start();




if ($_GET["btnloginx"]){

    // datos recibidos del index

    $usu = $_GET['usu'];
    $pass = $_GET['pass'];



        ///hacer consulta de documento - usuario - contraseña - estado. recibidos del index

    $consul = $conectar->prepare("SELECT password FROM usuarios WHERE user = '$usu'");
    $consul->execute();
    $fila = $consul->fetch();

        if($fila == true){
            $consultar = $conectar->prepare("SELECT * FROM usuarios WHERE user = '$usu'");
            $consultar->execute();
            $consultado = $consultar->fetch();

            $validacontra= $fila['password'];

            $password = password_verify($pass,$validacontra);

            if($consultado==true){



                // preparar la forma de ejecutar la fecha y hora actual de la región que que escoja 

                date_default_timezone_set("America/Bogota");
                $fecha = date('Y-m-d');
                $hora = date('H:i:s');

                ///si el usuario y la clave son correctas, creamos variables globales

                $docu= $consultado['documento'];

                $_SESSION['doc_type'] = $consultado['documento'];
                $_SESSION['name'] = $consultado['nombre'];
                $_SESSION['rol'] = $consultado['id_rol'];
                $_SESSION['user'] = $consultado['user'];
                $_SESSION['estado'] = $consultado['id_estado'];


                $fecha = $conectar->prepare("INSERT INTO fecha (fecha, hora, documento)VALUES('$fecha','$hora','$docu')");
                $fecha->execute();



                ///dependiendo del tipo de usuario lo redireccionamos

                //administrador

                if ($_SESSION['rol'] == 1) {
                    header("Location: vista/admin/index.php");
                    exit();
                }

                //instructor
                else if ($_SESSION['rol'] == 2) {
                    header("Location: vista/trabajador/index.php");
                    exit();
                }


                //aprendiz
                else if ($_SESSION['rol'] == 3) {
                    header('Location: vista/cliente/index.php');
                    exit();
                }
            }else {
            ///si el usuario y la clave son incorrectas lo lleva a la pagina
            echo "<script> alert ('Los datos recibidos son erroneos o su usuario está bloqueado');</script>";
            echo '<script>window.location="index.html"</script>';
        }
    }
} else {
    ///si el usuario y la clave son incorrectas lo lleva a la pagina
    echo "<script> alert ('ERROR__001');</script>";
    echo '<script>window.location="index.html"</script>';
    exit();
}


?>
        
        