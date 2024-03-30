<?php

    function listarTransportes()
    {
        $link = conectar();

        $sql = "SELECT idTransporte, nombreTransporte, precioTransporte, imgTransporte FROM transportes";
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function modificarTransportes()
    {
        $link = conectar();

        $precio = $_POST['precioTransporte'];
        $idTransporte = $_POST['idTransporte'];

        $sql = "UPDATE transportes SET precioTransporte = ".$precio." WHERE idTransporte = ".$idTransporte;

        try {
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        } catch (EXCEPTION $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function precioAndreani()
    {
        $link = conectar();

        $sql = "SELECT precioTransporte FROM transportes WHERE idTransporte = 1";
        $consulta = mysqli_query( $link,$sql );
        $resultado = mysqli_fetch_assoc( $consulta );
        return $resultado;
    }

    function precioOca()
    {
        $link = conectar();

        $sql = "SELECT precioTransporte FROM transportes WHERE idTransporte = 2";
        $consulta = mysqli_query( $link,$sql );
        $resultado = mysqli_fetch_assoc( $consulta );
        return $resultado;
    }

?>