<?php

    print_r($_GET);

    $clientID = "AaUApbO8_K6EITg_mMr40JlAu21JJHOM90Nb1s5Lk3ptw9VwjDjp7A2x4tG7dk5r049bkYsvY5lBmdlT";
    $Secret = "EFczkkJe4HwfZvV9rZeI23cvotdh50BO5cSLFxOI1j2c-y6gy7GJ7ra0iexD80RZuXWHZ_lBisVEgv3L";

    $login = curl_init("https://sandbox.paypal.com");

    curl_setopt($login,CURLOPT_RETURNTRANSFER,TRUE);

    curl_setopt($login,CURLOPT_USERPWD,$clientID.":".$Secret);

    curl_setopt($login,CURLOPT_POSTFIELDS,"grant_type=client_credentials");

    $Respuesta = curl_exec($login);

    $objRespuesta = json_decode($Respuesta);

    $AccessToken = $objRespuesta -> access_token;

    print_r($AccessToken);

?>