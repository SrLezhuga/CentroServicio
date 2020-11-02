<?php session_start(); include("assets/controler/conexion.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Orden</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Orden > Ordenes Completas</h1>
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
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                        $queryOrden = "SELECT id_orden, id_cliente, marca_herramienta, mod_herramienta, fech_entrada, status_orden, tipo_servicio  FROM tab_orden WHERE status_orden = 'CANCELADA' OR status_orden = 'REPARADA' OR status_orden = 'ENTREGADA' order by id_orden desc"; 
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
                                                    <td> 
                                                        <button type='button' class='btn btn-outline-light text-dark btn-sm BtnOrden' data-toggle='modal' data-target='#modalOrden'value=".$Orden['id_orden'].">
                                                        <i class='far fa-eye'></i></button>
                                                        <button type='button' class='btn btn-outline-light text-dark btn-sm BtnPDF' data-toggle='modal' data-target='#modalPDF'value=".$Orden['id_orden'].">
                                                        <i class='far fa-file-pdf'></i></button>
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
    <div class="modal fade" id="modalPDF">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Reporte</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class='form' action='assets/controler/reportes/reporteOrdenes.php' method='POST' target="_blank">

                        <!-- form cliente -->

                        <div class="getPDF">
                        </div>


                        <div class='row'>


                            <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                                <label>Pago:</label>
                                <div class='input-group '>

                                    <input type='checkbox' checked data-toggle='toggle' data-width='240' name='pago'
                                        data-onstyle='outline-danger' data-offstyle='outline-secondary'
                                        data-on="<i class='far fa-money-bill-alt'></i> Efectivo"
                                        data-off="<i class='far fa-credit-card'></i> Tarjeta">
                                </div>
                            </div>

                            <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                                <label>Factura:</label>
                                <div class='input-group '>

                                    <input type='checkbox' checked data-toggle='toggle' data-width='240' name='factura'
                                        data-onstyle='outline-danger' data-offstyle='outline-secondary'
                                        data-on="<i class='fas fa-check'></i> Cobrar IVA"
                                        data-off="<i class='fas fa-times'></i> No Cobrar">
                                </div>
                            </div>

                            <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                                <label>Correo:</label>
                                <div class='input-group '>

                                    <input type='checkbox' data-toggle='toggle' data-width='240' name='correo'
                                        data-onstyle='outline-danger' data-offstyle='outline-secondary'
                                        data-on="<i class='fas fa-check'></i> Enviar"
                                        data-off="<i class='fas fa-times'></i> No Enviar">
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="alert alert-info text-center">
                            <strong>Info!</strong> Solo se podra generar la nota una vez, revisa que los datos sean
                            correctos!
                        </div>


                        <hr>
                        <div class='row'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <button type='submit' class='btn btn-outline-danger btn-block'><i
                                        class='fas fa-file-pdf'></i>
                                    Generar PDF</button>
                            </div>
                        </div>

                        <!--/. form-->
                    </form>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                            Cerrar</button>
                    </div>

                </div>
            </div>
        </div>

        <script>
        // Display an info toast with no title
        toastr["success"]("Are you the six fingered man?")
        </script>

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
        // Modal tarjeta PDF

        $('.BtnPDF').on('click', function() {
            var id_button = $(this).val();
            $('.getPDF').load('./assets/controler/reportes/getPDF.php?id=' + id_button, function() {
                $('#modalPDF').modal({
                    show: true
                });
            });
        });
        </script>

</body>

</html>