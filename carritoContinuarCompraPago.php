<?php

    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    session_start();
    if(isset($_POST['sig'])){
        $expresionRegularTelefono = '/^(?:(?:00)?549?)?0?(?:11|[2368]\d)(?:(?=\d{0,2}15)\d{2})??\d{8}$/D';
        $telefonoCliente = $_POST['telRecep'];
        if(!preg_match($expresionRegularTelefono,$telefonoCliente)) {
            header('location: carritoContinuarCompra.php?error=4');
        } 
        $expresionRegularDni = '/[0-9]{7,8}/';
        $dniCliente = $_POST['dniCuilRecep'];
        if(!preg_match($expresionRegularDni,$dniCliente)) {
            header('location: carritoContinuarCompra.php?error=5');
        }
        $clientePorId = listarClientePorId();
        if($clientePorId == null){
            $insertarCliente = agregarCliente();
        }else{
            $modificarCliente = modificarCliente();
        }

        if($_POST['transporte'] == 'andreani'){
            $_SESSION['transporte'] = 'Andreani';
            $_SESSION['envio'] = $_POST['precioAndreani'];
        }elseif($_POST['transporte'] == 'oca'){
            $_SESSION['transporte'] = 'Oca';
            $_SESSION['envio'] = $_POST['precioOca'];
        }else{
            header('location: carritoContinuarCompra.php?error=3');
        } 
    }
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Carrito de compras - Metodo de pago</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-carritoContinuarCompraPago.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
</head>


<main class="mainClass">

<div class="container__timelapse">

    <div class="container__timelapse__productos">
        <h2 class="prdH2">PRODUCTOS</h2>
    </div>

    <div class="container__timelapse__envio">
        <h2 class="enviodH2">ENVIO</h2>
    </div>

    <div class="container__timelapse__pago">
        <h2 id="pagoH2">FORMA DE PAGO</h2>
    </div>
    
    <div class="container__timelapse__confirmarCompra">
        <h2 id="confH2">CONFIRMAR COMPRA</h2>
    </div>

</div>

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

<?php
    if( isset($_GET['error']) ){
        $error = $_GET['error'];

        $mensaje = match( $error ){
            '1' => 'Debe completar todos los campos',
            '2' => 'Tiene que loguearse para ingresar al sitio',
            '3' => 'Debe elegir entre los medios de pago ofrecidos para continuar con su compra'
        };

        $mensaje2 = match( $error ){
            '1' => 'ERROR AL INGRESAR LOS DATOS DE ENVIO',
            '2' => 'NO TIENE PERMISO PARA ACCEDER',
            '3' => 'DEBE SELECCIONAR UNA FORMA DE PAGO'
        }
?>
    <div class="errorFondo"></div>
    <div class="error">
        <span class="error__icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1><?= $mensaje2 ?></h1>
        <p class="error__p"><?= $mensaje ?></p>
    </div>
<?php
    }
?>

    <div class="containerTodo" id="formulario">   
        <form method="post" action="carritoContinuarCompraPagoFinalizar.php" class="containerModal">
            <h2>SELECCIONE SU METODO DE PAGO PREFERIDO</h2>

            <div class="container__todo__mediosPago">

                <div class="container__todo__mediosPago--sub paypal">
                    <h3>Paypal</h3>
                    <div class="container__todo__mediosPago--sub-img paypal">
                        <img src="images/paypallogo.png" alt="">
                    </div>
                    <input type="radio" name="medioPago" id="paypal" value="PayPal">
                </div>

                <div class="container__todo__mediosPago--sub mercadoPago">
                    <h3>MercadoPago</h3>
                    <div class="container__todo__mediosPago--sub-img mercadoPago">
                        <img src="images/logomercadopago.jpg" alt="">
                    </div>
                    <input type="radio" name="medioPago" id="mercadopago" value="MercadoPago">
                </div>

                <div class="container__todo__mediosPago--sub banco">
                    <h3>Deposito/Transferencia Bancaria</h3>
                    <div class="container__todo__mediosPago--sub-img banco">
                        <img src="images/bancarialogo.png" alt="">
                    </div>
                    <input type="radio" name="medioPago" id="banco" value="Transf/Depo Bancario">
                </div>

            </div>

            <div class="container__siguente">
                <div id="anterior">ANTERIOR</div>
                <input type="submit" value="SIGUIENTE" id="contadorSiguienteInput">
            </div>

            <a href="tiendaUser.php">VOLVER A CATALOGO</a>
        </form>
    </div>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>