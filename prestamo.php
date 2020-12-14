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
    <title> Centro de Servicio MFA | Préstamos</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Préstamo > Nuevo Préstamo</h1>
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
                                    <h1 class='h3 text-gray-800'>Nuevo préstamo</h1>
                                    <br>

                                    <form class="form" id="cleanForm" action="assets/controler/prestamo/altaPrestamo.php" method="POST">

                                        <!-- form herramienta -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Datos del préstamo:</legend>
                                            <div class="row">

                                                <!--Campo Cliente -->
                                                <div class="col">
                                                    <label>Cliente:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <select name="forPreCli" class="custom-select" required>
                                                            <option value="" selected disabled>Seleccione Cliente</option>
                                                            <?php $listCli = "SELECT * FROM tab_cliente ORDER BY nom_cliente ASC";
                                                            $rsCli = mysqli_query($con, $listCli) or die("Error de consulta");
                                                            while ($itemCli = mysqli_fetch_array($rsCli)) {
                                                                echo "<option value='" . $itemCli[0] . "|" . $itemCli[1] . "'>" . $itemCli[1] . " | " . $itemCli[2] . " | " . $itemCli[5] . "</option>";
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--Campo Herramienta / Maquina -->
                                                <div class="col">
                                                    <label>Herramienta / Máquina:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-tools"></i>
                                                            </span>
                                                        </div>
                                                        <select name="forPreHer" class="custom-select" required>
                                                            <option value="" selected disabled>Seleccione Herramienta / Máquina</option>
                                                            <?php $listHer = "SELECT * FROM tab_herramienta WHERE status_herramienta = 'DISPONIBLE' ORDER BY desc_herramienta ASC";
                                                            $rsHer = mysqli_query($con, $listHer) or die("Error de consulta");
                                                            while ($itemHer = mysqli_fetch_array($rsHer)) {
                                                                echo "<option value='" . $itemHer[0] . "'>" . $itemHer[2] . " | " . $itemHer[1] . " | " . $itemHer[3] . "</option>";
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>


                                            <br>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="button" onClick=clean() class="btn btn-outline-secondary btn-block"><i class="fas fa-eraser"></i> Borrar</button>
                                                </div>
                                                <br>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-paper-plane"></i> Enviar</button>
                                                </div>
                                            </div>

                                            <!--/. form-->
                                        </fieldset>
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
                                    <h1 class='h3 text-gray-800'>Préstamos MFA</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table">
                                        <table class="table table-hover table-sm" id="dataTablePrestamo" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Responsable</th>
                                                    <th>Herramienta</th>
                                                    <th>Fecha</th>
                                                    <th>Status</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $queryprestamo = "SELECT * FROM tab_prestamo";
                                                $rsprestamo = mysqli_query($con, $queryprestamo) or die("Error de consulta");
                                                while ($prestamo = mysqli_fetch_array($rsprestamo)) {
                                                   
                                                    $folio=$prestamo['id_prestamo'];
                                                    if(strlen($folio)==1){
                                                        $folio="0000".$folio;
                                                    }else if(strlen($folio)==2){
                                                        $folio="000".$folio;
                                                    }else if(strlen($folio)==3){
                                                        $folio="00".$folio;
                                                    }else if(strlen($folio)==4){
                                                        $folio="0".$folio;
                                                    }

                                                    if ($prestamo['status_prestamo']=="CANCELADA") {
                                                        $color="<tr class='table-danger' >";
                                                        $disable = "disabled";
                                                    }elseif ($prestamo['status_prestamo']=="FINALIZADA") {
                                                        $color="<tr class='table-success' >";
                                                        $disable = "disabled";
                                                    }else {
                                                        $color="<tr>";
                                                        $disable = "";
                                                    }

                                                    echo "
                                                " . $color . "
                                                    <td>" . $folio . "</td>
                                                    <td>" . $prestamo['cliente_prestamo'] . "</td>
                                                    <td>" . $prestamo['desc_prestamo'] . "</td>
                                                    <td>" . $prestamo['marca_prestamo'] . "</td>
                                                    <td>" . $prestamo['status_prestamo'] . "</td>
                                                    <td>
                                                    <button type='button' class='btn btn-outline-light text-dark btn-sm BtnPrestamo' data-toggle='modal' data-target='#modalPrestamo 'value=" . $prestamo['id_prestamo'] . "|" . $prestamo['id_cliente'] . ">
                                                    <i class='far fa-eye'></i></button>
                                                    <button type='button' class='btn btn-outline-light text-dark btn-sm BtnFinalizar' data-toggle='modal' data-target='#modalFinalizar 'value=" . $prestamo['id_prestamo'] . " " . $disable . ">
                                                    <i class='fas fa-undo-alt'></i></button>
                                                    <button type='button' class='btn btn-outline-light text-dark btn-sm BtnCancelar' data-toggle='modal' data-target='#modalCancelar 'value=" . $prestamo['id_prestamo'] . " " . $disable . ">
                                                    <i class='fas fa-ban'></i></button>
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
    <div class="modal fade" id="modalPrestamo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Préstamo</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getPrestamo">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                        Cerrar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="modalFinalizar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Finalizar</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h3 class="text-center">Se finalizará el préstamo ¿Deseas continuar?</h3>
                    <div class="getFinalizar">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                        Cerrar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="modalCancelar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Cancelar</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h3 class="text-center">Se cancelará el préstamo ¿Deseas continuar?</h3>
                    <div class="getCancelar">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                        Cerrar</button>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
    // Modal tarjeta Cancelar
    $('.BtnCancelar').on('click', function() {
        var id_button = $(this).val();
        $('.getCancelar').load('./assets/controler/prestamo/getCancelar.php?id=' + id_button, function() {
            $('#modalCancelar').modal({
                show: true
            });
        });
    });
    </script>

    <script type="text/javascript">
    // Modal tarjeta Finalizar
    $('.BtnFinalizar').on('click', function() {
        var id_button = $(this).val();
        $('.getFinalizar').load('./assets/controler/prestamo/getFinalizar.php?id=' + id_button, function() {
            $('#modalFinalizar').modal({
                show: true
            });
        });
    });
    </script>

    <script type="text/javascript">
    // Modal tarjeta Prestamo
    $('.BtnPrestamo').on('click', function() {
        var id_button = $(this).val();
        $('.getPrestamo').load('./assets/controler/prestamo/getPrestamo.php?id=' + id_button, function() {
            $('#modalPrestamo').modal({
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
                    "Se registró el préstamo",
                    "success"
                );
        </script>
    <?php } ?>
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 1) { ?>
        <script>
            Swal.fire(
                    "Mensaje de confirmación",
                    "Se finalizó el préstamo",
                    "success"
                );
            toastr["info"]("La herramienta vuelve a estar disponible");
        </script>
    <?php } ?>
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 2) { ?>
        <script>
            Swal.fire(
                    "Mensaje de confirmación",
                    "Se canceló el préstamo",
                    "success"
                );
            toastr["info"]("La herramienta vuelve a estar disponible");
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