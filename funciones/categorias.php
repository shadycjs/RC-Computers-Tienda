<?php

    #CRUD categorias

    function listarCategorias()
    {
        $link = conectar();
        $sql = "SELECT idCategoria, nombreCategoria FROM categoria";
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }