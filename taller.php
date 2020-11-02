<?php session_start();
include("assets/controler/conexion.php");
$ordenPendiente = "SELECT taller FROM tab_users WHERE code_user=" . $_SESSION['code_user'];
$rsordenPendiente = mysqli_query($con, $ordenPendiente) or die("Error de consulta");
$pendiente = mysqli_fetch_array($rsordenPendiente);
$id = $pendiente['taller']; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Taller</title>
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
                                                <a href="listaOrden.php" class="alert-link">lista de Ordenes</a> ;D
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
                                                                    <option value="Taller" selected >EN TALLER
                                                                    </option>
                                                                    <option value="PxP">PENDIENTE POR PARTES</option>
                                                                    <option value="PxA">PENDIENTE POR AUTORIZAR</option>
                                                                    <option value="APxP">AUTORIZADO / PxP
                                                                    </option>
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

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                                            <fieldset class='border p-2'>
                                                <legend class='w-auto'>Agregar Refacciones</legend>
                                                <form class="form" action="assets/controler/refaccion/restRefaccion.php" method="POST">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-md-3 col-sm-12 col-lg-3">
                                                            <label>Nueva Refacción:</label>
                                                            <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#modalRefaccion"><i class="fas fa-plus"></i><i class="fas fa-cog"></i></button>
                                                        </div>
                                                        <div class="col-xl-9 col-md-9 col-sm-12 col-lg-9">
                                                            <label>Inventario de Refacciones:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-cog"></i>
                                                                    </span>
                                                                </div>
                                                                <select name="fromRefId" class="custom-select" required>
                                                                    <option value="" selected disabled>Seleccione
                                                                        refacción
                                                                    </option>
                                                                    <?php $listRef = "SELECT * FROM tab_refaccion WHERE cant_refaccion > 0 ORDER BY marca_refaccion ASC";
                                                                    $rsRef = mysqli_query($con, $listRef) or die("Error de consulta");
                                                                    while ($itemRef = mysqli_fetch_array($rsRef)) {
                                                                        echo "<option value='" . $itemRef['id_refaccion'] . "'>" . $itemRef['cod_refaccion'] . " | " . $itemRef['desc_refaccion'] . " | " . $itemRef['marca_refaccion'] . " | $ " . $itemRef['costo_refaccion'] . ".00</option>";
                                                                    } ?>
                                                                </select>
                                                                <input type="hidden" name="formOrdId" required value=<?php echo $id; ?>>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12">
                                                            <label>Agregar Refacción:</label>
                                                            <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-cog"></i>
                                                                Agregar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </fieldset>
                                        </div>


                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                                            <fieldset class='border p-2'>
                                                <legend class='w-auto'>Agregar Servicio</legend>
                                                <form class="form" action="assets/controler/servicio/restServicio.php" method="POST">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-md-3 col-sm-12 col-lg-3">
                                                            <label>Nuevo Servicio:</label>
                                                            <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#modalServicio"><i class="fas fa-plus"></i><i class="fas fa-concierge-bell"></i></button>
                                                        </div>
                                                        <div class="col-xl-9 col-md-9 col-sm-12 col-lg-9">
                                                            <label>Lista de Servicios:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-cog"></i>
                                                                    </span>
                                                                </div>
                                                                <select name="fromSerId" class="custom-select" required>
                                                                    <option value="" selected disabled>Seleccione
                                                                        servicio
                                                                    </option>
                                                                    <?php $listSer = "SELECT * FROM tab_servicio ORDER BY desc_servicio ASC";
                                                                    $rsSer = mysqli_query($con, $listSer) or die("Error de consulta");
                                                                    while ($itemSer = mysqli_fetch_array($rsSer)) {
                                                                        echo "<option value='" . $itemSer['cod_servicio'] . "'>" . $itemSer['cod_servicio'] . " | " . $itemSer['desc_servicio'] . " | $ " . $itemSer['costo_servicio'] . ".00</option>";
                                                                    } ?>
                                                                </select>
                                                                <input type="hidden" name="formOrdId" required value=<?php echo $id; ?>>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12">
                                                            <label>Agregar Servicio:</label>
                                                            <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-cog"></i>
                                                                Agregar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </fieldset>

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">

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

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">

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
                                                                        <textarea rows="3" class="form-control" placeholder="Diagnostico y observaciones de la herramienta" name="forObs" required><?php echo $Detalle[0]; ?></textarea>
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
                                                        <img class='img-fluid mx-auto d-block' src='../CentroServicio/assets/img/Logo/logo.webp' style='height: 135px;    width: 135px; z-index: 0; opacity: 0.15;' onContextMenu='return false;' draggable='false'>
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

    <!-- The Modal -->
    <div class="modal fade" id="modalRefaccion">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Refaccion</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form" id="cleanFormRefaccion" action="assets/controler/refaccion/altaRefaccionTaller.php" method="POST">

                        <!-- form refaccion -->
                        <fieldset class='border p-2'>
                            <legend class='w-auto'>Datos de la refaccion</legend>
                            <div class="row">

                                <!--Campo Descripción -->
                                <div class="col-12">
                                    <label>Descripción:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-tasks"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Descripción refaccion" name="forRefDes" required>
                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <!--Campo Código -->
                                <div class="col-6">
                                    <label>Código:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-barcode"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Código refaccion" name="forRefCod" required>
                                    </div>
                                </div>

                                <!--Campo Marca -->
                                <div class="col-6">
                                    <label>Marca:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-tag"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Marca refaccion" name="forRefMar" required>
                                    </div>
                                </div>



                                <!--Campo Cantidad -->
                                <div class="col-6">
                                    <label>Cantidad:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-hashtag"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Cantidad en stock" max="50" min="1" name="forRefCan" required>
                                    </div>
                                </div>

                                <!--Campo Costo -->
                                <div class="col-6">
                                    <label>Costo:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Costo refaccion" name="forRefCos" required>
                                    </div>
                                </div>

                                <!--/. form Cantidad -->

                            </div>


                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <button type="button" onClick=cleanRefaccion() class="btn btn-outline-secondary btn-block"><i class="fas fa-eraser"></i>
                                        Borrar</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-paper-plane"></i> Enviar</button>
                                </div>
                            </div>
                        </fieldset>
                        <!--/. form-->
                    </form>
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
    <div class="modal fade" id="modalServicio">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Tarjeta Servicio</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form" id="cleanFormServicio" action="assets/controler/servicio/altaServicioTaller.php" method="POST">

                        <!-- form Servicio -->
                        <fieldset class='border p-2'>
                            <legend class='w-auto'>Datos del servicio</legend>
                            <div class="row">

                                <!--Campo Código -->
                                <div class="col-6">
                                    <label>Código:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-barcode"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Código servicio" name="forSerCod" required>
                                    </div>
                                </div>

                                <!--Campo Costo -->
                                <div class="col-6">
                                    <label>Costo:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Costo servicio" name="forSerCos" required>
                                    </div>
                                </div>

                                <!--Campo Descripción -->
                                <div class="col-12">
                                    <label>Descripción:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-tasks"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Descripción servicio" name="forSerDes" required>
                                    </div>
                                </div>



                            </div>

                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <button type="button" onClick=cleanServicio() class="btn btn-outline-secondary btn-block"><i class="fas fa-eraser"></i>
                                        Borrar</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-paper-plane"></i> Enviar</button>
                                </div>
                            </div>
                        </fieldset>
                        <!--/. form-->
                    </form>
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
            $('.getStatus').load('./assets/controler/taller/getOrdenStatus.php?id=' + id_button +'|'+ status,
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

</body>

</html>