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

    function chequearCodigoRegistro() : bool
    {
        //Capturamos codigo enviado
        $codigo = $_POST['codigoRegistro'];
        /**Chequear codigo + activo = 1 */
        $link = conectar();
        
        $sql = "SELECT id, usuEmail FROM password_resets
                    WHERE codigo = '".$codigo."' AND activo = 1";             
        $resultado = mysqli_query( $link,$sql );
        $cantidad = mysqli_num_rows( $resultado );
        if( $cantidad ){
            $datos = mysqli_fetch_assoc( $resultado );
            //Seteamos activo en 0
            $sql = "UPDATE password_resets SET activo = 0 WHERE id = '".$datos['id']."'";
            mysqli_query( $link,$sql );
            /**Almacenar en sesion el email */
            $_SESSION['usuEmail'] = $datos['usuEmail'];

            //Retornar booleano
            return true;
        }
        return false;
    }

    function chequearMail()
    {
        $link = conectar();

        $email = $_SESSION['emailReg'];

        $sql = "SELECT 1 FROM usuarios
                    WHERE usuEmail = '$email'";
        $resultado = mysqli_query( $link,$sql );
        $cantidad = mysqli_num_rows( $resultado );
        if( $cantidad ){
            return true;
        }

        return false;
    }

    function registrarUser() : bool
    {
        $link = conectar();

        $codigoChequeo = chequearCodigoRegistro();
        if( $codigoChequeo ){
            $nombre = $_SESSION['nombreReg'];
            $apellido = $_SESSION['apellidoReg'];
            $email = $_SESSION['emailReg'];
            $contra = $_SESSION['contraReg'];   
            $claveHash = password_hash( $contra, PASSWORD_DEFAULT );
            $existeMail = chequearMail();

            if( $existeMail ){
                header('location: tiendaLogOut.php?error=7');
                return false;
            }

            $sql = "INSERT INTO usuarios
                        (usuNombre, usuApellido, usuEmail, usuClave)
                        VALUES
                        ( '".$nombre."', '".$apellido."', '".$email."', '".$claveHash."' )";
        }
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

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    function enviarMail($usuNombre, $codigo)
    {
        //Capturamos datos enviadops por el form
        $email = $_POST['usuEmail'];
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                     //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'unreinramiro2000@gmail.com';                     //SMTP username
            $mail->Password   = 'hxwk qbjz tqox zgju';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('unreinramiro2000@gmail.com', 'RC-Computers');
            $mail->addAddress($email, $usuNombre);     //Add a recipient

            //Attachments
            $mail->AddEmbeddedImage('C:\xampp\htdocs\RC\Tienda\images\LOGO RC BLANCO SIN FONDO.png', 'logoRc', 'attachment', 'base64', 'image/png');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'CODIGO CAMBIO DE CLAVE RC COMPUTERS';
            $mail->Body    = '<!DOCTYPE html>
            <html>
                <head>
                <meta charset="UTF-8">
                <meta name="description" content="">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>RC Computers - Tienda</title>
                <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
                <meta http-equiv="Expires" content="0">
                <meta http-equiv="Last-Modified" content="0">
                <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
                <meta http-equiv="Pragma" content="no-cache">
                <style type="text/css">
            
                    *{
                        font-family: "Roboto Condensed", sans-serif;
                    }
            
                    header{
                        display: flex;
                        width: 400px; 
                        height: 130px;
                        background: linear-gradient(to bottom, black, #575353);
                        color: #fff;
                    }
            
                    header h1{
                        margin: auto;
                    }
            
                    .container__todo{
                        height: 100%;
                        width: 30%
                    }
            
                    .container__todo--imagen{
                        width: 35%;
                        height: 100%;
                    }
            
                    .container__todo__sub{
                        display: inline-block;
                        width: 400px;
                        height: 300px;
                        background-color: #464444;
                        color: #fff;
                        margin: 5px 0;
                    }
            
                    .container__todo__sub p{
                        margin-top: 50px;
                        font-size: 2em;
                        text-align: center;
                        color: #fff !important;
                    }

                    .container__todo__sub--codigo{
                        display: flex;
                        width: 100%;
                        height: 100px;
                        background-color: #fff;
                        text-align: center;
                    }
            
                    .container__todo__sub b{
                        font-size: 4em;
                        border-radius: 5px;
                        color: #000;
                        margin: auto;
                        width: 100%;
                        padding: 10px;
                        background-color: beige;
                    }
            
                    footer{
                        background: linear-gradient(to bottom, black, #575353);
                        color: white;
                        display: flex;
                        width: 400px;
                        height: 60px;
                        position: relative;
                        bottom: 0;
                    }
            
                    footer p{
                        align-self: center;
                        font-size: 1em;
                        margin-left: auto;
                        margin-right: auto;
                    }
            
                </style>
                </head>
                    <body>
                        <header>
                            <div class="container__todo--imagen">
                                <img alt="PHPMailer" src="cid:logoRc" style="width: 100%;
                                                                             height: 100%">
                                </div>
                                <h1>RC Computers</h1>
                        </header>
                        <div class="container__todo">
                                    <div class="container__todo__sub">
                                        <p>CÓDIGO CAMBIO DE CLAVE: </p>
                                        <div class="container__todo__sub--codigo">
                                            <b>'.$codigo.'</b>
                                        </div>
                                    </div>
                    
                        </div>
                        <footer> <!-- PIE DE PÁGINA -->
                            <p> RC Computers © All rights reserved </p>
                        </footer>
                        </body>
            </html>';
            $mail->AltBody = 'Ingresa el siguiente Código para reestablecer tu contraseña';

            $mail->CharSet = 'UTF-8';
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }

    function enviarMailRegistrarUser($usuNombre, $codigo)
    {
        //Capturamos datos enviadops por el form
        $email = $_POST['remail'];
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                     //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'unreinramiro2000@gmail.com';                     //SMTP username
            $mail->Password   = 'hxwk qbjz tqox zgju';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('unreinramiro2000@gmail.com', 'RC-Computers');
            $mail->addAddress($email, $usuNombre);     //Add a recipient

            //Attachments
            $mail->AddEmbeddedImage('C:\xampp\htdocs\RC\Tienda\images\LOGO RC BLANCO SIN FONDO.png', 'logoRc', 'attachment', 'base64', 'image/png');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'CODIGO DE REGISTRO RC COMPUTERS';
            $mail->Body    = '<!DOCTYPE html>
            <html>
                <head>
                <meta charset="UTF-8">
                <meta name="description" content="">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>RC Computers - Tienda</title>
                <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
                <meta http-equiv="Expires" content="0">
                <meta http-equiv="Last-Modified" content="0">
                <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
                <meta http-equiv="Pragma" content="no-cache">
                <style type="text/css">
            
                    *{
                        font-family: "Roboto Condensed", sans-serif;
                    }
            
                    header{
                        display: flex;
                        width: 400px; 
                        height: 130px;
                        background: linear-gradient(to bottom, black, #575353);
                        color: #fff;
                    }
            
                    header h1{
                        margin: auto;
                    }
            
                    .container__todo{
                        height: 100%;
                        width: 30%
                    }
            
                    .container__todo--imagen{
                        width: 35%;
                        height: 100%;
                    }
            
                    .container__todo__sub{
                        display: inline-block;
                        width: 400px;
                        height: 300px;
                        background-color: #464444;
                        color: #fff;
                        margin: 5px 0;
                    }
            
                    .container__todo__sub p{
                        margin-top: 50px;
                        font-size: 2em;
                        text-align: center;
                        color: #fff !important;
                    }

                    .container__todo__sub--codigo{
                        display: flex;
                        width: 100%;
                        height: 100px;
                        background-color: #fff;
                        text-align: center;
                    }
            
                    .container__todo__sub b{
                        font-size: 4em;
                        border-radius: 5px;
                        color: #000;
                        margin: auto;
                        width: 100%;
                        padding: 10px;
                        background-color: beige;
                    }
            
                    footer{
                        background: linear-gradient(to bottom, black, #575353);
                        color: white;
                        display: flex;
                        width: 400px;
                        height: 60px;
                        position: relative;
                        bottom: 0;
                    }
            
                    footer p{
                        align-self: center;
                        font-size: 1em;
                        margin-left: auto;
                        margin-right: auto;
                    }
            
                </style>
                </head>
                    <body>
                        <header>
                            <div class="container__todo--imagen">
                                <img alt="PHPMailer" src="cid:logoRc" style="width: 100%;
                                                                             height: 100%">
                                </div>
                                <h1>RC Computers</h1>
                        </header>
                        <div class="container__todo">
                                    <div class="container__todo__sub">
                                        <p>CÓDIGO DE REGISTRO: </p>
                                        <div class="container__todo__sub--codigo">
                                            <b>'.$codigo.'</b>
                                        </div>
                                    </div>
                    
                        </div>
                        <footer> <!-- PIE DE PÁGINA -->
                            <p> RC Computers © All rights reserved </p>
                        </footer>
                        </body>
            </html>';
            $mail->AltBody = 'Codigo de registro para RC Comupters';

            $mail->CharSet = 'UTF-8';
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }

    function enviarMailComprador($usuNombre)
    {
        //Capturamos datos enviados por el form
        $email = $_SESSION['usuEmail'];

        $provincia = $_SESSION['provinciaSession'];
        $ciudad = $_SESSION['ciudadSession'];
        $calle = $_SESSION['calleSession'];
        $altura = $_SESSION['alturaSession'];
        $piso = $_SESSION['pisoSession'];
        $depto = $_SESSION['deptoSession'];
        $torre = $_SESSION['torreSession'];
        $localidad = $_SESSION['localidadSession'];
        $codPostal = $_SESSION['codPostalSession'];
        $observaciones = $_SESSION['observacionesSession'];
        $telReceptor = $_SESSION['telRecepSession'];
        $dniCuitReceptor = $_SESSION['dniCuitSession'];
        $nombreReceptor = $_SESSION['nombreRecepSession'];
        $apellidoReceptor = $_SESSION['apellidoSession'];

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                     //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'unreinramiro2000@gmail.com';                     //SMTP username
            $mail->Password   = 'hxwk qbjz tqox zgju';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('unreinramiro2000@gmail.com', 'RC-Computers');
            $mail->addAddress('unreinramiro2000@gmail.com', $usuNombre);     //Add a recipient (ACORDARSE DE CAMBIAR EL MAIL AL $email!!!)

            //Attachments
            $mail->AddEmbeddedImage('C:\xampp\htdocs\RC\Tienda\images\LOGO RC BLANCO SIN FONDO.png', 'logoRc', 'attachment', 'base64', 'image/png');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'GRACIAS POR CONFIAR EN RC COMPUTERS';
            $mail->Body    = '<!DOCTYPE html>
            <html>
            <head>
            <meta charset="UTF-8">
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RC Computers - Tienda</title>
            <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <meta http-equiv="Expires" content="0">
            <meta http-equiv="Last-Modified" content="0">
            <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
            <meta http-equiv="Pragma" content="no-cache">
            <style type="text/css">
        
                *{
                    font-family: "Roboto Condensed", sans-serif;
                    box-sizing: border-box;
                }
        
                html, body{
                    min-height: 100%;
                }

                ul{
                    padding: 0;
                    margin: 0;
                }

                li{
                    padding: 0;
                    margin: 0;
                    list-style: none;
                    font-size: 1.4rem;
                }
        
                header{
                    display: flex;
                    height: 200px;
                    background: linear-gradient(to bottom, black, #575353);
                    color: #fff;
                    align-self: center;
                    margin-left: auto;
                    margin-right: auto;
                }
        
                header h1{
                    margin: auto;
                }

                #headerSub{
                    display: flex;
                    width: 100%;
                }

                #headerSub h1{
                    display: flex;
                    margin: auto;
                    text-align: center;
                }

                #containerTodo{
                    background: linear-gradient(to bottom, black, #575353);
                    color: #fff;
                }

                #datosComprador{
                    text-align: center;
                }
        
                #datosComprador__sub{
                    margin: 0 auto;
                }
        
                footer{
                    background: linear-gradient(to bottom, black, #575353);
                    color: white;
                    display: flex;
                    position: relative;
                    bottom: 0;
                    margin-top: 20px;
                }
        
                footer p{
                    align-self: center;
                    font-size: 1em;
                    margin-left: auto;
                    margin-right: auto;
                }
        
            </style>
            </head>
                <body>
                    <header class="container">
                        <div class="row" style="display: flex;
                                                justify-content: center;
                                                align-items: center;>
                            <div class="col-4 header-img" style="width: 40%;
                                                                 margin-left: 100px;">
                                <img alt="PHPMailer" src="cid:logoRc" style="width: 200px;
                                                                             min-width: 150px;">
                            </div>
                            <div id="headerSub">
                                <h1>RC Computers</h1>
                            </div>
                        </div> 
                    </header>
                    <div id="containerTodo">
                        <div>
                            <h1 style="text-align: center">'.$usuNombre.' ¡Muchas gracias por tu compra!</h1>
                            <div id="datosComprador">
                                <h2>Tus datos para el envio:</h2>
                                <div>
                                    <div class="datosComprador__sub">
                                        <ul>
                                            <li>Provincia: <b>'.$provincia.'</b></li>
                                            <li>Ciudad: <b>'.$ciudad.'</b></li>
                                            <li>Calle: <b>'.$calle.'</b></li>
                                            <li>Altura: <b>'.$altura.'</b></li>
                                            <li>Depto: <b>'.$depto.'</b></li>
                                            <li>Torre: <b>'.$torre.'</b></li>
                                            <li>Localidad: <b>'.$localidad.'</b></li>
                                            <li>Provincia: <b>'.$ciudad.'</b></li>
                                            <li>Cod.Postal: <b>'.$codPostal.'</b></li>
                                        </ul>
                                    </div>
                                    <div class="datosComprador__sub">
                                        <h2>Datos del receptor del envio</h2>
                                        <ul>
                                            <li>Nombre: <b>'.$nombreReceptor.'</b></li>
                                            <li>Apellido: <b>'.$apellidoReceptor.'</b></li>
                                            <li>DNI: <b>'.$dniCuitReceptor.'</b></li>
                                            <li>Telefono: <b>'.$telReceptor.'</b></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="datosProducto">
                                <h1>Detalle del pedido: </h1>
                                <div class="datosProducto__sub">
                                '.$total = 0;
                                foreach( $_SESSION['CARRITO'] as $indice => $producto ){

                                    $nombreProducto = $producto['nombre'];
                                    $precioProducto = $producto['precio'];
                                    $cantidadProducto = $producto['cantidad'];
                                    $imagenProducto = $producto['img'];
                            
                                    $idProductos = array_column($_SESSION['CARRITO'],'id');
                                    $posicionPrd = array_search($producto['id'],$idProductos);
                                }'
                                    <div class="datosProducto__sub--item">
                                        <div class="datosProducto__sub--item-nombre">
                                            '.$nombreProducto.'
                                        </div>
                                    </div>
                         
                                    <div class="datosProducto__sub--total">
                                        <h1>Total: '.$total.'</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="container"> <!-- PIE DE PÁGINA -->
                        <p> RC Computers © All rights reserved </p>
                    </footer>
                    </body>
        </html>';
            $mail->AltBody = 'Aca podras ver la informacion de tu compra';

            $mail->CharSet = 'UTF-8';
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }

    //PONER ESTA IMAGEN AL MODIFICA EL HTML DEL MAIL: img alt="PHPMailer" src="cid:logoRc"

    function generarCodigo( $length = 6 )
    {
        $chars = [
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
            "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
            1,2,3,4,5,6,7,8,9,0
        ];
        $codigo = '';
        $cantidad = count($chars) - 1;
        for( $n = 0; $n<$length; $n++ ){
            $codigo .= $chars[rand(0,$cantidad)];
        }
        return $codigo;
    }
    
    function almacenarCodigo( $codigo ) : bool
    {
        $email = isset($_POST['usuEmail']) ;
        $email = isset($_POST['remail']);

        $link = conectar();
        $sql = "INSERT INTO password_resets
                VALUES
                (DEFAULT, '".$codigo."', '".$email."', DEFAULT, DEFAULT)";
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch( EXCEPTION $e ){
            echo $e->getMessage();
            return false;
        }
    }

    function mailResetPass()
    {
        /**Chequear quue exista el mail en la tabla usuarios */
        $usuEmail = $_POST['usuEmail'];

        $link = conectar();
        $sql = "SELECT usuNombre FROM usuarios
                    WHERE usuEmail = '".$usuEmail."'";
        $resultado = mysqli_query( $link,$sql );
        $cantidad = mysqli_num_rows($resultado);

        if( $cantidad ){
            // $codigo = generarCodigo();
            // almacenarCodigo( $codigo );
            // enviarMail( $codigo );
            $consulta = mysqli_fetch_assoc($resultado);
            return $consulta;
        }

        header('location: tiendaLogOut.php?error=4');

    }

    function chequearCodigo() : bool
    {
        //Capturamos codigo enviado
        $codigo = $_POST['codigo'];
        /**Chequear codigo + activo = 1 */
        $link = conectar();
        
        $sql = "SELECT id, usuEmail FROM password_resets
                    WHERE codigo = '".$codigo."' AND activo = 1";             
        $resultado = mysqli_query( $link,$sql );
        $cantidad = mysqli_num_rows( $resultado );
        if( $cantidad ){
            $datos = mysqli_fetch_assoc( $resultado );
            //Seteamos activo en 0
            $sql = "UPDATE password_resets SET activo = 0 WHERE id = '".$datos['id']."'";
            mysqli_query( $link,$sql );
            /**Almacenar en sesion el email */
            $_SESSION['usuEmail'] = $datos['usuEmail'];

            //Retornar booleano
            return true;
        }
        return false;
    }

    function modificarClaveMail() : bool
    {
        $link = conectar();
        //Capturamos clave actual
        $usuClave = $_POST['nuevaClave'];
        $usuClave2 = $_POST['nuevaClave2'];
        $email = $_SESSION['usuEmail'];

        //Clave actual y clave en tabla usuarios coinciden
        //Comparamos que NO coincidan las nuevas claves
        if(  $usuClave != $usuClave2 ){
            header('location: tiendaLogOut.php?error=5');
            return true;
        }
        /*Aca sabemos que la clave actual esta OK y que la clave nueva y repite clave nueva
            COINCIDEN */
        /**Encriptamos clave nueva y almacenamos en tabla usuarios */
        $pwHash = password_hash($_POST['nuevaClave'],PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET usuClave = '".$pwHash."' 
                    WHERE usuEmail = '$email'";
        try{
            $res = mysqli_query( $link,$sql );
            return $res;
        }catch(EXCEPTION $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    
    }

