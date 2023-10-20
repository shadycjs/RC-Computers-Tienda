<?php

    const SERVER = 'localhost';
    const USUARIO = 'root';
    const CLAVE = '';
    const BASE = 'rc_computers_ventas';

    function conectar() : mysqli
    {
        $link = mysqli_connect(
            SERVER,
            USUARIO,
            CLAVE,
            BASE
        );
        return $link;
    }


    function conectarPDO() {
        try {
            // Configurar la conexión PDO
            $dsn = "mysql:host=localhost;dbname=rc_computers_ventas;charset=utf8";
            $usuario = "root";
            $contraseña = "";
    
            $conexion = new PDO($dsn, $usuario, $contraseña);
    
            // Configurar el modo de errores para que PDO lance excepciones en caso de error
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            return $conexion;
        } catch (PDOException $e) {
            // Manejar errores de conexión
            echo "Error de conexión: " . $e->getMessage();
            return null; // Opcionalmente, puedes manejar el error de otra manera o lanzar una excepción personalizada.
        }
    }