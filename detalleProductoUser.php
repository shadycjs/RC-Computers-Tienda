<?php
    session_start();
    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    if(isset($_SESSION['idUsuario'])){
        include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    }else{
        include 'C:\xampp\htdocs\RC\Tienda\header.php';
    }
    if( isset($_POST['btnReg']) ){
        registrarUser();
    }
    $productos = listarProductos();
    if( isset($_POST['btnIngresar']) ){
        login();
    }
    $productos = verPrdPorId( $_GET['id'] );
    if(isset($_POST['agregarCarrito']) && !isset($_SESSION['idUsuario'])){
        header('location: tiendaLogOut.php?error=3');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-detalleProductoUser.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
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
    while( $producto = mysqli_fetch_assoc( $productos ) ){
?> 
<form action="" method="post" class="containerTodo" id="formulario">   
    <input type="hidden" name="id" value="<?= $producto['idPrd'] ?>" id="id">
    <input type="hidden" name="nombre" value="<?= $producto['nombreCategoria'],' ',$producto['nombreMarca'],' ',$producto['nombrePrd'] ?>" id="nombre">
    <input type="hidden" name="precio" value="<?= $producto['precioPrd'] ?>" id="precio">
    <input type="hidden" name="img" value="<?= $producto['img1'] ?>" id="img">
    <div class="containerModal">
        <div class="containerModal__imagenes">
            <div class="imagenPrincipal">
                <img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="" class="mainImg">
            </div>
            <ul class="ImagenesSecundarias">
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="" id="img1" class="secuImg imgSelected"></li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img2'] ?>" alt="" id="img2" class="secuImg"></li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img3'] ?>" alt="" id="img3" class="secuImg"></li>
                <li><img src="http://localhost/RC/Tienda/images/<?= $producto['img4'] ?>" alt="" id="img4" class="secuImg"></li>
            </ul>
        </div>
        <div class="containerModalInfo">
            <h1><?= $producto['nombreCategoria'], ' '.$producto['nombreMarca'], ' '.$producto['nombrePrd'] ?></h1>
            
            <div class="containerModalInfoDetalles">
                <div class="containerModalInfoMarcaCodigo">
                    <h4><b>Marca: <?= $producto['nombreMarca'] ?></b></h4>
                    <h4><b>Codigo: <?= $producto['idPrd'] ?></b></h4>
                </div>
                <ul class="containerModalInfoGarantias">
                    <li><ion-icon style="color: green" name="shield-checkmark"></ion-icon><h6>GARANTIA</h6></li>
                    <li><ion-icon style="color: green" name="airplane"></ion-icon><h6>ENVIOS A TODO EL PAIS</h6></li>
                    <li><ion-icon style="color: green" name="checkmark-circle"></ion-icon></ion-icon><h6>STOCK DISPONIBLE</h6></li>
                </ul>
            </div>
            <div class="containerModalInfoPrecioCantidadFormasPago">
                
                <div class="containerModalInfoPrecioCantidad">
                    <div class="containerModalInfoPrecioCantidad__cantidad">
                        <h2>Unidades:</h2>
                        <p><?= $producto['stockPrd'] ?></p> 
                        <input type="hidden" name="cantidad" value="">
                    </div>
                    <div class="containerModalInfoPrecioCantidad__precio">
                        <h2>$<?= number_format($producto['precioPrd'], 2, ',', '.') ?></h2>   
                    </div>
                </div>

            <div class="containerModalFormasPago">
                <div class="containerModalFormasPago--imagenes">
                    <div class="containerModalFormasPago--imagenes-mercadopago">
                        <img src="http://localhost/RC/Tienda/images/logo-mercadopago.jpg" alt="">
                    </div>
                    <div class="containerModalFormasPago--imagenes-banco">
                        <img src="http://localhost/RC/Tienda/images/bancarialogo.png" alt="">
                    </div>
                </div>
            </div>
            <!-- Carousel -->
        <div class="fondoCarousel"></div>
            <div id="demo" class="container carouselTienda carousel slide" data-bs-ride="carousel">
            <button type="button" class="btn-close bg-danger" aria-label="Close" id="botonCerrarCarousel"></button>
                
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="col-12 carousel-item active">
                        <img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="img1" class="d-block w-100">
                    </div>
                    <div class="col-12 carousel-item">
                        <img src="http://localhost/RC/Tienda/images/<?= $producto['img2'] ?>" alt="img2" class="d-block w-100">
                    </div>
                    <div class="col-12 carousel-item">
                        <img src="http://localhost/RC/Tienda/images/<?= $producto['img3'] ?>" alt="img3" class="d-block w-100">
                    </div>
                    <div class="col-12 carousel-item">
                        <img src="http://localhost/RC/Tienda/images/<?= $producto['img4'] ?>" alt="img4" class="d-block w-100">
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev p-0" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next p-0" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
    <script>
        //IMAGENES CAMBIAN AL CLICKEAR
        const carousel = document.querySelector('.carouselTienda');
        const fondoCarousel = document.querySelector('.fondoCarousel');
        const btnCerrarCarousel = document.getElementById('botonCerrarCarousel');
        const mainImg = document.querySelector('.mainImg');
        const secuImg = document.querySelectorAll('.secuImg');
        const imgId1 = document.getElementById('img1');
        const imgId2 = document.getElementById('img2');
        const imgId3 = document.getElementById('img3');
        const imgId4 = document.getElementById('img4');
        
        let img1 = 'http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>';
        let img2 = 'http://localhost/RC/Tienda/images/<?= $producto['img2'] ?>';
        let img3 = 'http://localhost/RC/Tienda/images/<?= $producto['img3'] ?>';
        let img4 = 'http://localhost/RC/Tienda/images/<?= $producto['img4'] ?>';

        mainImg.addEventListener('click', ()=>{
            carousel.style.display = "block";
            fondoCarousel.style.display = "block";
        });

        btnCerrarCarousel.addEventListener('click', ()=>{
            carousel.style.display = "none";
            fondoCarousel.style.display = "none";
        });

        secuImg.forEach(secu => {
            imgId1.addEventListener('click', ()=>{
                mainImg.src = img1;
                imgId1.src = mainImg.src;
                imgId2.classList.remove('imgSelected');
                imgId3.classList.remove('imgSelected');
                imgId4.classList.remove('imgSelected');
                imgId1.classList.add('imgSelected');
            });
            imgId2.addEventListener('click', ()=>{
                mainImg.src = img2;
                imgId2.src = mainImg.src;
                imgId1.classList.remove('imgSelected');
                imgId3.classList.remove('imgSelected');
                imgId4.classList.remove('imgSelected');
                imgId2.classList.add('imgSelected');
            });
            imgId3.addEventListener('click', ()=>{
                mainImg.src = img3
                imgId3.src = mainImg.src;
                imgId1.classList.remove('imgSelected');
                imgId2.classList.remove('imgSelected');
                imgId4.classList.remove('imgSelected');
                imgId3.classList.add('imgSelected');
            });
            imgId4.addEventListener('click', ()=>{
                mainImg.src = img4;
                imgId4.src = mainImg.src;
                imgId1.classList.remove('imgSelected');
                imgId2.classList.remove('imgSelected');
                imgId3.classList.remove('imgSelected');
                imgId4.classList.add('imgSelected');
            });
        });
    </script>
            </div>
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
        <div class="containerModalInfoButton">
                <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="<?= $producto['stockPrd'] ?>">
                <button type="submit" id="agregarCarrito" name="agregarCarrito">AGREGAR AL CARRITO</button>
            </div>
        </div>

    </div>
    <a href="<?= (isset($_SESSION['idUsuario'])) ? 'tiendaUser.php' : 'tiendaLogOut.php' ?>">VOLVER A CATALOGO</a>
    
</form>
<?php
   
}
?>



</main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>