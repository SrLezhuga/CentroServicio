<?php session_start(); include("assets/controler/conexion.php");?>
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
                                    <div class="col-xl-6 col-md-6 mb-6">
                                    <form class="form" id="cleanForm" action="assets/controler/usuario/altaUsuario.php"
                                        method="POST">

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
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                            class="fas fa-paper-plane"></i> Enviar</button>
                                                </div>
                                            </div>

                                            <!--/. form-->
                                        </fieldset>
                                    </form>
                                    </div>

                                    <div class="col-xl-6 col-md-6 mb-6">
                                    <form class="form" id="cleanForm" action="assets/controler/usuario/altaUsuario.php"
                                        method="POST">

                                        <!-- form usuario -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Cambio Avatar:</legend>
                                            <div class="row">

                                                <!--Campo servicio -->
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12" style="
                                                text-align: center;">
                                                    

                                                        <label>
                                                            <input type="radio" name="Avatar" value="m1" checked>
                                                            <img src="../CentroServicio/assets/img/Avatar/man (1).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>
                                                          
                                                          <label>
                                                            <input type="radio" name="Avatar" value="m2">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (2).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="m3">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (3).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="m4">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (4).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="m5">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (5).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="m6">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (6).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="m7">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (7).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="m8">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (8).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>
                                                 
                                                          <label>
                                                            <input type="radio" name="Avatar" value="m9">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (9).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="m10">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (10).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="m11">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (11).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="m12">
                                                            <img src="../CentroServicio/assets/img/Avatar/man (12).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w1" >
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (1).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>
                                                          
                                                          <label>
                                                            <input type="radio" name="Avatar" value="w2">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (2).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w3">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (3).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w4">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (4).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w5">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (5).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w6">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (6).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w7">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (7).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w8">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (8).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>
                                                 
                                                          <label>
                                                            <input type="radio" name="Avatar" value="w9">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (9).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w10">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (10).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w11">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (11).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                          <label>
                                                            <input type="radio" name="Avatar" value="w12">
                                                            <img src="../CentroServicio/assets/img/Avatar/woman (12).png" style='height: 61px;    width: 61px;' 
                                                            onContextMenu='return false;' draggable='false'>
                                                          </label>

                                                </div>

                                                <style>
                                                    /* HIDE RADIO */
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  outline: 2px solid #f00;
}
                                                </style>

                                             
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
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                            class="fas fa-paper-plane"></i> Enviar</button>
                                                </div>
                                            </div>

                                            <!--/. form-->
                                        </fieldset>
                                    </form>
                                    </div>
                                </div>
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