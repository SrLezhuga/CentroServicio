<?php
session_start();
include "../conexion.php";
$id = $_GET['id'];

$query = "SELECT * FROM tab_refaccion WHERE id_refaccion = " . $id;
($resultSet = mysqli_query($con, $query)) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo "
<form class='form' action='assets/controler/refaccion/modRefaccion.php' method='POST'>
    <fieldset class='border p-2'>
        <legend class='w-auto'>Datos de la refaccion</legend>
        <div class='row'>
            <input type='hidden' class='form-control' placeholder='Id cliente' name='formRefId' value='".$item['id_refaccion']."' required/>

            <!-- form refaccion -->

                <!--Campo Código -->
                <div class='col-4'>
                    <label>Código:</label>
                    <div class='input-group'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-barcode'></i>
                            </span>
                        </div>
                        <input type='text' class='form-control' placeholder='Código refaccion' name='forRefCod' required value='".$item['cod_refaccion']."'/>
                    </div>
                </div>

                <!--Campo Descripción -->
                <div class='col-8'>
                    <label>Descripción:</label>
                    <div class='input-group'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-tasks'></i>
                            </span>
                        </div>
                        <input type='text' class='form-control' placeholder='Descripción refaccion' name='forRefDes' value='".$item['desc_refaccion']."' required />
                    </div>
                </div>
         

          
                <!--Campo Marca -->
                <div class='col'>
                    <label>Marca:</label>
                    <div class='input-group '>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-tag'></i>
                            </span>
                        </div>
                        <select name='forRefMar' class='custom-select' required>";
                            if($item['marca_refaccion']=="MFA") {
                                echo "<option value='MFA' selected >MFA</option>";
                            }else {
                                echo "<option value='MFA' >MFA</option>";
                            }
                            $listMarca = 'SELECT * FROM tab_marca ORDER BY marca_herramienta ASC';
                            $rsMarca = mysqli_query($con, $listMarca) or die('Error de consulta');
                            while ($itemMarca = mysqli_fetch_array($rsMarca)) {
                                if ($item['marca_refaccion']==$itemMarca[0]) {
                                    $selected="selected=yes";
                                 }else{
                                    $selected="selected=no";
                                 }
                                echo "<option value='" . $itemMarca[0] . "' " . $selected . " >" . $itemMarca[0] . "</option>";
                            } 
                            echo "
                        </select>
                    </div>
                </div>

                <!--Campo Cantidad -->
                <div class='col'>
                    <label>Cantidad:</label>
                    <div class='input-group'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-hashtag'></i>
                            </span>
                        </div>
                        <input type='number' class='form-control' placeholder='Cantidad en stock' max='50' min='1' name='forRefCan' value='".$item['cant_refaccion']."' required />
                    </div>
                </div>

                <!--Campo Unidad -->
                <div class='col'>
                    <label>Unidad:</label>
                    <div class='input-group '>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-puzzle-piece'></i>
                            </span>
                        </div>
                        <select name='forRefUni' class='custom-select' required>";
                            if ($item['unidad_refaccion']=="PIEZA") {
                                echo"<option value='PIEZA' selected >PIEZA</option>";
                                echo"<option value='CAJA' >CAJA</option>";
                                echo"<option value='OTRO' >OTRO</option>";
                            }elseif ($item['unidad_refaccion']=="CAJA") {
                                echo"<option value='CAJA' selected >CAJA</option>";
                                echo"<option value='PIEZA' >PIEZA</option>";
                                echo"<option value='OTRO' >OTRO</option>";
                            }else{
                                echo"<option value='OTRO' selected >OTRO</option>";
                                echo"<option value='PIEZA' >PIEZA</option>";
                                echo"<option value='CAJA' >CAJA</option>";
                            }
                            echo"
                        </select>
                    </div>
                </div>

                <!--Campo Costo -->
                <div class='col'>
                    <label>Costo:</label>
                    <div class='input-group'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-dollar-sign'></i>
                            </span>
                        </div>
                        <input type='text' class='form-control' placeholder='Costo refaccion' name='forRefCos' value='".$item['costo_refaccion']."' required />
                    </div>
                </div>

                <!--/. form Cantidad -->
           

            <hr />

            <!-- /. form cliente -->
        </div>

        <br />
        <hr />
        <div class='row'>
            <div class='col'>
                <button type='submit' class='btn btn-outline-danger btn-block'><i class='fas fa-pencil-alt'></i> Actualizar</button>
            </div>
        </div>
    </fieldset>
    <!--/. form-->
</form>

";

mysqli_close($con);
?>
