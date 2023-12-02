<?php

    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    require 'funciones/compras.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    $actualizarFactura = actualizarFactura();
    $subirFactura = subirFactura();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Pago Confirmado</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-resultadoSubirComprobantePago.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
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

    <div class="containerTodo" id="formulario">   
        <form class="containerModal">

            <div class="container__todo__pagoConfirmado">
<?php
    if( $subirFactura != 'Aun sin emitir' ){
?>
                <div class="container__todo__pagoConfirmado__sub">
                    <h1>¡SUBISTE LA FACTURA PARA LA ORDEN DE VENTA NRO <?= $_GET['nroVenta'] ?>!</h1>
                    <ion-icon name="checkmark-circle" class="iconoCheck"></ion-icon>
                </div>

                <div class="container__todo__pagoConfirmado__sub .descripcion">
                    <a href="configuracionAdmin.php">VOLVER</a>
                </div> 
<?php
    }else{
?>
                <div class="container__todo__pagoConfirmado__sub">
                    <h1>¡ERROR AL SUBIR LA FACTURA PARA LA ORDEN DE VENTA NRO <?= $_GET['nroVenta'] ?>!</h1>
                    <ion-icon name="close-circle" class="iconoCruz"></ion-icon>
                </div>

                <div class="container__todo__pagoConfirmado__sub .descripcion">
                    <a href="configuracionAdmin.php">VOLVER</a>
                </div> 
<?php
    }
?>
            </div>
        <a href="tiendaUser.php">VOLVER A CATALOGO</a>
        </form>
    </div>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>