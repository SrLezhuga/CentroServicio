<?php session_start();
include("assets/controler/conexion.php");
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user'] == 1 ||  $_SESSION['priv_user'] == 2) {
    # code...
} else {
    header("Location: http://" . $base_url . "/CentroServicio/404'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Buscar</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Orden > Buscar orden</h1>
                            <div id="reloj" style="text-align: left;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Content Row -->
                        <div class="col-4">
                            <!-- Formulario orden -->
                            <div class="col-xl-12 col-md-12 mb-12">
                                <div class="card border-left-danger shadow ">
                                    <div class="card-body">
                                        <h1 class='h3 text-gray-800'>Buscar</h1>
                                        <br>
                                        <!-- form cliente -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Folio:</legend>
                                            <div class="row">
                                                <!--Campo Cliente -->
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12">
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fab fa-slack-hash"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control validar" placeholder="Folio Orden" id="demo" name="folio" pattern='[0-9]{5}' title="Folio: XXXXX" required>
                                                    </div>
                                                </div>
                                                <!--Campo Cliente -->
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12">
                                                    <br>
                                                    <button type="button" class="btn btn-outline-danger btn-block BtnFolio"><i class="fas fa-search"></i> Buscar</button>
                                                </div>
                                            </div>
                                            <br>
                                            <!--/. form-->
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>

                        <!-- Content Row -->
                        <div class="col-8" id="Datos" style="display: none;">
                            <!-- Formulario orden -->
                            <div class="col-xl-12 col-md-12 mb-12">
                                <div class="card border-left-danger shadow ">
                                    <div class="card-body">
                                        <div id="getDatos"></div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <!-- Content Row -->
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

    <script type="text/javascript">
        // Modal tarjeta Orden
        $(function() {
            $(".validar").keydown(function(event) {
                //alert(event.keyCode);
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !== 190 && event.keyCode !== 110 && event.keyCode !== 8 && event.keyCode !== 9) {
                    return false;
                }
            });
        });

        $('.BtnFolio').on('click', function() {

            $("#Datos").css("display", "block");

            var costo = document.getElementById("demo").value;

            if (costo == "") {
                return Swal.fire(
                    "Mensaje de advertencia",
                    "No se capturó folio",
                    "info"
                );
            }

            $.ajax({
                url: "./assets/controler/buscar/buscarFolio.php",
                type: "post",
                data: {
                    id: costo
                }
            }).done(function(resp) {
                $("#getDatos").html(resp);

            });

        });
    </script>


</body>

</html>