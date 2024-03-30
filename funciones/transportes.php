<?php

    function listarTransportes()
    {
        $link = conectar();

        $sql = "SELECT nombreTransporte, precioTransporte, imgTransporte FROM transportes";
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }



?>