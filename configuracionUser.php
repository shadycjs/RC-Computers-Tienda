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

    //PAGINACION
    $total_registros = totalRegistrosCompras();
    $registros_por_pagina = 10;
    $total_paginas = ceil($total_registros/$registros_por_pagina);
    $pagina_actual = isset($_GET['pagActual']) ? $_GET['pagActual'] : 1;
    $primer_registro = ($pagina_actual-1) * $registros_por_pagina;

?>

<!DOCTYPE html>
<html>
<?php 
    $estiloCss = 'estilo-configuracionUser.css';
    $descTitulo = 'Configuracion '.$_SESSION['usuNombre'];
    include 'C:\xampp\htdocs\RC\Tienda\head.php' 
?>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\login.php'
?>
<main class="mainClass">
    
<?php include 'modalCerrarSesion.php'; ?>


    <div class="container__todo">
    <div class="container__todo__aside">
            <div class="container__infoUser" id="infoUser">
                <i class="bi bi-person-fill fs-1"></i>
                <h1 class="m-0">MI INFORMACION</h1>
            </div>
            <hr>
            <div class="container__infoUser" id="misCompras">
                <i class="bi bi-bag-check-fill fs-1"></i>
                <h1 class="m-0">COMPRAS</h1>
            </div>
            <hr>
            <div class="container__infoUser" id="cambiarClave">
                <i class="bi bi-key-fill fs-1"></i>
                <h1 class="m-0">CAMBIAR CONTRASEÑA</h1>
            </div>
            <hr>
            <div class="container__infoUser" id="cerrarSesion">
                <i class="bi bi-box-arrow-right fs-1"></i>
                <h1>CERRAR SESION</h1>
            </div>
        </div>
        <div class="container__todo__sub">


            <form method="post" action="" enctype="multipart/form-data" class="container__sub__2" id="containerImagenDatos">

                <div class="container__sub__3--imagen">
                    <div class="container__sub__3--imagen--container">
                        <img src="http://localhost/RC/Tienda/images/<?= $_SESSION['imagenActual']['usuImg'] ?>" id="imagenPerfil" alt="Foto de perfil">
                    </div>
                    <div class="container__sub__4--imagenNueva">
                        <label for="file">ELEGI TU FOTO <ion-icon name="cloud-upload" id="uploadIcon"></ion-icon></label>
                        <input type="file" name="imgUserNueva" id="imgUserNueva">
                        <input type="hidden" name="imgActual1" value="<?= $_SESSION['imagenActual']['usuImg'] ?>">
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
        <div class="row d-flex justify-content-center p-2">
            <input type="submit" name="agregarDatosUser" value="Agregar Datos" id="enviarModificarCambios">
        </div>
<?php
    }else{
?>
        <div class="row d-flex justify-content-center p-2">
            <input type="submit" name="modificarDatosUser" value="Modificar Datos" id="enviarModificarCambios">
        </div>            
<?php
    }
?>
        </form>

        <div class="container__todo__compras__sub">
            <?php
                if( $conteoCompras == 0 ){
            ?>

                    <div class="container__todo__compras__sub--sinCompras">
                        <h1>NO TIENES COMPRAS AUN...</h1>
                        <ion-icon name="ban" id="iconoSinProductosCarrito"></ion-icon>
                    </div>

            <?php
                }else{
            ?>
                    <h1>TUS COMPRAS</h1>

                    <table class="table table-striped text-center" style="height: 100%">

                        <tr class="bg-primary align-middle">
                            <td>Nro Compra</td>
                            <td>Fecha</td>
                            <td>Total</td>
                            <td>Detalle</td>
                        </tr>

            <?php
                while( $compra = mysqli_fetch_assoc($compras) ){
            ?>
                        <tr class="align-middle" style="max-height: 20px">
                            <td style="font-weight: bold"><?= $compra['nroVenta'] ?></td>
                            <td style="min-width: 100px"><?= $compra['fecha'] ?></td>
                            <td style="color: green">$<?= number_format($compra['Total'], 2) ?></td>
                            <td><a href="detalleDeVenta.php?idOrdenVenta=<?= $compra['idOrdenVenta'] ?>&comprobantePago=<?= $compra['comprobantePago'] ?>&factura=<?= $compra['factura'] ?>&fecha=<?= $compra['fecha'] ?>&envio=<?= $compra['envio'] ?>&transporte=<?= $compra['transporte'] ?>&nroVenta=<?= $compra['nroVenta'] ?>&estado=<?= $compra['estado'] ?>">Ver detalle</a></td>
                        </tr>
            <?php
                }
            }
            ?>
            
                    </table>
                    <div class="container__todo__paginacion">
                        <div class="container__todo__paginacion__sub">
                            <div class="container__todo__paginacion__sub--numeracion">
            <?php
                if($pagina_actual > 1){
            ?>

                    <a href="configuracionUser.php?pagActual=<?= $pagina_actual-1 ?>">Anterior</a>

            <?php
                }
            ?>
            <?php
                        for($i=1; $i<$total_paginas+1; $i++){
            ?>
                                <a href="configuracionUser.php?pagActual=<?= $i ?>"><?= $i ?></a>
            <?php
                        }
            ?>

            <?php
                if($pagina_actual < $total_paginas){
            ?>
                                <a href="configuracionUser.php?pagActual=<?= $pagina_actual+1 ?>">Siguiente</a>
            <?php
                }
            ?>
                            </div>
                        </div>
                    </div>

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
<script>
    const imgDefault = "http://localhost/RC/Tienda/images/<?= $_SESSION['imagenActual']['usuImg'] ?>";

    const fileImg = document.getElementById('imgUserNueva');

    const img = document.getElementById('imagenPerfil');

    fileImg.addEventListener('change', e =>{
        if(e.target.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
            img.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
        }else{
            img.src = imgDefault;
        }
    });

</script>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>