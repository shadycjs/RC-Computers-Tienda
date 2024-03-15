<?php

    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    // API DE MERCADOPAGO 
    require_once 'vendor/autoload.php';
    use MercadoPago\MercadoPagoConfig;
    use MercadoPago\Client\Preference\PreferenceClient;
    use MercadoPago\Resources\Preference\Item;
    use MercadoPago\Exceptions\MPApiException;

    // Si no existe la sesion Condicion de pago entonces redireccionamos con un error
    if( !isset($_POST['medioPago']) || empty(($_POST['medioPago'])) ){
        header('location: carritoContinuarCompraPago.php?error=3');
    }
    
    // Si eligio el medio de pago entonces lo guardamos en una variable de sesion
    if(isset($_POST['medioPago'])){
        if($_POST['medioPago'] == 'MercadoPago'){
            $_SESSION['condPago'] = 'MercadoPago';
            MercadoPagoConfig::setAccessToken("APP_USR-2539014882362896-100414-2d1019db0a61d179af420af3bda65b9c-1500470140");
    
            $client = new PreferenceClient();
            
            try{
                $total = 0;
                foreach( $_SESSION['CARRITO'] as $indice => $producto ){
                $total = $total+(($producto['precio']*$producto['cantidad']))+ $_SESSION['envio'];
                $request = [
                    "external_reference" => "4567",
                    "items" => array(
                        array(
                            "id" => "4567",
                            "title" => "Compra en RC Computers",
                            "description" => "Pc gamer",
                            "quantity" => 1,
                            "unit_price" => $total
                        )
                        
                    ),
                    'payer' => array(
                      'name' => 'Matheus',
                      'surname' => 'Brandao',
                      'email' => 'mafe123silva@gmail.com',
                      'phone' => array(
                        'area_code' => '69',
                        'number' => '9993203891',
                      ),
                      'identification' => array(
                        'type' => 'CPF',
                        'number' => '03600717243'
                      ),
                      'address' => array(
                        'street_name' => 'Street',
                        'street_number' => 123,
                        'zip_code' => '06233200',
                      ),
                      "payment_methods" => array(
                        "installments" => 1,
                        "default_payment_method_id" => null,
                        "default_installments" => null,
                        "excluded_payment_methods" => array(), // Mantém os métodos existentes
                        "excluded_payment_types" => array(), // Mantém os tipos de pagamento existentes
                        "pix" => array(
                            "enabled" => true,
                            "type" => "standard"
                            // Configurações específicas do PIX, se necessário
                        ),
                    ),
                      'notification_url' => 'https://crochesdanoadia.com/pastateste/index.php',
                      'statement_descriptor' => 'LIZZIIMPORTS'
                    )
                ];
                }
                $preference = $client->create($request);
                $preference->back_urls = array(
                    "success" => "https://www.tu-sitio/success",
                    "failure" => "http://www.tu-sitio/failure"
                );
                $preference->auto_return = "approved";
                $preference->binary_mode = true;
                //echo $preference->init_point;
            }catch (MPApiException $e) {
                echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
                var_dump($e->getApiResponse()->getContent());
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }elseif($_POST['medioPago'] == 'PayPal'){
            $_SESSION['condPago'] = 'PayPal';
        }elseif($_POST['medioPago'] == 'Transf/Depo Bancario'){
            $_SESSION['condPago'] = 'Transf/Depo Bancario';
        }
    }

?>

<!DOCTYPE html>
<html>
<?php 
    $estiloCss = 'estilo-carritoContinuarCompraPagoFinalizar.css';
    $descTitulo = 'Finalizar Compra';
    include 'C:\xampp\htdocs\RC\Tienda\head.php' 
?>

<main class="mainClass">

<?php
    if( isset($_GET['error']) ){
        $error = $_GET['error'];

        $mensaje = match( $error ){
            '1' => 'Cargue el comprobante e intente nuevamente..'
        };

        $mensaje2 = match( $error ){
            '1' => 'DEBE SUBIR EL COMPROBANTE DE PAGO'
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
    if( isset($_GET['error']) ){
        $error = $_GET['error'];

        $mensaje = match( $error ){
            '1' => 'Debe subir el comprobante de pago para continuar con su compra',
        };

        $mensaje2 = match( $error ){
            '1' => 'NO SUBIO EL COMPROBANTE DE PAGO',
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
    include 'timelapse.php';
?>

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

    <div class="containerTodo" id="formulario">   
        <form method="post" action="pagoConfirmado.php" class="containerModal" enctype='multipart/form-data'>

        <h4>Detalle de venta</h4>
        <table class="container__todo__tabla">
            <tr class="container__todo__tabla--primerFila">
                <td>Producto</td>
                <td>Precio unitario</td>
                <td>Cantidad</td>
                <td>Subtotal</td>
            </tr>
<?php
$SID = session_id();
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

        <tr class="container__todo__tabla--segundaFila">
            <td><img src="images/<?= $imagenProducto ?>" alt="" style="width: 100%; 
                                                                       height: 100%;
                                                                       border-radius: 5%"><i><?= $nombreProducto ?></i></td>
            <td>$<?= number_format($precioProducto,0, ',', '.') ?></td>
            <td><?= $cantidadProducto ?></td>
            <td>$<?= number_format($precioProducto*$cantidadProducto,0, ',', '.') ?></td>
        </tr>
<?php
    $total = $total+($precioProducto*$cantidadProducto)+$_SESSION['envio'];
    }
}
?>
        <tr class="container__todo__tabla--tercerFila" id="filaEnvio"><td colspan="4">Envio: $<?= number_format($_SESSION['envio'], 0, ',', '.') ?></td>
        <tr class="container__todo__tabla--tercerFila"><td colspan="4">Total: <b style="color: green">$<?= number_format($total,2, ',', '.') ?></b></td>
        </tr>
        </table>

<?php
        if($_SESSION['condPago'] == 'Transf/Depo Bancario'){
?>
        <div class="container__todo__banco">
            <div class="container__todo__banco__sub">
                <h4>DATOS PARA LA TRANSFERENCIA</h4>
                <div class="container__todo__banco__sub--datos">
                    <p>Numero de cuenta: <b>CC$ 191-042-016287/0</b></p>
                    <p>Titular: <b>Camilo Rossi</b></p>
                    <p>CUIT: <b>20-43049529-2</b></p>
                    <p>CBU: <b>19100421-55004201628700</b></p>
                </div>
                <div class="container__sub__4--imagenNueva">
                        <label for="file" id="subiTuCompro">SUBI TU COMPROBANTE ACA<ion-icon name="cloud-upload" id="uploadIcon"></ion-icon></label>
                        <label style="display: none" for="file" id="exitoCompro">¡SE CARGO EL COMPROBANTE!<ion-icon name="checkmark-circle-outline"></ion-icon></label>
                        <input type="file" name="comprobantePago" id="subaCompro">
                    </div>
                <div class="container__todo__banco__sub--confirmar">
                    <input type="submit" value="CONFIRMAR COMPRA" name="confCompra">
                </div>
            </div>
        </div>
<?php
        }
?>
        <div class="container__cambiar__envioPago">
            <div class="container__cambiar__envioPago--sub">
                <a href="carritoContinuarCompra.php">
                    <ion-icon name="airplane" class="iconosEnvioPago"></ion-icon>
                    Cambiar metodo de envio
                </a>
            </div>
            <div class="container__cambiar__envioPago--sub">
                <a href="carritoContinuarCompraPago.php">
                    <ion-icon name="cash" class="iconosEnvioPago"></ion-icon>
                    Cambiar forma de pago
                </a>
            </div>
        </div>
        <a href="tiendaUser.php">VOLVER A CATALOGO</a>

<script> <!-- CODIGO JS PARA EL BOTON DE MERCADOPAGO -->

      const mp = new MercadoPago('TEST-26dd2f44-361a-4eba-8075-cbf1aeee5ee9', {
        locale: 'es-AR'
      });

      mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "<?= $preference->id ?>",
        },
      });
      

    </script>

<script>  

const file = document.getElementById('subaCompro');
const subiTuCompro = document.getElementById('subiTuCompro');
const exitoCompro = document.getElementById('exitoCompro');
const contenedorFile = document.querySelector('.container__sub__4--imagenNueva');

file.addEventListener('change', e =>{
        if(e.target.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
            contenedorFile.style.backgroundColor = "green";
            exitoCompro.style.display = "block";
            subiTuCompro.style.display = "none";
        }
        reader.readAsDataURL(e.target.files[0]);
        }else{
            ontenedorFile.style.backgroundColor = "#d69b42";
        }
    });

</script>

        </form>
<?php
        if($_SESSION['condPago'] == 'MercadoPago'){
?>
            <div id="wallet_container"></div>
<?php
        }
?>
        </div>
    </div>

</main>
<?php
    if($total == 0){
        header('location: tiendaUser.php');
    }
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>