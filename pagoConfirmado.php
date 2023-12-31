<?php

    require 'funciones/conexionbd.php';
    require 'funciones/carrito.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    require 'funciones/compras.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    if($_POST['confCompra']){
        $comprobante = subirComprobante();
        foreach($_SESSION['CARRITO'] as $indice => $producto){
            $agregarOrden = agregarOrdenVenta($producto['id'],$producto['precio'],$comprobante, $producto['cantidad']);
        }
        unset($_SESSION['CARRITO']);
        unset($_SESSION['nroVenta']);
    }


    function __construct()
	{
		$this->client = new \GuzzleHttp\Client();
		$this->token = config('APP_USR-2539014882362896-100414-2d1019db0a61d179af420af3bda65b9c-1500470140'); // en SLipt Payment no se usa
	}

	function getPreference($preference_id, $token)
	{
		$response = $this->client->request('GET ', 'https://api.mercadopago.com/checkout/preferences/' . $preference_id, [
			'headers' => [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $token,
			]
		]);

		return $response;
	}

    function createPayment(){
        // Logica para almacenar datos en bd
        $payment = $_GET['payment_id'];
        $status = $_GET['status'];
        $payment_type = $_GET['payment_type'];
        $order_id = $_GET['merchant_order_id'];
        // setPreference(datos del formulario)

        
        
    }

	function setPreference($parameters, $token)
	{
		$response = $this->client->request('POST', 'https://api.mercadopago.com/checkout/preferences', [
			'headers' => [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $token,
			],
			'body' => json_encode([
				'marketplace' 			=> config('mercadopago.id'),
				'marketplace_fee' 		=>  (int) $package->price * config('qivli.fee'),
				'external_reference' 	=> $external_reference,
				'additional_info' 		=> $package->uuid,
				'installments' 			=> 1,
				'items' => [
					[
						'title' 		=> $package->name,
						'description' 	=> $package->School->name,
						'quantity' 		=> 1,
						'category_id' 	=> 'services',
						'currency_id' 	=> "ARS",
						'unit_price' 	=> (int) $package->price + $package->price * config('qivli.fee'),
					]
				],
				'payer' => [
					'name' 		=> $user->Person->firstname,
					'surname' 	=> $user->Person->lastname,
					'email' 	=> $user->email,
					'phone' => [
						'area_code' => '',
						'number' 	=> ''
					],
					'identification' => [
						'type' 		=> '',
						'number' 	=> ''
					],
					'address' => [
						'street_name' 	=>  '',
						'street_number' =>  '',
						'zip_code' 		=>  ''
					]
				],
				'payment_methods' => [
					'excluded_payment_methods' => [
						null
					],
					'excluded_payment_types' => [
						null
					]
				],
				'shipments' => [
					'free_methods' => [
						null
					],
					'receiver_address' => null
				],
				'back_urls' => [
					'success' => config('mercadopago.url') . '/mercadopago/callback'
				],
				'auto_return' => 'approved',
				'differential_pricing' => null,
				'tracks' 	=> null,
				'metadata' 	=> null
			]),
		]);

		return $response;
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Pago Confirmado</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-pagoConfirmado.css">
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

<main class="mainClass">


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
        <form class="containerModal">

            <div class="container__todo__pagoConfirmado">

                <div class="container__todo__pagoConfirmado__sub">
                    <h1>¡COMPRA CONFIRMADA CON EXITO!</h1>
                    <ion-icon name="bag-check" class="IconCompraConf"></ion-icon>
                </div>

                <div class="container__todo__pagoConfirmado__sub .descripcion">
                    <p>Te recordamos que la confirmacion del pago puede demorar hasta 48hs.
                        Recorda subir el comprobante de pago haciendo click <a href="">AQUI</a></p>
                </div> 
                
            </div>
        <a href="tiendaUser.php">VOLVER A CATALOGO</a>
        </form>
    </div>

</main>
<?php
    if($total == 0){
        header('location: tiendaUser.php');
    }
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>