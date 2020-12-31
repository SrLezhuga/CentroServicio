<?php
session_start();
include("../conexion.php");
$id = $_GET['id'];


$query = "SELECT * FROM tab_sucursal WHERE id_sucursal = " . $id;
$resultSet = mysqli_query($con, $query) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo "

<form class='form' id='cleanForm' action='assets/controler/sucursal/modSucursal.php' method='POST'>
    <fieldset class='border p-2'>
        <legend class='w-auto'>Datos de la Sucursal:</legend>
    <div class='row'>

        <input type='hidden' class='form-control' name='formSucId' value='".$item['id_sucursal']."' required>

        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <label>Sucursal:</label>
            <div class='input-group '>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>
                        <i class='fas fa-tag'></i>
                    </span>
                </div>
                <input type='text' class='form-control' placeholder='Nombre sucursal' name='formSucNom' value='".$item['nom_sucursal']."' required>
            </div>
        </div>

        <!-- /. form sucursal -->
    </div>

    <br>
    <hr>
    <div class='row'>
        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
            <button type='button' class='btn btn-outline-secondary btn-block disabled'><i class='fas fa-trash-alt'></i>
                Borrar</button>
        </div>
        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
            <button type='submit' class='btn btn-outline-danger btn-block'><i class='fas fa-pencil-alt'></i>
                Editar</button>
        </div>
    </div>
</fieldset>
    <!--/. form-->
</form>
";


?>