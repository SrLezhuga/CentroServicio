<?php session_start(); include("assets/controler/conexion.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Centro de Servicio FMA | Refacciones</title>
    <?php  include_once("assets/common/header.php");?>
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
                                    <h1 class='h3 text-gray-800'>Nueva Refaccion</h1>
                                    <br>

                                    <form class="form" id="cleanForm"
                                        action="assets/controler/refaccion/altarefaccion.php" method="POST">

                                        <!-- form refaccion -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Datos de la refaccion</legend>
                                            <div class="row">

                                                <!--Campo Código -->
                                                <div class="col-2">
                                                    <label>Código:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-barcode"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Código refaccion" name="forRefCod" required>
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
                                                        <input type="text" class="form-control"
                                                            placeholder="Descripción refaccion" name="forRefDes"
                                                            required>
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
                                                        <input type="text" class="form-control"
                                                            placeholder="Marca refaccion" name="forRefMar" required>
                                                    </div>
                                                </div>



                                                <!--Campo Cantidad -->
                                                <div class="col">
                                                    <label>Cantidad:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-hashtag"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control"
                                                            placeholder="Cantidad en stock" max="50" min="1"
                                                            name="forRefCan" required>
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
                                                        <input type="text" class="form-control"
                                                            placeholder="Costo refaccion" name="forRefCos" required>
                                                    </div>
                                                </div>

                                                <!--/. form Cantidad -->

                                            </div>


                                            <br>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="button" onClick=clean()
                                                        class="btn btn-outline-secondary btn-block"><i
                                                            class="fas fa-eraser"></i> Borrar</button>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                            class="fas fa-paper-plane"></i> Enviar</button>
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
                                    <h1 class='h3 text-gray-800'>Inventario</h1>
                                    <br>
                                    <!-- DataTales -->
                                    <div class="table">
                                        <table class="table table-hover table-sm" id="dataTableHerramienta" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>Descripción</th>
                                                    <th>Marca</th>
                                                    <th>Cantidad</th>
                                                    <th>Costo</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                        $queryrefaccion = "SELECT * FROM tab_refaccion"; 
                                                        $rsrefaccion = mysqli_query($con, $queryrefaccion) or die ("Error de consulta"); 
                                                            while ($refaccion = mysqli_fetch_array($rsrefaccion)) {

                                                                if($refaccion['cant_refaccion']==0){
                                                                    echo "<tr class='table-danger' style='color: brown;'>";
                                                                    $disable="";
                                                                }else{
                                                                    echo "<tr>";
                                                                    $disable="disabled";
                                                                }
                                                                echo "
                                                                        <td>".$refaccion['cod_refaccion']."</td>        
                                                                        <td>".$refaccion['desc_refaccion']."</td>
                                                                        <td>".$refaccion['marca_refaccion']."</td>
                                                                        <td>".$refaccion['cant_refaccion']."</td>
                                                                        <td>$ ".$refaccion['costo_refaccion'].".00</td>
                                                                        <td> 
                                                                            <button type='button' class='btn btn-outline-light text-dark btn-sm BtnRefaccionMod' data-toggle='modal' data-target='#modalRefaccionMod'value='".$refaccion['id_refaccion']."'>
                                                                            <i class='fas fa-eye'></i></button>
                                                                            <button type='button' class='btn btn-outline-light text-dark btn-sm BtnRefaccionDown' ".$disable." data-toggle='modal' data-target='#modalRefaccionDown'value='".$refaccion['id_refaccion']."'>
                                                                            <i class='fas fa-trash-alt'></i></button>
                                                                        </td>
                                                                    </tr>
                                                        "; } ?>
                                            </tbody>
                                        </table>
                                    </div>




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

    <!-- The Modal -->
    <div class="modal fade" id="modalRefaccionMod">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Modificar Refaccion</h3>
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
                        Cancelar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="modalRefaccionDown">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-left-danger shadow">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Eliminar Refaccion</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="getDatosDown">
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

    <script type="text/javascript">
    // Modal tarjeta Mod
    $('.BtnRefaccionMod').on('click', function() {
        var id_button = $(this).val();
        $('.getRefaccion').load('./assets/controler/refaccion/getRefaccion.php?id=' + id_button, function() {
            $('#modalRefaccionMod').modal({
                show: true
            });
        });
    });
    // Modal tarjeta Down
    $('.BtnRefaccionDown').on('click', function() {
        var id_button = $(this).val();
        $('.getDatosDown').load('./assets/controler/refaccion/datosRefaccion.php?id=' + id_button, function() {
            $('#modalRefaccionDown').modal({
                show: true
            });
        });
    });
    </script>




    <!-- Alerts! -->
    <?php if(isset($_GET['alert']) && $_GET['alert']==0){ ?>
    <script>
    toastr["success"]("Se registro la refaccion")
    </script>
    <?php } if(isset($_GET['alert']) && $_GET['alert']==1){ ?>
    <script>
    toastr["success"]("Se modifico la refaccion")
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