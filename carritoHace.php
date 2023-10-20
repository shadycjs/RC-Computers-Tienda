<?php

$itemsCarrito = listarCarrito();
$conteo = mysqli_num_rows($itemsCarrito);

if( isset($_POST['agregarCarrito']) ){
    $insercion = insertarPrdCarrito();
}

if( isset($_POST['borrarPrd']) ){
    $borrarPrd = borrarPrdCarrito();
}

header("location: detalleProductoUser.php");