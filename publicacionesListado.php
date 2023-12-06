<?php
    require 'funciones/conexionbd.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/clientes.php';
    require 'funciones/categorias.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser2.php';
    autenticar();
    $productos = buscarProductoPublicacionesListado();
    $categorias = listarCategorias();
    $existe = mysqli_num_rows($productos);
    //PAGINACION
    $total_registros = totalRegistrosProductos();
    $registros_por_pagina = 4;
    $total_paginas = ceil($total_registros/$registros_por_pagina);
    $pagina_actual = isset($_GET['pagActual']) ? $_GET['pagActual'] : 1;
    $primer_registro = ($pagina_actual-1) * $registros_por_pagina;   
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Ramiro Unrein">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="Tienda online de venta de productos informaticos">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Publicaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-publicacionesListado.css">
    <link rel="icon" type="image/x-icon" href="RC/LOGORCBLANCOSINFONDO-copia.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
</head>

<main class="container">
<?php include 'modalCerrarSesion.php'; ?>

<div class="container mt-100 bg-light d-flex flex-column align-items-center">
    <h1>PUBLICACIONES</h1>
    <div class="row agregarPubli">
        <div class="col-12 text-center">
            <a href="agregarProducto.php"><i class="bi bi-cloud-upload-fill"></i> AGREGAR PUBLICACION NUEVA </a>
        </div>
    </div>

    <div class="container">
        <div class="row gap-2">
        <form method="post" action="" class="col-6 input-group d-flex justify-content-center gap-2">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Categoria:</label>
                </div>
                <select name="categoria"class="custom-select" id="inputGroupSelect01">
<?php
    while( $categoria = mysqli_fetch_assoc( $categorias ) ){
?>
                <option value="<?= $categoria['nombreCategoria'] ?>"><?= $categoria['nombreCategoria'] ?></option>
<?php
    }
?>
                </select>
                <div class="">
                    <div class="input-group-prepend">
                        <input type="submit" value="Filtrar" class="btn btn-primary">
                    </div>
                </div>
            </form>
            <form action="" method="get" class="col-6 columna input-group">
                <button type="submit" class="button__buscador"><i class="bi bi-search"></i></button>
                <input type="search" class="form-control" name="search" id=""> 
            </form>
        </div>
    </div>

    <div class="container" id="shopContent"> <!-- PAGINA PRINCIPAL GRID TIENDA -->
<?php
    if(!$existe) {
?>

        <div class="row bg-danger d-flex justify-content-center align-items-center">
            <h1>NO SE ENCONTRARON RESULTADOS DE BUSQUEDA</h1>
            <i class="bi bi-ban text-center" style="font-size: 30rem"></i>
        </div>

<?php
    }else{
?>

<?php
    while ($producto = mysqli_fetch_assoc($productos)) {
        $borde = 'success';
        if ($producto['estadoPrd'] == 0) {
            $borde = 'danger';
        }
?>

    <div class="row m-2 border border border-<?= $borde ?>" style="min-height: 350px" >
        <figure class="col-12 col-md-4 d-flex">
            <img src="http://localhost/RC/Tienda/images/<?= $producto['img1'] ?>" alt="producto">
        </figure>
        <div class="col-12 col-md-8 d-flex flex-column justify-content-evenly">
            <div class="row">
                <h2><?= $producto['nombreCategoria'], ' '.$producto['nombreMarca'], ' '.$producto['nombrePrd'] ?></h2>
                <p class="precio">$<?= $producto['precioPrd'] ?></p>
                <p>Stock: <?= $producto['stockPrd'] ?></p>
                <p style="<?= ($producto['estadoPrd'] == 0) ? 'color: orange' : 'color: lightgreen' ?>">Estado: <?= ($producto['estadoPrd'] == 0) ? 'Deshabilitada' : 'Activa' ?></p>
            </div>
            <div class="row d-flex justify-content-between gap-3 p-2">
                <a href="http://localhost/RC/Tienda/detalleProductoUser.php?id=<?= $producto['idPrd'] ?>&idCategoria=<?= $producto['idCategoria'] ?>" class="col btn btn-dark d-flex align-items-center justify-content-center">VER DETALLE</a>
                <a href="http://localhost/RC/Tienda/eliminarProducto.php?id=<?= $producto['idPrd'] ?>&idCategoria=<?= $producto['idCategoria'] ?>" class="col btn btn-danger">ELIMINAR PRODUCTO</a>
                <a href="http://localhost/RC/Tienda/modificarProducto.php?id=<?= $producto['idPrd'] ?>&idCategoria=<?= $producto['idCategoria']?>&idMarca=<?= $producto['idMarca'] ?>" class="col btn btn-warning">MODIFICAR PRODUCTO</a>
            </div>
        </div>

    </div>
<?php
    }
?>
    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
    <ul class="pagination">
<?php
    if($pagina_actual > 1){
?>
        <li class="page-item"><a class="page-link" href="publicacionesListado.php?pagActual=<?= $pagina_actual-1 ?>">Anterior</a></li>
<?php
    }
?>
<?php
    for($i=1; $i<$total_paginas+1; $i++){
?>
        <li class="page-item"><a class="page-link" href="publicacionesListado.php?pagActual=<?= $i ?>"><?= $i ?></a></li>
<?php
    }
?>
<?php
    if($pagina_actual < $total_paginas){
?>
        <li class="page-item"><a class="page-link" href="publicacionesListado.php?pagActual=<?= $pagina_actual+1 ?>">Siguiente</a></li>
<?php
    }
}
?>
    </ul>
    </nav>
    </div>
</div>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>