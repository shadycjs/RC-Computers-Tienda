<?php

    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/clientes.php';
    require 'funciones/usuarios.php';
    require 'funciones/marcas.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    autenticar();
    $marcas = listarMarcas();
    $_SESSION['categoria'] = 2;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Agregar Motherboard</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-agregarMother.css">
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
        <form method="post" action="resultadoAgregarPublicacion.php" class="container__todo__sub" enctype="multipart/form-data">    
            <h1>AGREGAR MOTHERBOARD</h1>
            
            <div class="container__todo__sub__caracteristicasPublicacion">
                <h2>CARACTERISTICAS DE PUBLICACION</h2>

                <div class="caracteristicasPublicacion--titulo">
                    <label for="nombreProducto">NOMBRE DEL PRODUCTO</label>
                    <input type="text" name="nombreProducto" id="" placeholder="Por ej: Prime A320-K...">
                </div>

                <div class="caracteristicasPublicacion--titulo">
                    <label for="marcaProducto">MARCA DEL PRODUCTO</label>
                    <select name="marcaProducto" id="">
<?php
        while( $marca = mysqli_fetch_assoc($marcas) ){
?>
                    <option value="<?= $marca['idMarca'] ?>"><?= $marca['nombreMarca'] ?></option>
<?php
        }
?>
                    </select>
                </div>

                <div class="caracteristicasPublicacion--titulo">
                    <label for="unidadesProducto">UNIDADES DEL PRODUCTO</label>
                    <input type="number" name="unidadesProducto" id="">
                </div>

                <div class="caracteristicasPublicacion--titulo">
                    <label for="precioProducto">PRECIO DEL PRODUCTO</label>
                    <input type="number" step="0.01" name="precioProducto" id="precioProducto" placeholder="Por ej: 170000...">
                </div>

                <div class="caracteristicasPublicacion--titulo">
                    <label for="precioProducto">DESCRIPCION DEL PRODUCTO</label>
                    <textarea name="descProducto" id="" cols="30" rows="10" placeholder="Por ej: Motherboard con socket AM4..."></textarea>
                </div>

            </div>

            <div class="container__todo__sub__generalRefrigeracionMemoria">
                <div class="container__todo__sub__caracteristicasGenerales">
                    <h2>CARACTERISTICAS GENERALES</h2>

                    <div class="caracteristicasGenerales--input">
                        <label for="socketMother">Socket</label>
                        <input type="text" name="socketMother" id="">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="chipsetMother">Chipset</label>
                        <input type="text" name="chipsetMother" id="">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="botonFlashBiosMother">Boton Flash BIOS</label>
                        <select name="botonFlashBiosMother" id="">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="factorFormaMother">Factor de forma</label>
                        <input type="text" name="factorFormaMother" id="">
                    </div>

                </div>

                <div class="container__todo__sub__conectividad">
                    <h2>CONECTIVIDAD</h2>

                    <div class="conectividad--input">
                        <label for="slotExpansionMother">Slots de expansion</label>
                        <textarea name="slotExpansionMother" id="" cols="30" rows="10"></textarea>
                    </div>

                    <div class="conectividad--input">
                        <label for="cantSataMother">Cantidad SATA</label>
                        <input type="number" name="cantSataMother" id="">
                    </div>

                    <div class="conectividad--input">
                        <label for="interfazM2Mother">Interfaz M.2</label>
                        <select name="interfazM2Mother" id="">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>

                    <div class="conectividad--input">
                        <label for="cantM2Mother">Cantidad puertos M.2</label>
                        <input type="number" name="cantM2Mother" id="">
                    </div>

                    <div class="conectividad--input">
                        <label for="lanMother">LAN</label>
                        <select name="lanMother" id="">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>

                    <div class="conectividad--input">
                        <label for="wifiMother">Wi-Fi</label>
                        <select name="wifiMother" id="">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>

                    <div class="conectividad--input">
                        <label for="bluetoothMother">Bluetooth</label>
                        <select name="bluetoothMother" id="">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>

                    <div class="conectividad--input">
                        <label for="chipsetAudioMother">Chipset Audio</label>
                        <input type="text" name="chipsetAudioMother" id="">
                    </div>

                    <div class="conectividad--input">
                        <label for="cantUsb20Mother">Cantidad puertos USB 2.0</label>
                        <input type="number" name="cantUsb20Mother" id="">
                    </div>

                    <div class="conectividad--input">
                        <label for="cantUsb30Mother">Cantidad puertos USB 3.0</label>
                        <input type="number" name="cantUsb30Mother" id="">
                    </div>

                    <div class="conectividad--input">
                        <label for="displayPortMother">Display Port</label>
                        <input type="number" name="displayPortMother" id="">
                    </div>

                    <div class="conectividad--input">
                        <label for="hdmiMother">HDMI</label>
                        <input type="number" name="hdmiMother" id="">
                    </div>

                    <div class="conectividad--input">
                        <label for="vgaMother">VGA</label>
                        <input type="number" name="vgaMother" id="">
                    </div>

                </div>

                <div class="container__todo__sub__memoria">
                    <h2>MEMORIA</h2>
                    <div class="memoria--input">
                        <label for="cantSlotsMemoriaMother">Cantidad slots de memoria</label>
                        <input type="number" name="cantSlotsMemoriaMother" id="">
                    </div>

                    <div class="memoria--input">
                        <label for="capacidadMaximaMemoriaMother">Capacidad maxima memoria</label>
                        <input type="number" name="capacidadMaximaMemoriaMother" id="">
                    </div>
                    <div class="memoria--input">
                        <label for="velocidadMaximaMemoriaMother">Velocidad maxima memoria</label>
                        <input type="number" name="velocidadMaximaMemoriaMother" id="">
                    </div>
                </div>

            </div>

            <div class="container__todo__sub__imagenes">
                <h2>IMAGENES</h2>

                <div class="container__todo__sub__imagenes--img1">
                    <label for="img1">Imagen Principal</label>
                    <input type="file" name="img1" id="">
                    <ion-icon name="cloud-upload" id="uploadIcon"></ion-icon>
                </div>

                <div class="container__todo__sub__imagenesSecundarias">

                    <div class="container__todo__sub__imagenesSecundariasSub img2">
                        <label for="img2">2da Imagen (opcional)</label>
                        <input type="file" name="img2" id="">
                        <ion-icon name="cloud-upload" id="uploadIconSecundarias"></ion-icon>
                    </div>

                    <div class="container__todo__sub__imagenesSecundariasSub img3">
                        <label for="img3">3ra Imagen (opcional)</label>
                        <input type="file" name="img3" id="">
                        <ion-icon name="cloud-upload" id="uploadIconSecundarias"></ion-icon>
                    </div>

                    <div class="container__todo__sub__imagenesSecundariasSub img4">
                        <label for="img4">4ta Imagen (opcional)</label>
                        <input type="file" name="img4" id="">
                        <ion-icon name="cloud-upload" id="uploadIconSecundarias"></ion-icon>
                    </div>

                </div>

            </div>

            <div class="container__todo__sub--input--siguiente">
                <a href="agregarProducto.php">VOLVER</a>
                <input type="submit" value="AGREGAR" name="agregarMother">
            </div>

        </form>
    </div>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>