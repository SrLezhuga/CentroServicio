<?php session_start(); include("assets/controler/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Resumen</title>
    <?php  include("assets/common/header.php");?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  include("assets/common/sidebar.php");?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php  include("assets/common/topbar.php");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h1 class='h3 mb-0 text-gray-800'>Bienvenido al Sistema</h1>
                            <div id="reloj" style="text-align: left;"></div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

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
                                                    <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">
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
                                                    <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">
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
                                                    <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">
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

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Card -->
                        <div class="col">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Ordenes Pendientes</h1>
                                    <br>
                                    <canvas id="Barras" width="200" height="100"></canvas>

                                    <script>
                                    var ctx = document.getElementById('Barras').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'horizontalBar',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                    </script>


                                </div>
                            </div>
                            <br>
                        </div>

                        <!-- Card -->
                        <div class="col">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Ordenes Terminadas</h1>
                                    <br>
                                    <canvas id="Pie" width="200" height="100"></canvas>
                                    <script>
                                    var ctx = document.getElementById('Pie').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 0
                                            }]
                                        },

                                    });
                                    </script>


                                </div>
                            </div>
                            <br>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php  include_once("assets/common/foter.php");?>
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