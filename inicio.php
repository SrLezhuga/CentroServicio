<?php session_start(); include("assets/controler/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Inicio</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Bienvenido al Sistema <?php echo $_SESSION['name_user'];?>
                            </h1>
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
                                                    $countPendientes = "SELECT COUNT(*) FROM tab_orden WHERE  tec_taller = '$user' AND (status_orden = 'PxP' OR status_orden = 'PxA' OR status_orden = 'AUTORIZADA PxP' OR status_orden = 'EN TALLER')";
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
                                                    $countCompletas = "SELECT COUNT(*) FROM tab_orden WHERE  tec_taller = '$user' AND (status_orden = 'ENTREGADA' OR status_orden = 'CANCELADA' OR status_orden = 'REPARADA')";
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

                    <!-- Formulario orden -->
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Tablero de Anuncios</h1>

                                    <?php 
                                                    $countEspera = "SELECT COUNT(*) FROM tab_orden WHERE  status_orden = 'EN ESPERA'";
                                                    $rsEspera = mysqli_query($con, $countEspera) or die("Error de consulta");
                                                    $itemEspera = mysqli_fetch_array($rsEspera);
                                                    $espera=$itemEspera[0];
                                                 ?>


                                    <div class="alert alert-warning text-center alert-dismissible"
                                        <?php if($espera != 0){ echo "style='display: block;'"; } ?>>
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <h5><strong><i class="fas fa-exclamation-triangle"></i> Aviso:
                                                <?php if($espera == 1){
                                                echo "</strong>Aun queda ".$espera." orden en espera, seleccionala en 
                                                <a href='listaOrden.php' class='alert-link'>lista de Ordenes</a>";
                                            }else{
                                                echo "</strong>Aun quedan ".$espera." ordenes en espera, selecciona una de la
                                                <a href='listaOrden.php' class='alert-link'>lista de Ordenes</a>";
                                            }
                                            ?>
                                        </h5>
                                    </div>

                                    <div class="alert alert-warning text-center alert-dismissible"
                                        <?php if($pendientes == 0){ echo "style='display: none;'"; } ?>>
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <h5><strong><i class="fas fa-exclamation-triangle"></i> Aviso:
                                            </strong>Tienes
                                            ordenes pendientes, selecciona una de la
                                            <a href="listaTaller.php" class="alert-link">lista de Pendientes</a>
                                        </h5>
                                    </div>
                                    <?php 
                                                    $user = $_SESSION['name_user'];
                                                    $countTaller = "SELECT COUNT(*) FROM tab_orden WHERE  tec_taller = '$user' AND (status_orden = 'ENTREGADA' OR status_orden = 'CANCELADA' OR status_orden = 'REPARADA')";
                                                    $rsTaller = mysqli_query($con, $countTaller) or die("Error de consulta");
                                                    $itemTaller = mysqli_fetch_array($rsTaller);
                                                    $taller=$itemTaller[0];
                                                 ?>


                                    <div class="alert alert-warning text-center alert-dismissible"
                                        <?php if($taller != 0){ echo "style='display: none;'"; } ?>>
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <h5><strong><i class="fas fa-exclamation-triangle"></i> Aviso: </strong>No
                                            tienes orden asignada, selecciona una de la
                                            <a href="listaOrden.php" class="alert-link">lista de Ordenes</a>
                                        </h5>
                                    </div>

                                    <div class="alert alert-warning text-center alert-dismissible"
                                        <?php if($taller > 0){ echo "style='display: block;'"; } ?>>
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <h5><strong><i class="fas fa-exclamation-triangle"></i> Aviso: </strong>
                                            Tienes orden en taller, ve a
                                            <a href="listaOrden.php" class="alert-link">lista de Pendientes</a> y
                                            terminarla!
                                        </h5>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <br>

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