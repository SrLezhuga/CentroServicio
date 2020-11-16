<?php session_start();
include("assets/controler/conexion.php");
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user']==1 ||  $_SESSION['priv_user']==2) {
    # code...
}else {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/404'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Prestamos</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Prestamo > Alta herramienta</h1>
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
                                    <h1 class='h3 text-gray-800'>Nueva herramienta</h1>
                                    <br>

                                    <form class="form" id="cleanForm" action="assets/controler/herramienta/altaHerramienta.php" method="POST">

                                        <!-- form herramienta -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Datos de la herramienta:</legend>
                                            <div class="row">

                                                <!--Campo Código -->
                                                <div class="col">
                                                    <label>Código:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-barcode"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Código producto" name="forHerCod" required>
                                                    </div>
                                                </div>

                                                <!--Campo Descripción -->
                                                <div class="col">
                                                    <label>Descripción:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-tasks"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Descripción herramienta" name="forHerDes" required>
                                                    </div>
                                                </div>

                                                <!--Campo Marca -->
                                                <div class="col">
                                                    <label>Marca:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-tag"></i>
                                                            </span>
                                                        </div>
                                                        <select name="forHerMar" class="custom-select" required>
                                                            <option value="" selected disabled>Seleccione marca</option>
                                                            <option value="GENERICA">GENERICA</option>
                                                            <?php $listCli = "SELECT * FROM tab_marca ORDER BY marca_herramienta ASC";
                                                            $rsCli = mysqli_query($con, $listCli) or die("Error de consulta");
                                                            while ($itemCli = mysqli_fetch_array($rsCli)) {
                                                                echo "<option value='" . $itemCli[0] . "'>" . $itemCli[0] . "</option>";
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
                                    <h1 class='h3 text-gray-800'>Inventario</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table">
                                        <table class="table table-hover table-sm" id="dataTableHerramienta" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>Marca</th>
                                                    <th>Status</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $queryHerramienta = "SELECT * FROM tab_herramienta";
                                                $rsHerramienta = mysqli_query($con, $queryHerramienta) or die("Error de consulta");
                                                while ($Herramienta = mysqli_fetch_array($rsHerramienta)) {
                                                    echo "
                                            <tr>
                                                    <td>" . $Herramienta['cod_herramienta'] . "</td>
                                                    <td>" . $Herramienta['desc_herramienta'] . "</td>
                                                    <td>" . $Herramienta['marca_herramienta'] . "</td>
                                                    <td>" . $Herramienta['status_herramienta'] . "</td>
                                                    <td>
                                                    <button type='button' class='btn btn-outline-light text-dark btn-sm BtnHerramienta' data-toggle='modal' data-target='#modalHerramienta'value=" . $Herramienta['Id_herramienta'] . ">
                                                    <i class='fas fa-pencil-alt'></i></button>
                                                    <button type='button' class='btn btn-outline-light text-dark btn-sm BtnHerramienta' data-toggle='modal' data-target='#modalHerramienta'value=" . $Herramienta['Id_herramienta'] . ">
                                                    <i class='fas fa-trash-alt'></i></i></button>
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
     <div class="modal fade" id="modalHerramienta">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Herramienta</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getHerramienta">
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
    // Modal tarjeta Herramienta
    $('.BtnHerramienta').on('click', function() {
        var id_button = $(this).val();
        $('.getHerramienta').load('./assets/controler/herramienta/getHerramienta.php?id=' + id_button, function() {
            $('#modalHerramienta').modal({
                show: true
            });
        });
    });
    </script>

    <!-- Alerts! -->
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 0) { ?>
        <script>
            toastr["success"]("Se registro la herramienta")
        </script>
    <?php } ?>
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 1) { ?>
        <script>
            toastr["success"]("Se actualizo la herramienta")
        </script>
    <?php } ?>

    <script>
        //Limpiar formularios
        function clean() {
            document.getElementById("cleanForm").reset();
            toastr["success"]("Formulario vacío")
        }
    </script>
</body>

</html>