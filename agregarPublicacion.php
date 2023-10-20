<?php

    require 'funciones/conexionbd.php';
    require 'funciones/computadoras.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser.php';
    autenticar();

    if( isset($_POST['siguiente']) ){

        $_SESSION['img1'] = subirImagen();

        $_SESSION['img2'] = subirImagen2();
    
        $_SESSION['img3'] = subirImagen3();
    
        $_SESSION['img4'] = subirImagen4();
    
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Agregar Publicacion</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-agregarPublicacion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<main class="mainClass">
    <?php include 'modalCerrarSesion.php'; ?>
    <div class="container__todo">
        <form class="container__todo__sub" method="post" action="resultadoAgregarPublicacion.php" enctype="multipart/form-data">    
            <h1>DATOS DE PUBLICACION</h1>

            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                <label for="nombrePubli">Nombre de publicacion</label>
                    <input type="text" name="nombrePubli" id="" placeholder="Por Ej. PC Gamer Intel Core...">
                </div>
            </div>

            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                <label for="precio">Precio</label>
                    <input type="number" name="precio" id="" placeholder="Por Ej. $240.000...">
                </div>
                <div class="container__todo__sub2--input">
                <label for="stock">Stock</label>
                    <input type="number" name="stock" id="" placeholder="Por Ej. 3...">
                </div>
            </div>

            <div class="container__todo__sub--input" id="containerTextarea">
                <div class="container__todo__sub2--input">
                <label for="description">Descripcion</label>
                    <textarea name="descripcion" id="" cols="30" rows="10" placeholder="Por Ej. Equipo gamer..."></textarea>
                </div>
            </div>

            <input type="hidden" name="img1" value="<?= $_SESSION['img1'] ?>">
            <input type="hidden" name="img2" value="<?= $_SESSION['img2'] ?>">
            <input type="hidden" name="img3" value="<?= $_SESSION['img3'] ?>">
            <input type="hidden" name="img4" value="<?= $_SESSION['img4'] ?>">


            <div class="container__todo__sub--input--siguiente">
                <a href="agregarProducto.php">VOLVER</a>
                <input type="submit" value="PUBLICAR" name="publicar">
            </div>


        </form>
    </div>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>