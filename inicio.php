<?php session_start();
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user']==1 ||  $_SESSION['priv_user']==2 ||  $_SESSION['priv_user']==3 ) {
    # code...
}else {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/404'");
}
include("assets/controler/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Inicio</title>
    <?php include("assets/common/header.php"); ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("assets/common/sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include("assets/common/topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h1 class='h3 mb-0 text-gray-800'>Bienvenido al Sistema <?php echo $_SESSION['name_user']; ?>
                            </h1>
                            <div id="reloj" style="text-align: left;"></div>

                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row" <?php if ($_SESSION['priv_user']!=3) { echo 'style="display: none;"'; }?>>

                        <!-- Ordenes Pendientes -->
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding-bottom: 1rem;"> 
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Ordenes Pendientes
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php 
                                                    $user = $_SESSION['name_user'];
                                                    $countPendientes = "SELECT COUNT(*) FROM tab_orden WHERE  status_orden = 'PxP' OR status_orden = 'PxA' OR status_orden = 'AUTORIZADA PxP' OR status_orden = 'EN TALLER'";
                                                    $rsPendientes = mysqli_query($con, $countPendientes) or die("Error de consulta");
                                                    $itemPendientes = mysqli_fetch_array($rsPendientes);
                                                    $pendientes = $itemPendientes[0];
                                                 ?>
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php echo $pendientes; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ordenes Completas -->
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding-bottom: 1rem;">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Ordenes Completas
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php 
                                                    $user = $_SESSION['name_user'];
                                                    $countCompletas = "SELECT COUNT(*) FROM tab_orden WHERE status_orden = 'ENTREGADA' OR status_orden = 'CANCELADA' OR status_orden = 'REPARADA'";
                                                    $rsCompletas = mysqli_query($con, $countCompletas) or die("Error de consulta");
                                                    $itemCompletas = mysqli_fetch_array($rsCompletas);
                                                    $completas=$itemCompletas[0];
                                                 ?>
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php echo $completas; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Ordenes Total -->
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding-bottom: 1rem;">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Total de Ordenes
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php 
                                                    $countTotal = "SELECT COUNT(*) FROM tab_orden WHERE  status_orden != 'ENTREGADA' OR status_orden != 'CANCELADA' OR status_orden != 'REPARADA'";
                                                    $rsTotal = mysqli_query($con, $countTotal) or die("Error de consulta");
                                                    $itemTotal = mysqli_fetch_array($rsTotal);
                                                    $total=$itemTotal[0];
                                                 ?>
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php echo $total; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>
                    
                    <div class="text-center" <?php if ($_SESSION['priv_user']==3) { echo 'style="display: none;"'; }?>>
                        <br>
                        <img class='img-fluid mx-auto d-block' src='../CentroServicio/assets/img/Logo/logo.webp' style='height: 300px; width: 300px; z-index: 0; opacity: 0.2;' onContextMenu='return false;' draggable='false'>
                        <br>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <br>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include_once("assets/common/foter.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</body>

</html>