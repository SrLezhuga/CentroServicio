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
                        <div>
                            <h1 class='h3 mb-0 text-gray-800'>Orden > Nueva orden</h1>
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
                                    <h1 class='h3 text-gray-800'>Ingrese los datos</h1>
                                    <br>
                                    <form class="form" id="cleanFormOrden" action="assets/controler/orden/altaOrden.php"
                                        method="POST">
                                        <div class="row">
                                            <!-- form cliente -->
                                            <div class="col-12">
                                                <fieldset class='border p-2'>
                                                    <legend class='w-auto'>Datos del Cliente:</legend>
                                                    <div class="row">
                                                        <!--Campo Cliente -->
                                                        <div class="col-xl-2 col-md-6 col-sm-4 col-lg-2">
                                                            <label>Nuevo:</label>
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-block"
                                                                data-toggle="modal" data-target="#modalCliente"><i
                                                                    class="fas fa-user-plus"></i>
                                                                Agregar</button>
                                                        </div>
                                                        <!--Campo Cliente -->
                                                        <div class="col-xl-10 col-md-6 col-sm-8 col-lg-10">
                                                            <label>Cliente:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-user"></i>
                                                                    </span>
                                                                </div>
                                                                <select name="fromOrdCli" class="custom-select"
                                                                    required>
                                                                    <option value="" selected disabled>Seleccione
                                                                        datos
                                                                        del
                                                                        cliente</option>
                                                                    <?php $listCli = "SELECT * FROM tab_cliente ORDER BY nom_cliente ASC"; 
                                                                    $rsCli = mysqli_query($con, $listCli) or die ("Error de consulta");      
                                                                    while ($itemCli = mysqli_fetch_array($rsCli)) {
                                                                    echo "<option value='".$itemCli[0]."'>".$itemCli['nom_cliente']." | ".$itemCli['dir_cliente']." | ".$itemCli['tel_cliente']."</option>";}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- /. form producto -->
                                                    </div>
                                                    <br>
                                            </div>
                                            <!-- form producto -->
                                            <div class="col-12">
                                                <fieldset class='border p-2'>
                                                    <legend class='w-auto'>Datos del Producto:</legend>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <!--Campo servicio -->
                                                            <div class="col-xl-4 col-md-6 col-sm-6 col-lg-4">
                                                                <label>Tipo de servicio:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-cogs"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select name="fromOrdSer" class="custom-select"
                                                                        required>
                                                                        <option value="" selected disabled>Selecciones
                                                                            servicio
                                                                        </option>
                                                                        <option value="Garantia">Garantia</option>
                                                                        <option value="Presupuesto">Presupuesto</option>
                                                                        <option value="Mantenimiento">Mantenimiento
                                                                        </option>
                                                                        <option value="Mantenimiento/Garantía">
                                                                            Mantenimiento por Garantia
                                                                        </option>
                                                                        <option value="Ninguno">Ninguno</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--Campo Fecha -->
                                                            <div class="col-xl-4 col-md-6 col-sm-6 col-lg-4">
                                                                <label>Fecha:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="far fa-calendar-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="date" class="form-control"
                                                                        placeholder="Fecha de remision"
                                                                        value="<?php echo date('Y-m-d'); ?>"
                                                                        name="forOrdFec" readonly required>
                                                                </div>
                                                            </div>
                                                            <!--Campo Herramienta -->
                                                            <div class="col-xl-4 col-md-12 col-sm-12 col-lg-4">
                                                                <label>Herramienta:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-tools"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Descripción herramienta"
                                                                        name="forOrdHer" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <!--Campo Marca -->
                                                            <div class="col-xl-4 col-md-4 col-sm-4 col-lg-4">
                                                                <label>Marca:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-tag"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select name="fromOrdMar" class="custom-select"
                                                                        required>
                                                                        <option value="" selected disabled>Seleccione
                                                                            marca
                                                                        </option>
                                                                        <option value="GENERICA">GENERICA</option>
                                                                        <?php $listCli = "SELECT * FROM tab_marca ORDER BY marca_herramienta ASC"; 
                                                                    $rsCli = mysqli_query($con, $listCli) or die ("Error de consulta");      
                                                                        while ($itemCli = mysqli_fetch_array($rsCli)) {
                                                                        echo "<option value='".$itemCli[0]."'>".$itemCli[0]."</option>";}?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--Campo Modelo -->
                                                            <div class="col-xl-4 col-md-4 col-sm-4 col-lg-4">
                                                                <label>Modelo:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-tags"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Modelo herramienta"
                                                                        name="forOrdMod" required>
                                                                </div>
                                                            </div>
                                                            <!--Campo Adicional -->
                                                            <div class="col-xl-4 col-md-4 col-sm-4 col-lg-4">
                                                                <label>Adicional*:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-puzzle-piece"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Adicional" name="forOrdAdd"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <!--/. form producto -->
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="alert alert-info" style="text-align: center;">
                                                        <strong>Nota:</strong> El campo adicional se utiliza para
                                                        algunas marca que tienen caracteristicas extra en el modelo, por
                                                        ejempo tipo 1
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <br>
                                            <!--form detalles -->
                                            <div class="col-12">
                                                <fieldset class='border p-2'>
                                                    <legend class='w-auto'>Datos del Servicio:</legend>
                                                    <div class="row">
                                                        <!--Campo diagnostico -->
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Diagnostico de la Herramienta:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-file-alt"></i>
                                                                    </span>
                                                                </div>
                                                                <textarea rows="2" cols="25" class="form-control"
                                                                    placeholder="Diagnostico y observaciones de la herramienta entregada"
                                                                    name="forOrdDet" required></textarea>
                                                            </div>
                                                        </div>
                                                        <!--/. form detalles -->
                                                    </div>
                                                </fieldset>
                                                <br>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="button" onClick="cleanOrden();"
                                                            class="btn btn-outline-secondary btn-block"><i
                                                                class="fas fa-eraser"></i>
                                                            Borrar</button>
                                                    </div>
                                                    <div class="col">
                                                        <button type="submit"
                                                            class="btn btn-outline-danger btn-block"><i
                                                                class="fas fa-paper-plane" ></i>
                                                            Enviar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/. form-->
                                        </div>
                                    </form>
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
    <!-- Alerts!-->
    <script>
    function cleanOrden() {
        document.getElementById("cleanFormOrden").reset();
        toastr["success"]("Formulario vacío")
    }

    function cleanCliente() {
        document.getElementById("cleanFormCliente").reset();
        toastr["success"]("Formulario vacío")
    }
    </script>
    <?php if(isset($_GET['alert']) && $_GET['alert']==1){ ?>
    <script>
    toastr["success"]("Se registro el Cliente")
    </script>
    <?php } ?>
    <?php if(isset($_GET['alert']) && $_GET['alert']==0){ ?>
    <script>
    toastr["success"]("Orden generada");
    function folio() {
        window.open("http://localhost/CentroServicio/assets/controler/reportes/generarTalonario.php", "_blank");
    }
        setTimeout(folio,2000);
    </script>
    <?php } ?>
    <!-- The Modal Cliente-->
    <div class="modal fade" id="modalCliente">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow ">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form" id="cleanFormCliente" action="assets/controler/cliente/altaCliModal.php"
                        method="POST">
                        <!-- form cliente -->
                        <fieldset class='border p-2'>
                            <legend class='w-auto'>Datos del Cliente:</legend>
                            <div class="row">
                                <!--Campo cliente -->
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Cliente:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Nombre cliente"
                                            name="formCliNom" required>
                                    </div>
                                </div>
                                <!--Campo Domicilio -->
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Domicilio:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-home"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Domicilio cliente"
                                            name="formCliDom" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <!--Campo municipio -->
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label>Municipio:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Municipio"
                                            name="formCliMun" required>
                                    </div>
                                </div>

                                <!--Campo Codigo Postal -->
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label>Codigo Postal:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-hashtag"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Codigo Postal"
                                            name="formCliCP" required>
                                    </div>
                                </div>

                                <!--Campo Teléfono -->
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label>Teléfono:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone-alt"></i>
                                            </span>
                                        </div>
                                        <input type="tel" class="form-control" placeholder="Teléfono cliente"
                                            name="formCliTel" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <!--Campo Correo -->
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Correo:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-at"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Correo cliente"
                                            name="formCliMail" required>
                                    </div>
                                </div>
                                <!--Campo RFC -->
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>RFC:</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-address-card"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="RFC cliente"
                                            name="formCliRfc" required>
                                    </div>
                                </div>
                                <!-- /. form cliente -->
                            </div>
                        </fieldset>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <button type="button" onClick=cleanCliente()
                                    class="btn btn-outline-secondary btn-block"><i class="fas fa-eraser"></i>
                                    Borrar</button>
                            </div>
                            <br>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-outline-danger btn-block"><i
                                        class="fas fa-paper-plane"></i> Enviar</button>
                            </div>
                        </div>
                        <!--/. form-->
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal Cliente-->
</body>

</html>