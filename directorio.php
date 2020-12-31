<?php session_start();
include("assets/controler/conexion.php");
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user'] == 1) {
    # code...
} else {
    header("Location: http://" . $base_url . "/CentroServicio/404'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Directorio</title>
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
                        <script src="assets/js/demo/code.js"></script>
                        <div>
                            <h1 class='h3 mb-0 text-gray-800'>Usuario > Directorio de Empleados</h1>
                            <div id="reloj" style="text-align: left;">
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                    <?php
                        $queryUsuario = "SELECT * FROM tab_users";
                        $rsUsuario = mysqli_query($con, $queryUsuario) or die("Error de consulta");
                        while ($Usuario = mysqli_fetch_array($rsUsuario)) {

                            if ($Usuario['priv_user'] == 1) {
                                $privilegios = "Administrador";
                            } elseif ($Usuario['priv_user'] == 2) {
                                $privilegios = "Vendedor/Mostrador";
                            } else {
                                $privilegios = "Taller/Técnico";
                            }

                        echo'
                        <!-- Team member -->
                        <div class="col-4">
                            <div class="image-flip">
                                <div class="mainflip flip-0">
                                    <div class="frontside">
                                        <div class="card border-left-danger shadow" style="min-height: 175px;">
                                            <div class="card-body text-center">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <p><img class=" img-fluid" src="http://192.168.0.98/CentroServicio/assets/img/Avatar/'.$Usuario['conf_user'].'.png" alt="card image"></p>
                                                    </div>
                                                    <div class="col">
                                                        <h4 class="card-title" style="font-size: 1.2rem;">'.$Usuario['name_user'].'</h4>
                                                    </div>
                                                </div>
                                                <p class="card-text">'.$privilegios.'</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="backside">
                                        <div class="card border-left-danger" style="min-height: 175px;">
                                            <div class="card-body text-center mt-4">
                                                <h4 class="card-title">'.$Usuario['sucursal_user'].'</h4>
                                                <p class="card-text">Teléfono:<br>Correo:</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./Team member -->
                        ';
                        }
                    ?>

                    <!-- Content Row -->

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

    <!-- The Modal -->
    <div class="modal fade" id="modalCliente">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Cliente</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getCliente">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                        Cancelar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Alerts! -->
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 0) { ?>
        <script>
            toastr["success"]("Se actualizó el cliente")
        </script>
    <?php } ?>

    <script type="text/javascript">
        // Modal tarjeta cliente
        $('.BtnCliente').on('click', function() {
            var id_button = $(this).val();
            $('.getCliente').load('./assets/controler/cliente/getCliente.php?id=' + id_button, function() {
                $('#modalCliente').modal({
                    show: true
                });
            });
        });
    </script>

</body>

</html>