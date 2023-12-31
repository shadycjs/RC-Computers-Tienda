<?php

    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    include 'C:\xampp\htdocs\RC\Tienda\login.php';
    include 'C:\xampp\htdocs\RC\Tienda\header.php';
    $computadoras = verPrdPorId( $_GET['id'] );

    if( isset($_POST['btnIngresar']) ){
        login();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Detalle Producto</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-detalleProductoLogOut.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
</head>

<main>
<?php
    while( $computadora = mysqli_fetch_assoc( $computadoras ) ){
?> 
<div class="containerTodo">    
    <div class="containerModal">
        <div class="containerModal__imagenes">
            <div class="imagenPrincipal">
                <img src="http://localhost/RC/Tienda/images/<?= $computadora['img1'] ?>" alt="">
            </div>
            <ul class="ImagenesSecundarias">
                <li><img src="http://localhost/RC/Tienda/images/<?= $computadora['img2'] ?>" alt=""></li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $computadora['img3'] ?>" alt=""></li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $computadora['img4'] ?>" alt=""></li>
            </ul>
        </div>
        <div class="containerModalInfo">
            <h1><?= $computadora['nombrePc'] ?></h1>
            <hr>
            <div class="containerModalInfoDetalles">
                <div class="containerModalInfoMarcaCodigo">
                    <h4><b>MARCA: <?= $computadora['nombreMarca'] ?></b></h4>
                    <h4><b>CODIGO: <?= $computadora['idPrd'] ?></b></h4>
                </div>
                <ul class="containerModalInfoGarantias">
                    <li><ion-icon style="color: green" name="shield-checkmark"></ion-icon><h6>GARANTIA</h6></li>
                    <li><ion-icon style="color: green" name="airplane"></ion-icon><h6>ENVIOS A TODO EL PAIS</h6></li>
                    <li><ion-icon style="color: green" name="checkmark-circle"></ion-icon></ion-icon><h6>STOCK DISPONIBLE</h6></li>
                </ul>
            </div>
            <div class="containerModalInfoPrecioCantidad">
                <div class="containerModalInfoPrecioCantidad__cantidad">
                    <h2>Cantidad</h2>
                    <input type="number" name="" value="<?= $computadora['cantidadPc'] ?>">
                </div>
                <div class="containerModalInfoPrecioCantidad__precio">
                    <h2>$<?= $computadora['precioPc'] ?></h2>   
                </div>
            </div>
            <hr>
            <ul class="containerModalInfoConfig">
<?php
    $cssMicro = 'flex';
    $cssMother = 'flex';
    $cssRam = 'flex';
    $cssVideo = 'flex';
    $cssHdd = 'flex';
    $cssSsd = 'flex';
    $cssFuente = 'flex';
    $cssGabinete = 'flex';
    $cssMonitor = 'flex';
    if($computadora['micro'] == ''){
        $cssMicro = 'none';
    }
    if($computadora['mother'] == ''){
        $cssMother = 'none';
    }
    if($computadora['ram'] == ''){
        $cssRam = 'none';
    }
    if($computadora['video'] == ''){
        $cssVideo = 'none';
    }
    if($computadora['hdd'] == ''){
        $cssHdd = 'none';
    }
    if($computadora['ssd'] == ''){
        $cssSsd = 'none';
    }
    if($computadora['fuente'] == ''){
        $cssFuente = 'none';
    }
    if($computadora['gabinete'] == ''){
        $cssGabinete = 'none';
    }
    if($computadora['monitor'] == ''){
        $cssMonitor = 'none';
    }

    if($computadora['micro'] == '' && $computadora['mother'] == '' && $computadora['ram'] == '' && $computadora['video'] == '' &&
       $computadora['hdd'] == '' && $computadora['ssd'] == '' && $computadora['fuente'] == '' &&  $computadora['gabinete'] == ''
       && $computadora['monitor'] == ''){
?> 
        <H1 style="text-align: center">ESTE EQUIPO NO TIENE NINGÚN COMPONENTE CARGADO</H1>

<?php
       }else{
?>
                <h3>CONFIGURACION DEL EQUIPO:</h3>
                <li style="display: <?= $cssMicro ?>"><img src="http://localhost/RC/microprocesador.png" alt=""><p>Microprocesador: <b><?= $computadora['micro'] ?></b></p></li>
                <li style="display: <?= $cssMother ?>"><img src="http://localhost/RC/motherboard.png" alt=""><p>Motherboard: <b><?= $computadora['mother'] ?></b></p></li>
                <li style="display: <?= $cssRam ?>"><img src="http://localhost/RC/memoriaram.png" alt=""><p>Memoria ram: <b><?= $computadora['ram'] ?></b></p></li>
                <li style="display: <?= $cssVideo ?>"><img src="http://localhost/RC/placadevideo.png" alt=""><p>Placa de video: <b><?= $computadora['video'] ?></b></p></li>
                <li style="display: <?= $cssHdd ?>"><img src="http://localhost/RC/almacenamiento.png" alt=""><p>Disco duro: <b><?= $computadora['hdd'] ?></b></p></li>
                <li style="display: <?= $cssSsd ?>"><img src="http://localhost/RC/almacenamiento.png" alt=""><p>Disco solido: <b><?= $computadora['ssd'] ?></b></p></li>
                <li style="display: <?= $cssFuente ?>"><img src="http://localhost/RC/fuente.png" alt=""><p>Fuente: <b><?= $computadora['fuente'] ?></b></p></li>
                <li style="display: <?= $cssGabinete ?>"><img src="http://localhost/RC/gabinete.png" alt=""><p>Gabinete: <b><?= $computadora['gabinete'] ?></b></p></li>
                <li style="display: <?= $cssMonitor ?>"><img src="http://localhost/RC/monitor.png" alt=""><p>Monitor: <b><?= $computadora['monitor'] ?></b></p></li>
            </ul>
            <div class="containerModalInfoButton">
                <input type="submit" value="AGREGAR AL CARRITO" id="agregarCarrito">
            </div>
<?php
    }
?>
        </div>

    </div>

    <a href="tiendaLogOut.php">VOLVER A CATALOGO</a>
</div>
<?php
}
?>
</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footer.php'
?>