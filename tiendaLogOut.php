<?php

    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    require 'funciones/usuarios.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\header.php';
    if( isset($_POST['btnReg']) ){
        registrarUser();
    }
    $productos = listarProductos();
    if( isset($_POST['btnIngresar']) ){
        login();
    }
    $productos = buscarProducto();
    $resultadoBusqueda = mysqli_num_rows($productos);

    //PAGINACION
    $total_registros = totalRegistrosProductos();
    $registros_por_pagina = 6;
    $total_paginas = ceil($total_registros/$registros_por_pagina);
    $pagina_actual = isset($_GET['pagActual']) ? $_GET['pagActual'] : 1;
    $primer_registro = ($pagina_actual-1) * $registros_por_pagina;
    
    if( isset($_POST['reestablecerClave']) ){
        $chequeo = mailResetPass();
    }

    if( isset($_POST['modificarClave']) ){
        $modificarClaveMail = modificarClaveMail();
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Tienda</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-tienda.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <style type="text/css">
        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -5px;
        }
    </style>
</head>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\login.php'
?>
<main class="mainClass">

<?php
    if( isset($_POST['btnReg']) ){
?>
<div class="check__register--fondo"></div>
    <div class="check__register--container">
        <span class="check__register-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>¡USUARIO REGISTRADO CON ÉXITO!</h1>
        <div class="check__register-logueate">Logueate clickeando <b class="check__register-logueate-aqui">AQUI</b> para acceder a todos nuestros productos</div>
    </div>
</div>
<?php
    }
?>

<?php
    if( isset($modificarClaveMail) ){
?>
<div class="check__register--fondo"></div>
    <div class="check__register--container">
        <span class="check__register-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>¡SE MODIFICÓ LA CONTRASEÑA CON ÉXITO!</h1>
        <div class="check__register-logueate">Logueate clickeando <b class="check__register-logueate-aqui">AQUI</b> para acceder a todos nuestros productos</div>
    </div>
</div>
<?php
    }
?>

<?php
    if( isset($_GET['error']) ){
        $error = $_GET['error'];

        $mensaje = match( $error ){
            '1' => 'Intentelo nuevamente haciendo click aqui...',
            '2' => 'Tiene que loguearse para ingresar al sitio',
            '3' => 'Debe registrarse y loguearse para agregar productos al carrito',
            '4' => 'Intente nuevamente poniendo su mail',
            '5' => 'Las contraseñas deben coincidir',
            '6' => 'Intente nuevamente con el codigo enviado al mail'
        };

        $mensaje2 = match( $error ){
            '1' => 'USUARIO Y/O CONTRASEÑA INCORRECTAS',
            '2' => 'NO TIENE PERMISO PARA ACCEDER',
            '3' => 'TIENE QUE REGISTRARSE PARA COMPRAR',
            '4' => 'DIRECCION DE CORREO INCORRECTA',
            '5' => 'LAS CLAVES PROPORCIONADAS NO COINCIDEN',
            '6' => 'EL CODIGO ES INCORRECTO O HA CADUCADO'
        }
?>
    <div class="errorFondo"></div>
    <div class="error">
        <span class="error__icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1><?= $mensaje2 ?></h1>
        <p class="error__p"><?= $mensaje ?></p>
    </div>
<?php
    }
?>

<?php
    if( isset($chequeo) ){
        $codigo = generarCodigo();
        almacenarCodigo( $codigo );
        enviarMail($chequeo['usuNombre'], $codigo);
?>

<div class="errorFondo"></div>
    <div class="error" style="background: linear-gradient(to top, rgb(32, 29, 29), #575353);
                              padding: 10px;">
        <span class="error__icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>Email enviado con exito! chequee su casilla para reestablecer su clave</h1>
        <form action="" method="post" style="display: flex;
                                                              flex-direction: column;
                                                              gap: 10px;
                                                              width: 100%;
                                                              justify-content: center;
                                                              align-items: center">
                Ingrese el codigo enviado <br>
                <div class="input-box">
                    <input type="text" name="codigo" class="form-control my-3" required style=" width: 100%;
                                                                                       height: 100%;
                                                                                       background-color: transparent;
                                                                                       border: none;
                                                                                       outline: none;
                                                                                       font-size: 1em;
                                                                                       color: #fff;
                                                                                       font-weight: 600;
                                                                                       padding: 0 35px 0 5px;">
                    <label for="usuEmail">Codigo:</label>
                </div>
                <button class="btn" type="submit">Enviar</button>
            </form>
    </div>

<?php
    }
?>

<?php
if(isset($_POST['codigo'])){
    $chequeoCodigo = chequearCodigo();
    if( $chequeoCodigo ){
?>

<div class="errorFondo"></div>
    <div class="error" style="background: linear-gradient(to top, rgb(32, 29, 29), #575353);
                              padding: 10px;">
        <span class="error__icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>Cambio de clave:</h1>
        <form action="" method="post" style="display: flex;
                                            flex-direction: column;
                                            gap: 10px;
                                            width: 100%;
                                            justify-content: center;
                                            align-items: center">
                <br>
                <div class="input-box">
                    <input type="password" name="nuevaClave" class="form-control my-3" required style=" width: 100%;
                                                                                       height: 100%;
                                                                                       background-color: transparent;
                                                                                       border: none;
                                                                                       outline: none;
                                                                                       font-size: 1em;
                                                                                       color: #fff;
                                                                                       font-weight: 600;
                                                                                       padding: 0 35px 0 5px;">
                    <label for="usuEmail">Nueva contraseña:</label>
                </div>
                <div class="input-box">
                    <input type="password" name="nuevaClave2" class="form-control my-3" required style=" width: 100%;
                                                                                       height: 100%;
                                                                                       background-color: transparent;
                                                                                       border: none;
                                                                                       outline: none;
                                                                                       font-size: 1em;
                                                                                       color: #fff;
                                                                                       font-weight: 600;
                                                                                       padding: 0 35px 0 5px;">
                    <label for="usuEmail">Repita contraseña:</label>
                </div>
                <button class="btn" type="submit" name="modificarClave">Modificar contraseña</button>
            </form>
    </div>

<?php
    }else{
?>

<div class="errorFondo"></div>
    <div class="error">
        <span class="error__icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>EL CODIGO ES INCORRECTO O HA CADUCADO</h1>
        <p class="error__p">Intente nuevamente con el codigo enviado al mail</p>
    </div>

<?php
    }
}
?>

<div class="container-items" id="shopContent"> <!-- PAGINA PRINCIPAL GRID TIENDA -->

    <div class="container__buscador__grilla">

        <form action="" method="get" class="container__buscador__grilla--buscador">
            <button type="submit" class="button__buscador"><ion-icon name="search-circle" class="icono__buscador"></ion-icon></button>
            <input type="search" name="search" id=""> 
        </form>

        <div class="container__resultado">
            <label for="resultado">Resultado de busqueda: (<?= $resultadoBusqueda ?>)</label>
        </div>

        <div class="container__lista__grid">
            <ion-icon name="list" class="icono__lista__grid" id="list"></ion-icon>
            <ion-icon name="grid" class="icono__lista__grid" id="grid"></ion-icon>
        </div>

    </div>

<?php
    if($resultadoBusqueda == 0){
?>
    <div class="container__todo__sinResultados">
        <h1>NO HAY RESULTADOS DE BUSQUEDA</h1>
        <ion-icon name="ban" id="iconoSinProductosCarrito"></ion-icon>
    </div>
<?php
    }
?>

<?php
    $class = 0;
    while($producto = mysqli_fetch_assoc($productos)) {
        if($producto['estadoPrd'] == 1){
            $class ++;
?>
    <div class="item" id="item__grid-<?= $class ?>">
        <figure>
            <img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="producto">
        </figure>
        <div class="info-producto">
            <h2><?= $producto['nombrePrd'] ?></h2>
            <p class="precio">$<?= number_format($producto['precioPrd'], 0, ',', '.' ) ?></p>
            <p><?= $producto['descPrd'] ?></p>
            <p>Stock: <?= $producto['stockPrd'] ?></p>
            <a href="http://localhost/RC/Tienda/detalleProductoUser.php?id=<?= $producto['idPrd'] ?>&idCategoria=<?= $producto['idCategoria'] ?>" class="info-producto-submit">VER DETALLE</a>
        </div>
        <ul class="item__contacto">
            <li><ion-icon name="logo-whatsapp"></ion-icon>Whatsapp</li>
            <li><ion-icon name="mail"></ion-icon>Mail</li>
        </ul>
    </div>
<?php
    }}
?>

    <div class="container__todo__paginacion">
        <div class="container__todo__paginacion__sub">
            <div class="container__todo__paginacion__sub--numeracion">
<?php
    if($pagina_actual > 1){
?>
                <a href="tiendaLogOut.php?pagActual=<?= $pagina_actual-1 ?>">Anterior</a>
<?php
    }
?>
<?php
            for($i=1; $i<$total_paginas+1; $i++){
?>
                <a href="tiendaLogOut.php?pagActual=<?= $i ?>"><?= $i ?></a>
<?php
            }
?>

<?php
    if($pagina_actual < $total_paginas){
?>
                <a href="tiendaLogOut.php?pagActual=<?= $pagina_actual+1 ?>">Siguiente</a>
<?php
    }
?>
            </div>
        </div>
    </div>
    </div>
    
    <?php include 'C:\xampp\htdocs\RC\Tienda\categoriasAside.php'; ?>

</main>

<?php
    include 'C:\xampp\htdocs\RC\Tienda\footer.php'
?>