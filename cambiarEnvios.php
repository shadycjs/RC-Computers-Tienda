<?php
    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    require 'funciones/categorias.php';
    require 'funciones/transportes.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    autenticar();
    $transportes = listarTransportes();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Ramiro Unrein">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="Tienda online de venta de productos informaticos">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Cambiar Envios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-publicacionesListado.css">
    <link rel="icon" type="image/x-icon" href="RC/LOGORCBLANCOSINFONDO-copia.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<main>
<?php include 'modalCerrarSesion.php';
    while( $transporte = mysqli_fetch_assoc($transportes) ){
?>
<div class="container mt-100 bg-light d-flex flex-column align-items-center">

    <div class="row d-flex align-items-center">
        <div style="height: 100px" class="col">
            <img style="height: 100%" src="images/<?= $transporte['imgTransporte'] ?>" alt="">
        </div>
        <div class="col precio">
            <input type="number" value="<?= $transporte['precioTransporte'] ?>" name="" id="">
        </div>
    </div>
</div>
<?php
    }
?>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>