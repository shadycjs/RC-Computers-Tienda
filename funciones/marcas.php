<?php

    #CRUD marcas

    function listarMarcas()
    {
        $link = conectar();
        $sql = "SELECT idMarca, nombreMarca FROM marca";
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }