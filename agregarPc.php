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
    <title>RC Computers - Agregar Pc</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-agregarPc.css">
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
            <h1>CONFIGURACION DEL EQUIPO</h1>

            <div class="container__todo__sub--input" id="marca">
                <div class="container__todo__sub2--input">
                <label for="marcaPc">Marca del producto </label>
                <select name="marcaPc" id="">
                    <option value="1">AMD</option>
                    <option value="2">INTEL</option>
                </select>
                </div>
                <div class="container__todo__sub2--input">
                    <label for="monitor"><img src="http://localhost/RC/monitor.png" alt=""> Monitor</label>
                    <input type="text" name="monitor" id="" placeholder="Por ej. Samsung 24...">
                </div>
            
            </div>

            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <label for="micro"><img src="http://localhost/RC/microprocesador.png" alt=""> Microprocesador</label>
                    <input type="text" name="micro" id="" placeholder="Por ej. AMD Athlon...">
                </div>
                <div class="container__todo__sub2--input">
                    <label for="mother"><img src="http://localhost/RC/motherboard.png" alt=""> Motherboard</label>
                    <input type="text" name="mother" id="" placeholder="Por ej. MSI A320...">
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <label for="ram"><img src="http://localhost/RC/memoriaram.png" alt=""> Memoria ram</label>
                    <input type="text" name="ram" id="" placeholder="Por ej. Corsair Ven...">
                </div>
                <div class="container__todo__sub2--input">
                    <label for="video"><img src="http://localhost/RC/placadevideo.png" alt=""> Placa de video</label>
                    <input type="text" name="video" id="" placeholder="Por ej. GTX 1650...">
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <label for="duro"><img src="http://localhost/RC/almacenamiento.png" alt=""> Disco duro</label>
                    <input type="text" name="duro" id="" placeholder="Por ej. WD Blue 1TB...">
                </div>
                <div class="container__todo__sub2--input">
                    <label for="solido"><img src="http://localhost/RC/almacenamiento.png" alt=""> Disco solido</label>
                    <input type="text" name="solido" id="" placeholder="Por ej. SSD 240GB...">
                </div>
            </div>
            <div class="container__todo__sub--input">
                <div class="container__todo__sub2--input">
                    <label for="fuente"><img src="http://localhost/RC/fuente.png" alt=""> Fuente</label>
                    <input type="text" name="fuente" id="" placeholder="Por ej. 600W Corsair...">
                </div>
                <div class="container__todo__sub2--input">
                    <label for="gabinete"><img src="http://localhost/RC/gabinete.png" alt=""> Gabinete</label>
                    <input type="text" name="gabinete" id="" placeholder="Por ej. MagnumTech Kit...">
                </div>
            </div>


            <div class="container__todo__sub--input--siguiente">
                <a href="publicacionesListado.php">VOLVER</a>
                <input type="submit" value="SIGUIENTE">
            </div>

        </div>
    </div>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>