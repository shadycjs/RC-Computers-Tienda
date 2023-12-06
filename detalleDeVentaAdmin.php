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
    $compras = verDetalleVenta();
    $conteoCompras = mysqli_num_rows($compras);
    $usuarios = verUsuarioPorId();

    if( isset($_GET['numeroVenta']) ){
        $bajarCompro = bajarComprobante();
    }

    if( isset($_GET['numVentaFactura']) ){
        $bajarFactura = bajarFactura();
    }

    $detalleCliente = listarClientePorCompra();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Configuracion usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-detalleDeVentaAdmin.css">
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

        <div class="container__todo__sub">

            <div class="container__todo__compras__sub">

                        <div class="container__todo__detalleVenta">
                            <div class="container__todo__detalleVenta--tituloFecha">
                                <h1>Detalle de la venta NRO <?= $_GET['nroVenta'] ?></h1>
                                <h2>Fecha: <?= $_GET['fecha'] ?></h2>
                            </div>
                            <div class="container__todo__detalleVenta__sub">
                <?php
                    $total = 0;
                    while( $compra = mysqli_fetch_assoc($compras) ){
                ?>
                         

                            <div class="container__todo__detalleVenta__sub--producto">
                                <h3><?= $compra['cantidad'] ?> x <?= $compra['nombrePrd'] ?></h3>
                                <div class="container__todo__detalleVenta__subProducto--precio">
                                    <h3>$<?= number_format($compra['importe'], 2) ?></h3>
                                </div>
                            </div>



                         

                <?php
                    $total = $total+($compra['importe']*$compra['cantidad'])+$_GET['envio'];
                    }
                    $detalleDeVenta = 'detalleDeVentaAdmin';
                    if($_GET['factura'] == 'Aun sin emitir'){
                        $detalleDeVenta = 'subirFacturaCompra';
                    }
                ?>
                                <div class="container__todo__detalleVenta__sub--envioTransporte">
                                    <h3>ENVIO</h3>
                                    <div class="container__todo__detalleVenta__sub--transporte">
                                        <h2><?= $_GET['transporte'] ?></h2>
                                        <h2>$<?= $_GET['envio'] ?></h2>
                                    </div>
                                </div>

                                <div class="container__todo__detalleVenta__sub--formaPago<?= ($_GET['condicionPago'] == 'MercadoPago') ? 'MercadoPago' : 'Transf' ?>">
                                    <h3>FORMA DE PAGO</h3>
                                    <div class="container__todo__detalleVenta__sub--transporte">
                                        <h2><?= $_GET['condicionPago'] ?></h2>
                                    </div>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Ver info Cliente
                                    </button>

                                    <!-- The Modal -->
                                    <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title text-dark"><?= $detalleCliente['usuNombre'].' '.$detalleCliente['usuApellido'] ?></h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body text-dark">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" class="form-control" id="provincia" placeholder="" name="provincia" value="<?= $detalleCliente['CliProvincia'] ?>" readonly>
                                                            <label for="provincia">Provincia</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="" value="<?= $detalleCliente['CliCiudad'] ?>" readonly>
                                                            <label for="ciudad">Ciudad</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" class="form-control" id="calle" name="calle" placeholder="" value="<?= $detalleCliente['CliCalle'] ?>" readonly>
                                                            <label for="calle">Calle</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" class="form-control" id="alutra" placeholder="" name="alutra" value="<?= $detalleCliente['CliAltura'] ?>" readonly>
                                                            <label for="alutra">Altura</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" class="form-control" id="piso" placeholder="" name="piso" value="<?= $detalleCliente['CliPiso'] ?>" readonly>
                                                            <label for="piso">Piso</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" class="form-control" id="depto" name="depto" placeholder="" value="<?= $detalleCliente['CliDepto'] ?>" readonly>
                                                            <label for="depto">Depto</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" class="form-control" id="torre" placeholder="" name="torre" value="<?= $detalleCliente['CliTorre'] ?>" readonly>
                                                            <label for="torre">Torre</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" class="form-control" id="postal" placeholder="" name="postal" value="<?= $detalleCliente['CliPostal'] ?>" readonly>
                                                            <label for="postal">Cod.Postal</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" class="form-control" id="localidad" name="depto" placeholder="" value="<?= $detalleCliente['CliLocalidad'] ?>" readonly>
                                                            <label for="localidad">Localidad</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="container__todo__detalleVenta__sub--facturaComprobante">
                                    <div class="container__todo__detalleVenta__sub--comprobante">
                                        <h3>Comprobante de pago</h3>
                                        <a href="detalleDeVentaAdmin.php?idOrdenVenta=<?= $_GET['idOrdenVenta'] ?>&nroVenta=<?= $_GET['nroVenta'] ?>&factura=<?= $_GET['factura'] ?>&fecha=<?= $_GET['fecha'] ?>&envio=<?= $_GET['envio'] ?>&transporte=<?= $_GET['transporte'] ?>&comprobantePago=<?= $_GET['comprobantePago'] ?>&numeroVenta=<?= $_GET['nroVenta'] ?>&idUsuario=<?= $_GET['idUsuario'] ?>&condicionPago=<?= $_GET['condicionPago'] ?>"><?= $_GET['comprobantePago'] != 'Aun sin emitir'? $_GET['comprobantePago'] : $subirFacturaString = 'AUN SIN SUBIR'; ?></a>
                                    </div>
                                    <div class="container__todo__detalleVenta__sub--factura">
                                        <h3>Factura</h3>
                                        <a href="<?= $detalleDeVenta ?>.php?numVentaFactura=<?= $_GET['nroVenta'] ?>&idOrdenVenta=<?= $_GET['idOrdenVenta'] ?>&factura=<?= $_GET['factura'] ?>&fecha=<?= $_GET['fecha'] ?>&envio=<?= $_GET['envio'] ?>&transporte=<?= $_GET['transporte'] ?>&idUsuario=<?= $_GET['idUsuario'] ?>"><?= $_GET['factura'] != 'Aun sin emitir'? $_GET['factura'] : $subirFacturaString = 'SUBIR FACTURA'; ?></a>   
                                    </div>
                                </div>

                                <div class="container__todo__detalleVenta__sub--total">
                                    <h3>TOTAL</h3>
                                    <h2>$<?= number_format($total, 0, ',', '.') ?></h2>
                                </div>

                            </div> 
                        </div>

            </div>
            <a href="configuracionAdmin.php">VOLVER A CONFIGURACION</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>