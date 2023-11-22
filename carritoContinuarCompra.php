<?php

    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';

    $infoClientes = infoCliente();

    if(mysqli_num_rows($infoClientes)!= 0){
        $infoCliente =  mysqli_fetch_assoc($infoClientes);
        $CliProvincia = $infoCliente['CliProvincia'];
        $CliCiudad = $infoCliente['CliCiudad'];
        $CliCalle = $infoCliente['CliCalle'];
        $CliAltura = $infoCliente['CliAltura'];
        $CliPiso = $infoCliente['CliPiso'];
        $CliDepto = $infoCliente['CliDepto'];
        $CliTorre = $infoCliente['CliTorre'];
        $CliLocalidad = $infoCliente['CliLocalidad'];
        $CliPostal = $infoCliente['CliPostal'];
        $CliObser = $infoCliente['CliObser'];
        $telefono = $infoCliente['telefono'];
        $dniCuit = $infoCliente['dniCuit'];
    }

    $provincias = array( 'Buenos Aires'
    ,'Buenos Aires Capital'
    ,'Catamarca'
    ,'Chaco'
    ,'Chubut'
    ,'Cordoba'
    ,'Corrientes'
    ,'Entre Rios'
    ,'Formosa'
    ,'Jujuy'
    ,'La Pampa'
    ,'La Rioja'
    ,'Mendoza'
    ,'Misiones'
    ,'Neuquen'
    ,'Rio Negro'
    ,'Salta'
    ,'San Juan'
    ,'San Luis'
    ,'Santa Cruz'
    ,'Santa Fe'
    ,'Santiago del Estero'
    ,'Tierra del Fuego'
    ,'Tucuman');
$cantProvincias = count($provincias);

    $clientePorId = listarClientePorId();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Carrito de compras</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-carritoContinuarCompra.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
</head>


<main class="mainClass">

<div class="container__timelapse">

    <div class="container__timelapse__productos">
        <h2 class="prdH2">PRODUCTOS</h2>
    </div>

    <div class="container__timelapse__envio">
        <h2 class="enviodH2">ENVIO</h2>
    </div>

    <div class="container__timelapse__pago">
        <h2 id="pagoH2">FORMA DE PAGO</h2>
    </div>
    
    <div class="container__timelapse__confirmarCompra">
        <h2 id="confH2">CONFIRMAR COMPRA</h2>
    </div>

</div>

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
    if( isset($_GET['error']) ){
        $error = $_GET['error'];

        $mensaje = match( $error ){
            '1' => 'Debe completar todos los campos',
            '2' => 'Tiene que loguearse para ingresar al sitio',
            '3' => 'Debe elegir entre los transportes ofrecidos para continuar con su compra'
        };

        $mensaje2 = match( $error ){
            '1' => 'ERROR AL INGRESAR LOS DATOS DE ENVIO',
            '2' => 'NO TIENE PERMISO PARA ACCEDER',
            '3' => 'DEBE SELECCIONAR UN TRANSPORTE'
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

    <div class="containerTodo" id="formulario">   
<?php
    if( empty($_SESSION['CARRITO']) ){
?>
    <div class="container__sinProductosCarrito">
        <h3>NO HAY PRODUCTOS EN SU CARRITO...</h3>
        <ion-icon name="ban" id="iconoSinProductosCarritoPagina"></ion-icon>
        <a href="tiendaUser.php">VOLVER A CATALOGO</a>
    </div>
<?php
    }else{
?>
        <h1 id="tituloCarrito">MIS PRODUCTOS EN CARRITO:</h1>
        <div class="containerModal">



<?php
$total = 0;
if(!empty($_SESSION['CARRITO'])){

    foreach( $_SESSION['CARRITO'] as $indice => $producto ){

        $nombreProducto = $producto['nombre'];
        $precioProducto = $producto['precio'];
        $cantidadProducto = $producto['cantidad'];
        $imagenProducto = $producto['img'];

        $idProductos = array_column($_SESSION['CARRITO'],'id');
        $posicionPrd = array_search($producto['id'],$idProductos);

?>
            <div class="containerModal__carrito">

                <div class="containerModal__carrito__imgNombre">
                    <div class="containerModal__carrito__imgNombre--img">
                        <img src="images/<?= $imagenProducto ?>" alt="">
                    </div>
                    <div class="containerModal__carrito__imgNombre--nombre">
                        <b><?= $nombreProducto ?></b>
                    </div>
                </div>

                <div class="containerModal__carrito__precio">
                    <p>P/unitario: $<?= number_format($precioProducto,2) ?></p>
                </div>

                <form action="" method="post" class="containerModal__carrito__cantidad">
                    <button type="submit" name="restarPrd"><ion-icon name="remove" class="agregarRestarPrd"></ion-icon></button>
                    <input type="number" name="" value="<?= $cantidadProducto ?>" readonly>
                    <input type="hidden" name="indice" value="<?= $posicionPrd ?>">
                    <button type="submit" name="sumarPrd"><ion-icon name="add" class="agregarRestarPrd"></ion-icon></button>
                </form>

                <div class="containerModal__carrito__subtotal">
                    <p>Subtotal: $<?= number_format($precioProducto*$cantidadProducto,2) ?></p>
                </div>

                <form action="" method="post" class="containerModal__carrito__eliminarPrd">
                    <input type="hidden" name="idPrd" value="<?= $producto['id'] ?>">
                    <button name="borrarPrd"><ion-icon name="trash" class="iconoEliminarItem"></ion-icon></button>
                </form>

            </div>
<?php
    $total = $total+($precioProducto*$cantidadProducto);
    }
?>

    
            
    <form action="carritoContinuarCompraPago.php" method="post" class="contenedor__carrito__modal__envios">
                <h3>SELECCIONE UN TRANSPORTE</h3>
                <div class="contenedor__carrito__modal__transportes">

                    <div class="contenedor__carrito__modal__transportes--andreani">

                        <label for="andreani">Andreani</label>
                        <input type="radio" name="transporte" id="andreani" value="andreani">
                        <div class="contenedor__carrito__modal__transportes--andreani-img">
                            <img src="images/logo andreani.jpg" alt="">
                        </div>
                        <p id="precioAndreani">$2.300</p>
                        <input type="hidden" name="precioAndreani" value="2300">                    
                    </div>

                    <div class="contenedor__carrito__modal__transportes--oca">

                        <label for="oca">Oca</label>
                        <input type="radio" name="transporte" id="oca" value="oca">
                        <div class="contenedor__carrito__modal__transportes--oca-img">
                            <img src="images/logooca.png" alt="">
                        </div>
                        <p id="precioOca">$4.300</p>
                        <input type="hidden" name="precioOca" value="4300">
                    </div>
                </div>
        <div class="container__todo__sub">

            <div class="container__sub__2">

                <div class="container__sub__3 TituloInfoPersonal">
                    <h3>Información para el envío:</h3>
                </div>

            </div>
            
            <div class="container__sub__2" id="containerProvinciaCiudad">

                <div class="container__sub__3--provinciaCiudad">
                    <div class="container__sub__4--provincia">
                        <label for="provincia">Provincia</label>
                        <select name="provinciaCli" id="">
<?php
                    for( $i=0;$i<$cantProvincias;$i++ ){
?>
                    <option <?php if(mysqli_num_rows($infoClientes)!= 0){ if($provincias[$i] == $CliProvincia){ echo 'selected'; } } ?> value="<?= $provincias[$i] ?>"><?= $provincias[$i] ?></option>
<?php
                    }
?>
                        </select>
                    </div>
                    <div class="container__sub__4--ciudad">
                        <input type="text" name="ciudadCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $CliCiudad : '' ?>" required>
                        <label for="ciudad">Ciudad</label>
                    </div>
                </div>

            </div>
            
            <div class="container__sub__2">

                <div class="container__sub__3--calleAltura" id="containerCalleAltura">
                    <div class="container__sub__4--calle">
                        <input type="text" name="calleCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $CliCalle : '' ?>" required>
                        <label for="calle">Calle</label>
                    </div>
                    <div class="container__sub__4--altura">
                        <input type="number" name="alturaCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $CliAltura : '' ?>" required>
                        <label for="altura">Altura</label>
                    </div>
                </div>

            </div>
            
            <div class="container__sub__2">

                <div class="container__sub__3--pisoDeptoTorre" id="containerpisoDeptoTorre">
                    <div class="container__sub__4--piso">
                        <input type="number" name="pisoCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $CliPiso : '' ?>" required>
                        <label for="piso">Piso</label>
                    </div>
                    <div class="container__sub__4--Depto">
                        <input type="number" name="deptoCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $CliDepto : '' ?>" required>
                        <label for="depto">Depto</label>
                    </div>
                    <div class="container__sub__4--Torre">
                        <input type="number" name="torreCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $CliTorre : '' ?>" required>
                        <label for="torre">Torre</label>
                    </div>
                </div>

            </div>
            
            <div class="container__sub__2">

                <div class="container__sub__3--localidadCodpostal" id="containerlocalidadCodpostal">
                    <div class="container__sub__4--localidad">
                        <input type="text" name="localidadCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $CliLocalidad : '' ?>" required>
                        <label for="localidad">Localidad</label>
                    </div>
                    <div class="container__sub__4--codpostal">
                        <input type="number" name="codpostalCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $CliPostal : '' ?>" required>
                        <label for="codpostal">Cod.Postal</label>
                    </div>

                </div>

            </div>
            
            <div class="container__sub__2">

                <div class="container__sub__3--observaciones" id="containerobservaciones">
                    <div class="container__sub__4--observaciones">
                        <label for="observaciones">Observaciones</label>
                        <textarea name="observacionesCli" id="" cols="30" rows="10"><?= mysqli_num_rows($infoClientes)!= 0 ? $CliObser : '' ?></textarea>
                    </div>
                </div>

            </div>
        </div>

        <div class="container__infoReceptorEnvio">
            <h3>Datos de la persona autorizada a recibir el envio</h3>
            <div class="container__infoReceptorEnvio__sub">

                <div class="container__infoReceptorEnvio__sub__inputs nombre">
                    <input type="text" name="nombreRecep" id="" required>
                    <label for="nombreRecep">Nombre(Del receptor)</label>
                </div>

                <div class="container__infoReceptorEnvio__sub__inputs apellido">
                    <input type="text" name="apellidoRecep" id="" required>
                    <label for="apellidoRecep">Apellido(Del receptor)</label>
                </div>

                <div class="container__infoReceptorEnvio__sub__inputs dni">
                    <input type="number" name="dniCuilRecep" id="" required>
                    <label for="dniCuilRecep">DNI(Del receptor)</label>
                </div>

                <div class="container__infoReceptorEnvio__sub__inputs telefono">
                    <input type="number" name="telRecep" id="" required>
                    <label for="telRecep">Telefono(Del receptor)</label>
                </div>

            </div>
        </div>

        </div>




<?php
}
?>
                <input type="hidden" name="idCli" value="<?= $clientePorId['idCli'] ?>">
<div class="container__siguente">
            <div id="anterior">ANTERIOR</div>
            <div id="contadorSiguiente">SIGUIENTE</div>
            <input type="submit" name="sig" value="SIGUIENTE" id="contadorSiguienteInput">
        </div>
</form>
        <div class="contenedor__carrito__modal__sub--totalCompra" id="TOTAL">
            <h1>TOTAL: $<?= (isset($_SESSION['CARRITO']))? number_format($total,2,'.',',') : '0' ?></h1>
        </div>


        
        <a href="tiendaUser.php">VOLVER A CATALOGO</a>


        </div>
<?php
}
?>
            
        </div>
        
        
    </div>



</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>