<?php

    require 'funciones/conexionbd.php';
    require 'funciones/computadoras.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser.php';
    autenticar();
    $_SESSION['marcaPc'] = $_POST['marcaPc'];
    $_SESSION['monitor'] = $_POST['monitor'];
    $_SESSION['micro'] = $_POST['micro'];
    $_SESSION['mother'] = $_POST['mother'];
    $_SESSION['ram'] = $_POST['ram'];
    $_SESSION['video'] = $_POST['video'];
    $_SESSION['duro'] = $_POST['duro'];
    $_SESSION['solido'] = $_POST['solido'];
    $_SESSION['fuente'] = $_POST['fuente'];
    $_SESSION['gabinete'] = $_POST['gabinete'];
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Agregar Imagenes</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-agregarImagenes.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<main class="mainClass">
    <?php include 'modalCerrarSesion.php'; ?>
    <form class="container__todo" method="post" action="agregarPublicacion.php" enctype="multipart/form-data">
        <div class="container__todo__sub">    
            <h1>AGREGAR LAS IMAGENES</h1>

            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <label for="img1">ARRASTRE LA IMAGEN PRINCIPAL</label>
                    <input type="file" name="img1">
                    <img src="http://localhost/RC/Tienda/images/subirArchivo.png" alt="">
                </div>
            </div>

            <div class="container__todo__sub2--input--secun">
                <div class="container__todo__sub2--input--secun__sub">
                    <label for="img2">ARRASTRE LA IMAGEN SECUNDARIA(opcional)</label>
                    <input type="file" name="img2" id="">
                    <img src="http://localhost/RC/Tienda/images/subirArchivo.png" alt="">
                </div>
                <div class="container__todo__sub2--input--secun__sub">
                    <label for="img3">ARRASTRE LA IMAGEN SECUNDARIA(opcional)</label>
                    <input type="file" name="img3" id="">
                    <img src="http://localhost/RC/Tienda/images/subirArchivo.png" alt="">
                </div>
                <div class="container__todo__sub2--input--secun__sub">
                    <label for="img4">ARRASTRE LA IMAGEN SECUNDARIA(opcional)</label>
                    <input type="file" name="img4" id="">
                    <img src="http://localhost/RC/Tienda/images/subirArchivo.png" alt="">
                </div>
            </div>


            <div class="container__todo__sub--input--siguiente">
                <a href="agregarProducto.php">VOLVER</a>
                <input type="submit" value="SIGUIENTE" name="siguiente">
            </div>

        </div>
    </form>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>