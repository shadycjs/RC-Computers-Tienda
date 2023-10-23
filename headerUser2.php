<?php
    $verificarCliente = verificarCliente();

    $_SESSION['imagenActual'] = verImagenPorId();

    if( isset($_POST['borrarPrd']) ){
        $id = $_POST['idPrd'];
        print_r($id);
            foreach( $_SESSION['CARRITO'] as $indice => $producto ){
                if( $producto['id'] == $id ){
                    unset($_SESSION['CARRITO'][$indice]);
                };
            };   
    };

if( isset($_POST['agregarCarrito']) ){

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = (int)$_POST['precio'];
    $cantidad = (int)$_POST['cantidad'];
    $img = $_POST['img'];
    $_SESSION['nroVenta'] = time();

    if( !isset($_SESSION['CARRITO']) ){

        $producto = array(
            'id'=>$id,
            'nombre'=>$nombre,
            'precio'=>$precio,
            'cantidad'=>$cantidad,
            'img'=>$img,
        );

        $_SESSION['CARRITO'][0]=$producto;

    }else{
        $idProductos = array_column($_SESSION['CARRITO'],'id');


        
        if(in_array($id,$idProductos)){

            $posicionIdDuplicado = array_search($id,$idProductos);
            $_SESSION['CARRITO'][$posicionIdDuplicado]['cantidad'] = $_SESSION['CARRITO'][$posicionIdDuplicado]['cantidad']+$cantidad;

        }else{

            $numeroProductos = count($_SESSION['CARRITO']);

            $producto = array(
                'id'=>$id,
                'nombre'=>$nombre,
                'precio'=>$precio,
                'cantidad'=>$cantidad,
                'img'=>$img,
            );

            $_SESSION['CARRITO'][$numeroProductos]=$producto;
        }
    }
    
}

if( isset($_POST['restarPrd']) ){
    $posicionPrd = $_POST['indice'];
    if(isset($_SESSION['CARRITO'][$posicionPrd]['cantidad'])){
        if( $_SESSION['CARRITO'][$posicionPrd]['cantidad'] <= 1 ){
            unset($_SESSION['CARRITO'][$posicionPrd]);
        }else{
            $_SESSION['CARRITO'][$posicionPrd]['cantidad'] = $_SESSION['CARRITO'][$posicionPrd]['cantidad']-1;   
        }
    }
}

if( isset($_POST['sumarPrd']) ){
    $posicionPrd = $_POST['indice'];

    $_SESSION['CARRITO'][$posicionPrd]['cantidad'] = $_SESSION['CARRITO'][$posicionPrd]['cantidad']+1;   

}

if(isset($_SESSION['CARRITO'])){
    if(count($_SESSION['CARRITO']) == 0){
        unset($_SESSION['nroVenta']);
    }
}

?>
<body>

    <div class="btnfondo"></div>
    <header class="header-container"> <!-- ENCABEZADO -->
        <div class="contenedor-todo"> 
        <a href="http://localhost/RC/inicio.php" class="logo"> 
            <img src="http://localhost/RC/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
        </a>
        <nav class="contenedor-menu"> <!-- NAV DE TIENDA/EMPRESA/CONTACTO -->
            <ul>
                <li><a href="http://localhost/RC/Tienda/tiendaUser.php" target="_blank">Tienda</a></li>               
                <li><a href="http://localhost/RC/inicio 2.php" target="_blank">Empresa</a></li>
                <li><a href="http://localhost/RC/contacto.php" target="_blank">Contacto</a></li>
            </ul>
        </nav>
        <nav class="contenedor-enlaces"> <!-- NAV DE REDES SOCIALES -->
            <ul>
                <li><a href="https://www.facebook.com/profile.php?id=100065065447610" class="nav-link fab fa-facebook-f" target="_blank"></a></li>
                <li><a href="https://www.instagram.com/rc_computers_/" class="nav-link fab fa-instagram" target="_blank"></a></li>
                <li><a href="#" class="nav-link fab fa-whatsapp" target="_blank"></a></li>   
            </ul>       
        </nav>

        <div class="contenedor__perfil__subir"> <!-- CARRITO -->
<?php
    if($_SESSION['idRol'] != 1){
?>
            <div class="contenedor__carrito">
                
                <p class="contenedor__carrito-a"><ion-icon class="cart" name="cart"></ion-icon><div class="contenedor__conteo"><?= empty($_SESSION['CARRITO']) ? '0' : count($_SESSION['CARRITO']) ?></div></p>

                <div class="contenedor__carrito__modal">
                    <div class="contenedor__carrito__modal__sub">
                        <h2>MI CARRITO:</h2>
<?php
    if( empty($_SESSION['CARRITO']) ){
?>
    <div class="container__sinProductosCarrito">
        <h3>NO HAY PRODUCTOS EN SU CARRITO...</h3>
        <ion-icon name="ban" id="iconoSinProductosCarrito"></ion-icon>
    </div>
<?php
    }
?>

<?php
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
                        <div class="contenedor__carrito__modal__sub--item" id="resultado">


                            <div class="contenedor__carrito__modal__sub--item-img">
                                <img src="http://localhost/RC/Tienda/images/<?= $imagenProducto ?>" alt="">
                            </div>

                            <div class="contenedor__carrito__modal__sub--item-nombrePrecioCantidadSubtotal">
                            
                                <div class="contenedor__carrito__modal__sub--item-precio-nombre">
                                    <p><?= $nombreProducto ?></p>
                                </div>
                                
                                <div class="contenedor__carrito__modal__sub--item-precio">
                                    <b>Precio unitario: $<?= number_format($precioProducto, 2, ',', '.') ?></b>
                                </div>

                                <form action="" method="post" class="contenedor__carrito__modal__sub--item-cantidad">
                                    <b><?= $cantidadProducto ?> unidad/es 
                                    <div class="contenedor__carrito__modal__sub--item-cantidad-agregarRestar">
                                        <button type="submit" name="restarPrd"><ion-icon name="remove-circle" class="iconoRemoverAgregaPrd"></ion-icon></button></b>
                                        <input type="hidden" name="indice" value="<?= $posicionPrd ?>">
                                        <button type="submit" name="sumarPrd"><ion-icon name="add-circle" class="iconoRemoverAgregaPrd"></ion-icon></button>
                                    </div>
                                </form>

                                <div class="contenedor__carrito__modal__sub--item--subtotal">
                                    <p>Subtotal: </p><b>$<?= number_format($precioProducto*$cantidadProducto,2, ',', '.') ?></b>
                                </div>

                            </div>

                <form action="" method="post" class="contenedor__carrito__modal__sub--item-eliminarItem">
                                <input type="hidden" name="idPrd" value="<?= $producto['id'] ?>">
                                <button name="borrarPrd"><ion-icon name="close-circle-outline" class="iconoEliminarItem"></ion-icon></button>
                            </form>

                        </div>
<?php

    $total = $total+($precioProducto*$cantidadProducto);

    }

?>
                        <div class="contenedor__carrito__modal__sub--totalCompra">
                            <h1>TOTAL: $<?= (isset($_SESSION['CARRITO']))? number_format($total,2, ',', '.') : '0' ?></h1>
                        </div>
<?php
    if( $verificarCliente && isset($_SESSION['envio']) ){
?>
                        <div class="contenedor__carrito__modal__sub--continuarComprando">
                            <a href="carritoContinuarCompraPagoFinalizar.php">CONTINUAR CON MI COMPRA</a>
                        </div>
<?php
    }else{
?>
                        <div class="contenedor__carrito__modal__sub--continuarComprando">
                            <a href="carritoContinuarCompra.php">CONTINUAR CON MI COMPRA</a>
                        </div>
<?php
    }
?>

<?php
}
?>
                    </div>

                    
            </div>

        </div> 

<?php
    
    }else{
?>
            <div class="contenedor__subir">
                <a href="publicacionesListado.php"><ion-icon name="folder-open"></ion-icon> PUBLICACIONES </a>
            </div> 
<?php
    }
?>
            <div class="contenedor__perfil"> <!-- PERFIL DEL USER -->
                <a href="<?= $_SESSION['idRol'] == 1 ? 'configuracionAdmin.php' : 'configuracionUser.php' ?>" class="contenedor__perfil-imagen">
                    <img src="http://localhost/RC/Tienda/images/<?= $_SESSION['imagenActual']['usuImg'] ?>" alt="">
                </a>
                <div class="contenedor__perfil__info">
                    <h5 class="contenedor__perfil__info--user"><?= $_SESSION['usuNombre'] ?><ion-icon class="flechitaUser" name="caret-forward-outline"></ion-icon></h5>
                    <ul class="contenedor__perfil__info--logout">
                        <li><ion-icon name="home" class="ion__icon"></ion-icon><a id="" href="tiendaUser.php">Inicio</a></li>
<?php
        $configuracion = 'configuracionUser.php';
    if($_SESSION['idRol'] == 1){
        $configuracion = 'configuracionAdmin.php';
    }
?>
                        <li><ion-icon name="settings-outline" class="ion__icon"></ion-icon><a href="<?= $configuracion ?>">Configuración</a></li>
<?php
    if($_SESSION['idRol'] == 1){
?>
                        <li id="users"><ion-icon name="people" class="ion__icon"></ion-icon><a id="users" href="listadoUsuarios.php">Usuarios</a></li>
<?php
    }
?>
                        <hr>
                        <li id="logOut"><ion-icon name="log-out-outline" class="ion__icon"></ion-icon><p id="logOut">Cerrar Sesion</p></li>
                    </ul>
                </div>
            </div>

        </div>
      
     </header>