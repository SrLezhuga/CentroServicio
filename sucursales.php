<?php session_start();
include("assets/controler/conexion.php");
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user'] == 1 ||  $_SESSION['priv_user'] == 3) {
    # code...
} else {
    header("Location: http://" . $base_url . "/CentroServicio/404'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Sucursales</title>
    <?php include_once("assets/common/header.php"); ?>
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
                            <h1 class='h3 mb-0 text-gray-800'>Usuario > Sucursal</h1>
                            <div id="reloj" style="text-align: left;">
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Formulario orden -->
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Nueva Sucursal</h1>
                                    <br>

                                    <form class="form" id="cleanForm" action="assets/controler/sucursal/altaSucursal.php" method="POST">
                                        <!-- form Sucursal -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Datos de la Sucursal:</legend>
                                            <div class="row">
                                                <!--Campo Sucursal -->
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <label>Sucursal:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-tag"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Nombre sucursal" name="formSucNom" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                    <label>&nbsp;</label>
                                                    <button type="button" onClick=clean() class="btn btn-outline-secondary btn-block"><i class="fas fa-eraser"></i>
                                                        Borrar</button>
                                                </div>
                                                <br>
                                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-paper-plane"></i> Guardar</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <br>
                                        <!--/. form-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                    <br>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Formulario orden -->
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Lista Sucursales</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table">
                                        <table class="table table-hover table-sm" id="dataTableSucursales" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sucursales</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $querySucursal = "SELECT * FROM tab_sucursal";
                                                $rsSucursal = mysqli_query($con, $querySucursal) or die("Error de consulta");
                                                while ($Sucursal = mysqli_fetch_array($rsSucursal)) {

                                                    echo "<tr>
                                                                        <td>" . $Sucursal['nom_sucursal'] . "</td>
                                                                        <td> 
                                                                            <button type='button' class='btn btn-outline-light text-dark btn-sm BtnSucursalMod' data-toggle='modal' data-target='#modalservicioMod'value='" . $Sucursal['id_sucursal'] . "'>
                                                                            <i class='fas fa-eye'></i></button>
                                                                        </td>
                                                                    </tr>
                                                        ";
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>




                                    <!-- DataTales End -->
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Content Row -->

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

    <!-- The Modal -->
    <div class="modal fade" id="modalservicioMod">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Modificar sucusal</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getSucursal">
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

    <script type="text/javascript">
        // Modal tarjeta Mod
        $('.BtnSucursalMod').on('click', function() {
            var id_button = $(this).val();
            $('.getSucursal').load('./assets/controler/sucursal/getSucursal.php?id=' + id_button, function() {
                $('#modalservicioMod').modal({
                    show: true
                });
            });
        });
    </script>

    <!-- Alerts! -->
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 0) { ?>
        <script>
            Swal.fire(
                "Mensaje de confirmación",
                "Se registró la sucursal",
                "success"
            );
        </script>
    <?php }
    if (isset($_GET['alert']) && $_GET['alert'] == 1) { ?>
        <script>
            Swal.fire(
                "Mensaje de confirmación",
                "Se modificó la sucursal",
                "success"
            );
        </script>
    <?php } ?>
    <script>
        //Limpiar formularios
        function clean() {
            document.getElementById("cleanForm").reset();
            Swal.fire(
                "Mensaje de confirmación",
                "Formulario vacío",
                "success"
            );
        }
    </script>
</body>

</html>