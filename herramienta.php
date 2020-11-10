<?php session_start(); include("assets/controler/conexion.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Prestamos</title>
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

                                    <form class="form" action="/action_page.php">

                                        <!-- form herramienta -->
                                        <h5><b>Datos de la herramienta</b></h5>
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
                                                    <input type="text" class="form-control"
                                                        placeholder="Código producto" name="forOrdFec" required>
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
                                                        placeholder="Descripción herramienta" name="forOrdFec" required>
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
                                                    <input type="text" class="form-control"
                                                        placeholder="Marca herramienta" name="forOrdHer" required>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">

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
                                                        placeholder="Observaciones herramienta" name="forOrdHer"
                                                        required>
                                                </div>
                                            </div>

                                            <!--Campo Cantidad -->
                                            <div class="col">
                                                <label>Cantidad:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-hashtag"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control"
                                                        placeholder="Cantidad en stock" max="50" min="1"
                                                        name="forOrdCar" required>
                                                </div>
                                            </div>

                                            <!--/. form Cantidad -->
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
                                    <h1 class='h3 text-gray-800'>Inventario</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table">
                                        <table class="table table-hover table-sm" id="dataTableHerramienta" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>Marca</th>
                                                    <th>Observaciones</th>
                                                    <th>Existencia</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>00001</td>
                                                    <td>Tiger Nixon</td>
                                                    <td>Dewalt</td>
                                                    <td>dcd776ac2-b3</td>
                                                    <td>2</td>
                                                    <td><button type="button" class="btn btn-outline-info btn-sm"><i
                                                                class="far fa-eye"></i> Ver</button></td>
                                                </tr>
                                                <tr>
                                                    <td>00002</td>
                                                    <td>Garrett Winters</td>
                                                    <td>Milwaukee</td>
                                                    <td>2697-22ct</td>
                                                    <td>3</td>
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