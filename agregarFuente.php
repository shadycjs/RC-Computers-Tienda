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
    $_SESSION['categoria'] = 8;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Agregar Fuente</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-agregarFuente.css">
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
            <h1>AGREGAR FUENTE</h1>
            
            <div class="container__todo__sub__caracteristicasPublicacion">
                <h2>CARACTERISTICAS DE PUBLICACION</h2>

                <div class="caracteristicasPublicacion--titulo">
                    <label for="nombreProducto">NOMBRE DEL PRODUCTO</label>
                    <input type="text" name="nombreProducto" id="" placeholder="Por ej: P650B 650W 80 Plus Bronze ...">
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
                    <textarea name="descProducto" id="" cols="30" rows="10" placeholder="Por ej: Fuente certificada 80 Plus Bronze..."></textarea>
                </div>

            </div>

            <div class="container__todo__sub__generalRefrigeracionMemoria">
                <div class="container__todo__sub__caracteristicasGenerales">
                    <h2>CARACTERISTICAS GENERALES</h2>

                    <div class="caracteristicasGenerales--input">
                        <label for="potenciaFuente">Watts reales</label>
                        <input type="number" name="potenciaFuente" id="" placeholder="Por ej: 650...">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="factorFormaFuente">Factor de forma</label>
                        <input type="text" name="factorFormaFuente" id="">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="tamanioFanCoolerFuente">Tamaño fan cooler</label>
                        <input type="number" name="tamanioFanCoolerFuente" id="">
                    </div>

                    <div class="caracteristicasGenerales--input">
                        <label for="certificacionFuente">Certificacion</label>
                        <input type="text" name="certificacionFuente" id="" placeholder="Por ej: 80 Plus Bronze...">
                    </div>

                </div>

                <div class="container__todo__sub__cableado">
                    <div class="container__todo__sub__cableado">
                        <h2>CABLEADO</h2>
                        <div class="cableado--input">
                            <label for="conectorMother204PinFuente">Conector Mother 20 pin</label>
                            <input type="number" name="conectorMother204PinFuente" id="">
                        </div>

                        <div class="cableado--input">
                            <label for="conectorCpu44PinFuente">Conector Cpu 44 Pin Fuente</label>
                            <input type="number" name="conectorCpu44PinFuente" id="">
                        </div>

                        <div class="cableado--input">
                            <label for="conectorCpu8PinFuente">Conector Cpu 8 Pin Fuente</label>
                            <input type="number" name="conectorCpu8PinFuente" id="">
                        </div>

                        <div class="cableado--input">
                            <label for="conectorSataFuente">Conexiones SATA</label>
                            <input type="number" name="conectorSataFuente" id="">
                        </div>

                        <div class="cableado--input">
                            <label for="conectorMolex4PinFuente">Conexiones MOLEX</label>
                            <input type="number" name="conectorMolex4PinFuente" id="">
                        </div>

                        <div class="cableado--input">
                            <label for="conectorFloppy4PinFuente">Conexiones FLOPPY</label>
                            <input type="number" name="conectorFloppy4PinFuente" id="">
                        </div>

                        <div class="cableado--input">
                            <label for="conectorPcie62PinFuente">Conector PCIe 6 Pines</label>
                            <input type="number" name="conectorPcie62PinFuente" id="">
                        </div>

                    </div>

                </div>

                <div class="container__todo__sub__iluminacion">
                    <h2>ILUMINACION</h2>

                    <div class="iluminacion--input">
                        <label for="iluminacionFuente">Iluminacion</label>
                        <select name="iluminacionFuente" id="">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
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
                <input type="submit" value="AGREGAR" name="agregarFuente">
            </div>

        </form>
    </div>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>