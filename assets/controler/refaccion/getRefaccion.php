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
            <input type='hidden' class='form-control' placeholder='Id cliente' name='formRefId' value='".$item[id_refaccion]."' required/>

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
                        <input type='text' class='form-control' placeholder='Código refaccion' name='forRefCod' required value='".$item[cod_refaccion]."'/>
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
                        <input type='text' class='form-control' placeholder='Descripción refaccion' name='forRefDes' value='".$item[desc_refaccion]."' required />
                    </div>
                </div>
         

          
                <!--Campo Marca -->
                <div class='col'>
                    <label>Marca:</label>
                    <div class='input-group'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-tag'></i>
                            </span>
                        </div>
                        <input type='text' class='form-control' placeholder='Marca refaccion' name='forRefMar' value='".$item[marca_refaccion]."' required />
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
                        <input type='number' class='form-control' placeholder='Cantidad en stock' max='50' min='1' name='forRefCan' value='".$item[cant_refaccion]."' required />
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
                        <input type='text' class='form-control' placeholder='Costo refaccion' name='forRefCos' value='".$item[costo_refaccion]."' required />
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
