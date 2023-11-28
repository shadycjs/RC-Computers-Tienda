<?php

    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';

    if(isset($_POST['medioPago'])){
        if($_POST['medioPago'] == 'MercadoPago'){
            $_SESSION['condPago'] = 'MercadoPago';
        }elseif($_POST['medioPago'] == 'PayPal'){
            $_SESSION['condPago'] = 'PayPal';
        }elseif($_POST['medioPago'] == 'Transf/Depo Bancario'){
            $_SESSION['condPago'] = 'Transf/Depo Bancario';
        }
    }else{
        header('location: carritoContinuarCompraPago.php?error=3');
    }

    require_once 'vendor/autoload.php';
    use MercadoPago\MercadoPagoConfig;
    use MercadoPago\Client\Preference\PreferenceClient;
    use MercadoPago\Resources\Preference\Item;
    use MercadoPago\Exceptions\MPApiException;
    
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
            "success" => "http://localhost/RC/Tienda/pagoConfirmado.php/success",
            "failure" => "http://localhost/RC/Tienda/pagoErroneo.php/failure",
            "pending" => "http://www.tu-sitio/pending"
        );
        $preference->auto_return = "approved";
        $preference->binary_mode = true;
        echo $preference->init_point;
    }catch (MPApiException $e) {
        echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
        var_dump($e->getApiResponse()->getContent());
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Carrito de compras - Finalizar</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-carritoContinuarCompraPagoFinalizar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 650px;
            display: inline-block;
        }
    }
    
</style>

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
            <td><?= $nombreProducto ?></td>
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
        <tr class="container__todo__tabla--tercerFila"><td colspan="4">Total: $<?= number_format($total,2, ',', '.') ?></td>
        </tr>
        </table>

<?php
        if($_SESSION['condPago'] == 'PayPal'){
?>
        <div id="paypal-button-container"></div>
<?php
        }
?>

<?php
        if($_SESSION['condPago'] == 'MercadoPago'){
?>
        <div id="wallet_container">
        </div>
<?php
        }
?>

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
                <div class="container__todo__banco__sub--factura">
                    <label for="factura">Adjuntar comprobante de pago aqui:</label>
                    <input type="file" name="facturaCompra" accept=".pdf">
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
            <div class="container__cambiar__envioPago--envio">
                <a href="carritoContinuarCompra.php">Cambiar metodo de envio</a>
                <ion-icon name="airplane" class="iconosEnvioPago"></ion-icon>
            </div>
            <div class="container__cambiar__envioPago--pago">
                <a href="carritoContinuarCompraPago.php">Cambiar forma de pago</a>
                <ion-icon name="cash" class="iconosEnvioPago"></ion-icon>
            </div>
        </div>
        <a href="tiendaUser.php">VOLVER A CATALOGO</a>

<script> <!-- CODIGO JS PARA EL BOTON DE MERCADOPAGO -->

      const mp = new MercadoPago('APP_USR-6c0fb4ff-d246-4c01-b6e2-b14727e30931', {
        locale: 'es-AR'
      });

      mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "<?= $preference->id ?>",
        },
      });

    </script>

<script>  <!-- CODIGO JS PARA EL BOTON DE PAYPAL -->

    paypal.Button.render({
        env: 'sandbox', // sandbox | production
        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },
 
        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
 
        client: {
            sandbox:    'AaUApbO8_K6EITg_mMr40JlAu21JJHOM90Nb1s5Lk3ptw9VwjDjp7A2x4tG7dk5r049bkYsvY5lBmdlT',
            production: ''
        },
 
        // Wait for the PayPal button to be clicked
 
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?= number_format($total,2) ?>', currency: 'USD' }, 
                            description:"Compra de productos a RC Computers:$<?= number_format($total,2) ?>",
                            custom:"<?= $SID ?>"
                        }
                    ]
                }
            });
        },
 
        // Wait for the payment to be authorized by the customer
 
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                console.log(data);
                window.location="verificador.php?paymentToken="+data.paymentToken
            });
        }
    
    }, '#paypal-button-container');
 
</script>

        </form>
    </div>

</main>
<?php
    if($total == 0){
        header('location: tiendaUser.php');
    }
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>