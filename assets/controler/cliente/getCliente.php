<?php
session_start();
include("../conexion.php");
$id = $_GET['id'];

$query = "SELECT * FROM tab_cliente WHERE id_cliente = " . $id;
$resultSet = mysqli_query($con, $query) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo "
<form class='form' id='cleanForm' action='assets/controler/cliente/modCli.php' method='POST'>
    <fieldset class='border p-2'>
        <legend class='w-auto'>Datos del Cliente:</legend>
    <div class='row'>

        <input type='hidden' class='form-control' placeholder='Id cliente' name='formCliId' value='".$item[id_cliente]."' required>

        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
            <label>Cliente:</label>
            <div class='input-group '>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>
                        <i class='fas fa-user-alt'></i>
                    </span>
                </div>
                <input type='text' class='form-control' placeholder='Nombre cliente' name='formCliNom' value='".$item[nom_cliente]."' required>
            </div>
        </div>

        <!--Campo Domicilio -->
        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
            <label>Domicilio:</label>
            <div class='input-group '>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>
                        <i class='fas fa-home'></i>
                    </span>
                </div>
                <input type='text' class='form-control' placeholder='Domicilio cliente' name='formCliDom' value='".$item[dir_cliente]."' required>
            </div>
        </div>

    </div>

    <div class='row'>
    <!--Campo municipio -->
    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
        <label>Municipio:</label>
        <div class='input-group'>
            <div class='input-group-prepend'>
                <span class='input-group-text'>
                    <i class='fas fa-map-marker-alt'></i>
                </span>
            </div>
            <input type='text' class='form-control' placeholder='Municipio' name='formCliMun'  value='".$item[mun_cliente]."' required />
        </div>
    </div>

    <!--Campo Codigo Postal -->
    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
        <label>Codigo Postal:</label>
        <div class='input-group'>
            <div class='input-group-prepend'>
                <span class='input-group-text'>
                    <i class='fas fa-hashtag'></i>
                </span>
            </div>
            <input type='text' class='form-control' placeholder='Codigo Postal' name='formCliCP' value='".$item[cp_cliente]."' required />
        </div>
    </div>
    </div>

    <div class='row'>

        <!--Campo Teléfono -->
        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
            <label>Teléfono:</label>
            <div class='input-group '>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>
                        <i class='fas fa-phone-alt'></i>
                    </span>
                </div>
                <input type='tel' class='form-control' placeholder='Teléfono cliente' name='formCliTel' value='".$item[tel_cliente]."' required>
            </div>
        </div>

        <!--Campo RFC -->
        <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
            <label>RFC:</label>
            <div class='input-group '>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>
                        <i class='fas fa-address-card'></i>
                    </span>
                </div>
                <input type='text' class='form-control' placeholder='RFC cliente' name='formCliRfc' value='".$item[rfc_cliente]."' required>
            </div>
        </div>

        <!-- /. form cliente -->
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

mysqli_close($con);
?>