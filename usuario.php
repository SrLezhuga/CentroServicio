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
    <title> Centro de Servicio MFA | Personal</title>
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
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label>Nombres:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" id="nombre" class="form-control" placeholder="Nombre" name="formUseNom" required>
                                                    </div>
                                                </div>

                                                <!--Campo Apellido -->
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label>Apellidos:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" id="apellido" class="form-control" placeholder="Apellido" name="formUseApe" required>
                                                    </div>
                                                </div>

                                                <!--Campo usuario -->
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label>Usuario:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" id="usuario" class="form-control" onclick="FxUser()" onblur="comprobarUsuario()" placeholder="Usuario" name="formUseUsu" required>
                                                    </div>
                                                </div>

                                                <!--Campo Sucursal -->
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label>Sucursal:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-store-alt"></i>
                                                            </span>
                                                        </div>
                                                        <select name="formUseSuc" class="custom-select" required>
                                                            <option value="" selected disabled>SELECCIONE UNA
                                                            </option>
                                                            <?php $listSuc = "SELECT * FROM tab_sucursal ORDER BY nom_sucursal ASC";
                                                            $rsSuc = mysqli_query($con, $listSuc) or die("Error de consulta");
                                                            while ($itemSuc = mysqli_fetch_array($rsSuc)) {
                                                                echo "<option value='" . $itemSuc[1] . "'>" . $itemSuc[1] . "</option>";
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--Campo Contraseña -->
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label>Contraseña:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control" placeholder="Contraseña" name="formUseCon" min="6" max="12" aria-describedby="passwordHelpInline" required>
                                                    </div>
                                                </div>

                                                <!--Campo Privilegios -->
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label>Privilegios:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-id-card-alt"></i>
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
                                                    <th>Sucursal</th>
                                                    <th>Privilegios</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $queryUsuario = "SELECT * FROM tab_users";
                                                $rsUsuario = mysqli_query($con, $queryUsuario) or die("Error de consulta");
                                                while ($Usuario = mysqli_fetch_array($rsUsuario)) {

                                                    if ($Usuario['code_user'] == $_SESSION['code_user']) {
                                                        $disable = "disabled";
                                                    } else {
                                                        $disable = "";
                                                    }

                                                    if ($Usuario['priv_user'] == 1) {
                                                        $privilegios = "Administrador";
                                                    } elseif ($Usuario['priv_user'] == 2) {
                                                        $privilegios = "Vendedor/Mostrador";
                                                    } else {
                                                        $privilegios = "Taller/Técnico";
                                                    }

                                                    if ($Usuario['nick_user'] == null) {
                                                        $class = "class='table-danger'";
                                                    } else {
                                                        $class = "";
                                                    }

                                                    echo "
                    <tr " . $class . ">
                            <td>" . $Usuario['name_user'] . "</td>
                            <td>" . $Usuario['nick_user'] . "</td>
                            <td>" . $Usuario['sucursal_user'] . "</td>
                            <td>" . $privilegios . "</td>
                            <td>
                            <button type='button' class='btn btn-outline-light text-dark btn-sm BtnMod' data-toggle='modal' data-target='#modalMod'value=" . $Usuario["code_user"] . " " . $disable . ">
                            <i class='fas fa-pencil-alt'></i></button>
                            <button type='button' class='btn btn-outline-light text-dark btn-sm BtnRest' data-toggle='modal' data-target='#modalRest'value=" . $Usuario["code_user"] . " " . $disable . ">
                            <i class='fas fa-sync-alt'></i></button>
                            <button type='button' class='btn btn-outline-light text-dark btn-sm BtnDel' data-toggle='modal' data-target='#modalDel'value=" . $Usuario["code_user"] . " " . $disable . ">
                            <i class='fas fa-trash-alt'></i></button>
                            </td>
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

    <!-- The Modal -->
    <div class="modal fade" id="modalDel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Desactivar Usuario</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getContent">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                        Cancelar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="modalMod">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Modificar Usuario</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getContent">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                        Cancelar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="modalRest">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Restablecer Contraseña</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getContent">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                        Cancelar</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        function FxUser() {

            var nombre = document.getElementById("nombre").value;
            var apellido = document.getElementById("apellido").value;

            var n = nombre.substr(0, 3);
            var a = apellido.substr(0, 3);

            var Upn = n.toUpperCase();
            var Upa = a.toUpperCase();

            document.getElementById("usuario").value = Upn + Upa;
        }
    </script>

<script>
function comprobarUsuario() {
	
	jQuery.ajax({
	url: "./assets/controler/usuario/validarUsuario.php",
	data:'usuario='+$("#usuario").val(),
	type: "POST",
	success:function(data){
        if (data==0) {
            toastr["success"]("Usuario disponible");
        }else{
            toastr["error"]("Usuario no disponible");
            document.getElementById("usuario").value = "";
        }
	},
	error:function (){
        alert(data);
    }
    });
    
}
</script>

    <!-- Alerts! -->
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 0) { ?>
        <script>
            Swal.fire(
                    "Mensaje de confirmación",
                    "Se registró el usuario",
                    "success"
                );
        </script>
    <?php } ?>
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 1) { ?>
        <script>
            Swal.fire(
                    "Mensaje de confirmación",
                    "Se actualizó el usuario",
                    "success"
                );
        </script>
    <?php } ?>
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 2) { ?>
        <script>
            Swal.fire(
                    "Mensaje de confirmación",
                    "Se restableció contraseña del usuario",
                    "success"
                );
        </script>
    <?php } ?>
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 3) { ?>
        <script>
            Swal.fire(
                    "Mensaje de confirmación",
                    "Se desactivó el usuario",
                    "success"
                );
            toastr["info"]("Para reactivar, asigna usuario y contraseña");
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

    <script type="text/javascript">
        // Modal tarjeta mod
        $('.BtnMod').on('click', function() {
            var id_button = $(this).val();
            $('.getContent').load('./assets/controler/usuario/getUsuario.php?id=' + id_button, function() {
                $('#modalCliente').modal({
                    show: true
                });
            });
        });
        // Modal tarjeta rest
        $('.BtnRest').on('click', function() {
            var id_button = $(this).val();
            $('.getContent').load('./assets/controler/usuario/getRestablecer.php?id=' + id_button, function() {
                $('#modalCliente').modal({
                    show: true
                });
            });
        });
        // Modal tarjeta del
        $('.BtnDel').on('click', function() {
            var id_button = $(this).val();
            $('.getContent').load('./assets/controler/usuario/getEliminar.php?id=' + id_button, function() {
                $('#modalCliente').modal({
                    show: true
                });
            });
        });
    </script>

</body>

</html>