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

                        <!-- Formulario orden -->
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Reporte de ordenes</h1>
                                    <br>

                                    <form class="form" id="cleanForm" action="assets/controler/reportes/reporteLista.php" method="POST" target="_blank">

                                        <!-- form herramienta -->
                                        <h5><b>Datos del reporte</b></h5>
                                        <div class="row">

                                            <!--Campo Marca -->
                                            <div class="col">
                                                <label>Estado orden:</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tag"></i>
                                                        </span>
                                                    </div>
                                                    <select name="fromRepList" class="custom-select" required>
                                                        <option value="" selected disabled>Seleccione un status</option>
                                                        <option value="Todos">Todos</option>
                                                        <option value="Capturada">Capturada</option>
                                                        <option value="Pendiente revision">Pendiente revision</option>
                                                        <option value="Pendiente partes">Pendiente partes</option>
                                                        <option value="Pendiente reparación">Pendiente reparación
                                                        </option>
                                                        <option value="Reparada">Reparada</option>
                                                        <option value="Herramienta entregada">Herramienta entregada
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!--Campo Código -->
                                            <div class="col">
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

                                            <!--Campo Descripción -->
                                            <div class="col">
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

                                            <!--/. form Cantidad -->
                                        </div>


                                        <br>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <button type="button" onClick=clean()
                                                    class="btn btn-outline-secondary btn-block"><i
                                                        class="fas fa-eraser"></i> Borrar</button>
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
                            <br>
                        </div>

                    </div>

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
    <script>
    //Limpiar formularios
    function clean() {
        document.getElementById("cleanForm").reset();
        toastr["success"]("Formulario vacío")
    }
    </script>
</body>

</html>