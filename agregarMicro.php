<?php

    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/clientes.php';
    require 'funciones/usuarios.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    autenticar();
 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Agregar Microprocesador</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-agregarMicro.css">
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
        <form method="post" action="agregarImagenes.php" class="container__todo__sub">    
            <h1>AGREGAR MICROPROCESADOR</h1>
            <div class="container__todo__sub__generalRefrigeracionMemoria">
                <div class="container__todo__sub__caracteristicasGenerales">
                    <h2>CARACTERISTICAS GENERALES</h2>
                    <div class="caracteristicasGenerales--input">
                        <label for="nucleosMicro">Nucleos</label>
                        <input type="number" name="nucleosMicro" id="">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="hilosMicro">Hilos</label>
                        <input type="number" name="hilosMicro" id="">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="socketMicro">Socket</label>
                        <input type="text" name="socketMicro" id="">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="frecuenciaBaseMicro">Frecuencia Base</label>
                        <input type="number" name="frecuenciaBaseMicro" id="">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="graficosIntegradosMicro">Graficos Integrados</label>
                        <select name="graficosIntegradosMicro" id="">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="modeloGraficosIntegradosMicro">Modelo graficos integrados</label>
                        <input type="text" name="modeloGraficosIntegradosMicro" id="">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="litografiaMicro">Litrografia</label>
                        <input type="text" name="litografiaMicro" id="">
                    </div>

                </div>

                <div class="container__todo__sub__coolerDisipador">
                    <h2>COOLER Y DISIPADOR</h2>

                    <div class="coolerDisipador--input">
                        <label for="coolerMicro">Cooler</label>
                        <select name="coolerMicro" id="">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>

                    <div class="coolerDisipador--input">
                        <label for="tdpMicro">TDP</label>
                        <input type="number" name="tdpMicro" id="">
                    </div>

                    <div class="coolerDisipador--input">
                        <label for="maxTempMicro">Maxima temperatura</label>
                        <input type="number" name="maxTempMicro" id="">
                    </div>

                </div>

                <div class="container__todo__sub__memoria">
                    <h2>MEMORIA</h2>
                    <div class="memoria--input">
                        <label for="cacheL1Micro">Cache L1</label>
                        <input type="number" name="cacheL1Micro" id="">
                    </div>

                    <div class="memoria--input">
                        <label for="cacheL2Micro">Cache L2</label>
                        <input type="number" name="cacheL2Micro" id="">
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
                <input type="submit" value="SIGUIENTE">
            </div>

        </form>
    </div>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>