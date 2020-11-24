<?php session_start();
include("assets/controler/conexion.php");
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user']==1 ) {
    # code...
}else {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/404'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Informe</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Informe > Resumen</h1>
                            <div id="reloj" style="text-align: left;"></div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Ordenes Pendientes -->
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" style="padding-bottom: 1rem;">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Órdenes Pendientes
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

                        <!-- Ordenes en espera -->
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" style="padding-bottom: 1rem;">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Órdenes en espera
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php
                                                    $user = $_SESSION['name_user'];
                                                    $countPendientes = "SELECT COUNT(*) FROM tab_orden WHERE  status_orden = 'EN ESPERA'";
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
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" style="padding-bottom: 1rem;">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Órdenes Completas
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php
                                                    $user = $_SESSION['name_user'];
                                                    $countCompletas = "SELECT COUNT(*) FROM tab_orden WHERE status_orden = 'ENTREGADA' OR status_orden = 'CANCELADA' OR status_orden = 'REPARADA'";
                                                    $rsCompletas = mysqli_query($con, $countCompletas) or die("Error de consulta");
                                                    $itemCompletas = mysqli_fetch_array($rsCompletas);
                                                    $completas = $itemCompletas[0];
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
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3" style="padding-bottom: 1rem;">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Total de Órdenes
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php
                                                    $countTotal = "SELECT COUNT(*) FROM tab_orden WHERE  status_orden != 'ENTREGADA' OR status_orden != 'CANCELADA' OR status_orden != 'REPARADA'";
                                                    $rsTotal = mysqli_query($con, $countTotal) or die("Error de consulta");
                                                    $itemTotal = mysqli_fetch_array($rsTotal);
                                                    $total = $itemTotal[0];
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
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class='h3 text-gray-800'>Órdenes por mes</h1>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <select class="custom-select" onchange="resultadosBarra(this.value);">
                                                    <?php
                                                    $date = date("Y");
                                                    $dateActual = $date + 6;
                                                    for ($i = 2020; $i < $dateActual; $i++) {
                                                        if ($i == $date) {
                                                            $select = "selected";
                                                        } else {
                                                            $select = "";
                                                        }
                                                        echo '<option value="' . $i . '" ' . $select . '>' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <canvas id="Barras" width="200" height="100"></canvas>

                                    <script>
                                        var fecha = new Date();
                                        var year = fecha.getFullYear();
                                        $(document).ready(resultadosBarra(year));

                                        function resultadosBarra(año) {
                                            $.ajax({
                                                type: "POST",
                                                url: "assets/controler/informe/datosBarras.php",
                                                data: "año=" + año,
                                                success: function(data) {
                                                    var valores = eval(data);

                                                    var m1 = valores[0];
                                                    var m2 = valores[1];
                                                    var m3 = valores[2];
                                                    var m4 = valores[3];
                                                    var m5 = valores[4];
                                                    var m6 = valores[5];
                                                    var m7 = valores[6];
                                                    var m8 = valores[7];
                                                    var m9 = valores[8];
                                                    var m10 = valores[9];
                                                    var m11 = valores[10];
                                                    var m12 = valores[11];

                                                    var DatosBarras = {
                                                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                                        datasets: [{
                                                            backgroundColor: 'rgba(231, 74, 59, 0.5)',
                                                            borderColor: 'rgba(255, 99, 132, 1)',
                                                            data: [m1, m2, m3, m4, m5, m6, m7, m8, m9, m10, m11, m12]
                                                        }]
                                                    }
                                                    var ctx = document.getElementById('Barras').getContext('2d');
                                                    var Barras = new Chart(ctx, {
                                                        type: 'bar',
                                                        data: DatosBarras,
                                                        options: {
                                                            legend: {
                                                                display: false
                                                            }
                                                        }
                                                    });
                                                }
                                            })
                                        }
                                    </script>


                                </div>
                            </div>
                            <br>
                        </div>

                        <!-- Card -->
                        <div class="col">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class='h3 text-gray-800'>Terminadas</h1>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <select class="custom-select" onchange="resultadosCirculo(this.value);">
                                                    <?php
                                                    $date = date("Y");
                                                    $dateActual = $date + 6;
                                                    for ($i = 2020; $i < $dateActual; $i++) {
                                                        if ($i == $date) {
                                                            $select = "selected";
                                                        } else {
                                                            $select = "";
                                                        }
                                                        echo '<option value="' . $i . '" ' . $select . '>' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <canvas id="Pie" width="200" height="100"></canvas>
                                    <script>
                                        var fecha = new Date();
                                        var year = fecha.getFullYear();
                                        $(document).ready(resultadosCirculo(year));

                                        function resultadosCirculo(año) {
                                            $.ajax({
                                                type: "POST",
                                                url: "assets/controler/informe/datosCirculo.php",
                                                data: "año=" + año,
                                                success: function(data) {
                                                    var valores = eval(data);

                                                    var can = valores[0];
                                                    var ter = valores[1];
                                                    var pen = valores[2];

                                                    var DatosCirculo = {
                                                        labels: ['Canceladas', 'Completas', 'Pendientes'],
                                                        datasets: [{
                                                            backgroundColor: [
                                                        'rgba(231, 74, 59, 0.4)',
                                                        'rgba(54, 162, 235, 0.4)',
                                                        'rgba(255, 206, 86, 0.4)'
                                                    ],
                                                    borderColor: [
                                                        'rgba(255, 99, 132, 1)',
                                                        'rgba(54, 162, 235, 1)',
                                                        'rgba(255, 206, 86, 1)'
                                                    ],
                                                            borderWidth: 1,
                                                            data: [can, ter, pen]
                                                        }]
                                                    }
                                                    var ctx = document.getElementById('Pie').getContext('2d');
                                                    var myChart = new Chart(ctx, {
                                                        type: 'pie',
                                                        data: DatosCirculo,
                                                        options: {
                                                            legend: {
                                                                display: true
                                                            }
                                                        }
                                                    });
                                                }
                                            })
                                        }
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