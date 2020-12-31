<?php session_start();
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user']==1 ||  $_SESSION['priv_user']==2 ||  $_SESSION['priv_user']==3 ) {
    # code...
}else {
    header("Location: http://" . $base_url . "/CentroServicio/404'");
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
                            <h1 class='h3 mb-0 text-gray-800'>Bienvenido al sistema <?php echo $_SESSION['name_user']; ?>
                            </h1>
                            <div id="reloj" style="text-align: left;"></div>

                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row" <?php if ($_SESSION['priv_user']!=3) { echo 'style="display: none;"'; }?>>

                        <!-- Ordenes Pendientes -->
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" style="padding-bottom: 1rem;"> 
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Ordenes Pendientes
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                <script type="text/javascript">
                                                $(document).ready(function() {
                                                    function changeNumber() {
                                                        value = $('#pendiente').text();
                                                        value = $('#espera').text();
                                                        value = $('#completa').text();
                                                        value = $('#total').text();
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "./assets/controler/inicio/pendiente.php",
                                                            success: function(data) {
                                                                $('#pendiente').text(data);
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "./assets/controler/inicio/espera.php",
                                                            success: function(data) {
                                                                $('#espera').text(data);
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "./assets/controler/inicio/completa.php",
                                                            success: function(data) {
                                                                $('#completa').text(data);
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "./assets/controler/inicio/total.php",
                                                            success: function(data) {
                                                                $('#total').text(data);
                                                            }
                                                        });
                                                    }
                                                    setInterval(changeNumber, 3000);
                                                });
                                                </script>
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <span id="pendiente">0</span>
                                                    </div>
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

                        <!-- Ordenes en espera -->
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" style="padding-bottom: 1rem;"> 
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Ordenes en Espera
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <span id="espera">0</span>    
                                                    </div>
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
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" style="padding-bottom: 1rem;">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Ordenes Completas
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <span id="completa">0</span>
                                                    </div>
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
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" style="padding-bottom: 1rem;">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Total de Ordenes
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <span id="total">0</span>
                                                    </div>
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