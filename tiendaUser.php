<?php
    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/productos.php';
    require 'funciones/usuarios.php';
    require 'funciones/autenticar.php';
    require 'funciones/clientes.php';
    session_start();
    autenticar();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    if( isset($_POST['btnReg']) ){
        registrarUser();
    }
    $productos = listarProductos();
    $resultadoBusqueda = mysqli_num_rows($productos);

    //PAGINACION
    $total_registros = totalRegistrosProductos();
    $registros_por_pagina = 6;
    $total_paginas = ceil($total_registros/$registros_por_pagina);
    $pagina_actual = isset($_GET['pagActual']) ? $_GET['pagActual'] : 1;
    $primer_registro = ($pagina_actual-1) * $registros_por_pagina;   
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

<main class="mainClass">

<div class="cerrar__sesion--fondo"></div>
    <div class="cerrar__sesion--container">
        <span class="cerrar__sesion-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>USTED ESTA POR CERRAR SESION</h1>
        <p class="error__p">¿Desea cerrar sesion?</p>
        <div class="cerrar__sesion--container__sub">
            <b id="cerrarSesionSi"><a href="sesionCerrada.php">SI</a></b>
            <b id="cerrarSesionNo">NO</b>
        </div>
</div>

<div class="container-items" id="shopContent"> <!-- PAGINA PRINCIPAL GRID TIENDA -->

    <div class="container__buscador__grilla">

        <form action="" method="get" class="container__buscador__grilla--buscador">
            <button type="submit" class="button__buscador"><ion-icon name="search-circle" class="icono__buscador"></ion-icon></button>
            <input type="search" name="search" id=""> 
        </form>

        <div class="container__resultado">
            <label for="resultado">Resultado de busqueda: (<?= $resultadoBusqueda ?>)</label>
        </div>

        <div class="container__lista__grid">
            <ion-icon name="list" class="icono__lista__grid" id="list"></ion-icon>
            <ion-icon name="grid" class="icono__lista__grid" id="grid"></ion-icon>
        </div>

    </div>

<?php
    if($resultadoBusqueda == 0){
?>
    <div class="container__todo__sinResultados">
        <h1>NO HAY RESULTADOS DE BUSQUEDA</h1>
        <ion-icon name="ban" id="iconoSinProductosCarrito"></ion-icon>
    </div>
<?php
    }
?>

<?php
    while($producto = mysqli_fetch_assoc($productos)) {
?>
    <div class="item">
        <figure>
            <img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="producto">
        </figure>
        <div class="info-producto">
            <h2><?= $producto['nombreCategoria'], ' '.$producto['nombreMarca'], ' '.$producto['nombrePrd'] ?></h2>
            <p class="precio">$<?= number_format($producto['precioPrd'], 2, ',', '.') ?></p>
            <p>Stock: <?= $producto['stockPrd'] ?></p>
            <a href="http://localhost/RC/Tienda/detalleProductoUser.php?id=<?= $producto['idPrd'] ?>&idCategoria=<?= $producto['idCategoria'] ?>" class="info-producto-submit">VER DETALLE</a>
        </div>
        <ul class="item__contacto">
            <li><ion-icon name="logo-whatsapp"></ion-icon>Whatsapp</li>
            <li><ion-icon name="mail"></ion-icon>Mail</li>
        </ul>
    </div>
<?php
    }
?>

    <div class="container__todo__paginacion">
        <div class="container__todo__paginacion__sub">
            <div class="container__todo__paginacion__sub--numeracion">
<?php
    if($pagina_actual > 1){
?>
                <a href="tiendaUser.php?pagActual=<?= $pagina_actual-1 ?>">Anterior</a>
<?php
    }
?>
<?php
            for($i=1; $i<$total_paginas+1; $i++){
?>
                <a href="tiendaUser.php?pagActual=<?= $i ?>"><?= $i ?></a>
<?php
            }
?>

<?php
    if($pagina_actual < $total_paginas){
?>
                <a href="tiendaUser.php?pagActual=<?= $pagina_actual+1 ?>">Siguiente</a>
<?php
    }
?>
            </div>
        </div>
    </div>
    </div>
    
    <?php include 'C:\xampp\htdocs\RC\Tienda\categoriasAside.php'; ?>

</main>

<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>