<?php session_start(); include("assets/controler/conexion.php");
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user']==1 ||  $_SESSION['priv_user']==2) {
    # code...
}else {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/404'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Lista Clientes</title>
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
                        <script src="assets/js/demo/code.js"></script>
                        <div>
                            <h1 class='h3 mb-0 text-gray-800'>Cliente > Lista Clientes</h1>
                            <div id="reloj" style="text-align: left;">
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">



                        <!-- Card -->
                        <div class="col">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Cartera de Clientes</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm" id="dataTableCliente" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Dirección</th>
                                                    <th>Municipio</th>
                                                    <th>CP</th>
                                                    <th>Teléfono</th>
                                                    <th>RFC</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                        $queryCliente = "SELECT * FROM tab_cliente"; 
                                        $rsCliente = mysqli_query($con, $queryCliente) or die ("Error de consulta"); 
                                          while ($Cliente = mysqli_fetch_array($rsCliente)) {
                                            echo "
                                            <tr>
                                                    <td>".$Cliente['nom_cliente']."</td>
                                                    <td>".$Cliente['dir_cliente']."</td>
                                                    <td>".$Cliente['mun_cliente']."</td>
                                                    <td>".$Cliente['cp_cliente']."</td>
                                                    <td>".$Cliente['tel_cliente']."</td>
                                                    <td>".$Cliente['rfc_cliente']."</td>
                                                    <td><button type='button' class='btn btn-outline-light text-dark btn-sm BtnCliente' data-toggle='modal' data-target='#modalCliente'value=".$Cliente['id_cliente'].">
                                                    <i class='fas fa-pencil-alt'></i></button></td>
                                                </tr>
                                            "; } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- DataTales End -->
                                </div>
                            </div>
                            <br>
                        </div>

                    </div>

                    <!-- Content Row -->

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
    <?php if(isset($_GET['alert']) && $_GET['alert']==0){ ?>
    <script>
        Swal.fire(
                    "Mensaje de confirmación",
                    "Se actualizó el cliente",
                    "success"
                );
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