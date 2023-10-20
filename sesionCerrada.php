<?php

    require 'funciones/conexionbd.php';
    require 'funciones/computadoras.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\header.php';
    if( isset($_POST['btnReg']) ){
        registrarUser();
    }
    $computadoras = idRandomPc();
    if( isset($_POST['btnIngresar']) ){
        login();
    }
    logout();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Tienda</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-sesionCerrada.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\login.php'
?>
<main>

    <div class="containerVisita">
        <h1>¡GRACIAS POR SU VISITA!</h1>
        <h2>No te olvides de seguirnos en nuestras redes para enterarte de ofertas especiales!</h2>
        <ul class="redesVisita">
            <li><a href="https://www.instagram.com/rc_computers_/"><ion-icon class="redesVisitaIcon" name="logo-instagram"></a> Instagram</ion-icon></li>
            <li><a href="https://www.facebook.com/people/RC-Computers/100065065447610/"><ion-icon class="redesVisitaIcon" name="logo-facebook"></ion-icon></a> Facebook</li>
        </ul>
    </div>

<?php
    if( isset($_GET['error']) ){
        $error = $_GET['error'];
        $mensaje = match( $error ){
            '1' => 'Intentelo nuevamente haciendo click aqui...',
            '2' => 'Tiene que loguearse para acceder'
        };
?>
    <div class="errorFondo"></div>
    <div class="error">
        <span class="error__icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>USUARIO Y/O CONTRASEÑA INCORRECTAS</h1>
        <p class="error__p"><?= $mensaje ?></p>
    </div>
<?php
    }
?>

    <div class="container-items" id="shopContent"> <!-- PAGINA PRINCIPAL GRID TIENDA -->
        <h1 id="prdDestacado">PRODUCTOS DESTACADOS</h1>
<?php
    while ($computadora = mysqli_fetch_assoc($computadoras)) {
?>
    
    <div class="item">
        <figure>
            <img src="http://localhost/RC/Tienda/images/<?= $computadora['img1'] ?>" alt="producto">
        </figure>
        <div class="info-producto">
            <h2><?= $computadora['nombrePc'] ?></h2>
            <p class="precio">$<?= $computadora['precioPc'] ?></p>
            <p>Stock: <?= $computadora['stockPc'] ?></p>
            <a href="http://localhost/RC/Tienda/detalleProductoLogOut.php?id=<?= $computadora['idPrd'] ?>" class="info-producto-submit">VER DETALLE</a>
        </div>
        <ul class="item__contacto">
            <li><ion-icon name="logo-whatsapp"></ion-icon>Whatsapp</li>
            <li><ion-icon name="mail"></ion-icon>Mail</li>
        </ul>
    </div>
<?php
    }
?>
    </div>
</main>

<?php
    include 'C:\xampp\htdocs\RC\Tienda\footer.php'
?>