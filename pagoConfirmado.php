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
        // Preguntamos si recibimos el comprobante de pago, en caso de no recibirlo lo redireccionamos a la pagina anterior
        if($_FILES['comprobantePago']['error'] != 0){
            header('location: carritoContinuarCompraPagoFinalizar.php?error=1');
        }else{
            $comprobante = subirComprobante();
            // Agregamos los productos que estaban en la session a la base de datos
            foreach($_SESSION['CARRITO'] as $indice => $producto){
                $agregarOrden = agregarOrdenVenta($producto['id'],$producto['precio'],$comprobante, $producto['cantidad']);
            }
            //Enviamos el mail al comprador con los datos de la compra
            $enviarMailComprador = enviarMailComprador($_SESSION['usuNombre']);
            //Enviamos el mail al vededor avisandole de la compra y de sus datos
            $enviarMailVendedor = enviarMailVendedor($_SESSION['usuNombre'], $_SESSION['usuApellido']);

            //Vaciamos las sesiones del carrito
            unset($_SESSION['CARRITO']);
            unset($_SESSION['nroVenta']);
        }


?>

<!DOCTYPE html>
<html>

<?php 
    $estiloCss = 'estilo-pagoConfirmado.css';
    $descTitulo = 'Pago Confirmado';
    include 'C:\xampp\htdocs\RC\Tienda\head.php' 
?>

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

                <div class="container__todo__pagoConfirmado__sub">
                    <ion-icon name="bag-check" class="IconCompraConf"></ion-icon>
                    <h1>¡COMPRA CONFIRMADA CON EXITO!</h1>
                </div>

                <div class="container__todo__pagoConfirmado__sub .descripcion d-flex flex-column">
                    <p>Te recordamos que la confirmacion del pago puede demorar hasta 48hs habiles.</p>
                    <b>Te enviamos un e-mail con toda la informacion de tu pedido!</b>
                </div> 
                
            </div>
            <button type="button" class="btn btn-outline-success"><a href="tiendaUser.php">VOLVER A CATALOGO</a></button>
        </form>
    </div>

</main>
<?php
    if($total == 0){
        header('location: tiendaUser.php');
    }
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>