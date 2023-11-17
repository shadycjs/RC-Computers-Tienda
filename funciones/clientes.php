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

        $sql = "INSERT INTO clientes
                (idUsuario, CliProvincia, CliCiudad, CliCalle, CliAltura, CliPiso, CliDepto
                , CliTorre, CliLocalidad, CliPostal, CliObser, telefono, dniCuit)
                VALUES
                ($idUsuario, '".$provinciaCli."', '".$ciudadCli."', '".$calleCli."', $alturaCli
                ,$pisoCli, $deptoCli, $torreCli, '".$localidadCli."', $codpostalCli,'".$observacionesCli."', $telefono, $dniCuit)";

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

        $sql = "UPDATE clientes SET CliProvincia = '$provinciaCli', CliCiudad = '$ciudadCli', CliCalle = '$calleCli',
        CliAltura = $alturaCli, CliPiso = $pisoCli, CliDepto = $deptoCli, CliTorre = $torreCli,
        CliLocalidad = '$localidadCli', CliPostal = $codpostalCli, CliObser = '$observacionesCli' WHERE idCli = ".$idCli;

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

        $sql = "SELECT CliProvincia, CliCiudad, CliCalle, CliAltura, CliPiso, CliDepto,
                    CliTorre, CliLocalidad, CliPostal, CliObser, telefono, dniCuit FROM clientes 
                        WHERE idUsuario = ".$_SESSION['idUsuario'];
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function listarComprasClientes()
    {
        $link = conectar();

        $sql = "SELECT nroVenta, fecha, SUM(importe) as Total, condicionPago, envio, transporte, comprobantePago, factura, ov.idUsuario, u.usuNombre, u.usuApellido FROM orden__venta ov
                    INNER JOIN usuarios u ON u.idUsuario = ov.idUsuario
                        GROUP BY nroVenta";
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function listarComprasDetalladasClientes()
    {
        $link = conectar();

        $sql = "SELECT nroVenta, fecha, importe, cantidad, condicionPago, envio, transporte, pv.nombrePc, ov.idUsuario FROM orden__venta ov
                    INNER JOIN usuarios u ON u.idUsuario = ov.idUsuario
                        INNER JOIN pc_venta pv ON pv.idPrd = ov.idPrd
                            WHERE nroVenta = ".$_GET['nroVenta'];
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function subirFactura() : string
    {
      //si no enviaron un archivo
      $factura = 'Aun sin emitir';

      //si enviaron un archivo
      if( $_FILES['facturaCompra']['error'] == 0 ){

        $archivo = $_FILES['facturaCompra'];

        #### Mover el archivo desde /tmp a nuestra carpeta /productos
        $temp = $_FILES['facturaCompra']['tmp_name'];
        $ruta = 'facturas/';
        
        $extension = pathinfo( $_FILES['facturaCompra']['name'], PATHINFO_EXTENSION );
        $factura = 'Factura NRO '.$_GET['nroVenta'].' - '.$_GET['usuNombre'].' '.$_GET['usuApellido'].'.'.$extension;
        move_uploaded_file( $temp,$ruta.$factura );
      }
      return $factura;
    }

    function actualizarFactura() : bool
    {
        $link = conectar();

        $nroVenta = $_GET['nroVenta'];
        $facturaSubida = subirFactura();
        $sql = "UPDATE orden__venta SET factura = '$facturaSubida' 
                    WHERE nroVenta = ".$nroVenta;
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            return false;
        }
    }