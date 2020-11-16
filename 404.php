<?php include("assets/controler/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | 404</title>
    <?php include("assets/common/header.php"); ?>
</head>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <h4>Centro De Servicio</h4>
</nav>
<!-- End of Topbar -->

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

<footer class="sticky-footer bg-grey" style="position: fixed; left: 0; bottom: 0; width: 100%; text-align: center;">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>
                <h6><b>MAYOREO FERRETERO ATLAS SA DE CV</b></h6>
                GUADALAJARA JALISCO MEXICO CP 44450 <br>
                R.F.C: MFA030403T73 GUADALUPE VICTORIA #55<br>
                Copyright &copy; Centro de Servicio MFA | Intranet <?php echo date('Y'); ?>
            </span>
        </div>
    </div>
</footer>

</html>