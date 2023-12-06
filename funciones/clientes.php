<?php

    #CRUD CLIENTES

    function listarClientePorId()
    {
        $link = conectar();

        $sql = "SELECT idCli, idUsuario, CliProvincia, CliCiudad, CliCalle, CliAltura, CliPiso, 
                    CliDepto, CliTorre, CliLocalidad, CliPostal, CliObser, telefono, dniCuit FROM clientes
                        WHERE idUsuario = ".$_SESSION['idUsuario'];
        $consulta = mysqli_query( $link,$sql );
        $resultado = mysqli_fetch_assoc( $consulta );
        return $resultado;
    }

    function listarClientePorCompra()
    {
        $link = conectar();

        $sql = "SELECT u.usuNombre, u.usuApellido, c.idCli, c.idUsuario, c.CliProvincia, c.CliCiudad, c.CliCalle, c.CliAltura, c.CliPiso, 
                    c.CliDepto, c.CliTorre, c.CliLocalidad, c.CliPostal, c.CliObser, c.telefono, c.dniCuit FROM clientes c
                        INNER JOIN usuarios u ON u.idUsuario = c.idUsuario
                            INNER JOIN orden__venta ov ON ov.idUsuario = c.idUsuario 
                                WHERE c.idUsuario = ".$_GET['idUsuario'];
        $consulta = mysqli_query( $link,$sql );
        $resultado = mysqli_fetch_assoc( $consulta );
        return $resultado;
    }

    function agregarCliente() : bool
    {
        $link = conectar();

        $provinciaCli = $_POST['provinciaCli'];
        $ciudadCli = $_POST['ciudadCli'];
        $calleCli = $_POST['calleCli'];
        $alturaCli = $_POST['alturaCli'];
        $pisoCli = $_POST['pisoCli'];
        $deptoCli = $_POST['deptoCli'];
        $torreCli = $_POST['torreCli'];
        $localidadCli = $_POST['localidadCli'];
        $codpostalCli = $_POST['codpostalCli'];
        $observacionesCli = $_POST['observacionesCli'];
        $idUsuario = $_SESSION['idUsuario'];
        $telefono = (isset($_POST['telRecep'])) ? $_POST['telRecep'] : 'DEFAULT';
        $dniCuit = (isset($_POST['dniCuilRecep'])) ? $_POST['dniCuilRecep'] : 'DEFAULT';
        $nombreRecep = (isset($_POST['nombreRecep'])) ? $_POST['nombreRecep'] : 'DEFAULT';
        $apellidoRecep = (isset($_POST['apellidoRecep'])) ? $_POST['apellidoRecep'] : 'DEFAULT';

        $sql = "INSERT INTO clientes
                (idUsuario, CliProvincia, CliCiudad, CliCalle, CliAltura, CliPiso, CliDepto
                , CliTorre, CliLocalidad, CliPostal, CliObser, telefono, dniCuit, nombreRecep, apellidoRecep)
                VALUES
                ($idUsuario, '".$provinciaCli."', '".$ciudadCli."', '".$calleCli."', $alturaCli
                ,$pisoCli, $deptoCli, $torreCli, '".$localidadCli."', $codpostalCli,'".$observacionesCli."', '$telefono', $dniCuit,
                '$nombreRecep', '$apellidoRecep')";
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            echo $e->getMessage();
            header('location: carritoContinuarCompra.php?error=1');
            return false;
        }
    }

    function modificarCliente() : bool
    {
        $link = conectar();

        $provinciaCli = $_POST['provinciaCli'];
        $ciudadCli = $_POST['ciudadCli'];
        $calleCli = $_POST['calleCli'];
        $alturaCli = $_POST['alturaCli'];
        $pisoCli = $_POST['pisoCli'];
        $deptoCli = $_POST['deptoCli'];
        $torreCli = $_POST['torreCli'];
        $localidadCli = $_POST['localidadCli'];
        $codpostalCli = $_POST['codpostalCli'];
        $observacionesCli = $_POST['observacionesCli'];
        $idUsuario = $_SESSION['idUsuario'];
        $idCli = $_POST['idCli'];
        $telefono = (isset($_POST['telRecep'])) ? $_POST['telRecep'] : 'DEFAULT';
        $dniCuit = (isset($_POST['dniCuilRecep'])) ? $_POST['dniCuilRecep'] : 'DEFAULT';
        $nombreRecep = (isset($_POST['nombreRecep'])) ? $_POST['nombreRecep'] : 'DEFAULT';
        $apellidoRecep = (isset($_POST['apellidoRecep'])) ? $_POST['apellidoRecep'] : 'DEFAULT';

        $sql = "UPDATE clientes SET CliProvincia = '$provinciaCli', CliCiudad = '$ciudadCli', CliCalle = '$calleCli',
        CliAltura = $alturaCli, CliPiso = $pisoCli, CliDepto = $deptoCli, CliTorre = $torreCli,
        CliLocalidad = '$localidadCli', CliPostal = $codpostalCli, CliObser = '$observacionesCli',
        nombreRecep = '$nombreRecep', apellidoRecep = '$apellidoRecep', telefono = '$telefono',
        dniCuit = $dniCuit WHERE idCli = ".$idCli;

        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            echo $e->getMessage();
            return false;
        }
    }

    function verificarCliente()
    {
        $link = conectar();

        $sql = "SELECT 1 FROM clientes WHERE idUsuario = ".$_SESSION['idUsuario'];
        $consulta = mysqli_query( $link,$sql );
        $resultado = mysqli_num_rows( $consulta );
        return $resultado;
    }

    function infoCliente()
    {
        $link = conectar();

        $sql = "SELECT idCli, CliProvincia, CliCiudad, CliCalle, CliAltura, CliPiso, CliDepto,
                    CliTorre, CliLocalidad, CliPostal, CliObser, telefono, dniCuit FROM clientes 
                        WHERE idUsuario = ".$_SESSION['idUsuario'];
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }


