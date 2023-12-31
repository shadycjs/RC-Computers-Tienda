<?php

    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    autenticar();
    $productos = verPrdPorId( $_GET['id'] );
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Eliminar Producto</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-eliminarProducto.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<main class="mainClass">
    <?php include 'modalCerrarSesion.php'; ?>
<?php
    while( $producto = mysqli_fetch_assoc( $productos ) ){
?> 
<div class="containerTodo">
    <div class="containerTodoEliminar">
        <ion-icon name="trash-outline"></ion-icon>
        <a href="resultadoEliminarPublicacion.php?id=<?= $producto['idPrd'] ?>">ELIMINAR ESTE PRODUCTO</a> 
    </div>   
    <div class="containerModal">
        <div class="containerModal__imagenes">
            <div class="imagenPrincipal">
                <img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="">
            </div>
            <ul class="ImagenesSecundarias">
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img2'] ?>" alt=""></li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img3'] ?>" alt=""></li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img4'] ?>" alt=""></li>
            </ul>
        </div>
        <div class="containerModalInfo">
            <h1><?= $producto['nombrePrd'] ?></h1>
            <hr>
            <div class="containerModalInfoDetalles">
                <div class="containerModalInfoMarcaCodigo">
                    <h4><b>MARCA: <?= $producto['nombreMarca'] ?></b></h4>
                    <h4><b>CODIGO: <?= $producto['idPrd'] ?></b></h4>
                </div>
                <ul class="containerModalInfoGarantias">
                    <li><ion-icon style="color: green" name="shield-checkmark"></ion-icon><h6>GARANTIA</h6></li>
                    <li><ion-icon style="color: green" name="airplane"></ion-icon><h6>ENVIOS A TODO EL PAIS</h6></li>
                    <li><ion-icon style="color: green" name="checkmark-circle"></ion-icon></ion-icon><h6>STOCK DISPONIBLE</h6></li>
                </ul>
            </div>
            <div class="containerModalInfoPrecioCantidad">
                <div class="containerModalInfoPrecioCantidad__cantidad">
                    <h2>Stock</h2>
                    <input type="number" name="" value="<?= $producto['stockPrd'] ?>">
                </div>
                <div class="containerModalInfoPrecioCantidad__precio">
                    <h2>$<?= $producto['precioPrd'] ?></h2>   
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
       $producto['hddPc'] == '' && $producto['ssdPc'] == '' && $producto['fuentePc'] == '' &&  $producto['gabinetePc'] == ''){
?>
        <H1 style="text-align: center">ESTE EQUIPO NO TIENE NINGÚN COMPONENTE CARGADO</H1>

<?php
       }else{
?>
                <h3>CONFIGURACION:</h3>
                <li style="display: <?= $cssMicro ?>"><img src="http://localhost/RC/microprocesador.png" alt=""><p>Microprocesador: <b><?= $producto['microPc'] ?></b></p></li>
                <li style="display: <?= $cssMother ?>"><img src="http://localhost/RC/motherboard.png" alt=""><p>Motherboard: <b><?= $producto['motherPc'] ?></b></p></li>
                <li style="display: <?= $cssRam ?>"><img src="http://localhost/RC/memoriaram.png" alt=""><p>Memoria ram: <b><?= $producto['ramPc'] ?></b></p></li>
                <li style="display: <?= $cssVideo ?>"><img src="http://localhost/RC/placadevideo.png" alt=""><p>Placa de video: <b><?= $producto['videoPc'] ?></b></p></li>
                <li style="display: <?= $cssHdd ?>"><img src="http://localhost/RC/almacenamiento.png" alt=""><p>Disco duro: <b><?= $producto['hddPc'] ?></b></p></li>
                <li style="display: <?= $cssSsd ?>"><img src="http://localhost/RC/almacenamiento.png" alt=""><p>Disco solido: <b><?= $producto['ssdPc'] ?></b></p></li>
                <li style="display: <?= $cssFuente ?>"><img src="http://localhost/RC/fuente.png" alt=""><p>Fuente: <b><?= $producto['fuentePc'] ?></b></p></li>
                <li style="display: <?= $cssGabinete ?>"><img src="http://localhost/RC/gabinete.png" alt=""><p>Gabinete: <b><?= $producto['gabinetePc'] ?></b></p></li>
            </ul>

<?php
 }
    }elseif($producto['idCategoria'] == 1){
?>

        <div class="containerModalInfoConfig__micro">

            <div class="containerModalInfoConfig__micro--caracteristicasGenerales">
                <h4>CARACTERISTICAS GENERALES</h4>
                <ul>
                    <li>Nucleos: <b><?= $producto['nucleosMicro'] ?></b></li>
                    <li>Hilos: <b><?= $producto['hilosMicro'] ?></b></li>
                    <li>Socket: <b><?= $producto['socketMicro'] ?></b> </li>
                    <li>Frecuencia Base: <b><?= $producto['frecuenciaBaseMicro'] ?>GHz</b></li>
                    <li>Frecuencia Maxima: <b><?= $producto['frecuenciaMaxMicro'] ?>GHz</b></li>
                    <li>Graficos Integrados: <b><?= ($producto['graficosIntegrados'] == 1) ? 'Si' : 'No' ?></b></li>
                    <li>Modelo Graficos Integrados: <b><?= $producto['modeloGraficosIntegradosMicro'] ?></b></li>
                    <li>Litografia: <b><?= $producto['litografiaMicro'] ?></b></li>
                </ul>
            </div>

            <div class="containerModalInfoConfig__micro--coolerDisipadoresMemoria">
                <div class="containerModalInfoConfig__micro--coolerDisipadores">
                    <h4>COOLER Y DISIPADORES</h4>
                    <ul>
                        <li>Cooler: <b><?= ($producto['cooler'] == 0) ? 'No' : 'Si' ?></b></li>
                        <li>TDP: <b><?= $producto['tdpMicro'] ?>W</b></li>
                        <li>Max Temp: <b><?= $producto['tempMaximaMicro'] ?>°C</b> </li>
                    </ul>
                </div>
                <div class="containerModalInfoConfig__micro--memoria">
                    <h4>MEMORIA</h4>
                    <ul>
                        <?php if($producto['cacheL1Micro'] != 0){ ?><li>Cache L1: <b><?= $producto['cacheL1Micro'] ?></b>Mb</li><?php } ?>
                        <?php if($producto['cacheL2Micro'] != 0){ ?><li>Cache L2: <b><?= $producto['cacheL2Micro'] ?></b>Mb</li><?php } ?>
                        <?php if($producto['cacheL3Micro'] != 0){ ?><li>Cache L3: <b><?= $producto['cacheL3Micro'] ?></b>Mb</li><?php } ?>
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
                        <li>Socket: <b><?= $producto['socketMother'] ?></b></li>
                        <li>Chipset: <b><?= $producto['chipsetMother'] ?></b></li>
                        <li>Boton FlashBios<b> <?= ($producto['flashBiosButtonMother'] == 0) ? 'No' : 'Si' ?></b></li>
                        <li>Factor de forma: <b><?= $producto['factorFormaMother'] ?></b></li>
                    </ul>
                </div>

                <div class="containerModalInfoConfig__mother--memoria">
                    <h4>MEMORIA</h4>
                    <ul>
                        <li>Cantidad de slots de memorias: <b><?= $producto['slotsRamMother'] ?></b></li>
                        <li>Capacidad maxima: <b><?= $producto['cantMaxRamMother'] ?>Gb</b></li>
                        <li>Velocidad maxima: <b><?= $producto['velocidadMaxRamMother'] ?>Mhz</b></li>
                    </ul>
                </div>

            </div>

            <div class="containerModalInfoConfig__mother--conectividad">
                <h4>CONECTIVIDAD</h4>
                <ul>
                    <li>Slots Expasion: <b><?= $producto['slotsExpasionMother'] ?></b></li>
                    <li>Cantidad SATA: <b><?= $producto['cantSataMother'] ?></b></li>
                    <li>Interfaz M.2:<b> <?= ($producto['interfazm2Mother'] == 0) ? 'No' : 'Si' ?></b></li>
                    <li>Puertos M.2:<b><?= $producto['cantPuertosM2Mother'] ?></b></li>
                    <li>LAN:<b> <?= ($producto['lanMother'] == 0) ? 'No' : 'Si' ?></b></li>
                    <li>WiFi:<b> <?= ($producto['wifiMother'] == 0) ? 'No' : 'Si' ?></b></li>
                    <li>Bluetooth:<b> <?= ($producto['bluetoothMother'] == 0) ? 'No' : 'Si' ?></b></li>
                    <li>Chipset Audio:<b><?= $producto['chipsetAudioMother'] ?></b></li>
                    <li>Puertos Usb 2.0:<b><?= $producto['puertosUsb20Mother'] ?></b></li>
                    <li>Puertos Usb 3.0:<b><?= $producto['puertosUsb30Mother'] ?></b></li>
                    <li>Display Port:<b><?= $producto['cantDisplayPortMother'] ?></b></li>
                    <li>HDMI:<b><?= $producto['cantHdmiMother'] ?></b></li>
                    <li>VGA:<b><?= $producto['cantVgaMother'] ?></b></li>
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
                        <li>Tipo: <b><?= $producto['ddrMemoriaRam'] ?></b></li>
                        <li>Capacidad: <b><?= $producto['tamanioMemoriaRam'] ?>Gb</b></li>
                        <li>Velocidad:<b> <?= $producto['velocidadMemoriaRam'] ?>Mhz</b></li>
                        <li>Latencia: <b><?= $producto['latenciaMemoriaRam'] ?>CL</b></li>
                        <li>Color: <b><?= $producto['colorMemoriaRam'] ?></b></li>
                    </ul>
            </div>

            <div class="containerModalInfoConfig__ram--compatibilidad">
                <h4>COMPATIBILIDAD Y DISIPADORES</h4>
                    <ul>
                        <li>Tipo: <b><?= $producto['compatibilidadMemoriaRam'] ?></b></li>
                        <li>Disipador: <b><?= ($producto['disipadorMemoriaRam'] == 0) ? 'No' : 'Si' ?></b></li>
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
                    <li>Conectividad: <b><?= $producto['tipoPciePlacaVideo'] ?></b></li>
                    <li>Tipo: <b><?= $producto['gddrPlacaVideo'] ?></b></li>
                    <li>Frecuencia base:<b> <?= $producto['frecuenciaBasePlacaVideo'] ?>Mhz</b></li>
                    <li>Frecuencia maxima: <b><?= $producto['frecuenciaMaximaPlacaVideo'] ?>Mhz</b></li>
                    <li>Tamaño memoria: <b><?= $producto['tamanioMemoriaPlacaVideo'] ?>Gb</b></li>
                </ul>
            </div>

            <div class="containerModalInfoConfig__placaVideo--dimensionesConectividad">
                <div class="containerModalInfoConfig__placaVideo--dimensiones">
                    <h4>DIMENSIONES</h4>
                    <ul>
                        <li>Ancho de placa: <b><?= $producto['anchoPlacaVideo'] ?>mm</b></li>
                        <li>Largo de placa: <b><?= $producto['largoPlacaVideo'] ?>mm</b></li>
                        <li>Peso de placa:<b> <?= $producto['pesoPlacaVideo'] ?>g</b></li>
                    </ul>
                </div>

                <div class="containerModalInfoConfig__placaVideo--conectividad">
                    <h4>CONECTIVIDAD</h4>
                    <ul>
                        <li>DisplayPort: <b><?= $producto['displayPortPlacaVideo'] ?></b></li>
                        <li>HDMI: <b><?= $producto['hdmiPlacaVideo'] ?></b></li>
                        <li>DVI:<b> <?= $producto['dviPlacaVideo'] ?></b></li>
                    </ul>
                </div>
            </div>

            <div class="containerModalInfoConfig__placaVideo--extras">
                <h4>EXTRAS</h4>
                <ul>
                    <li>Bus: <b><?= $producto['busPlacaVideo'] ?></b></li>
                    <li>Multiples monitores: <b><?= ($producto['multiplesPantallasPlacaVideo']) ? 'Si' : 'No' ?></b></li>
                    <li>Numero coolers: <b><?= $producto['numeroFanCoolersPlacaVideo'] ?></b></li>
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
                    <li>Tipo de conexion: <b><?= $producto['interfazDiscoDuro'] ?></b></li>
                    <li>Capacidad: <b><?= $producto['capacidadDiscoDuro'] ?>Gb</b></li>
                    <li>Factor de forma:<b> <?= $producto['factorFormaDiscoDuro'] ?>''</b></li>
                </ul>
            </div>

            <div class="containerModalInfoConfig__discoDuro--rendimiento">
            <h4>RENDIMIENTO</h4>
                <ul>
                    <li>Revoluciones por minuto: <b><?= $producto['rpmDiscoDuro'] ?>RPM</b></li>
                    <li>Cache: <b><?= $producto['memoriaCacheDiscoDuro'] ?>Gb</b></li>
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
                    <li>Tipo de conexion: <b><?= $producto['interfazDiscoSolido'] ?></b></li>
                    <li>Capacidad: <b><?= $producto['capacidadDiscoSolido'] ?>Gb</b></li>
                    <li>Factor de forma:<b> <?= $producto['factorFormaDiscoSolido'] ?>''</b></li>
                </ul>
            </div>

            <div class="containerModalInfoConfig__discoSolido--rendimiento">
            <h4>RENDIMIENTO</h4>
                <ul>
                    <li>Lectura: <b><?= $producto['lecturaDiscoSolido'] ?>MB/Seg</b></li>
                    <li>Escritura: <b><?= $producto['escrituraDiscoSolido'] ?>MB/Seg</b></li>
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
                    <li>Watts Reales: <b><?= $producto['potenciaFuente'] ?>W</b></li>
                    <li>Formato: <b><?= $producto['factorFormaFuente'] ?></b></li>
                    <li>Tamaño fan cooler:<b><?= $producto['tamanioFanCoolerFuente'] ?>mm</b></li>
                    <li>Certificacion:<b><?= $producto['certificacionFuente'] ?></b></li>
                </ul>
            </div>

            <div class="containerModalInfoConfig__fuente--cableado">
                <h4>CABLEADO</h4>
                <ul>
                    <li>Conector Mother 20 pin: <b><?= $producto['conectorMother204PinFuente'] ?></b></li>
                    <li>Conector CPU 4 pines: <b><?= $producto['conectorCpu44PinFuente'] ?></b></li>
                    <li>Conector CPU 8 pines: <b><?= $producto['conectorCpu8PinFuente'] ?></b></li>
                    <li>Conexiones SATA: <b><?= $producto['conectorSataFuente'] ?></b></li>
                    <li>Conexiones MOLEX: <b><?= $producto['conectorMolex4PinFuente'] ?></b></li>
                    <li>Conexiones FLOPPY: <b><?= $producto['conectorFloppy4PinFuente'] ?></b></li>
                    <li>Conector PCIe 6 Pines: <b><?= $producto['conectorPcie62PinFuente'] ?></b></li>
                </ul>
            </div>

            <div class="containerModalInfoConfig__fuente--iluminacion">
                <h4>ILUMINACION</h4>
                <ul>
                    <li>Cooler: <b><?= ($producto['iluminacionCoolerFuente']) ? 'Si' : 'Sin iluminacion' ?></b></li>
                </ul>
            </div>

        </div>

<?php
    }
?>

        </div>

    </div>
    <a href="publicacionesListado.php">VOLVER A LISTADO</a>
    
</form>
<?php
   
}
?>
</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>