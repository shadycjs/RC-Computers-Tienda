<?php

    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    require 'funciones/marcas.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    autenticar();
    $productos = verPrdPorId( $_GET['id'] );
    $marcas = listarMarcas();
    if( $_GET['idCategoria'] == 1 ){
        $_SESSION['idCategoria'] = 1;
    }
    if( $_GET['idCategoria'] == 2 ){
        $_SESSION['idCategoria'] = 2;
    }
    if( $_GET['idCategoria'] == 3 ){
        $_SESSION['idCategoria'] = 3;
    }
    if( $_GET['idCategoria'] == 4 ){
        $_SESSION['idCategoria'] = 4;
    }
    if( $_GET['idCategoria'] == 5 ){
        $_SESSION['idCategoria'] = 5;
    }
    if( $_GET['idCategoria'] == 6 ){
        $_SESSION['idCategoria'] = 6;
    }
    if( $_GET['idCategoria'] == 7 ){
        $_SESSION['idCategoria'] = 7;
    }
    if( $_GET['idCategoria'] == 8 ){
        $_SESSION['idCategoria'] = 8;
    }
    if( $_GET['idCategoria'] == 9 ){
        $_SESSION['idCategoria'] = 9;
    }
    if( $_GET['idCategoria'] == 10 ){
        $_SESSION['idCategoria'] = 10;
    }
    if( $_GET['idCategoria'] == 11 ){
        $_SESSION['idCategoria'] = 11;
    }
    if( $_GET['idCategoria'] == 12 ){
        $_SESSION['idCategoria'] = 12;
    }
    if( $_GET['idCategoria'] == 13 ){
        $_SESSION['idCategoria'] = 13;
    }
    if( $_GET['idCategoria'] == 14 ){
        $_SESSION['idCategoria'] = 14;
    }
    if( $_GET['idCategoria'] == 15 ){
        $_SESSION['idCategoria'] = 15;
    }
    var_dump($_SESSION['idCategoria']);
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
    while( $producto = mysqli_fetch_assoc( $productos ) ){
?> 
<div class="containerTodo">    
    <form action="resultadoModificarPublicacion.php" method="post" class="containerModal" enctype="multipart/form-data">
        <div class="containerModal__imagenes">
            <div class="imagenPrincipal">
                <H1>IMAGEN ACTUAL:</H1>
                <img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="">
                <div class="imagenPrincipal__sub">
                    <b>IMAGEN PRINCIPAL NUEVA:</b>
                    <input type="file" name="img1" id="">
                    <input type="hidden" name="imgActual1" value="<?= $producto['img1'] ?>">
                </div>
            </div>
            <hr>
            <h2 id="imgSecuAct">IMAGENES SECUNDARIAS ACTUALES:</h2>
            <ul class="ImagenesSecundarias">
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img2'] ?>" alt="">
                    <div class="imagenesSecundarias__sub">
                        <b>NUEVA IMAGEN:</b>
                        <input type="file" name="img2" id="">
                        <input type="hidden" name="imgActual2" value="<?= $producto['img2'] ?>">
                    </div>    
                </li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img3'] ?>" alt="">
                    <div class="imagenesSecundarias__sub">
                        <b>NUEVA IMAGEN:</b>
                        <input type="file" name="img3" id="">
                        <input type="hidden" name="imgActual3" value="<?= $producto['img3'] ?>">
                    </div>  
                </li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img4'] ?>" alt="">
                    <div class="imagenesSecundarias__sub">
                        <b>NUEVA IMAGEN:</b>
                        <input type="file" name="img4" id="">
                        <input type="hidden" name="imgActual4" value="<?= $producto['img4'] ?>">
                    </div>  
                </li>
            </ul>
            <div class="containerModalInfoButton">
                <input type="submit" value="GUARDAR CAMBIOS" id="agregarCarrito" name="guardarCambios">
            </div>
        </div>
        <div class="containerModalInfo">
            <h1>TITULO DEL PRODUCTO:</h1>
            <input type="text" name="nombrePubli" value="<?= $producto['nombrePrd'] ?>" id="titulo">
            <hr>
            <div class="containerModalInfoDetalles">
                <div class="containerModalInfoMarcaCodigo">
                    <h4><b>MARCA: <select name="marca" id="">
<?php
        while( $marca = mysqli_fetch_assoc( $marcas ) ){
?>
                        <option <?= ( $marca['idMarca'] == $_GET['idMarca'] ) ? 'selected' : '' ?> value="<?= $marca['idMarca'] ?>"><?= $marca['nombreMarca'] ?></option>
<?php
        }
?>
                    </select></b></h4>
                    <h4><b>CODIGO: <input type="text" name="idPrd" value="<?= $producto['idPrd'] ?>" id="id"></b></h4>
                </div>
            </div>
            <div class="containerModalInfoPrecioCantidad">
                <div class="containerModalInfoPrecioCantidad__cantidad">
                    <h2>Stock</h2>
                    <input type="number" name="stock" value="<?= $producto['stockPrd'] ?>" id="cantidad">
                </div>
                <div class="containerModalInfoPrecioCantidad__precio">
                    <h1>PRECIO:</h1>
                    <h2>$<input type="number" name="precio" step="0.01" value="<?= $producto['precioPrd'] ?>" id="precio"></h2>   
                </div>
                <div class="containerModalInfoPrecioCantidad__descripcion">
                    <h2>DESCRIPCION:</h2>
                    <h2><textarea name="descPrd" id="" cols="30" rows="10"><?= $producto['descPrd'] ?></textarea></h2>   
                </div>
            </div>
            <div class="containerModalInfoEstado">
                <h2>ESTADO PUBLICACION:</h2>
                <select name="estadoPc" id="">
                    <option <?= ($producto['estadoPrd'] == 0) ? 'selected' : '' ?> value="0">Desactivar</option>
                    <option <?= ($producto['estadoPrd'] == 1) ? 'selected' : '' ?> value="1">Activar</option>
                </select>
            </div>
            <hr>
            <ul class="containerModalInfoConfig">
<?php
if($producto['idCategoria'] == 15){
    $cssMicro = 'flex';
    $cssMother = 'flex';
    $cssRam = 'flex';
    $cssVideo = 'flex';
    $cssHdd = 'flex';
    $cssSsd = 'flex';
    $cssFuente = 'flex';
    $cssGabinete = 'flex';
    $cssMonitor = 'flex';
    if($producto['microPc'] == ''){
        $cssMicro = 'none';
    }
    if($producto['motherPc'] == ''){
        $cssMother = 'none';
    }
    if($producto['ramPc'] == ''){
        $cssRam = 'none';
    }
    if($producto['videoPc'] == ''){
        $cssVideo = 'none';
    }
    if($producto['hddPc'] == ''){
        $cssHdd = 'none';
    }
    if($producto['ssdPc'] == ''){
        $cssSsd = 'none';
    }
    if($producto['fuentePc'] == ''){
        $cssFuente = 'none';
    }
    if($producto['gabinetePc'] == ''){
        $cssGabinete = 'none';
    }
    if($producto['monitorPc'] == ''){
        $cssMonitor = 'none';
    }

    if($producto['microPc'] == '' && $producto['motherPc'] == '' && $producto['ramPc'] == '' && $producto['videoPc'] == '' &&
       $producto['hddPc'] == '' && $producto['ssdPc'] == '' && $producto['fuentePc'] == '' &&  $producto['gabinetePc'] == ''
       && $producto['monitorPc'] == ''){
?> 
        <H1 style="text-align: center">ESTE EQUIPO NO TIENE NINGÚN COMPONENTE CARGADO</H1>

<?php
       }else{
?>
                <h3>CONFIGURACION DEL EQUIPO:</h3>
                <li style="display: <?= $cssMicro ?>"><img src="http://localhost/RC/microprocesador.png" alt=""><p>Microprocesador: <b><input type="text" name="micro" value="<?= $producto['microPc'] ?>" id="micro"></b></p></li>
                <li style="display: <?= $cssMother ?>"><img src="http://localhost/RC/motherboard.png" alt=""><p>Motherboard: <b><input type="text" name="mother" value="<?= $producto['motherPc'] ?>" id="mother"></b></p></li>
                <li style="display: <?= $cssRam ?>"><img src="http://localhost/RC/memoriaram.png" alt=""><p>Memoria ram: <b><input type="text" name="ram" value="<?= $producto['ramPc'] ?>" id="ram"></b></p></li>
                <li style="display: <?= $cssVideo ?>"><img src="http://localhost/RC/placadevideo.png" alt=""><p>Placa de video: <b><input type="text" name="video" value="<?= $producto['videoPc'] ?>" id="video"></b></p></li>
                <li style="display: <?= $cssHdd ?>"><img src="http://localhost/RC/almacenamiento.png" alt=""><p>Disco duro: <b><input type="text" name="duro" value="<?= $producto['hddPc'] ?>" id="hdd"></b></p></li>
                <li style="display: <?= $cssSsd ?>"><img src="http://localhost/RC/almacenamiento.png" alt=""><p>Disco solido: <b><input type="text" name="solido" value="<?= $producto['ssdPc'] ?>" id="ssd"></b></p></li>
                <li style="display: <?= $cssFuente ?>"><img src="http://localhost/RC/fuente.png" alt=""><p>Fuente: <b><input type="text" name="fuente" value="<?= $producto['fuentePc'] ?>" id="fuente"></b></p></li>
                <li style="display: <?= $cssGabinete ?>"><img src="http://localhost/RC/gabinete.png" alt=""><p>Gabinete: <b><input type="text" name="gabinete" value="<?= $producto['gabinetePc'] ?>" id="gabinete"></b></p></li>
                <li style="display: <?= $cssMonitor ?>"><img src="http://localhost/RC/monitor.png" alt=""><p>Monitor: <b><input type="text" name="monitor" value="<?= $producto['monitorPc'] ?>" id="monitor"></b></p></li>
            </ul>
<?php
    }
}elseif($producto['idCategoria'] == 1){
?>

<div class="containerModalInfoConfig__micro">

<div class="containerModalInfoConfig__micro--caracteristicasGenerales">
    <h4>CARACTERISTICAS GENERALES</h4>
    <ul>
        <li>Nucleos: <b><input type="number" name="nucleosMicro" value="<?= $producto['nucleosMicro'] ?>"></b></li>
        <li>Hilos: <b><input type="number" name="hilosMicro" value="<?= $producto['hilosMicro'] ?>"></b></li>
        <li>Socket: <b><input type="text" name="socketMicro" value="<?= $producto['socketMicro'] ?>"></b> </li>
        <li>Frecuencia Base: <b><input type="number" name="frecuenciaBaseMicro" value="<?= $producto['frecuenciaBaseMicro'] ?>"></b></li>
        <li>Frecuencia Maxima: <b><input type="number" name="frecuenciaMaximaMicro" value="<?= $producto['frecuenciaMaxMicro'] ?>"></b></li>
        <li>Graficos Integrados: <b><select name="graficosIntegradosMicro" id="">
            <option <?= ($producto['graficosIntegrados'] == 0) ? 'Selected' : '' ?> value="0">No</option>
            <option <?= ($producto['graficosIntegrados'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
        </select></b></li>
        <li>Modelo Graficos Integrados: <b><input type="text" name="modeloGraficosIntegradosMicro" value="<?= $producto['modeloGraficosIntegradosMicro'] ?>"></b></li>
        <li>Litografia: <b><input type="text" name="litografiaMicro" value="<?= $producto['litografiaMicro'] ?>"></b></li>
    </ul>
</div>

<div class="containerModalInfoConfig__micro--coolerDisipadoresMemoria">
    <div class="containerModalInfoConfig__micro--coolerDisipadores">
        <h4>COOLER Y DISIPADORES</h4>
        <ul>
            <li>Cooler: <b><select name="coolerMicro" id="">
                <option <?= ($producto['cooler'] == 0) ? 'Selected' : '' ?> value="0">No</option>
                <option <?= ($producto['cooler'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
            </select></b></li>
            <li>TDP: <b><input type="text" name="tdpMicro" value="<?= $producto['tdpMicro'] ?>"></b></li>
            <li>Max Temp: <b><input type="text" name="maxTempMicro" value="<?= $producto['tempMaximaMicro'] ?>"></b> </li>
        </ul>
    </div>
    <div class="containerModalInfoConfig__micro--memoria">
        <h4>MEMORIA</h4>
        <ul>
            <li>Cache L1: <b><input type="number" name="cacheL1Micro" value="<?= $producto['cacheL1Micro'] ?>"></b>Mb</li>
            <li>Cache L2: <b><input type="number" name="cacheL2Micro" value="<?= $producto['cacheL2Micro'] ?>"></b>Mb</li>
            <li>Cache L3: <b><input type="number" name="cacheL3Micro" value="<?= $producto['cacheL3Micro'] ?>"></b>Mb</li>
        </ul> 
    </div>
</div>

</div>

<?php
    }elseif($producto['idCategoria'] == 2){
?>

<div class="containerModalInfoConfig__mother">

<div class="containerModalInfoConfig__mother--caracteristicasGeneralesMemoria">
    
    <div class="containerModalInfoConfig__mother--caracteristicasGenerales">
        <h4>CARACTERISTICAS GENERALES</h4>
        <ul>
            <li>Socket: <b><input type="text" name="socketMother" value="<?= $producto['socketMother'] ?>"></b></li>
            <li>Chipset: <b><input type="text" name="chipsetMother" value="<?= $producto['chipsetMother'] ?>"></b></li>
            <li>Boton FlashBios<b><select name="botonFlashBiosMother" id="">
                <option <?= ($producto['flashBiosButtonMother'] == 0) ? 'Selected' : '' ?> value="0">No</option>
                <option <?= ($producto['flashBiosButtonMother'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
            </select></b></li>
            <li>Factor de forma: <b><input type="text" name="factorFormaMother" value="<?= $producto['factorFormaMother'] ?>"></b></li>
        </ul>
    </div>

    <div class="containerModalInfoConfig__mother--memoria">
        <h4>MEMORIA</h4>
        <ul>
            <li>Cantidad de slots de memorias: <b><input type="number" name="cantSlotsMemoriaMother" value="<?= $producto['slotsRamMother'] ?>"></b></li>
            <li>Capacidad maxima: <b><input type="number" name="capacidadMaximaMemoriaMother" value="<?= $producto['cantMaxRamMother'] ?>"></b></li>
            <li>Velocidad maxima: <b><input type="number" name="velocidadMaximaMemoriaMother" value="<?= $producto['velocidadMaxRamMother'] ?>"></b></li>
        </ul>
    </div>

</div>

<div class="containerModalInfoConfig__mother--conectividad">
    <h4>CONECTIVIDAD</h4>
    <ul>
        <li>Slots Expasion: <b><input type="text" name="slotExpansionMother" value="<?= $producto['slotsExpasionMother'] ?>"></b></li>
        <li>Cantidad SATA: <b><input type="number" name="cantSataMother" value="<?= $producto['cantSataMother'] ?>"></b></li>
        <li>Interfaz M.2:<b><select name="interfazM2Mother" id="">
            <option <?= ($producto['interfazm2Mother'] == 0) ? 'Selected' : '' ?> value="0">No</option>
            <option <?= ($producto['interfazm2Mother'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
        </select></b></li>
        <li>Puertos M.2:<b><input type="number" name="cantM2Mother" value="<?= $producto['cantPuertosM2Mother'] ?>"></b></li>
        <li>LAN:<b><select name="lanMother" id="">
            <option <?= ($producto['lanMother'] == 0) ? 'Selected' : '' ?> value="0">No</option>
            <option <?= ($producto['lanMother'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
        </select></b></li>
        <li>WiFi:<b><select name="wifiMother" id="">
            <option <?= ($producto['wifiMother'] == 0) ? 'Selected' : '' ?> value="0">No</option>
            <option <?= ($producto['wifiMother'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
        </select></b></li>
        <li>Bluetooth:<b><select name="bluetoothMother" id="">
            <option <?= ($producto['bluetoothMother'] == 0) ? 'Selected' : '' ?> value="0">No</option>
            <option <?= ($producto['bluetoothMother'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
        </select></b></li>
        <li>Chipset Audio:<b><input type="text" name="chipsetAudioMother" value="<?= $producto['chipsetAudioMother'] ?>"></b></li>
        <li>Puertos Usb 2.0:<b><input type="number" name="cantUsb20Mother" value="<?= $producto['puertosUsb20Mother'] ?>"></b></li>
        <li>Puertos Usb 3.0:<b><input type="number" name="cantUsb30Mother" value="<?= $producto['puertosUsb30Mother'] ?>"></b></li>
        <li>Display Port:<b><input type="number" name="displayPortMother" value="<?= $producto['cantDisplayPortMother'] ?>"></b></li>
        <li>HDMI:<b><input type="number" name="hdmiMother" value="<?= $producto['cantHdmiMother'] ?>"></b></li>
        <li>VGA:<b><input type="number" name="vgaMother" value="<?= $producto['cantVgaMother'] ?>"></b></li>
    </ul>
</div>

</div>

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