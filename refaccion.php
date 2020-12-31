<?php session_start();
include("assets/controler/conexion.php");
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user'] == 1) {
    # code...
} else {
    header("Location: http://" . $base_url . "/CentroServicio/404'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Refacciones</title>
    <?php include_once("assets/common/header.php"); ?>
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
                            <h1 class='h3 mb-0 text-gray-800'>Refacción > Alta Refacción</h1>
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
                                    <h1 class='h3 text-gray-800'>Nueva Refacción</h1>
                                    <br>

                                    <form class="form" id="cleanForm" action="assets/controler/refaccion/altaRefaccion.php" method="POST">

                                        <!-- form refaccion -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Datos de la refacción</legend>
                                            <div class="row">

                                                <!--Campo Código -->
                                                <div class="col-3">
                                                    <label>Código:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-barcode"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Código refacción" name="forRefCod" required>
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
                                                        <input type="text" class="form-control" placeholder="Descripción refacción" name="forRefDes" required>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">

                                                <!--Campo Marca -->
                                                <div class="col">
                                                    <label>Marca:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-tag"></i>
                                                            </span>
                                                        </div>
                                                        <select name="forRefMar" class="custom-select" required>
                                                            <option value="" selected disabled>Seleccione marca
                                                            </option>
                                                            <option value="MFA">MFA</option>
                                                            <?php $listMarca = "SELECT * FROM tab_marca ORDER BY marca_herramienta ASC";
                                                            $rsMarca = mysqli_query($con, $listMarca) or die("Error de consulta");
                                                            while ($itemMarca = mysqli_fetch_array($rsMarca)) {
                                                                echo "<option value='" . $itemMarca[1] . "'>" . $itemMarca[1] . "</option>";
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--Campo Costo -->
                                                <div class="col">
                                                    <label>Costo:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-dollar-sign"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Costo refacción" name="forRefCos" required>
                                                    </div>
                                                </div>

                                                <!--/. form Cantidad -->

                                            </div>


                                            <br>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="button" onClick=clean() class="btn btn-outline-secondary btn-block"><i class="fas fa-eraser"></i> Borrar</button>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-paper-plane"></i> Enviar</button>
                                                </div>
                                            </div>
                                        </fieldset>
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
                                    <h1 class='h3 text-gray-800'>Carga Masiva</h1>
                                    <br>
                                    <fieldset class='border p-2'>
                                        <legend class='w-auto'>Datos de la refacción</legend>
                                        <form action="#" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="txt_archivo" lang="es" accept=".csv, .xls, .xlsx">
                                                        <label class="custom-file-label" for="txt_archivo">No se ha
                                                            seleccionado ningún
                                                            archivo</label>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-outline-secondary btn-block" onclick="CargarExcel()"><i class="fas fa-file-excel"></i> Cargar
                                                        Excel</button>
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-outline-danger btn-block " onclick="RegistrarExcel()" disabled id="btn_registrar"><i class="fas fa-save"></i> Guardar Datos</button>
                                                </div>
                                            </div>
                                            <a href="./assets/controler/exportar/plantilla.php"><i class="fas fa-file-csv"></i> Descargar Plantilla</a>
                                        </form>
                                        <br>
                                        <!-- DataTales -->
                                        <div class="col-12" id="div_tabla">
                                            <br>
                                        </div>
                                        
                                    </fieldset>



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
            <?php include_once("assets/common/foter.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script type="text/javascript">
        $('input[type="file"]').on('change', function() {
            var ext = $(this).val().split('.').pop();
            if ($(this).val() != '') {
                if (ext == "xls" || ext == "xlsx" || ext == "csv") {

                } else {
                    $(this).siblings(".custom-file-label").addClass("selected").html("No se ha seleccionado ningún archivo");
                    Swal.fire(
                        "Mensaje de error",
                        "Extensión no permitida: ." + ext + "",
                        "error"
                    );
                }

            } else {
                $(this).siblings(".custom-file-label").addClass("selected").html("No se ha seleccionado ningún archivo");
            }
        });

        function CargarExcel() {
            var excel = $("#txt_archivo").val();
            if (excel == "") {
                return Swal.fire(
                    "Mensaje de advertencia",
                    "Seleccionar un archivo excel",
                    "warning"
                );

            }
            Swal.fire({
                title: 'Cargando datos',
                allowEscapeKey: false,
                allowOutsideClick: false,
                timer: 500000,
                showConfirmButton: false,
                willOpen: () => {
                    swal.showLoading();
                }
            });
            var formData = new FormData();
            var files = $("#txt_archivo")[0].files[0];
            formData.append('archivoexcel', files);

            $.ajax({
                url: './assets/controler/exportar/importar_excel_ajax.php',
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function(resp) {
                    swal.close();
                    $("#div_tabla").html(resp);
                    document.getElementById("btn_registrar").disabled = false;
                }
            });
            return false;
        }

        function RegistrarExcel() {

            Swal.fire({
                title: 'Cargando datos',
                allowEscapeKey: false,
                allowOutsideClick: false,
                timer: 500000,
                showConfirmButton: false,
                willOpen: () => {
                    swal.showLoading();
                }
            });

            var contador = 0;
            var arreglo_id = new Array();
            var arreglo_codigo = new Array();
            var arreglo_descripcion = new Array();
            var arreglo_marca = new Array();
            var arreglo_costo = new Array();

            $("#tabla_detalle tbody#tbody_tabla_detalle tr").each(function() {
                arreglo_id.push($(this).find("td").eq(0).text());
                arreglo_codigo.push($(this).find("td").eq(1).text());
                arreglo_descripcion.push($(this).find("td").eq(2).text());
                arreglo_marca.push($(this).find("td").eq(3).text());
                arreglo_costo.push($(this).find("td").eq(4).text());
                contador++;
            });

            if (contador == 0) {
                return Swal.fire(
                    "Mensaje de advertencia",
                    "La tabla tiene que tener como minimo un dato",
                    "warning"
                );
            }

            var id = arreglo_id.toString();
            var codigo = arreglo_codigo.toString();
            var descripcion = arreglo_descripcion.toString();
            var marca = arreglo_marca.toString();
            var costo = arreglo_costo.toString();

            $.ajax({
                url: "./assets/controler/exportar/controlador_registro.php",
                type: "post",
                data: {
                    id: id,
                    codi: codigo,
                    desc: descripcion,
                    marc: marca,
                    cost: costo
                }
            }).done(function(resp) {
                swal.close();
                if (resp == 1) {
                    return Swal.fire(
                        "Mensaje de confirmación",
                        "Se cargaron los datos",
                        "success"
                    ).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    return Swal.fire(
                        "Mensaje de error",
                        "Error al cargar intentalo nuevamente",
                        "error"
                    ).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>

    <!-- Alerts! -->
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 0) { ?>
        <script>
        Swal.fire(
                    "Mensaje de confirmación",
                    "Se registró la refacción",
                    "success"
                );
        </script>
    <?php } ?>
    <script>
        //Limpiar formularios
        function clean() {
            document.getElementById("cleanForm").reset();
            Swal.fire(
                    "Mensaje de confirmación",
                    "Formulario vacío",
                    "success"
                );
        }
    </script>
</body>

</html>