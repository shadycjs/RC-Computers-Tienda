<?php

    #CRUD COMPRAS

    function verCompras()
    {
        $link = conectar();

        $idUser = $_SESSION['idUsuario'];
        $sql = "SELECT nroVenta, fecha, SUM(importe) as Total, condicionPago, envio, transporte, comprobantePago, factura, idUsuario FROM orden__venta
                  GROUP BY nroVenta
                    HAVING idUsuario = ".$idUser;
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function verDetalleCompra()
    {
        $link = conectar();
        $nroVenta = $_GET['nroVenta'];

        $idUser = $_SESSION['idUsuario'];
        $sql = "SELECT nroVenta, fecha, importe, cantidad, condicionPago, envio, nombrePrd, transporte, comprobantePago, factura, idUsuario FROM orden__venta ov
                  INNER JOIN productos p ON p.idPrd = ov.idPrd
                    WHERE idUsuario = ".$idUser." AND nroVenta = ".$nroVenta;
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function subirComprobante() : string
    {
      //si no enviaron un archivo
      $comprobante = 'Aun sin emitir';

      //si enviaron un archivo
      if( $_FILES['facturaCompra']['error'] == 0 ){

        $archivo = $_FILES['facturaCompra'];

        #### Mover el archivo desde /tmp a nuestra carpeta /productos
        $temp = $_FILES['facturaCompra']['tmp_name'];
        $ruta = 'comprobantes/';
        
        $extension = pathinfo( $_FILES['facturaCompra']['name'], PATHINFO_EXTENSION );
        $comprobante = 'Comprobante Orden NRO '.$_GET['nroVenta'].' - '.$_SESSION['usuNombre'].' '.$_SESSION['usuApellido'].'.'.$extension;
        move_uploaded_file( $temp,$ruta.$comprobante );
      }
      return $comprobante;
    }

    function agregarOrdenVenta( $idPrd, $precioProducto, $comprobante, $cantidadProducto )
    {
        $link = conectar();

        $envio = $_SESSION['envio'];
        $transporte = $_SESSION['transporte'];
        $idUsuario = $_SESSION['idUsuario'];
        $nroVenta = $_SESSION['nroVenta'];
        $condPago = $_SESSION['condPago'];
        
        $sql = "INSERT INTO orden__venta
                (nroVenta, fecha, importe, cantidad, condicionPago, idPrd, envio, transporte, comprobantePago, idUsuario)
                VALUES
                ($nroVenta, SYSDATE(), $precioProducto, $cantidadProducto, '$condPago',$idPrd, $envio, '$transporte', '$comprobante', $idUsuario)";
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function bajarComprobante()
    {
        $nroVenta = $_GET['numeroVenta'];
        $sql = "SELECT comprobantePago, nroVenta FROM orden__venta
                  GROUP BY nroVenta
                    HAVING nroVenta = $nroVenta";
        $link = conectar();
        $resultado = mysqli_query($link, $sql);
    
        if (mysqli_num_rows($resultado) == 1) {
            $fila = mysqli_fetch_assoc($resultado);
            $archivo = $fila['comprobantePago'];
            $ruta_archivo = "comprobantes/" . $archivo;

            // Verificar que el archivo exista en el servidor
            if (file_exists($ruta_archivo)) {
                // Enviar el archivo al navegador
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $archivo . '"');
                readfile($ruta_archivo);
            } else {
                echo "El archivo no existe en el servidor.";
            }
        } else {
            echo "El archivo no se encontró en la base de datos.";
        }
    }

    function bajarFactura()
    {
        $nroVenta = $_GET['numVentaFactura'];
        $sql = "SELECT factura, nroVenta FROM orden__venta
                  GROUP BY nroVenta
                    HAVING nroVenta = $nroVenta";
        $link = conectar();
        $resultado = mysqli_query($link, $sql);
    
        if (mysqli_num_rows($resultado) == 1) {
            $fila = mysqli_fetch_assoc($resultado);
            $archivo = $fila['factura'];
            $ruta_archivo = "facturas/" . $archivo;

            // Verificar que el archivo exista en el servidor
            if (file_exists($ruta_archivo)) {
                // Enviar el archivo al navegador
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $archivo . '"');
                readfile($ruta_archivo);
            } else {
                echo "El archivo no existe en el servidor.";
            }
        } else {
            echo "El archivo no se encontró en la base de datos.";
        }
    }

    function actualizarComprobante() : bool
    {
        $link = conectar();

        $nroVenta = $_GET['nroVenta'];
        $comprobanteSubida = subirComprobante();
        $sql = "UPDATE orden__venta SET comprobantePago = '$comprobanteSubida' 
                    WHERE nroVenta = ".$nroVenta;
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            return false;
        }
    }