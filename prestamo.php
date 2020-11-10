<?php session_start(); include("assets/controler/conexion.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Prestamos</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Prestamo > Nuevo Prestamo</h1>
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
                                    <h1 class='h3 text-gray-800'>Nuevo prestamo</h1>
                                    <br>

                                    <form class="form" action="/action_page.php">

                                        <!-- form herramienta -->
                                        <h5><b>Datos del prestamo</b></h5>
                                        <div class="row">

                                            <!--Campo Responsable -->
                                            <div class="col">
                                                <label>Responsable:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nombre responsable" name="forOrdFec" required>
                                                </div>
                                            </div>

                                            <!--Campo Observaciones -->
                                            <div class="col">
                                                <label>Observaciones:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        placeholder="Descripción herramienta" name="forOrdFec" required>
                                                </div>
                                            </div>

                                        </div>


                                        <br>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <button type="button" class="btn btn-outline-secondary btn-block"><i
                                                        class="fas fa-times"></i> Cancelar</button>
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                        class="fas fa-paper-plane"></i> Enviar</button>
                                            </div>
                                        </div>

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
                                    <h1 class='h3 text-gray-800'>Prestamos MFA</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table">
                                        <table class="table table-hover" id="dataTablePrestamo" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Responsable</th>
                                                    <th>Fecha</th>
                                                    <th>Observaciones</th>
                                                    <th>Status</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>00001</td>
                                                    <td>Tiger Nixon</td>
                                                    <td>2020-09-25</td>
                                                    <td>Requiere prestamo</td>
                                                    <td>Pendiente</td>
                                                    <td><button type="button" class="btn btn-outline-info btn-sm"><i
                                                                class="far fa-eye"></i> Ver</button></td>
                                                </tr>
                                                <tr>
                                                    <td>00002</td>
                                                    <td>Garrett Winters</td>
                                                    <td>2020-09-25</td>
                                                    <td>Requiere prestamo</td>
                                                    <td>Pendiente</td>
                                                    <td><button type="button" class="btn btn-outline-info btn-sm"><i
                                                                class="far fa-eye"></i> Ver</button></td>
                                                </tr>
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

</body>

</html>