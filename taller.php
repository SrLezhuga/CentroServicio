<?php session_start();
include("assets/controler/conexion.php");

if (isset($_SESSION['priv_user']) && $_SESSION['priv_user'] == 1 ||  $_SESSION['priv_user'] == 3) {
    # code...
} else {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/404'");
}

$ordenPendiente = "SELECT taller FROM tab_users WHERE code_user=" . $_SESSION['code_user'];
$rsordenPendiente = mysqli_query($con, $ordenPendiente) or die("Error de consulta");
$pendiente = mysqli_fetch_array($rsordenPendiente);
$id = $pendiente['taller']; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Taller</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Taller > Mesa de trabajo</h1>
                            <div id="reloj" style="text-align: left;"></div>
                        </div>
                    </div>


                    <!-- Content Row -->
                    <div class="row" <?php if ($id > 0) {
                                            echo "style='content-visibility: hidden;'";
                                        } ?>>
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Orden de Servicio:</h1>
                                    <br>
                                    <fieldset class='border p-2'>
                                        <legend class='w-auto'>Folio: N/A</legend>
                                        <div class="alert alert-warning text-center">
                                            <h5><strong><i class="fas fa-exclamation-triangle"></i> Aviso: </strong>No
                                                tienes orden asignada, selecciona una de la
                                                <a href="listaOrden" class="alert-link">lista de Órdenes</a> o
                                                <a href="listaTaller" class="alert-link">Órdenes Pendientes</a>
                                            </h5>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row" <?php if ($id == 0) {
                                            echo "style='visibility: hidden;'";
                                        } ?>>
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Orden de Servicio:</h1>
                                    <br>

                                    <div class="row">
                                        <div class="col-12">
                                            <fieldset class='border p-2'>
                                                <legend class='w-auto'>Folio:
                                                    <?php
                                                    $folio = $id;
                                                    if (strlen($folio) == 1) {
                                                        $folio = "0000" . $folio;
                                                    } else if (strlen($folio) == 2) {
                                                        $folio = "000" . $folio;
                                                    } else if (strlen($folio) == 3) {
                                                        $folio = "00" . $folio;
                                                    } else if (strlen($folio) == 4) {
                                                        $folio = "0" . $folio;
                                                    }
                                                    echo $folio;
                                                    ?>
                                                </legend>
                                                <div class="row">
                                                    <div class="col-xl-2 col-md-2 col-sm-12 col-lg-2">
                                                        <label>Ver Folio de la Orden:</label>
                                                        <button type="button" class="btn btn-outline-secondary btn-block BtnOrdenTaller" data-toggle="modal" data-target="#modalOrdenTaller" value=<?php echo $id; ?>><i class="fas fa-eye"></i>
                                                            Ver Orden</button>
                                                    </div>
                                                    <div class="col-xl-8 col-md-8 col-sm-12 col-lg-8">
                                                        <label>Estado de la Orden:</label>
                                                        <div class="input-group ">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-cog"></i>
                                                                </span>
                                                            </div>
                                                            <select name="formStatus" class="custom-select" id="StatusSelect" required>
                                                                <option value="Taller" selected>EN TALLER
                                                                </option>
                                                                <option value="PxP">PENDIENTE POR PARTES</option>
                                                                <option value="PxA">PENDIENTE POR AUTORIZAR</option>
                                                                <option value="APxP">AUTORIZADO / PxP
                                                                </option>
                                                                <option value="CANCELADA">CANCELADA</option>
                                                                <option value="REPARADA">REPARADA</option>
                                                            </select>
                                                            <input type="hidden" name="formId" required value=<?php echo $id; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-md-2 col-sm-12 col-lg-2">
                                                        <label>Actualizar Orden:</label>
                                                        <button type='button' class='btn btn-outline-danger btn-block BtnStatus' data-toggle='modal' data-target='#modalStatusOrden ' value='<?php echo $id; ?>'>
                                                            <i class='fas fa-sync-alt'>Actualizar</i></button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                            <fieldset class='border p-2'>
                                                <legend class='w-auto'>Agregar Refacciones</legend>
                                                <form class="form" action="assets/controler/refaccion/restRefaccion.php" method="POST">
                                                    <div class="row">
                                                        <div class="col-xl-10 col-md-10 col-sm-12 col-lg-10">
                                                            <label>Inventario de Refacciones:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-cog"></i>
                                                                    </span>
                                                                </div>
                                                                <select name="fromRefId" class="mi-selector custom-select" required>
                                                                <option value="" selected disabled>Seleccione refaccion</option>
                                                                    <?php $listRef = "SELECT * FROM tab_refaccion ORDER BY cant_refaccion ASC";
                                                                    $rsRef = mysqli_query($con, $listRef) or die("Error de consulta");
                                                                    while ($itemRef = mysqli_fetch_array($rsRef)) {
                                                                        if ($itemRef['cant_refaccion'] == 0) {
                                                                            echo "<option disabled>" . $itemRef['cod_refaccion'] . " | " . $itemRef['desc_refaccion'] . "</option>";
                                                                        } else {
                                                                            echo "<option value='" . $itemRef['id_refaccion'] . "'>" . $itemRef['cod_refaccion'] . " | " . $itemRef['desc_refaccion'] . " | " . $itemRef['marca_refaccion'] . " | $ " . $itemRef['costo_refaccion'] . ".00</option>";
                                                                        }
                                                                    } ?>
                                                                </select>
                                                                <input type="hidden" name="formOrdId" required value=<?php echo $id; ?>>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-2 col-md-2 col-sm-2 col-lg-2">
                                                            <label>Agregar:</label>
                                                            <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-cog"></i>
                                                                Refacción</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </fieldset>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                            <fieldset class='border p-2'>
                                                <legend class='w-auto'>Agregar Servicio</legend>
                                                <form class="form" action="assets/controler/servicio/restServicio.php" method="POST">
                                                    <div class="row">
                                                        <div class="col-xl-10 col-md-10 col-sm-12 col-lg-10">
                                                        <label>Lista de Servicios:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-concierge-bell"></i>
                                                                    </span>
                                                                </div>

                                                            <select name="fromSerId" class="mi-selector custom-select" required>
                                                            <option value="" selected disabled>Seleccione servicio</option>
                                                                <?php $listSer = "SELECT * FROM tab_servicio ORDER BY desc_servicio DESC";
                                                                $rsSer = mysqli_query($con, $listSer) or die("Error de consulta");
                                                                while ($itemSer = mysqli_fetch_array($rsSer)) {
                                                                    echo "<option value='" . $itemSer['cod_servicio'] . "'>" . $itemSer['cod_servicio'] . " | " . $itemSer['desc_servicio'] . " | $ " . $itemSer['costo_servicio'] . "</option>";
                                                                } ?>
                                                            </select>
                                                            <input type="hidden" name="formOrdId" required value=<?php echo $id; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-md-2 col-sm-2 col-lg-2">
                                                        <label>Agregar:</label>
                                                        <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-concierge-bell"></i>
                                                            Servicio</button>
                                                    </div>
                                        </div>
                                        </form>
                                        </fieldset>

                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">

                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Refacciones</legend>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-sm table-borderless" id="dataTableRefacciones" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Descripción</th>
                                                            <th>Marca</th>
                                                            <th>Costo</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $queryrefaccion = "SELECT R.cod_refaccion, R.desc_refaccion, R.marca_refaccion, R.costo_refaccion FROM tab_ordenrefaccion AS R
                                                                                   JOIN tab_orden AS O
                                                                                   ON R.id_orden = O.id_orden
                                                                                   WHERE O.id_orden =$id";
                                                        $rsrefaccion = mysqli_query($con, $queryrefaccion) or die("Error de consulta");
                                                        while ($refaccion = mysqli_fetch_array($rsrefaccion)) {
                                                            echo "
                                                                        <tr>
                                                                            <td>" . $refaccion['cod_refaccion'] . "</td>        
                                                                            <td>" . $refaccion['desc_refaccion'] . "</td>
                                                                            <td>" . $refaccion['marca_refaccion'] . "</td>
                                                                            <td>$ " . $refaccion['costo_refaccion'] . ".00</td>
                                                                            <td> 
                                                                                <button type='button' class='btn btn-outline-light text-dark btn-sm BtnRefaccion' data-toggle='modal' data-target='#modalDownRefaccion 'value='" . $id . "|" . $refaccion['cod_refaccion'] . "'>
                                                                                <i class='fas fa-trash-alt'></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    ";
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">

                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Servicios</legend>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-sm table-borderless" id="dataTableServicios" width="100%" cellspacing="0">
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
                                                        $queryServicio = "SELECT S.cod_servicio, S.desc_servicio, S.costo_servicio FROM tab_ordenservicio AS S
                                                                JOIN tab_orden AS O
                                                                ON S.id_orden = O.id_orden
                                                                WHERE O.id_orden =$id";
                                                        ($rsServicio = mysqli_query($con, $queryServicio)) or die("Error de consulta");
                                                        while ($servicio = mysqli_fetch_array($rsServicio)) {
                                                            echo "
                                                                <tr>
                                                                    <td>" . $servicio['cod_servicio'] . "</td>
                                                                    <td>" . $servicio['desc_servicio'] . "</td>
                                                                    <td>$ " . $servicio['costo_servicio'] . ".00</td>
                                                                    <td> 
                                                                        <button type='button' class='btn btn-outline-light text-dark btn-sm BtnServicio' data-toggle='modal' data-target='#modalDownServicio 'value='" . $id . "|" . $servicio['cod_servicio'] . "'>
                                                                        <i class='fas fa-trash-alt'></i></button>
                                                                    </td>
                                                                </tr>";
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-12">
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Observaciones</legend>
                                            <div class="row">
                                                <div class="col-10">
                                                    <form class="form" action="assets/controler/taller/modOrdenTaller.php" method="POST">
                                                        <div class="row">
                                                            <div class="col-xl-10 col-md-10 col-sm-12 col-lg-10">
                                                                <label>Diagnostico de la Herramienta:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-file-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <?php
                                                                    $queryDetalle = "SELECT detalle_servicio FROM tab_orden WHERE id_Orden=" . $id . ";";
                                                                    $rsDetalle = mysqli_query($con, $queryDetalle) or die("Error de consulta");
                                                                    $Detalle = mysqli_fetch_array($rsDetalle); ?>
                                                                    <textarea rows="2" class="form-control" placeholder="Diagnostico y observaciones de la herramienta" name="forObs" required><?php echo $Detalle[0]; ?></textarea>
                                                                    <input type="hidden" required name="formMun" value=<?php echo $id; ?>>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-2 col-md-2 col-sm-12 col-lg-2">
                                                                <label>Agregar Nota:</label>
                                                                <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-file-alt"></i> Agregar
                                                                    Observación
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-2">
                                                    <img class='img-fluid mx-auto d-block' src='../CentroServicio/assets/img/Logo/logo.webp' style='height: 100px; width: 100px; z-index: 0; opacity: 0.15;' onContextMenu='return false;' draggable='false'>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- /.container-fluid -->

            </div>
            <br>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include_once("assets/common/foter.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- The Modal -->
    <div class="modal fade" id="modalOrdenTaller">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Orden</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getOrdenTaller">
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
    <div class="modal fade" id="modalDownRefaccion">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Refacción</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getRefaccion">
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
    <div class="modal fade" id="modalDownServicio">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Servicio</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getServicio">
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
    <div class="modal fade" id="modalStatusOrden">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Actualizar Orden</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getStatus">
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

    <!-- Alerts! -->
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 0) { ?>
        <script>
            toastr["success"]("Observaciones actualizadas")
        </script>
    <?php }
    if (isset($_GET['alert']) && $_GET['alert'] == 1) { ?>
        <script>
            toastr["success"]("Estado de la orden actualizado!")
        </script>
    <?php }
    if (isset($_GET['alert']) && $_GET['alert'] == 2) { ?>
        <script>
            toastr["success"]("Se registro Servicio")
        </script>
    <?php }
    if (isset($_GET['alert']) && $_GET['alert'] == 3) { ?>
        <script>
            toastr["success"]("Se registro Refacción")
        </script>
    <?php } ?>

    <script type="text/javascript">
        // Modal tarjeta Orden
        $('.BtnOrdenTaller').on('click', function() {
            var id_button = $(this).val();
            $('.getOrdenTaller').load('./assets/controler/taller/getTaller.php?id=' + id_button, function() {
                $('#modalOrdenTaller').modal({
                    show: true
                });
            });
        });
        // Modal tarjeta Refaccion
        $('.BtnRefaccion').on('click', function() {
            var id_button = $(this).val();
            $('.getRefaccion').load('./assets/controler/refaccion/getOrdenRefaccion.php?id=' + id_button,
                function() {
                    $('#modalDownRefaccion').modal({
                        show: true
                    });
                });
        });
        // Modal tarjeta Servicio
        $('.BtnServicio').on('click', function() {
            var id_button = $(this).val();
            $('.getServicio').load('./assets/controler/servicio/getOrdenServicio.php?id=' + id_button,
                function() {
                    $('#modalDownServicio').modal({
                        show: true
                    });
                });
        });
        // Modal tarjeta Status
        $('.BtnStatus').on('click', function() {
            var status = $("#StatusSelect").val();
            var id_button = $(this).val();
            $('.getStatus').load('./assets/controler/taller/getOrdenStatus.php?id=' + id_button + '|' + status,
                function() {
                    $('#modalStatusOrden').modal({
                        show: true
                    });
                });
        });
    </script>
    <!-- Alerts!-->
    <script>
        function cleanServicio() {
            document.getElementById("cleanFormServicio").reset();
            toastr["success"]("Formulario vacío")
        }

        function cleanRefaccion() {
            document.getElementById("cleanFormRefaccion").reset();
            toastr["success"]("Formulario vacío")
        }
    </script>

    <script>
        jQuery(document).ready(function($) {
            $(document).ready(function() {
                $('.mi-selector').select2();
            });
        });
    </script>

</body>

</html>