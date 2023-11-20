<?php

    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';   
    require 'funciones/compras.php';
    require 'funciones/clientes.php';
    error_reporting(-1);
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    if( isset($_POST['btnReg']) ){
        registrarUser();
    }
    if( isset($_POST['btnIngresar']) ){
        login();
    };
    $rol = verRol();

    if( isset($_POST['cambiarImgPerfil']) ){
        $modificaImg = modificarImgPerfil();
    };
    $compras = verCompras();
    $conteoCompras = mysqli_num_rows($compras);
    $usuarios = verUsuarioPorId();

    if( isset($_GET['numeroVenta']) ){
        $bajarCompro = bajarComprobante();
    }

    if( isset($_GET['numVentaFactura']) ){
        $bajarFactura = bajarFactura();
    }

    if( isset($_POST['agregarDatosUser']) ){
        $actualizarUser = agregarCliente();
    }elseif( isset($_POST['modificarDatosUser']) ){
        $actualizarUser = modificarCliente();
    }

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
    <title>RC Computers - Configuracion usuario</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-configuracionUser.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
    
<?php include 'modalCerrarSesion.php'; ?>


    <div class="container__todo">
    <div class="container__todo__aside">
            <div class="container__infoUser" id="infoUser">
                <ion-icon class="iconoAside" name="person-sharp"></ion-icon>
                <h1>MI INFORMACION</h1>
            </div>
            <hr>
            <div class="container__infoUser" id="misCompras">
                <ion-icon class="iconoAside" name="bag-handle"></ion-icon>
                <h1>MIS COMPRAS</h1>
            </div>
            <hr>
            <div class="container__infoUser" id="cambiarClave">
                <ion-icon class="iconoAside" name="key"></ion-icon>
                <h1>CAMBIAR CONTRASEÑA</h1>
            </div>
            <hr>
            <div class="container__infoUser" id="cerrarSesion">
                <ion-icon class="iconoAside" name="log-out"></ion-icon>
                <h1>CERRAR SESION</h1>
            </div>
        </div>
        <div class="container__todo__sub">


            <form method="post" action="" enctype="multipart/form-data" class="container__sub__2" id="containerImagenDatos">

                <div class="container__sub__3--imagen">
                    <div class="container__sub__3--imagen--container">
                        <img src="http://localhost/RC/Tienda/images/<?= $_SESSION['imagenActual']['usuImg'] ?>" alt="">
                    </div>
                    <div class="container__sub__4--imagenNueva">
                        <label for="file">ELEGI TU FOTO <ion-icon name="cloud-upload" id="uploadIcon"></ion-icon></label>
                        <input type="file" name="imgUserNueva" id="">
                    </div>
                    <input type="hidden" name="imgUserVieja" value="<?= $_SESSION['imagenActual']['usuImg'] ?>">
                    <input type="submit" value="Cambiar foto de perfil" name="cambiarImgPerfil" id="cambiarFotoPerfil">
                </div>

                <div class="container__sub__3--datos">
                    <div class="container__sub__4--nombreRol">
                        <h1><?= $_SESSION['usuNombre'] ?> <?= $_SESSION['usuApellido'] ?></h1>
                        <b><?= $rol['rol'] ?></b>
                    </div>
                    <div class="container__sub__4--mail">
                        <label for="email">EMAIL</label>
                        <input type="email" name="email" value="<?= $usuarios['usuEmail'] ?>">
                    </div>
                </div>  

            </form>

        <form action="" method="post" class="container__sub__2--datos">
            <div class="container__sub__2">

                <div class="container__sub__3--TituloInfoPersonal">
                    <h1>Datos del usuario:</h1>
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
                        <input type="text" name="ciudadCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $clientePorId['CliCiudad'] : '' ?>" required>
                        <label for="ciudad">Ciudad</label>
                    </div>
                </div>

            </div>
            
            <div class="container__sub__2">

                <div class="container__sub__3--calleAltura" id="containerCalleAltura">
                    <div class="container__sub__4--calle">
                        <input type="text" name="calleCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $clientePorId['CliCalle'] : '' ?>" required>
                        <label for="calle">Calle</label>
                    </div>
                    <div class="container__sub__4--altura">
                        <input type="number" name="alturaCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $clientePorId['CliAltura'] : '' ?>" required>
                        <label for="altura">Altura</label>
                    </div>
                </div>

            </div>
            
            <div class="container__sub__2">

                <div class="container__sub__3--pisoDeptoTorre" id="containerpisoDeptoTorre">
                    <div class="container__sub__4--piso">
                        <input type="number" name="pisoCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $clientePorId['CliPiso'] : '' ?>" required>
                        <label for="piso">Piso</label>
                    </div>
                    <div class="container__sub__4--Depto">
                        <input type="number" name="deptoCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $clientePorId['CliDepto'] : '' ?>" required>
                        <label for="depto">Depto</label>
                    </div>
                    <div class="container__sub__4--Torre">
                        <input type="number" name="torreCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $clientePorId['CliTorre'] : '' ?>" required>
                        <label for="torre">Torre</label>
                    </div>
                </div>

            </div>
            
            <div class="container__sub__2">

                <div class="container__sub__3--localidadCodpostal" id="containerlocalidadCodpostal">
                    <div class="container__sub__4--localidad">
                        <input type="text" name="localidadCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $clientePorId['CliLocalidad'] : '' ?>" required>
                        <label for="localidad">Localidad</label>
                    </div>
                    <div class="container__sub__4--codpostal">
                        <input type="number" name="codpostalCli" value="<?= mysqli_num_rows($infoClientes)!= 0 ? $clientePorId['CliPostal'] : '' ?>" required>
                        <label for="codpostal">Cod.Postal</label>
                    </div>

                </div>

            </div>
            
            <div class="container__sub__2">

                <div class="container__sub__3--observaciones" id="containerobservaciones">
                    <div class="container__sub__4--observaciones">
                        <label for="observaciones">Observaciones</label>
                        <textarea name="observacionesCli" id="" cols="30" rows="10"><?= mysqli_num_rows($infoClientes)!= 0 ? $clientePorId['CliObser'] : '' ?></textarea>
                    </div>
                </div>

            </div>
            <input type="hidden" name="idCli" value="<?= $clientePorId['idCli'] ?>">
<?php
    if($verificarCliente == null){
?>

            <input type="submit" name="agregarDatosUser" value="Agregar Datos" id="enviarModificarCambios">

<?php
    }else{
?>
            <input type="submit" name="modificarDatosUser" value="Modificar Datos" id="enviarModificarCambios">
<?php
    }
?>
        </form>

        <div class="container__todo__compras__sub">
            <?php
                if( $conteoCompras <= 0 ){
            ?>

                    <div class="container__todo__compras__sub--sinCompras">
                        <h1>NO TIENES VENTAS AUN...</h1>
                        <ion-icon name="ban" id="iconoSinProductosCarrito"></ion-icon>
                    </div>

            <?php
                }else{
            ?>
                    <h1>TUS COMPRAS</h1>

                    <table class="container__todo__compras__sub--table">

                        <tr class="container__todo__compras__sub--table-tr-1">
                            <td>Nro Compra</td>
                            <td>Fecha</td>
                            <td>Total</td>
                            <td>Condicion de pago</td>
                            <td>Envio</td>
                            <td>Transporte</td>
                            <td>Comprobante de pago</td>
                            <td>Factura</td>
                            <td>Detalle</td>
                        </tr>

            <?php
                while( $compra = mysqli_fetch_assoc($compras) ){
                    $configuracionUser = 'configuracionUser';
                    if($compra['comprobantePago'] == 'Aun sin emitir'){
                        $configuracionUser = 'subirComprobantePago';
                    }
            ?>
                        <tr id="container__todo__compras__sub--table-tr-2">
                            <td><?= $compra['nroVenta'] ?></td>
                            <td><?= $compra['fecha'] ?></td>
                            <td>$<?= number_format($compra['Total'], 2) ?></td>
                            <td><?= $compra['condicionPago'] ?></td>
                            <td><?= $compra['envio'] ?></td>
                            <td><?= $compra['transporte'] ?></td>
                            <td><a href="<?= $configuracionUser ?>.php?numeroVenta=<?= $compra['nroVenta'] ?>"> <?= $compra['comprobantePago'] != 'Aun sin emitir'? $compra['comprobantePago'] : $subirFacturaString = 'SUBIR COMPROBANTE'; ?></a></td>
                            <td><a href="configuracionUser.php?numVentaFactura=<?= $compra['nroVenta'] ?>"> <?= $compra['factura'] ?></a></td>
                            <td><a href="detalleDeVenta.php?nroVenta=<?= $compra['nroVenta'] ?>">Ver detalle</a></td>
                        </tr>
            <?php
                }
            }
            ?>
            
                    </table>

        </div>


        <form method="post" action="resultadoModificarClave.php" class="container__todo_cambiarClave__sub">
            <h1>CAMBIO DE CLAVE</h1>

            <div class="container__todo__cambiarClave__sub__2 actual">
                <label for="contraActual">Contraseña actual</label>
                <input type="password" name="contraActual" id="contraActual">
                <div class="container__mensajeError contraActual" id="msjClave">
                    Debe completar el campo Contraseña actual.
                </div>
            </div>

            <div class="container__todo__cambiarClave__sub__2 nueva">
                <label for="contraNueva">Contraseña nueva</label>
                <input type="password" name="contraNueva" id="contraNueva">
                <div class="container__mensajeError contraNueva" id="msjClaveNueva">
                    Debe completar el campo Contraseña nueva.
                </div>
            </div>

            <div class="container__todo__cambiarClave__sub__2 repetir">
                <label for="contraRepetir">Repetir Contraseña</label>
                <input type="password" name="contraRepetir" id="contraRepetir">
                <div class="container__mensajeError contraRepetir" id="msjClaveRepetir">
                    Debe completar el campo Repita contraseña con un valor igual a Nueva contraseña.
                </div>
            </div>

            <div class="container__todo__submitCambiarClave">
                <input type="submit" value="Cambiar Contraseña" name="cambiarContra">    
            </div>
        </form>

        </div>
</div>








<?php
    if( isset($_GET['error']) == 1 ){
?>
<div class="error__cambioClave--fondo"></div>
    <div class="error__cambioClave--container">
        <span class="error__cambioClave-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>ERROR AL CAMBIAR LA CLAVE, LAS CREDENCIALES NO COINCIDEN</h1>
        <div class="error__cambioClave-intentarDeNuevo">Intentarlo nuevamente...</div>
    </div>
</div>
<?php
    }
?>

</main>

<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>