<?php

    require 'funciones/conexionbd.php';
    require 'funciones/autenticar.php';
    require 'funciones/usuarios.php';
    require 'funciones/roles.php';
    session_start();
    include 'C:\xampp\htdocs\RC\Tienda\headerUser.php';
    $usuario = verUserPorId();
    $roles = listarRoles();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="pc, gamer, computadora, pc gamer">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Computers - Listado Usuarios</title>
    <link rel="icon" href="http://localhost/Rc/LOGO%20RC%20BLANCO%20SIN%20FONDO%20-%20copia.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/RC/Tienda/css/estilo-listadoUsuarios.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
</head>

<main class="mainClass">

<div class="cerrar__sesion--fondo"></div>
    <div class="cerrar__sesion--container">
        <span class="cerrar__sesion-close"><ion-icon name="close-outline"></ion-icon></span>
        <h1>USTED ESTA POR CERRAR SESION</h1>
        <p class="error__p">¿Desea cerrar sesion?</p>
        <div class="cerrar__sesion--container__sub">
            <b id="cerrarSesionSi"><a href="sesionCerrada.php">SI</a></b>
            <b id="cerrarSesionNo">NO</b>
        </div>
</div>

<form action="resultadoEliminarUsuario.php" method="post" class="container__todo__users">

<div class="container__todo__users__sub">
    <h1>USUARIOS</h1>

    <table class="container__todo__users__sub--table">
        <tr class="container__todo__users__sub--table-tr-1">
            <td>ID Usuario</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Email</td>
            <td>Rol</td>
            <td>Estado</td>
        </tr>
<?php
    if($usuario['usuActivo']){
        $estado = 'Activo';
    }else{
        $estado = 'Inactivo';
    }
?>
        <tr>
            <td><?= $usuario['idUsuario'] ?></td>
            <td><?= $usuario['usuNombre'] ?></td>
            <td><?= $usuario['usuApellido'] ?></td>
            <td><?= $usuario['usuEmail'] ?></td>
            <td><?= $usuario['rol'] ?></td>
            <td><?= $estado ?></td>
            <td id="eliminarUsuario">
                <div class="columnaModificarEliminarUser">
                    <input type="submit" value="Eliminar este usuario" name="eliminarUsuario">
                </div>
            </td>
        </tr>

    </table>
    <a href="listadoUsuarios.php" id="volverListado">Volver al listado de usuarios</a>
</div>
    <input type="hidden" name="idUsuario" value="<?= $usuario['idUsuario'] ?>">
    <input type="hidden" name="usuNombre" value="<?= $usuario['usuNombre'] ?>">
    <input type="hidden" name="usuApellido" value="<?= $usuario['usuApellido'] ?>">
    <input type="hidden" name="usuEmail" value="<?= $usuario['usuEmail'] ?>">
    <input type="hidden" name="usuRol" value="<?= $usuario['idRol'] ?>">
    <input type="hidden" name="usuActivo" value="<?= $usuario['usuActivo'] ?>">
</form>

</main>
<?php
    include 'C:\xampp\htdocs\RC\Tienda\footerUser.php'
?>