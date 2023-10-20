<?php

    require 'funciones/conexionbd.php';
    require 'funciones/computadoras.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser.php';
    autenticar();
    $computadoras = verPcPorId( $_GET['id'] );
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Modificar Producto</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-modificarProducto.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
    <form action="resultadoModificarPublicacion.php" method="post" class="containerModal" enctype="multipart/form-data">
        <div class="containerModal__imagenes">
            <div class="imagenPrincipal">
                <H1>IMAGEN ACTUAL:</H1>
                <img src="http://localhost/RC/Tienda/images/<?= $computadora['img1'] ?>" alt="">
                <div class="imagenPrincipal__sub">
                    <b>IMAGEN PRINCIPAL NUEVA:</b>
                    <input type="file" name="img1" id="">
                    <input type="hidden" name="imgActual1" value="<?= $computadora['img1'] ?>">
                </div>
            </div>
            <hr>
            <h2 id="imgSecuAct">IMAGENES SECUNDARIAS ACTUALES:</h2>
            <ul class="ImagenesSecundarias">
                <li><img src="http://localhost/RC/Tienda/images/<?= $computadora['img2'] ?>" alt="">
                    <div class="imagenesSecundarias__sub">
                        <b>NUEVA IMAGEN:</b>
                        <input type="file" name="img2" id="">
                        <input type="hidden" name="imgActual2" value="<?= $computadora['img2'] ?>">
                    </div>    
                </li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $computadora['img3'] ?>" alt="">
                    <div class="imagenesSecundarias__sub">
                        <b>NUEVA IMAGEN:</b>
                        <input type="file" name="img3" id="">
                        <input type="hidden" name="imgActual3" value="<?= $computadora['img3'] ?>">
                    </div>  
                </li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $computadora['img4'] ?>" alt="">
                    <div class="imagenesSecundarias__sub">
                        <b>NUEVA IMAGEN:</b>
                        <input type="file" name="img4" id="">
                        <input type="hidden" name="imgActual4" value="<?= $computadora['img4'] ?>">
                    </div>  
                </li>
            </ul>
            <div class="containerModalInfoButton">
                <input type="submit" value="GUARDAR CAMBIOS" id="agregarCarrito" name="guardarCambios">
            </div>
        </div>
        <div class="containerModalInfo">
            <h1>TITULO DEL PRODUCTO:</h1>
            <input type="text" name="nombrePubli" value="<?= $computadora['nombrePc'] ?>" id="titulo">
            <hr>
            <div class="containerModalInfoDetalles">
                <div class="containerModalInfoMarcaCodigo">
                    <h4><b>MARCA: <select name="marca" id="">
                        <option value="<?= $computadora['idMarca'] ?>"><?= $computadora['nombreMarca'] ?></option>
                        <option value="1">AMD</option>
                        <option value="2">INTEL</option>
                    </select></b></h4>
                    <h4><b>CODIGO: <input type="text" name="idPrd" value="<?= $computadora['idPrd'] ?>" id="id"></b></h4>
                </div>
            </div>
            <div class="containerModalInfoPrecioCantidad">
                <div class="containerModalInfoPrecioCantidad__cantidad">
                    <h2>Stock</h2>
                    <input type="number" name="stock" value="<?= $computadora['stockPc'] ?>" id="cantidad">
                </div>
                <div class="containerModalInfoPrecioCantidad__precio">
                    <h1>PRECIO:</h1>
                    <h2><input type="number" name="precio" value="<?= $computadora['precioPc'] ?>" id="precio"></h2>   
                </div>
            </div>
            <div class="containerModalInfoEstado">
                <h2>ESTADO PUBLICACION:</h2>
                <select name="estadoPc" id="">
                    <option value="<?= $computadora['estadoPc'] ?>"><?= $computadora['estadoPc'] ?></option>
                    <option value="1">Activar</option>
                    <option value="2">Desactivar</option>
                </select>
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
                <li style="display: <?= $cssMicro ?>"><img src="http://localhost/RC/microprocesador.png" alt=""><p>Microprocesador: <b><input type="text" name="micro" value="<?= $computadora['micro'] ?>" id="micro"></b></p></li>
                <li style="display: <?= $cssMother ?>"><img src="http://localhost/RC/motherboard.png" alt=""><p>Motherboard: <b><input type="text" name="mother" value="<?= $computadora['mother'] ?>" id="mother"></b></p></li>
                <li style="display: <?= $cssRam ?>"><img src="http://localhost/RC/memoriaram.png" alt=""><p>Memoria ram: <b><input type="text" name="ram" value="<?= $computadora['ram'] ?>" id="ram"></b></p></li>
                <li style="display: <?= $cssVideo ?>"><img src="http://localhost/RC/placadevideo.png" alt=""><p>Placa de video: <b><input type="text" name="video" value="<?= $computadora['video'] ?>" id="video"></b></p></li>
                <li style="display: <?= $cssHdd ?>"><img src="http://localhost/RC/almacenamiento.png" alt=""><p>Disco duro: <b><input type="text" name="duro" value="<?= $computadora['hdd'] ?>" id="hdd"></b></p></li>
                <li style="display: <?= $cssSsd ?>"><img src="http://localhost/RC/almacenamiento.png" alt=""><p>Disco solido: <b><input type="text" name="solido" value="<?= $computadora['ssd'] ?>" id="ssd"></b></p></li>
                <li style="display: <?= $cssFuente ?>"><img src="http://localhost/RC/fuente.png" alt=""><p>Fuente: <b><input type="text" name="fuente" value="<?= $computadora['fuente'] ?>" id="fuente"></b></p></li>
                <li style="display: <?= $cssGabinete ?>"><img src="http://localhost/RC/gabinete.png" alt=""><p>Gabinete: <b><input type="text" name="gabinete" value="<?= $computadora['gabinete'] ?>" id="gabinete"></b></p></li>
                <li style="display: <?= $cssMonitor ?>"><img src="http://localhost/RC/monitor.png" alt=""><p>Monitor: <b><input type="text" name="monitor" value="<?= $computadora['monitor'] ?>" id="monitor"></b></p></li>
            </ul>
<?php
    }
?>
        </div>
        <hr>
    </form>

    <a href="publicacionesListado.php">VOLVER AL LISTADO</a>
</div>
<?php
}
?>
</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>