<?php session_start();  include("assets/controler/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Reportes</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Reportes > Generar Reportes</h1>
                            <div id="reloj" style="text-align: left;"></div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Reporte Orden -->
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Ordenes</h1>
                                    <br>
                                    <form class="form" id="cleanForm"
                                        action="assets/controler/reportes/reporteLista.php" method="POST"
                                        target="_blank">
                                        <h5><b>Datos del reporte</b></h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Estado orden:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-stethoscope"></i>
                                                        </span>
                                                    </div>
                                                    <select name="fromRepList" class="custom-select" required>
                                                        <option value="Todos">Todos</option>
                                                        <option value="Reparada">Reparada</option>
                                                        <option value="Cancelada">Cancelada</option>
                                                        <option value="En espera">Pendiente revision</option>
                                                        <option value="PxP">Pendiente partes</option>
                                                        <option value="PxA">Pendiente aprobar</option>
                                                        <option value="Entregada">Herramienta entregada</option>
                                                        <option value="APxP">Aprovada pendiente partes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label>Fecha inicial:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control"
                                                        placeholder="Código producto" name="forFecIni" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label>Fecha final:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control"
                                                        placeholder="Descripción herramienta" name="forFecFin" required>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                class="fas fa-file-pdf"></i> Generar Reporte</button>
                                    </form>
                                </div>
                            </div>
                            <br>
                        </div>

                        <br>

                        <!-- Reporte Mostrador -->
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Mostrador</h1>
                                    <br>
                                    <form class="form" id="cleanForm"
                                        action="assets/controler/reportes/reporteMostrador.php" method="POST"
                                        target="_blank">
                                        <h5><b>Datos del reporte</b></h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Tipo de pago:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-stethoscope"></i>
                                                        </span>
                                                    </div>
                                                    <select name="fromRepList" class="custom-select" required>
                                                        <option value="Todas">Efectivo y Tarjeta</option>
                                                        <option value="EFECTIVO">Solo Efectivo</option>
                                                        <option value="TARJETA">Solo Tarjeta</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label>Fecha inicial:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control"
                                                        placeholder="Código producto" name="forFecIni" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label>Fecha final:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control"
                                                        placeholder="Descripción herramienta" name="forFecFin" required>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                class="fas fa-file-pdf"></i> Generar Reporte</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>

                         <!-- Reporte Prestamo -->
                         <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Prestamos</h1>
                                    <br>
                                    <form class="form" id="cleanForm"
                                        action="assets/controler/reportes/reportePrestamos.php" method="POST"
                                        target="_blank">
                                        <h5><b>Datos del reporte</b></h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Estado del prestamo:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-stethoscope"></i>
                                                        </span>
                                                    </div>
                                                    <select name="fromRepList" class="custom-select" required>
                                                        <option value="Todas">Todos</option>
                                                        <option value="1">Solo Entegrados</option>
                                                        <option value="2">Solo Pendientes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label>Fecha inicial:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control"
                                                        placeholder="Código producto" name="forFecIni" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label>Fecha final:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control"
                                                        placeholder="Descripción herramienta" name="forFecFin" required>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                class="fas fa-file-pdf"></i> Generar Reporte</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>

                        <!-- Reporte Clientes -->
                        <div class="col-xl-3 col-md-3 mb-3">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Clientes</h1>
                                    <br>
                                    <form class="form" id="cleanForm"
                                        action="assets/controler/reportes/reporteCliente.php" method="POST"
                                        target="_blank">
                                        <h5><b>Datos del reporte</b></h5>
                                        <label>Orden de lista:</label>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-stethoscope"></i>
                                                </span>
                                            </div>
                                            <select name="fromOrdenList" class="custom-select" required>
                                                <option value="ASC">Orden A - Z</option>
                                                <option value="DESc">Orden Z - A</option>
                                            </select>
                                        </div>
                                        <br>
                                        <hr>
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                class="fas fa-file-pdf"></i> Generar Reporte</button>
                                    </form>
                                </div>
                            </div>
                            <br>
                        </div>

                        <br>

                        <!-- Formulario orden -->
                        <div class="col-xl-3 col-md-3 mb-3">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Usuarios</h1>
                                    <br>
                                    <form class="form" id="cleanForm"
                                        action="assets/controler/reportes/reporteUsuario.php" method="POST"
                                        target="_blank">
                                        <h5><b>Datos del reporte</b></h5>
                                        <div class="row">
                                            <div class="col">
                                                <label>Funciones en el sistema:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-stethoscope"></i>
                                                        </span>
                                                    </div>
                                                    <select name="RepUsuario" class="custom-select" required>
                                                        <option value="Todos">Todos</option>
                                                        <option value="1">Administradores</option>
                                                        <option value="2">Vendedores</option>
                                                        <option value="3">Técnicos</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                class="fas fa-file-pdf"></i> Generar Reporte</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>


                        <!-- Formulario orden -->
                        <div class="col-xl-3 col-md-3 mb-3">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Refacciones</h1>
                                    <br>
                                    <form class="form" id="cleanForm"
                                        action="assets/controler/reportes/reporteRefacciones.php" method="POST"
                                        target="_blank">
                                        <h5><b>Datos del reporte</b></h5>
                                        <div class="row">
                                            <div class="col">
                                                <label>Estado del inventario:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-stethoscope"></i>
                                                        </span>
                                                    </div>
                                                    <select name="RepInventario" class="custom-select" required>
                                                        <option value="Todos">Todos</option>
                                                        <option value="Reparada">Con Stock</option>
                                                        <option value="Cancelada">Sin Stock</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                class="fas fa-file-pdf"></i> Generar Reporte</button>
                                    </form>
                                </div>
                            </div>
                            <br>
                        </div>

                        <br>

                        <!-- Formulario orden -->
                        <div class="col-xl-3 col-md-3 mb-3">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Servicios</h1>
                                    <br>
                                    <form class="form" id="cleanForm"
                                        action="assets/controler/reportes/reporteServicios.php" method="POST"
                                        target="_blank">
                                        <h5><b>Datos del reporte</b></h5>
                                        <div class="row">
                                            <div class="col">
                                                <label>Estado orden:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-stethoscope"></i>
                                                        </span>
                                                    </div>
                                                    <select name="RepServicio" class="custom-select" required>
                                                        <option value="Todos">Todos</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                class="fas fa-file-pdf"></i> Generar Reporte</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>




                    </div>
                    <br>
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

    <!-- Alerts! -->
    <?php if(isset($_GET['alert']) && $_GET['alert']==0){ ?>
    <script>
    toastr["success"]("Se registro el Cliente")
    </script>
    <?php } ?>

</body>

</html>