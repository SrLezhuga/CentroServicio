<?php session_start(); include("assets/controler/conexion.php");

$queryUser = "SELECT * FROM tab_users WHERE code_user =".$_SESSION['code_user']; 
$rsUser = mysqli_query($con, $queryUser) or die ("Error de consulta"); 
$user = mysqli_fetch_array($rsUser);
$contralOld =  $user['pass_user'];
$items      =  explode("-", $user['conf_user']);
                    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Ajustes</title>
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
                            <h1 class='h3 mb-0 text-gray-800'>Usuario > Ajustes</h1>
                            <div id="reloj" style="text-align: left;"></div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Formulario orden -->
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-danger shadow ">
                                <div class="card-body">
                                    <h1 class='h3 text-gray-800'>Ajustes</h1>
                                    <br>
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-12">
                                            <form class="form" id="cleanForm"
                                                action="assets/controler/usuario/altaUsuario.php" method="POST">

                                                <!-- form usuario -->
                                                <fieldset class='border p-2'>
                                                    <legend class='w-auto'>Cambio contraseña:</legend>
                                                    <div class="row">

                                                        <!--Campo Contraseña -->
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Contraseña actual:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-key"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="password" class="form-control"
                                                                    placeholder="Contraseña actual" name="formUseOld"
                                                                    aria-describedby="passwordHelpInline" required>
                                                            </div>
                                                        </div>

                                                        <!--Campo Contraseña -->
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Nueva Contraseña:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-key"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="password" class="form-control"
                                                                    placeholder="Nueva Contraseña" name="formUseNew1"
                                                                    aria-describedby="passwordHelpInline" required>
                                                            </div>
                                                        </div>

                                                        <!--Campo Contraseña -->
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Confirma Contraseña:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-key"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="password" class="form-control"
                                                                    placeholder="Repetir Contraseña" name="formUseNew2"
                                                                    aria-describedby="passwordHelpInline" required>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <br>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <button type="button" onClick=clean()
                                                                class="btn btn-outline-secondary btn-block"><i
                                                                    class="fas fa-eraser"></i> Borrar</button>
                                                        </div>
                                                        <br>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-block"><i
                                                                    class="fas fa-save"></i> Actualizar</button>
                                                        </div>
                                                    </div>

                                                    <!--/. form-->
                                                </fieldset>
                                            </form>
                                        </div>


                                        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-12">
                                            <form class="form" id="cleanForm"
                                                action="assets/controler/usuario/altaUsuario.php" method="POST">

                                                <!-- form usuario -->
                                                <fieldset class='border p-2'>
                                                    <legend class='w-auto'>Cambio color:</legend>
                                                    <div class="row">

                                                        <!--Campo Contraseña -->
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Color:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-palette"></i>
                                                                    </span>
                                                                </div>
                                                                <select name="fromOrdSer" class="custom-select"
                                                                    required>
                                                                    <option value="" selected disabled>Selecciones
                                                                        color
                                                                    </option>
                                                                    <option value="1">Rojo</option>
                                                                    <option value="2">Azul</option>
                                                                    <option value="3">Verde</option>
                                                                    <option value="4">Negro</option>
                                                                    <option value="5">Gris</option>
                                                                    <option value="6">Rosa</option>
                                                                    <option value="7">Naranja</option>
                                                                    <option value="8">Morado</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <br>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <button type="button" onClick=clean()
                                                                class="btn btn-outline-secondary btn-block"><i
                                                                    class="fas fa-eraser"></i> Borrar</button>
                                                        </div>
                                                        <br>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-block"><i
                                                                    class="fas fa-save"></i> Actualizar</button>
                                                        </div>
                                                    </div>

                                                    <!--/. form-->
                                                </fieldset>
                                                <br>
                                                <div class="alert alert-info" style="text-align: center;">
                                                    <strong>Nota:</strong> Los cambios seran reflejados en el siguiente
                                                    inicio de
                                                    sesion.
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-12">
                                            <form class="form" id="cleanForm"
                                                action="assets/controler/usuario/altaUsuario.php" method="POST">

                                                <!-- form usuario -->
                                                <fieldset class='border p-2'>
                                                    <legend class='w-auto'>Cambio avatar:</legend>
                                                    <div class="row">

                                                        <!--Campo servicio -->
                                                        <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12" style="
                                                text-align: center;">
                                                            <?php 
                                                    for ($i=1; $i < 41 ; $i++) { 
                                                      if ($i==$items[0]) {
                                                          $check="checked";
                                                      }else{
                                                          $check="";
                                                      }
                                                    
                                                      echo "
                                                          <label>
                                                            <input type='radio' name='Avatar' value='m2' ".$check.">
                                                            <img src='../CentroServicio/assets/img/Avatar/".$i.".png' style='height: 50px; width: 50px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>
                                                      ";}
                                                    ?>

                                                        </div>
                                                    </div>

                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-block"><i
                                                                    class="fas fa-save"></i> Actualizar</button>
                                                        </div>
                                                    </div>

                                                    <!--/. form-->
                                                </fieldset>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

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