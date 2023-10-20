<?php

    require 'funciones/conexionbd.php';
    require 'funciones/computadoras.php';
    include 'C:\xampp\htdocs\RC\Tienda\headerAdmin.php';
    $computadoras = listarPC();
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
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-tienda.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<main>

    <div class="container-items" id="shopContent"> <!-- PAGINA PRINCIPAL GRID TIENDA -->
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
            <p>Stock: <?= $computadora['cantidadPc'] ?></p>
            <a href="http://localhost/RC/Tienda/detalleProductoAdmin.php?id=<?= $computadora['idPrd'] ?>" class="info-producto-submit">VER DETALLE</a>
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
    
    <?php include 'C:\xampp\htdocs\RC\Tienda\categoriasAside.php'; ?>

</main>

<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerAdmin.php'
?>