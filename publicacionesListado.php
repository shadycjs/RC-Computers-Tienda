<?php

    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    autenticar();
    $productos = buscarProductoPublicacionesListado();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Publicaciones</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-publicacionesListado.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<main class="mainClass">
<?php include 'modalCerrarSesion.php'; ?>

    <h1>PUBLICACIONES</h1>
    <div class="container__agregarPubli">
        <a href="agregarProducto.php"><ion-icon name="cloud-upload"></ion-icon> AGREGAR PUBLICACION NUEVA </a>
    </div>

    <form action="" method="get" class="container__buscador__grilla--buscador">
        <button type="submit" class="button__buscador"><ion-icon name="search-circle" class="icono__buscador"></ion-icon></button>
        <input type="search" name="search" id=""> 
    </form>

    <div class="container-items" id="shopContent"> <!-- PAGINA PRINCIPAL GRID TIENDA -->
<?php
    while ($producto = mysqli_fetch_assoc($productos)) {
?>

    <div class="item">
        <figure>
            <img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="producto">
        </figure>
        <div class="info-producto">
            <h2><?= $producto['nombreCategoria'], ' '.$producto['nombreMarca'], ' '.$producto['nombrePrd'] ?></h2>
            <p class="precio">$<?= $producto['precioPrd'] ?></p>
            <p>Stock: <?= $producto['stockPrd'] ?></p>
            <div class="info-producto__buttons">
                <a href="http://localhost/RC/Tienda/detalleProductoUser.php?id=<?= $producto['idPrd'] ?>&idCategoria=<?= $producto['idCategoria'] ?>" class="info-producto-submit">VER DETALLE</a>
                <a href="http://localhost/RC/Tienda/eliminarProducto.php?id=<?= $producto['idPrd'] ?>" class="info-producto-submit" id="buttonEliminar">ELIMINAR PRODUCTO</a>
                <a href="http://localhost/RC/Tienda/modificarProducto.php?id=<?= $producto['idPrd'] ?>&idCategoria=<?= $producto['idCategoria']?>&idMarca=<?= $producto['idMarca'] ?>" class="info-producto-submit" id="buttonModificar">MODIFICAR PRODUCTO</a>
            </div>
        </div>

    </div>
<?php
    }
?>
    </div>

</main>

<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>