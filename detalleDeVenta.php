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

    if( isset($_GET['numeroVenta']) ){
        $bajarCompro = bajarComprobante();
    }

    if( isset($_GET['numVentaFactura']) ){
        $bajarFactura = bajarFactura();
    }


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

                        <div class="container__todo__detalleVenta">
                            <div class="container__todo__detalleVenta--tituloFecha">
                                <h1>Detalle de la compra NRO <?= $_GET['nroVenta'] ?></h1>
                                <h2>Fecha: <?= $_GET['fecha'] ?></h2>
                            </div>
                            <div class="container__todo__detalleVenta__sub">
                <?php
                    while( $compra = mysqli_fetch_assoc($compras) ){
                ?>
                         

                            <div class="container__todo__detalleVenta__sub--producto">
                                <h3><?= $compra['cantidad'] ?> x <?= $compra['nombrePrd'] ?></h3>
                                <div class="container__todo__detalleVenta__subProducto--precio">
                                    <h3>$<?= number_format($compra['importe'], 2) ?></h3>
                                </div>
                            </div>



                         

                <?php
                    $total = $total+($compra['importe']*$compra['cantidad'])+$_GET['envio'];
                    }
                    $detalleDeVenta = 'detalleDeVenta';
                    if($_GET['comprobantePago'] == 'Aun sin emitir'){
                        $detalleDeVenta = 'subirComprobantePago';
                    }
                ?>
                                <div class="container__todo__detalleVenta__sub--envioTransporte">
                                    <h3>ENVIO</h3>
                                    <div class="container__todo__detalleVenta__sub--transporte">
                                        <h2><?= $_GET['transporte'] ?></h2>
                                        <h2>$<?= $_GET['envio'] ?></h2>
                                    </div>
                                </div>

                                <div class="container__todo__detalleVenta__sub--facturaComprobante">
                                    <div class="container__todo__detalleVenta__sub--comprobante">
                                        <h3>Comprobante de pago</h3>
                                        <a href="<?= $detalleDeVenta ?>.php?idOrdenVenta=<?= $_GET['idOrdenVenta'] ?>&nroVenta=<?= $_GET['nroVenta'] ?>&factura=<?= $_GET['factura'] ?>&fecha=<?= $_GET['fecha'] ?>&envio=<?= $_GET['envio'] ?>&transporte=<?= $_GET['transporte'] ?>&comprobantePago=<?= $_GET['comprobantePago'] ?>&numeroVenta=<?= $_GET['nroVenta'] ?>"><?= $_GET['comprobantePago'] != 'Aun sin emitir'? $_GET['comprobantePago'] : $subirFacturaString = 'SUBIR COMPROBANTE'; ?></a>
                                    </div>
                                    <div class="container__todo__detalleVenta__sub--factura">
                                        <h3>Factura</h3>
                                        <a href="detalleDeVenta.php?numVentaFactura=<?= $_GET['nroVenta'] ?>&idOrdenVenta=<?= $_GET['idOrdenVenta'] ?>&factura=<?= $_GET['factura'] ?>&fecha=<?= $_GET['fecha'] ?>&envio=<?= $_GET['envio'] ?>&transporte=<?= $_GET['transporte'] ?>"><?= $_GET['factura'] ?></a>   
                                    </div>
                                </div>

                                <div class="container__todo__detalleVenta__sub--total">
                                    <h3>TOTAL</h3>
                                    <h2>$<?= number_format($total, 0, ',', '.') ?></h2>
                                </div>

                            </div> 
                        </div>

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