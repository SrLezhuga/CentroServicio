<?php session_start(); include("assets/controler/conexion.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Servicios</title>
    <?php  include_once("assets/common/header.php");?>
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
                            <h1 class='h3 mb-0 text-gray-800'>Refacciones > Alta Servicios</h1>
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
                                    <h1 class='h3 text-gray-800'>Nuevo Servicio</h1>
                                    <br>

                                    <form class="form" id="cleanForm"
                                        action="assets/controler/servicio/altaServicio.php" method="POST">

                                        <!-- form Servicio -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Datos del servicio</legend>
                                            <div class="row">

                                                <!--Campo Código -->
                                                <div class="col-2">
                                                    <label>Código:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-barcode"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Código servicio" name="forSerCod" required>
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
                                                        <input type="text" class="form-control"
                                                            placeholder="Descripción servicio" name="forSerDes"
                                                            required>
                                                    </div>
                                                </div>
                                                <!--Campo Costo -->
                                                <div class="col-2">
                                                    <label>Costo:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-dollar-sign"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Costo servicio" name="forSerCos" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <br>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="button" onClick=clean()
                                                        class="btn btn-outline-secondary btn-block"><i
                                                            class="fas fa-eraser"></i> Borrar</button>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                            class="fas fa-paper-plane"></i> Enviar</button>
                                                </div>
                                            </div>
                                        </fieldset>
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
                                    <h1 class='h3 text-gray-800'>Lista Servicios</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table">
                                        <table class="table table-hover table-sm" id="dataTableHerramienta" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>Descripción</th>
                                                    <th>Costo</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                        $queryservicio = "SELECT * FROM tab_servicio"; 
                                                        $rsservicio = mysqli_query($con, $queryservicio) or die ("Error de consulta"); 
                                                            while ($servicio = mysqli_fetch_array($rsservicio)) {

                                                                    echo "<tr>
                                                                        <td>".$servicio[cod_servicio]."</td>        
                                                                        <td>".$servicio[desc_servicio]."</td>
                                                                        <td>$ ".$servicio[costo_servicio].".00</td>
                                                                        <td> 
                                                                            <button type='button' class='btn btn-outline-light text-dark btn-sm BtnservicioMod' data-toggle='modal' data-target='#modalservicioMod'value='".$servicio[id_servicio]."'>
                                                                            <i class='fas fa-eye'></i></button>
                                                                        </td>
                                                                    </tr>
                                                        "; } ?>
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

    <!-- The Modal -->
    <div class="modal fade" id="modalservicioMod">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Modificar servicio</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getservicio">
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
    $('.BtnservicioMod').on('click', function() {
        var id_button = $(this).val();
        $('.getservicio').load('./assets/controler/servicio/getServicio.php?id=' + id_button, function() {
            $('#modalservicioMod').modal({
                show: true
            });
        });
    });
    </script>

    <!-- Alerts! -->
    <?php if(isset($_GET['alert']) && $_GET['alert']==0){ ?>
    <script>
    toastr["success"]("Se registro el servicio")
    </script>
    <?php } if(isset($_GET['alert']) && $_GET['alert']==1){ ?>
    <script>
    toastr["success"]("Se modifico el servicio")
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