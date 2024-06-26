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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
<div class="container">    
    <form action="resultadoModificarPublicacion.php" method="post" class="container bg-light f-flex flex-column" enctype="multipart/form-data">
        <div class="containerModal__imagenes">
            <div class="imagenPrincipal">
                <H1>IMAGEN ACTUAL:</H1>
                <img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="" id="img1">
                <div class="imagenPrincipal__sub">
                    <b>IMAGEN PRINCIPAL NUEVA:</b>
                    <input type="file" name="img1" id="imagenPrincipal">
                    <input type="hidden" name="imgActual1" value="<?= $producto['img1'] ?>">
                </div>
            </div>
            <hr>
            <h2 id="imgSecuAct">IMAGENES SECUNDARIAS ACTUALES:</h2>
            <div class="container">
                <ul class="row">
                    <li class="col-md-4">
                        <img class="img-fluid" src="http://localhost/RC/Tienda/images/<?= $producto['img2'] ?>" alt="" id="img2">
                        <div class="imagenesSecundarias__sub">
                            <b>NUEVA IMAGEN:</b>
                            <input type="file" name="img2" id="imagenDos">
                            <input type="hidden" name="imgActual2" value="<?= $producto['img2'] ?>">
                        </div>    
                    </li>
                    <li class="col-md-4">
                        <img class="img-fluid" src="http://localhost/RC/Tienda/images/<?= $producto['img3'] ?>" alt="" id="img3">
                        <div class="imagenesSecundarias__sub">
                            <b>NUEVA IMAGEN:</b>
                            <input type="file" name="img3" id="imagenTres">
                            <input type="hidden" name="imgActual3" value="<?= $producto['img3'] ?>">
                        </div>  
                    </li>
                    <li class="col-md-4">
                        <img class="img-fluid" src="http://localhost/RC/Tienda/images/<?= $producto['img4'] ?>" alt="" id="img4">
                        <div class="imagenesSecundarias__sub">
                            <b>NUEVA IMAGEN:</b>
                            <input type="file" name="img4" id="imagenCuatro">
                            <input type="hidden" name="imgActual4" value="<?= $producto['img4'] ?>">
                        </div>  
                    </li>
                </ul>
            </div>

        </div>
        <div class="container">
            <div class="container">
                <div class="row">
                    <h1>Titulo del producto:</h1>
                    <input type="text" name="nombrePubli" value="<?= $producto['nombrePrd'] ?>">
                </div>
            </div>
            <hr>
            <div class="container d-flex flex-column gap-2">
                <div class="row">
                    <h4 class="col-sm-4 col-md-2">Marca:</h4> 
                    <select class="col-sm-8 col-md-10" name="marca">
<?php
        while( $marca = mysqli_fetch_assoc( $marcas ) ){
?>
                    <option <?= ( $marca['idMarca'] == $_GET['idMarca'] ) ? 'selected' : '' ?> value="<?= $marca['idMarca'] ?>"><?= $marca['nombreMarca'] ?></option>
<?php
        }
?>
                    </select>
                </div>
                <div class="row">
                    <h4 class="col-sm-4 col-md-2">Codigo:</h4> 
                    <input class="col-sm-8 col-md-10" type="text" name="idPrd" value="<?= $producto['idPrd'] ?>">
                </div>
                <div class="row">
                    <h4 class="col-sm-4 col-md-2">Stock:</h4>
                    <input class="col-sm-8 col-md-10" type="number" name="stock" value="<?= $producto['stockPrd'] ?>" id="cantidad">
                </div>
                <div class="row">
                    <h4 class="col-sm-4 col-md-2">Precio:</h4>
                    <input class="col-sm-8 col-md-10" type="number" name="precio" step="0.01" value="<?= $producto['precioPrd'] ?>">   
                </div>
                <div class="row">
                    <h4>Descripcion:</h4>
                    <textarea name="descPrd" id="" cols="30" rows="10"><?= $producto['descPrd'] ?></textarea>
                </div>
                <div class="row">
                    <h4>ESTADO PUBLICACION:</h4>
                    <select name="estadoPc">
                        <option <?= ($producto['estadoPrd'] == 0) ? 'selected' : '' ?> value="0">Desactivar</option>
                        <option <?= ($producto['estadoPrd'] == 1) ? 'selected' : '' ?> value="1">Activar</option>
                    </select>
            </div>
            </div>

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
    }elseif($producto['idCategoria'] == 3){
?>

<div class="containerModalInfoConfig__ram">
    <div class="containerModalInfoConfig__ram--caracteristicasGenerales">
        <h4>CARACTERISTICAS GENERALES</h4>
            <ul>
                <li>Tipo: <b><input type="text" name="ddrMemoriaRam" value="<?= $producto['ddrMemoriaRam'] ?>"></b></li>
                <li>Capacidad: <b><input type="number" name="capacidadMemoriaRam" value="<?= $producto['tamanioMemoriaRam'] ?>"></b></li>
                <li>Velocidad:<b><input type="number" name="velocidadMemoriaRam" value="<?= $producto['velocidadMemoriaRam'] ?>"></b></li>
                <li>Latencia: <b><input type="number" name="latenciaMemoriaRam" value="<?= $producto['latenciaMemoriaRam'] ?>"></b></li>
                <li>Color: <b><input type="text" name="colorMemoriaRam" value="<?= $producto['colorMemoriaRam'] ?>"></b></li>
            </ul>
    </div>

    <div class="containerModalInfoConfig__ram--compatibilidad">
        <h4>COMPATIBILIDAD Y DISIPADORES</h4>
            <ul>
                <li>Tipo: <b><input type="text" name="tipoMemoriaRam" value="<?= $producto['compatibilidadMemoriaRam'] ?>"></b></li>
                <li>Disipador: <b><select name="disipadorMemoriaRam" id="">
                    <option <?= ($producto['disipadorMemoriaRam'] == 0) ? 'Selected' : '' ?> value="0">No</option>
                    <option <?= ($producto['disipadorMemoriaRam'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
                </select></b></li>
            </ul>
    </div>
</div>

<?php
    }elseif($producto['idCategoria'] == 6){
?>

<div class="containerModalInfoConfig__placaVideo">

    <div class="containerModalInfoConfig__placaVideo--caracteristicasGenerales">
        <h4>CARACTERISTICAS GENERALES</h4>
        <ul>
            <li>Conectividad: <b><input type="text" name="tipoPciePlacaVideo" value="<?= $producto['tipoPciePlacaVideo'] ?>"></b></li>
            <li>Tipo: <b><input type="text" name="gddrPlacaVideo" value="<?= $producto['gddrPlacaVideo'] ?>"></b></li>
            <li>Frecuencia base:<b><input type="number" name="frecuenciaBasePlacaVideo" value="<?= $producto['frecuenciaBasePlacaVideo'] ?>"></b></li>
            <li>Frecuencia maxima: <b><input type="number" name="frecuenciaMaximaPlacaVideo" value="<?= $producto['frecuenciaMaximaPlacaVideo'] ?>"></b></li>
            <li>Tamaño memoria: <b><input type="number" name="tamañoMemoriaPlacaVideo" value="<?= $producto['tamanioMemoriaPlacaVideo'] ?>"></b></li>
        </ul>
    </div>

    <div class="containerModalInfoConfig__placaVideo--dimensionesConectividad">
        <div class="containerModalInfoConfig__placaVideo--dimensiones">
            <h4>DIMENSIONES</h4>
            <ul>
                <li>Ancho de placa: <b><input type="number" name="anchoPlacaVideo" value="<?= $producto['anchoPlacaVideo'] ?>"></b></li>
                <li>Largo de placa: <b><input type="number" name="largoPlacaVideo" value="<?= $producto['largoPlacaVideo'] ?>"></b></li>
                <li>Peso de placa:<b><input type="number" name="pesoPlacaVideo" value="<?= $producto['pesoPlacaVideo'] ?>"></b></li>
            </ul>
        </div>

        <div class="containerModalInfoConfig__placaVideo--conectividad">
            <h4>CONECTIVIDAD</h4>
            <ul>
                <li>DisplayPort: <b><input type="number" name="displayPortPlacaVideo" value="<?= $producto['displayPortPlacaVideo'] ?>"></b></li>
                <li>HDMI: <b><input type="number" name="hdmiPlacaVideo" value="<?= $producto['hdmiPlacaVideo'] ?>"></b></li>
                <li>DVI:<b><input type="number" name="dviPlacaVideo" value="<?= $producto['dviPlacaVideo'] ?>"></b></li>
            </ul>
        </div>
    </div>

    <div class="containerModalInfoConfig__placaVideo--extras">
        <h4>EXTRAS</h4>
        <ul>
            <li>Bus: <b><input type="number" name="busPlacaVideo" value="<?= $producto['busPlacaVideo'] ?>"></b></li>
            <li>Multiples monitores: <b><select name="multiplesMonitoresPlacaVideo" id="">
                <option <?= ($producto['multiplesPantallasPlacaVideo'] == 0) ? 'Selected' : '' ?> value="0">No</option>
                <option <?= ($producto['multiplesPantallasPlacaVideo'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
            </select></b></li>
            <li>Numero coolers: <b><input type="number" name="numeroCoolersPlacaVideo" value="<?= $producto['numeroFanCoolersPlacaVideo'] ?>"></b></li>
        </ul>
    </div>

</div>

<?php
    }elseif($producto['idCategoria'] == 4){
?>

<div class="containerModalInfoConfig__discoDuro">

    <div class="containerModalInfoConfig__discoDuro--caracteristicasGenerales">
        <h4>CARACTERISTICAS GENERALES</h4>
        <ul>
            <li>Tipo de conexion: <b><input type="text" name="interfazDiscoDuro" value="<?= $producto['interfazDiscoDuro'] ?>"></b></li>
            <li>Capacidad: <b><input type="number" name="capacidadDiscoDuro" value="<?= $producto['capacidadDiscoDuro'] ?>"></b></li>
            <li>Factor de forma:<b><input type="number" step="0.01" name="factorFormaDiscoDuro" value="<?= $producto['factorFormaDiscoDuro'] ?>"></b></li>
        </ul>
    </div>

    <div class="containerModalInfoConfig__discoDuro--rendimiento">
    <h4>RENDIMIENTO</h4>
        <ul>
            <li>Revoluciones por minuto: <b><input type="number" name="rpmDiscoDuro" value="<?= $producto['rpmDiscoDuro'] ?>"></b></li>
            <li>Cache: <b><input type="number" name="memoriaCacheDiscoDuro" value="<?= $producto['memoriaCacheDiscoDuro'] ?>"></b></li>
        </ul>
    </div>

</div>

<?php
    }elseif($producto['idCategoria'] == 5){
?>

<div class="containerModalInfoConfig__discoSolido">

    <div class="containerModalInfoConfig__discoSolido--caracteristicasGenerales">
        <h4>CARACTERISTICAS GENERALES</h4>
        <ul>
            <li>Tipo de conexion: <b><input type="text" name="interfazDiscoSolido" value="<?= $producto['interfazDiscoSolido'] ?>"></b></li>
            <li>Capacidad: <b><input type="number" name="capacidadDiscoSolido" value="<?= $producto['capacidadDiscoSolido'] ?>"></b></li>
            <li>Factor de forma:<b><input type="number" name="factorFormaDiscoSolido" value="<?= $producto['factorFormaDiscoSolido'] ?>"></b></li>
        </ul>
    </div>

    <div class="containerModalInfoConfig__discoSolido--rendimiento">
    <h4>RENDIMIENTO</h4>
        <ul>
            <li>Lectura: <b><input type="number" name="lecturaDiscoSolido" value="<?= $producto['lecturaDiscoSolido'] ?>"></b></li>
            <li>Escritura: <b><input type="number" name="escrituraDiscoSolido" value="<?= $producto['escrituraDiscoSolido'] ?>"></b></li>
        </ul>
    </div>

</div>

<?php
    }elseif($producto['idCategoria'] == 8 ){
?>

<div class="containerModalInfoConfig__fuente">

    <div class="containerModalInfoConfig__fuente--caracteristicasGenerales">
        <h4>CARACTERISTICAS GENERALES</h4>
        <ul>
            <li>Watts Reales: <b><input type="number" name="potenciaFuente" value="<?= $producto['potenciaFuente'] ?>"></b></li>
            <li>Formato: <b><input type="text" name="factorFormaFuente" value="<?= $producto['factorFormaFuente'] ?>"></b></li>
            <li>Tamaño fan cooler:<b><input type="number" name="tamanioFanCoolerFuente" value="<?= $producto['tamanioFanCoolerFuente'] ?>"></b></li>
            <li>Certificacion:<b><input type="text" name="certificacionFuente" value="<?= $producto['certificacionFuente'] ?>"></b></li>
        </ul>
    </div>

    <div class="containerModalInfoConfig__fuente--cableado">
        <h4>CABLEADO</h4>
        <ul>
            <li>Conector Mother 20 pin: <b><input type="number" name="conectorMother204PinFuente" value="<?= $producto['conectorMother204PinFuente'] ?>"></b></li>
            <li>Conector CPU 4 pines: <b><input type="number" name="conectorCpu44PinFuente" value="<?= $producto['conectorCpu44PinFuente'] ?>"></b></li>
            <li>Conector CPU 8 pines: <b><input type="number" name="conectorCpu8PinFuente" value="<?= $producto['conectorCpu8PinFuente'] ?>"></b></li>
            <li>Conexiones SATA: <b><input type="number" name="conectorSataFuente" value="<?= $producto['conectorSataFuente'] ?>"></b></li>
            <li>Conexiones MOLEX: <b><input type="number" name="conectorMolex4PinFuente" value="<?= $producto['conectorMolex4PinFuente'] ?>"></b></li>
            <li>Conexiones FLOPPY: <b><input type="number" name="conectorFloppy4PinFuente" value="<?= $producto['conectorFloppy4PinFuente'] ?>"></b></li>
            <li>Conector PCIe 6 Pines: <b><input type="number" name="conectorPcie62PinFuente" value="<?= $producto['conectorPcie62PinFuente'] ?>"></b></li>
        </ul>
    </div>

    <div class="containerModalInfoConfig__fuente--iluminacion">
        <h4>ILUMINACION</h4>
        <ul>
            <li>Cooler: <b><select name="iluminacionFuente" id="">
                <option <?= ($producto['iluminacionCoolerFuente'] == 0) ? 'Selected' : '' ?> value="0">No</option>
                <option <?= ($producto['iluminacionCoolerFuente'] == 1) ? 'Selected' : '' ?> value="1">Si</option>
            </select></b></li>
        </ul>
    </div>

</div>

<?php
    }
?>
            <div class="containerModalInfoButton">
                <input type="submit" value="GUARDAR CAMBIOS" id="agregarCarrito" name="guardarCambios">
                <a class="text-dark"href="publicacionesListado.php">VOLVER AL LISTADO</a>
            </div>
        </div>
        <hr>

    </form>

    
</div>
<script>
    const img1Default = "http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>";
    const img2Default = "http://localhost/RC/Tienda/images/<?= $producto['img2'] ?>";
    const img3Default = "http://localhost/RC/Tienda/images/<?= $producto['img3'] ?>";
    const img4Default = "http://localhost/RC/Tienda/images/<?= $producto['img4'] ?>";

    const fileImg1 = document.getElementById('imagenPrincipal');
    const fileImg2 = document.getElementById('imagenDos');
    const fileImg3 = document.getElementById('imagenTres');
    const fileImg4 = document.getElementById('imagenCuatro');

    const img = document.getElementById('img1');
    const img2 = document.getElementById('img2');
    const img3 = document.getElementById('img3');
    const img4 = document.getElementById('img4');

    fileImg1.addEventListener('change', e =>{
        if(e.target.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
            img.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
        }else{
            img.src = img1Default;
        }
    });

    fileImg2.addEventListener('change', e =>{
        if(e.target.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
            img2.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
        }else{
            img2.src = img2Default;
        }
    });

    fileImg3.addEventListener('change', e =>{
        if(e.target.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
            img3.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
        }else{
            img3.src = img3Default;
        }
    });

    fileImg4.addEventListener('change', e =>{
        if(e.target.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
            img4.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
        }else{
            img4.src = img4Default;
        }
    });

</script>
<?php
}
?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>