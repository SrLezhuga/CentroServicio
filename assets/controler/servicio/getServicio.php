<?php
session_start();
include "../conexion.php";
$id = $_GET['id'];

$query = "SELECT * FROM tab_servicio WHERE id_servicio = " . $id;
($resultSet = mysqli_query($con, $query)) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo "
<form class='form' action='assets/controler/servicio/modServicio.php' method='POST'>
    <fieldset class='border p-2'>
        <legend class='w-auto'>Datos de la servicio</legend>
        <div class='row'>
            <input type='hidden' class='form-control' placeholder='Id cliente' name='formSerId' value='".$item[id_servicio]."' required />

            <!--Campo Código -->
            <div class='col-2'>
                <label>Código:</label>
                <div class='input-group'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text'>
                            <i class='fas fa-barcode'></i>
                        </span>
                    </div>
                    <input type='text' class='form-control' placeholder='Código servicio' name='forSerCod' value='".$item[cod_servicio]."' required />
                </div>
            </div>

            <!--Campo Descripción -->
            <div class='col'>
                <label>Descripción:</label>
                <div class='input-group'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text'>
                            <i class='fas fa-tasks'></i>
                        </span>
                    </div>
                    <input type='text' class='form-control' placeholder='Descripción servicio' name='forSerDes' value='".$item[desc_servicio]."' required />
                </div>
            </div>

            <!--Campo Costo -->
            <div class='col-2'>
                <label>Costo:</label>
                <div class='input-group'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text'>
                            <i class='fas fa-dollar-sign'></i>
                        </span>
                    </div>
                    <input type='text' class='form-control' placeholder='Costo servicio' name='forSerCos' value='".$item[costo_servicio]."' required />
                </div>
            </div>
            <hr />
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