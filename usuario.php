<?php session_start();
include("assets/controler/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Alta Personal</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Usuario > Alta Usuario</h1>
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
                                    <form class="form" id="cleanForm" action="assets/controler/usuario/altaUsuario.php" method="POST">

                                        <!-- form usuario -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Datos del personal:</legend>
                                            <div class="row">



                                                <!--Campo Nombre -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Nombres:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Nombre" name="formUseNom" required>
                                                    </div>
                                                </div>

                                                <!--Campo usuario -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Usuario:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Usuario" name="formUseUsu" required>
                                                    </div>
                                                </div>

                                                <!--Campo Contraseña -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Contraseña:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control" placeholder="Contraseña" name="formUseCon" aria-describedby="passwordHelpInline" required>
                                                    </div>
                                                </div>

                                                <!--Campo Privilegios -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Privilegios:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-tag"></i>
                                                            </span>
                                                        </div>
                                                        <select name="fromUsePriv" class="custom-select" required>
                                                            <option value="" selected disabled>SELECCIONE UNO
                                                            </option>
                                                            <option value="1">ADMINISTRADOR</option>
                                                            <option value="2">VENDEDOR/MOSTRADOR</option>
                                                            <option value="3">TALLER/TÉCNICO</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>


                                            <br>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="button" onClick=clean() class="btn btn-outline-secondary btn-block"><i class="fas fa-eraser"></i> Borrar</button>
                                                </div>
                                                <br>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-paper-plane"></i> Enviar</button>
                                                </div>
                                            </div>

                                            <!--/. form-->
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Perfiles de Usuarios</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm" id="dataTableCliente" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Usuario</th>
                                                    <th>Contraseña</th>
                                                    <th>Privilegios</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $queryCliente = "SELECT * FROM tab_users";
                                                $rsCliente = mysqli_query($con, $queryCliente) or die("Error de consulta");
                                                while ($Cliente = mysqli_fetch_array($rsCliente)) {
                                                    echo "
                    <tr>
                            <td>" . $Cliente['name_user'] . "</td>
                            <td>" . $Cliente['nick_user'] . "</td>
                            <td>" . $Cliente['pass_user'] . "</td>
                            <td>" . $Cliente['priv_user'] . "</td>
                            <td><button type='button' class='btn btn-outline-light text-dark btn-sm BtnCliente' data-toggle='modal' data-target='#modalCliente'value=" . $Cliente["code_user"] . ">
                            <i class='fas fa-pencil-alt'></i></button></td>
                        </tr>
                    ";
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- DataTales End -->
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

    <!-- Alerts! -->
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 0) { ?>
        <script>
            toastr["success"]("Se registro el Usuario")
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