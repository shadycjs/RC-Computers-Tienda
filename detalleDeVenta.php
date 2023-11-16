<?php

    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/compras.php';
    require 'funciones/clientes.php';
    error_reporting(-1);
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    if( isset($_POST['btnReg']) ){
        registrarUser();
    }
    if( isset($_POST['btnIngresar']) ){
        login();
    };
    $rol = verRol();

    if( isset($_POST['cambiarImgPerfil']) ){
        $modificaImg = modificarImgPerfil();
    };
    $compras = verDetalleCompra();
    $conteoCompras = mysqli_num_rows($compras);
    $usuarios = verUsuarioPorId();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Configuracion usuario</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-detalleDeVenta.css">
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
<main class="mainClass">
    
<?php include 'modalCerrarSesion.php'; ?>


    <div class="container__todo">

        <div class="container__todo__sub">

            <div class="container__todo__compras__sub">
                <?php
                    if( $conteoCompras <= 0 ){
                ?>

                        <h1>NO TIENES COMPRAS AUN...</h1>

                <?php
                    }else{
                ?>
                        <h1>DETALLE DE LA COMPRA NRO <?= $_GET['nroVenta'] ?></h1>

                        <table class="container__todo__compras__sub--table">

                            <tr class="container__todo__compras__sub--table-tr-1">
                                <td>Fecha</td>
                                <td>Importe Unitario</td>
                                <td>Cantidad</td>
                                <td>Condicion de pago</td>
                                <td>Nombre producto</td>
                                <td>Transporte</td>
                            </tr>

                <?php
                    while( $compra = mysqli_fetch_assoc($compras) ){
                ?>
                            <tr id="container__todo__compras__sub--table-tr-2">
                                <td><?= $compra['fecha'] ?></td>
                                <td>$<?= number_format($compra['importe'], 2) ?></td>
                                <td><?= $compra['cantidad'] ?></td>
                                <td><?= $compra['condicionPago'] ?></td>
                                <td><?= $compra['nombrePrd'] ?></td>
                                <td><?= $compra['transporte'] ?></td>
                            </tr>
                <?php
                    }
                }
                ?>
                        </table>
                        
            </div>
            <a href="configuracionUser.php">VOLVER A CONFIGURACION</a>
        </div>
</div>








<?php
    if( isset($_GET['error']) == 1 ){
?>
<div class="error__cambioClave--fondo"></div>
    <div class="error__cambioClave--container">
        <span class="error__cambioClave-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>ERROR AL CAMBIAR LA CLAVE, LAS CREDENCIALES NO COINCIDEN</h1>
        <div class="error__cambioClave-intentarDeNuevo">Intentarlo nuevamente...</div>
    </div>
</div>
<?php
    }
?>

</main>

<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>