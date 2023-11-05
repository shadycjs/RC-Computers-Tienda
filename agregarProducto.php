<?php

    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/clientes.php';
    require 'funciones/usuarios.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    autenticar();
 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Agregar Pc</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-agregarProducto.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<main class="mainClass">
    <?php include 'modalCerrarSesion.php'; ?>
    <div class="container__todo">
        <h1>ELEGIR EL PRODUCTO A AGREGAR</h1>
        <div class="container__todo__sub">    

            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <a href="agregarMicro.php"><img src="http://localhost/RC/microprocesador.png" alt="">Microprocesador</a>
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <a href="agregarMother.php"><img src="http://localhost/RC/motherboard.png" alt="">Motherboard</a>
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <a href="agregarRam.php"><img src="http://localhost/RC/memoriaram.png" alt="">Memoria ram</a>
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <a href=""><img src="http://localhost/RC/placadevideo.png" alt="">Placa de video</a>
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <a href=""><img src="http://localhost/RC/almacenamiento.png" alt="">Disco duro</a>
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <a href=""><img src="http://localhost/RC/almacenamiento.png" alt="">Disco solido</a>
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <a href=""><img src="http://localhost/RC/fuente.png" alt="">Fuente</a>
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <a href=""><img src="http://localhost/RC/gabinete.png" alt="">Gabinete</a>
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <a href="agregarPc.php"><img src="http://localhost/RC/monitor.png" alt=""> PC</a>
                </div>
            </div>

        </div>
        <a href="publicacionesListado.php" id="volverListado">VOLVER A LISTADO DE PUBLICACIONES</a>
    </div>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>