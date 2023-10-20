<?php

    #CRUD USUARIOS

    function listarUsuarios()
    {
        $link = conectar();

        $sql = "SELECT u.idUsuario, u.usuNombre, u.usuApellido, u.usuEmail, u.usuActivo, u.usuImg, r.idRol, r.rol 
                    FROM usuarios u
                        INNER JOIN roles r ON u.idRol = r.idRol";
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function registrarUser() : bool
    {
        $link = conectar();

        $nombre = $_POST['rnombre'];
        $apellido = $_POST['rapellido'];
        $email = $_POST['remail'];
        $contra = $_POST['rcontra'];   
        $claveHash = password_hash( $contra, PASSWORD_DEFAULT );

        $sql = "INSERT INTO usuarios
                (usuNombre, usuApellido, usuEmail, usuClave)
                VALUES
                ( '".$nombre."', '".$apellido."', '".$email."', '".$claveHash."' )";
        
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }
        catch(EXCEPTION $e){
            echo $e->getMessage();
            return FALSE;
        }
    }

    function modificarUser() : bool
    {
        $link = conectar();

        $idUser = $_POST['idUsuario'];
        $nombreUser = $_POST['usuNombre'];
        $apellidoUser = $_POST['usuApellido'];
        $emailUser = $_POST['usuEmail'];
        $idRol = $_POST['usuRol'];
        $estadoUser = $_POST['usuActivo'];

        $sql = "UPDATE usuarios SET usuNombre = '".$nombreUser."', usuApellido = '".$apellidoUser."',
                    usuEmail = '".$emailUser."', idRol = $idRol, usuActivo = $estadoUser
                        WHERE idUsuario = ".$idUser;
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            FALSE;
        }
    }

    function eliminarUser() : bool
    {
        $link = conectar();

        $idUser = $_POST['idUsuario'];

        $sql = "DELETE FROM usuarios
                    WHERE idUsuario = ".$idUser;
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            FALSE;
        }
    }

    function verRol()
    {
        $link = conectar();

        $idRol = $_SESSION['idRol'];
        $sql = "SELECT rol FROM roles 
                    WHERE idRol = ".$idRol;
        $resultado = mysqli_query( $link,$sql );
        $rol = mysqli_fetch_assoc($resultado);
        return $rol;
    }

    function subirImagenUsu() : string
    {
      //si no enviaron un archivo
      $prdImagen = 'userIconDefault.png';

      //si no enviaron archivo en modificarProducto()
      if( isset($_POST['imgUserVieja']) ){
        $prdImagen = $_POST['imgUserVieja'];
      }

      //si enviaron un archivo
      if( $_FILES['imgUserNueva']['error'] == 0 ){

        $archivo = $_FILES['imgUserNueva'];

        #### Mover el archivo desde /tmp a nuestra carpeta /productos
        $temp = $_FILES['imgUserNueva']['tmp_name'];
        $ruta = 'images/';
        
        $extension = pathinfo( $_FILES['imgUserNueva']['name'], PATHINFO_EXTENSION );
        $prdImagen = time().'.'.$extension;
        move_uploaded_file( $temp,$ruta.$prdImagen );
      }
      return $prdImagen;
    }

    function verImagenPorId()
    {
        $link = conectar();

        $idUsu = $_SESSION['idUsuario'];
        $sql = "SELECT usuImg FROM usuarios
                    WHERE idUsuario = ".$idUsu;
        $resultado = mysqli_query( $link,$sql );
        $imagenDevuelta = mysqli_fetch_assoc($resultado);
        return $imagenDevuelta;
    }

    function modificarImgPerfil()
    {
        $link = conectar();

        $idUsu = $_SESSION['idUsuario'];
        $usuImg = subirImagenUsu();
        $sql = "UPDATE usuarios SET usuImg = '".$usuImg."' 
                    WHERE idUsuario = ".$idUsu;
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            return FALSE;
        }
    }

    function verUsuarioPorId() : array
    {
        $link = conectar();

        $idUsuario = $_SESSION['idUsuario'];
        $sql = "SELECT idUsuario, usuNombre, usuApellido, usuEmail, idRol, usuActivo, usuImg
                    FROM usuarios
                        WHERE idUsuario = ".$idUsuario;
        $consulta = mysqli_query( $link,$sql );
        $resultado = mysqli_fetch_assoc($consulta);
        return $resultado;
    }

    function verUserPorId() : array
    {
        $link = conectar();

        $idUsuario = $_GET['idUser'];
        $sql = "SELECT u.idUsuario, u.usuNombre, u.usuApellido, u.usuEmail, r.idRol, r.rol,u.usuActivo, u.usuImg
                    FROM usuarios u
                        INNER JOIN roles r ON u.idRol = r.idRol
                        WHERE idUsuario = ".$idUsuario;
        $consulta = mysqli_query( $link,$sql );
        $resultado = mysqli_fetch_assoc($consulta);
        return $resultado;
    }

    function modificarClave() : bool
    {
        //Capturamos clave actual
        $usuClave = $_POST['contraActual'];
        /* Obtenemos la clave encriptada */
        $link = conectar();
        $sql = "SELECT usuClave FROM usuarios
                    WHERE idUsuario = ".$_SESSION['idUsuario'];
        try{
            $resultado = mysqli_query( $link,$sql );
        }catch( EXCEPTION $e ){
            echo $e->getMessage();
            return false;
        }
        /* Comparamos la clave sin encriptar: enviada por el usuario
        con la clave encriptada de la tabla usuarios  
        */
        $usuario = mysqli_fetch_assoc( $resultado );
        if( !password_verify( $usuClave,$usuario['usuClave'] ) ){
            //Si no coinciden las claves
            header('location: configuracionUser.php?error=1');
            return false;
        }else{
            //Clave actual y clave en tabla usuarios coinciden
            //Comparamos que NO coincidan las nuevas claves
            if( $_POST['contraNueva'] != $_POST['contraRepetir'] ){
                header('location: configuracionUser.php?error=2');
                return true;
            }
            /*Aca sabemos que la clave actual esta OK y que la clave nueva y repite clave nueva
                COINCIDEN */
            /**Encriptamos clave nueva y almacenamos en tabla usuarios */
            $pwHash = password_hash($_POST['contraNueva'],PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET usuClave = '".$pwHash."' 
                        WHERE idUsuario = ".$_SESSION['idUsuario'];
            try{
                $res = mysqli_query( $link,$sql );
                return $res;
            }catch(EXCEPTION $e){
                echo $e->getMessage();
                return false;
            }
            return true;
        }
    }
    