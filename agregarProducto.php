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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    <div class="container-fluid bg-primary text-center m-2 text-white d-flex flex-column justify-content-between" style="min-height: 40%">
        <h1>ELEGIR EL PRODUCTO A AGREGAR</h1>
        <div class="row text-center">    
            <div class="row">
                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center item">
                    <div class="display-6 d-flex justify-content-space-between">
                        <a href="agregarMicro.php"><i class="bi bi-cpu d-flex gap-2">Microprocesador</i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center item">
                    <div class="display-6">
                        <a href="agregarMother.php"><i class="bi bi-motherboard d-flex gap-2">Motherboard</i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center item">
                    <div class="display-6">
                        <a href="agregarRam.php"><i class="bi bi-memory d-flex gap-2">Memoria ram</i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center item">
                    <div class="display-6">
                        <a href="agregarPlacaVideo.php"><i class="bi bi-gpu-card d-flex gap-2">Placa de video</i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center item">
                    <div class="display-6">
                        <a href="agregarDiscoDuro.php"><i class="bi bi-device-hdd-fill d-flex gap-2">Disco duro</i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center item">
                    <div class="display-6">
                        <a href="agregarDiscoSolido.php"><i class="bi bi-device-ssd d-flex gap-2">Disco solido</i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center item">
                    <div class="display-6">
                        <a href="agregarFuente.php"><i class="bi bi-plug d-flex gap-2">Fuente</i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center item">
                    <div class="display-6">
                        <a href=""><i class="bi bi-pc d-flex gap-2">Gabinete</i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center item">
                    <div class="display-6">
                        <a href="agregarPc.php"><i class="bi bi-pc-display d-flex gap-2">PC</i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-white">
            <a href="publicacionesListado.php" id="volverListado">VOLVER A LISTADO DE PUBLICACIONES</a>
        </div>
    </div>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>