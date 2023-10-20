<?php

    #CRUD CARRITO

    function listarCarrito()
    {
        $link = conectar();

        $sql = "SELECT cu.id_cart, cu.idPrd, cu.idUsuario, pc.nombrePc, SUM(cu.cantidadPc) as cantidadPc, pc.precioPc , ROUND(SUM(pc.precioPc*cu.cantidadPc)) as subtotal, pc.img1 FROM carrito_usuario cu
                    INNER JOIN pc_venta pc ON pc.idPrd = cu.idPrd
                        GROUP BY idPrd 
                            HAVING idUsuario = ".$_SESSION['idUsuario'];
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    }

    function insertarPrdCarrito()
    {
        $link = conectar();

        $idUsuario = $_SESSION['idUsuario'];
        $idPrd = $_POST['id'];
        $cantPc = $_POST['cantidad'];

        $sql = "INSERT INTO carrito_usuario
                ( idUsuario, idPrd, cantidadPc )
                VALUES
                ( $idUsuario,$idPrd,$cantPc )";
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            return FALSE;
        }
    }

    function borrarPrdCarrito()
    {
        $link = conectar();

        $idUsuario = $_SESSION['idUsuario'];
        $idPrd = $_POST['idPrdDelete'];

        $sql = "DELETE FROM carrito_usuario WHERE idUsuario = ".$_SESSION['idUsuario']." AND idPrd = ".$idPrd;
        try{
            $resultado = mysqli_query( $link,$sql );
            return $resultado;
        }catch(EXCEPTION $e){
            return FALSE;
        }  
    }

    function verCantPrdCarrito()
    {
        $link = conectar();

        $sql = "SELECT cu.id_cart, cu.idPrd, cu.idUsuario, pc.nombrePc, SUM(cu.cantidadPc) as cantidadPc, pc.precioPc , ROUND(SUM(pc.precioPc*cu.cantidadPc)) as subtotal, pc.img1 FROM carrito_usuario cu
                    INNER JOIN pc_venta pc ON pc.idPrd = cu.idPrd
                        GROUP BY idUsuario
                            HAVING idUsuario = ".$_SESSION['idUsuario'];
        $consulta = mysqli_query( $link,$sql );
        $resultado = mysqli_fetch_assoc( $consulta );
        return $resultado;
    }