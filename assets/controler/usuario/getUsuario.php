<?php
session_start();
include("../conexion.php");
$id = $_GET['id'];

$query = "SELECT * FROM tab_users WHERE code_user = " . $id;
$resultSet = mysqli_query($con, $query) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

if ($item['priv_user']==1) {
    $administrador= "selected";
    $mostrador = "";
    $tecnico = "";
}elseif ($item['priv_user']==2) {
    $administrador= "";
    $mostrador = "selected";
    $tecnico = "";
}else {
    $administrador= "";
    $mostrador = "";
    $tecnico = "selected";
}

echo '
<form class="form" id="cleanForm" action="assets/controler/usuario/modUsuario.php" method="POST">

<!-- form usuario -->
<fieldset class="border p-2">
    <legend class="w-auto">Datos del personal:</legend>
    <div class="row">

        <input type="hidden" class="form-control" name="formUseId" required value='. $item['code_user'] .'>

        <!--Campo Nombre -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Nombres:</label>
            <div class="input-group ">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user-alt"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="Nombre" name="formUseNom" required value="'. $item['name_user'] .'">
            </div>
        </div>

        <!--Campo usuario -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <label>Usuario:</label>
            <div class="input-group ">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user-alt"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="Usuario" name="formUseUsu" required value="'. $item['nick_user'] .'">
            </div>
        </div>
 
        <!--Campo Sucursal -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <label>Sucursal:</label>
            <div class="input-group ">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-store-alt"></i>
                    </span>
                </div>
                <select name="formUseSuc" class="custom-select" required>';
                $listSuc = "SELECT * FROM tab_sucursal ORDER BY nom_sucursal ASC";
                $rsSuc = mysqli_query($con, $listSuc) or die("Error de consulta");
                while ($itemSuc = mysqli_fetch_array($rsSuc)) {
                    if ($item['sucursal_user']==$itemSuc['nom_sucursal']) {
                        $selected="selected";
                    }else{
                        $selected="";
                    }
                    echo "<option value='" . $itemSuc[1] . "' $selected >" . $itemSuc[1] . "</option>";
                } 
                echo '
                </select>
                </div>
        </div>

        <!--Campo Contraseña -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Contraseña:</label>
            <div class="input-group ">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
                <input type="password" class="form-control" aria-describedby="passwordHelpInline" required value="Esta un es una contraseña" readonly="yes">
            </div>
        </div>

        <!--Campo Privilegios -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <label>Privilegios:</label>
            <div class="input-group ">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-id-card-alt"></i>
                    </span>
                </div>
                <select name="fromUsePriv" class="custom-select" required>
                    <option value="1" '.$administrador.'>ADMINISTRADOR</option>
                    <option value="2" '.$mostrador.'>VENDEDOR/MOSTRADOR</option>
                    <option value="3" '.$tecnico.'>TALLER/TÉCNICO</option>
                </select>
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
</form>
';

mysqli_close($con);
?>