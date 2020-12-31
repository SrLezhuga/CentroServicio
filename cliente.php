<?php session_start();
if (isset($_SESSION['priv_user']) && $_SESSION['priv_user']==1 ||  $_SESSION['priv_user']==2) {
    # code...
}else {
    header("Location: http://" . $base_url . "/CentroServicio/404'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio MFA | Alta Cliente</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Cliente > Alta Clientes</h1>
                            <div id="reloj" style="text-align: left;"></div>
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
                                    <form class="form" id="cleanForm" action="assets/controler/cliente/altaCli.php"
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
                                                        <input type="text" class="form-control"
                                                            placeholder="Nombre cliente" name="formCliNom" required>
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
                                                        <input type="text" class="form-control"
                                                            placeholder="Domicilio cliente" name="formCliDom" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <!--Campo Col -->
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label>Colonia:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Colonia" name="formCliCol"  required>
                                                    </div>
                                                </div>

                                                <!--Campo municipio -->
                                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
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
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <label>Código Postal:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-hashtag"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Código Postal" name="formCliCP" pattern='[0-9]{5}' required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                            
                                                <!--Campo Teléfono -->
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <label>Teléfono:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-phone-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="tel" class="form-control"
                                                            placeholder="Teléfono cliente" name="formCliTel" required>
                                                    </div>
                                                </div>

                                                <!--Campo Correo -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Correo:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-at"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email" class="form-control"
                                                            placeholder="Correo cliente" name="formCliMail" value="Sin@Correo.com" required>
                                                    </div>
                                                </div>

                                                <!--Campo RFC -->
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <label>Rfc:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-address-card"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Rfc cliente" name="formCliRfc" value="Sin capturar" required>
                                                    </div>
                                                </div>

                                                <!-- /. form cliente -->
                                                
                                            </div>

                                            <br>
                                            <div class="alert alert-info" style="text-align: center;">
                                                        <strong>Nota:</strong> Si el cliente no cuenta con RFC o Correo este se capturara con valores por defecto.
                                                    </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="button" onClick=clean()
                                                        class="btn btn-outline-secondary btn-block"><i
                                                            class="fas fa-eraser"></i> Borrar</button>
                                                </div>
                                                <br>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                            class="fas fa-paper-plane"></i> Guardar</button>
                                                </div>
                                            </div>

                                            <!--/. form-->
                                        </fieldset>
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
        Swal.fire(
                    "Mensaje de confirmación",
                    "Se registró el cliente",
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