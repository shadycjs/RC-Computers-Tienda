<?php

    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    autenticar();

    if( isset($_GET['id']) ){
        $eliminarProducto = eliminarProducto($_GET['id']);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Resultado modificar publicacion</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-agregarPublicacion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<main>

<?php
    if( $eliminarProducto ){
?>
    <div class="container__todo">
        <div class="container__todo__sub">    
            <h1 style="color: green">SE ELIMINO EL PRODUCTO CORRECTAMENTE</h1>
            <a style="color: #000" href="publicacionesListado.php">VOLVER AL LISTADO</a>
        </div>
    </div>
<?php
    }else{
?>
    <div class="container__todo">
        <div class="container__todo__sub">    
            <h1 style="color: red">HUBO UN ERROR AL ELIMINAR EL PRODUCTO</h1>
            <a  style="color: #000" href="publicacionesListado.php">VOLVER A PARA INTENTARLO NUEVAMENTE...</a>
        </div>
    </div>
<?php
    }
?>
</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footer.php'
?>