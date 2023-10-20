<?php

require_once 'vendor/autoload.php';
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Resources\Preference\Item;
use MercadoPago\Exceptions\MPApiException;

MercadoPagoConfig::setAccessToken("TEST-4496492563717601-100411-0e4fa3be17ab7200067c5cf24481aa79-262415866");

$client = new PreferenceClient();

try{
    foreach( $_SESSION['CARRITO'] as $indice => $producto ){
    $total = $producto['precio']*$producto['cantidad'] + $_SESSION['envio'];
    $request = [
        "external_reference" => "4567",
        "items" => array(
            array(
                "id" => "4567",
                "title" => "Productos Informaticos",
                "description" => "Pc gamer",
                "quantity" => 1,
                "unit_price" => $total
            )
            
        )
    ];
    }
    $preference = $client->create($request);
    $preference->back_urls = array(
        "success" => "http://localhost/RC/Tienda/pagoConfirmado.php",
        "failure" => "http://localhost/RC/Tienda/pagoErroneo.php",
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