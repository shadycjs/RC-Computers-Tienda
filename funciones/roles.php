<?php

    #CRUD ROLES

    function listarRoles()
    {
        $link = conectar();

        $sql = "SELECT idRol, rol FROM roles";
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }