<?php session_start();
include("assets/controler/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | 404</title>
    <?php include("assets/common/header.php"); ?>
</head>

<body id="page-top">

    <!-- 404 Error Text -->
    <div class="text-center">
        <br>
        <img class='img-fluid mx-auto d-block' src='../CentroServicio/assets/img/Logo/logo.webp' style='height: 160px; width: 160px; z-index: 0; opacity: 1;' onContextMenu='return false;' draggable='false'>
        <br>
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Página no encontrada</p>
        <p class="text-gray-500 mb-0">Parece que encontraste un fallo en la matriz...</p>
        <a href="assets/controler/lockout.php">&larr; Volver al inicio</a>
    </div>

</body>

</html>