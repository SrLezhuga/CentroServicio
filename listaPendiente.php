<?php session_start(); include("assets/controler/conexion.php");
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user']==1 ||  $_SESSION['priv_user']==2) {
    # code...
}else {
    header("Location: http://" . $base_url . "/CentroServicio/404'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Orden</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Orden > Órdenes Pendientes</h1>
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
                                    <h1 class='h3 text-gray-800'>Orden de Reparación</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm" id="dataTableOrden" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Cliente</th>
                                                    <th>Marca</th>
                                                    <th>Modelo</th>
                                                    <th>Fecha</th>
                                                    <th>Estado </th>
                                                    <th>Servicio</th>
                                                    <th>Técnico</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                        $queryOrden = "SELECT id_orden, id_cliente, marca_herramienta, mod_herramienta, fech_entrada, status_orden, tipo_servicio, tec_taller  FROM tab_orden WHERE status_orden = 'PxP' OR status_orden = 'PxA' OR status_orden = 'EN TALLER' OR status_orden = 'APxP' "; 
                                        $rsOrden = mysqli_query($con, $queryOrden) or die ("Error de consulta"); 
                                          while ($Orden = mysqli_fetch_array($rsOrden)) {
                                            
                                            $folio=$Orden['id_orden'];
                                            if(strlen($folio)==1){
                                                $folio="0000".$folio;
                                            }else if(strlen($folio)==2){
                                                $folio="000".$folio;
                                            }else if(strlen($folio)==3){
                                                $folio="00".$folio;
                                            }else if(strlen($folio)==4){
                                                $folio="0".$folio;
                                            }

                                            $queryCliente = "SELECT nom_cliente FROM tab_cliente WHERE id_cliente = $Orden[id_cliente]"; 
                                            $rsCliente = mysqli_query($con, $queryCliente) or die ("Error de consulta"); 
                                              while ($Cliente = mysqli_fetch_array($rsCliente)) {
                                                 
                                              
                                            echo "
                                                <tr>
                                                    <td>".$folio."</td>
                                                    <td>".$Cliente['nom_cliente']."</td>
                                                    <td>".$Orden['marca_herramienta']."</td>
                                                    <td>".$Orden['mod_herramienta']."</td>
                                                    <td>".$Orden['fech_entrada']."</td>
                                                    <td>".$Orden['status_orden']."</td>
                                                    <td>".$Orden['tipo_servicio']."</td>
                                                    <td>".$Orden['tec_taller']."</td>
                                                    <td>";
                                                    if ($_SESSION['priv_user']==1) {
                                                        echo "<button type='button' class='btn btn-outline-light text-dark btn-sm BtnOrden' data-toggle='modal' data-target='#modalOrden'value=".$Orden['id_orden'].">
                                                        <i class='far fa-eye'></i></button>
                                                        <button type='button' class='btn btn-outline-light text-dark btn-sm BtnLiberar' data-toggle='modal' data-target='#modalLiberar'value=".$Orden['id_orden'].">
                                                        <i class='fas fa-unlock-alt'></i></button>";
                                                    }else{
                                                        echo "<button type='button' class='btn btn-outline-light text-dark btn-sm BtnOrden' data-toggle='modal' data-target='#modalOrden'value=".$Orden['id_orden'].">
                                                        <i class='far fa-eye'></i></button>";
                                                    }
                                            echo "
                                                    </td>
                                                </tr>
                                            "; 


}
                                           }
                                             ?>
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
    <div class="modal fade" id="modalOrden">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Orden</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getOrden">
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
    <div class="modal fade" id="modalLiberar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Liberar</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getLiberar">
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
    // Modal tarjeta Orden

    $('.BtnOrden').on('click', function() {
        var id_button = $(this).val();
        $('.getOrden').load('./assets/controler/orden/getOrden.php?id=' + id_button, function() {
            $('#modalOrden').modal({
                show: true
            });
        });
    });

    // Modal tarjeta Orden

    $('.BtnLiberar').on('click', function() {
        var id_button = $(this).val();
        $('.getLiberar').load('./assets/controler/orden/getLiberar.php?id=' + id_button, function() {
            $('#modalLiberar').modal({
                show: true
            });
        });
    });
    </script>

    <!-- Alerts! -->
    <?php if(isset($_GET['alert']) && $_GET['alert']==0){ ?>
    <script>
        Swal.fire(
                    "Mensaje de confirmación",
                    "Se libero la orden",
                    "success"
                );
    </script>
    <?php } ?>

</body>

</html>