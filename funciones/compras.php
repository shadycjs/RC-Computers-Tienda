<?php

    #CRUD COMPRAS

    function totalRegistrosCompras() : int
    {
      $link = conectar();

      $sql = "SELECT * FROM orden__venta";
      $consulta = mysqli_query($link,$sql);
      $resultado = mysqli_num_rows($consulta);
      return $resultado;
    }

    function verCompras()
    {
        $link = conectar();

        $idUser = $_SESSION['idUsuario'];
        $sql = "SELECT idOrdenVenta, nroVenta, fecha, SUM(importe) as Total, condicionPago, envio, transporte, comprobantePago, factura, idUsuario FROM orden__venta
                  GROUP BY nroVenta
                    HAVING idUsuario = ".$idUser;
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function verDetalleCompra()
    {
        $link = conectar();
        $idOrdenVenta = $_GET['idOrdenVenta'];

        $idUser = $_SESSION['idUsuario'];
        $sql = "SELECT nroVenta, fecha, importe, cantidad, condicionPago, envio, nombrePrd, transporte, comprobantePago, factura, idUsuario FROM orden__venta ov
                  INNER JOIN productos p ON p.idPrd = ov.idPrd
                    WHERE idUsuario = ".$idUser." AND idOrdenVenta = ".$idOrdenVenta;
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function verDetalleVenta()
    {
        $link = conectar();
        $idOrdenVenta = $_GET['idOrdenVenta'];

        $idUser = $_GET['idUsuario'];
        $sql = "SELECT nroVenta, fecha, importe, cantidad, condicionPago, envio, nombrePrd, transporte, comprobantePago, factura, idUsuario FROM orden__venta ov
                  INNER JOIN productos p ON p.idPrd = ov.idPrd
                    WHERE idUsuario = ".$idUser." AND idOrdenVenta = ".$idOrdenVenta;
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function listarComprasClientes()
    {
        $link = conectar();

        //Paginacion
        $total_registros = totalRegistrosCompras();
        $registros_por_pagina = 10;
        $pagina_actual = isset($_GET['pagActual']) ? $_GET['pagActual'] : 1;
        $primer_registro = ($pagina_actual-1) * $registros_por_pagina;

        $sql = "SELECT nroVenta, idOrdenVenta, fecha, estado, SUM(importe) as Total, condicionPago, envio, transporte, comprobantePago, factura, ov.idUsuario, u.usuNombre, u.usuApellido FROM orden__venta ov
                    INNER JOIN usuarios u ON u.idUsuario = ov.idUsuario
                        GROUP BY nroVenta
                            LIMIT $registros_por_pagina OFFSET $primer_registro";
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
        $comprobante = time().'.'.$extension;
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

    function modificarEstadoVenta($ids) : bool
    {
        $link = conectar();

        $estado = mysqli_real_escape_string($link, $_POST['estadoOrden'][$ids]);
        $idOrdenVenta =  $_POST['idOrdenVenta'][$ids];
        var_dump($idOrdenVenta);
        $sql = "UPDATE orden__venta SET estado = '$estado' WHERE idOrdenVenta = ".$idOrdenVenta;
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            return false;
        }
    }

    function bajarComprobante()
    {
        $idOrdenVenta = $_GET['idOrdenVenta'];
        $sql = "SELECT * FROM orden__venta
                  WHERE idOrdenVenta = '$idOrdenVenta'";
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

    function actualizarComprobante() : bool
    {
        $link = conectar();

        $nroVenta = $_GET['idOrdenVenta'];
        $comprobanteSubida = subirComprobante();
        $sql = "UPDATE orden__venta SET comprobantePago = '$comprobanteSubida' 
                    WHERE idOrdenVenta = ".$nroVenta;
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            return false;
        }
    }

    function subirFactura() : string
    {

      //si enviaron un archivo
      if( $_FILES['facturaCompra']['error'] == 0 ){

        $archivo = $_FILES['facturaCompra'];

        #### Mover el archivo desde /tmp a nuestra carpeta /productos
        $temp = $_FILES['facturaCompra']['tmp_name'];
        $ruta = 'facturas/';
        
        $extension = pathinfo( $_FILES['facturaCompra']['name'], PATHINFO_EXTENSION );
        $factura = time().'.'.$extension;
        move_uploaded_file( $temp,$ruta.$factura );

      }

      return $factura;
    }

    function bajarFactura()
    {
        $nroVenta = $_GET['numVentaFactura'];
        $sql = "SELECT factura, nroVenta FROM orden__venta
                  GROUP BY nroVenta
                    HAVING nroVenta = '$nroVenta'";
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

    function actualizarFactura() : string
    {
        $link = conectar();

        $id = $_GET['idOrdenVenta'];
        $factura = subirFactura();
        $sql = "UPDATE orden__venta SET factura = '$factura' WHERE idOrdenVenta = '$id'";

        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }
        catch( EXCEPTION $e ){
            $e->getMessage(); 
            return FALSE;
        }
    }