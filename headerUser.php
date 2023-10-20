<?php
    $_SESSION['imagenActual'] = verImagenPorId();
    if($_SESSION['idRol'] != 1){
        $itemsCarrito = listarCarrito();
        $conteo = verCantPrdCarrito();
        $conteoFilas = mysqli_num_rows( $itemsCarrito );
    }
    if( isset($_POST['agregarCarrito']) ){
        $insercion = insertarPrdCarrito();
    }

    if( isset($_POST['borrarPrd']) ){
        $borrarPrd = borrarPrdCarrito();
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
                
                <p class="contenedor__carrito-a"><ion-icon class="cart" name="cart"></ion-icon><div class="contenedor__conteo"><?= $conteo==null ? '0' : $conteo['cantidadPc'] ?></div></p>

                <form action="" method="post" class="contenedor__carrito__modal">
                    <div class="contenedor__carrito__modal__sub">
                        <h2>MI CARRITO:</h2>
<?php
    if( $conteoFilas <= 0 ){
?>
    <div class="container__sinProductosCarrito">
        <h3>NO HAY PRODUCTOS EN SU CARRITO...</h3>
        <ion-icon name="ban"></ion-icon>
    </div>
    
<?php
    }
?>

<?php
        $total = 0;
    foreach( $itemsCarrito as $item ){
        $total += $item['subtotal'];
?>
                        <div class="contenedor__carrito__modal__sub--item" id="resultado">
                        <input type="hidden" name="idPrdDelete" value="<?= $item['idPrd'] ?>">

                            <div class="contenedor__carrito__modal__sub--item-img">
                                <img src="http://localhost/RC/Tienda/images/<?= $item['img1'] ?>" alt="">
                            </div>

                            <div class="contenedor__carrito__modal__sub--item-nombrePrecioCantidadSubtotal">
                            
                                <div class="contenedor__carrito__modal__sub--item-precio-nombre">
                                    <p><?= $item['nombrePc'] ?></p>
                                </div>
                                
                                <div class="contenedor__carrito__modal__sub--item-precio">
                                    <b>Precio unitario: $<?= $item['precioPc'] ?></b>
                                </div>

                                <div class="contenedor__carrito__modal__sub--item-cantidad">
                                    <b><?= $item['cantidadPc'] ?> unidad/es <ion-icon name="remove-circle"></ion-icon> <ion-icon name="add-circle"></ion-icon></b>
                                </div>

                                <div class="contenedor__carrito__modal__sub--item--subtotal">
                                    <p>Subtotal: </p><b>$<?= $item['subtotal'] ?></b>
                                </div>

                            </div>

                            <div class="contenedor__carrito__modal__sub--item-eliminarItem">
                                <button name="borrarPrd"><ion-icon name="close-circle-outline" class="iconoEliminarItem"></ion-icon></button>
                            </div>

                        </div>
<?php
    }
?>
                        <div class="contenedor__carrito__modal__sub--totalCompra">
                            <h1>TOTAL: $<?= $total ?></h1>
                        </div>

                        <div class="contenedor__carrito__modal__sub--continuarComprando">
                            <input type="submit" value="CONTINUAR CON MI COMPRA">
                        </div>
                        
                    </div>

                    
            </form>

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
                <a href="configuracionUser.php" class="contenedor__perfil-imagen">
                    <img src="http://localhost/RC/Tienda/images/<?= $_SESSION['imagenActual']['usuImg'] ?>" alt="">
                </a>
                <div class="contenedor__perfil__info">
                    <h5 class="contenedor__perfil__info--user"><?= $_SESSION['usuNombre'] ?><ion-icon class="flechitaUser" name="caret-forward-outline"></ion-icon></h5>
                    <ul class="contenedor__perfil__info--logout">
                        <li><ion-icon name="home" class="ion__icon"></ion-icon><a id="" href="tiendaUser.php">Inicio</a></li>
                        <li><ion-icon name="settings-outline" class="ion__icon"></ion-icon><a href="configuracionUser.php">Configuración</a></li>
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