<?php
session_start();
include("../conexion.php");
$id = $_GET['id'];

$query = "SELECT * FROM tab_herramienta WHERE Id_herramienta = " . $id;
$resultSet = mysqli_query($con, $query) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo '
    <form class="form" id="cleanForm" action="assets/controler/herramienta/modHerramienta.php" method="POST">

        <input type="hidden" name="forHerId" value="'.$id.'">

                                        <!-- form herramienta -->
                                        <fieldset class="border p-2">
                                            <legend class="w-auto">Datos de la herramienta:</legend>
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
                                                        <input type="text" class="form-control" placeholder="Código producto" name="forHerCod" required  value="'.$item['cod_herramienta'].'">
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
                                                        <select name="forHerMar" class="custom-select" required>
                                                            <option value="GENERICA">GENERICA</option>';
                                                             $listMarca = "SELECT * FROM tab_marca ORDER BY marca_herramienta ASC";
                                                            $rsMarca = mysqli_query($con, $listMarca) or die("Error de consulta");
                                                            while ($itemMarca = mysqli_fetch_array($rsMarca)) {

                                                                if ($itemMarca[0]==$item['marca_herramienta']) {
                                                                   $select="selected";
                                                                }else {
                                                                    $select="";
                                                                }

                                                                echo "<option value='" . $itemMarca[0] . "' ". $select .">" . $itemMarca[0] . "</option>";
                                                            } 
                                                     echo '       
                                                        </select>
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
                                                        <input type="text" class="form-control" placeholder="Descripción herramienta" name="forHerDes" required  value="'.$item['desc_herramienta'].'">
                                                    </div>
                                                </div>

                                            </div>

                                            <br>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-sync-alt"></i> Actualizar</button>
                                                </div>
                                            </div>

                                            <!--/. form-->
                                        </fieldset>
                                    </form>';



mysqli_close($con);
?>
