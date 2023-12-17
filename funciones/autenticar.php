<?php 

    #CRUD AUTENTICAR

    ob_start();

    function login()
    {
        $link = conectar();

        $usuEmail = $_POST['lemail'];
        $usuClave = $_POST['lcontra'];

        $sql = "SELECT idUsuario, usuNombre, usuApellido, idRol, usuClave, usuEmail FROM usuarios
                    WHERE usuEmail = '".$usuEmail."'
                        AND usuActivo = 1";
        try{
            $resultado = mysqli_query( $link,$sql );
            $cantidad = mysqli_num_rows( $resultado );
        }catch( EXCEPTION $e ){
            echo $e->getMessage();
        }
        //Si la variable "$cantidad" == 0 -> el usuario se logueo MAL
        //Si la variable "$cantidad" == 1 -> el usuario se logueo OK
        if( $cantidad == 0 ){
            //Redireccion a formLogin.php
            header('location: tiendaLogOut.php?error=1');
        }else{
            //Aca sabemos que el email esta OK
            // y que el usuario esta ACTIVO
            // Verificamos la contrasenia
            $usuario = mysqli_fetch_assoc( $resultado );
                 // Si la contrasenia esta mal
                if( !password_verify( $usuClave,$usuario['usuClave'] ) ){
                    header('location: tiendaLogOut.php?error=1');
                    return;
                }
            /* Aca ya sabemos: se logueo bien y esta activo */ 
            #### RUTINA DE AUTENTICACION ####
            //Sesiones
                $_SESSION['idUsuario'] = $usuario['idUsuario'];
                $_SESSION['usuNombre'] = $usuario['usuNombre'];
                $_SESSION['usuApellido'] = $usuario['usuApellido'];
                $_SESSION['usuEmail'] = $usuario['usuEmail'];
                $_SESSION['idRol'] = $usuario['idRol'];
                $_SESSION['login'] = 1;
            //Redireccion a admin.php
            header('location: tiendaUser.php');
        }

    }

    function logout() : void
    {
        //eliminamos variables de sesion
        session_unset();
        //eliminamos la sesion
        session_destroy();
        //redireccion con demora
        header('refresh:5;url=tiendaLogOut.php');
    }

    function autenticar() : void
    {
        if( !isset( $_SESSION['login'] ) ){
            header('location: tiendaLogOut.php?error=2');
        }
    }