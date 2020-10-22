<?php session_start();  include("../conexion.php");?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <h4>Centro De Servicio</h4>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-inline d-lg-inline text-gray-600 small"><?php echo $_SESSION['name_user'];?></span>
                <img class="img-profile rounded-circle" src="assets/img/Avatar/man (1).png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confModal">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configuración
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Salir
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-left-danger shadow ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar sesion</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona <b>"Salir"</b> si deseas terminar la sesion.</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary " type="button" data-dismiss="modal"><i
                            class="fas fa-times"></i> Cancelar</button>
                    <a class="btn btn-outline-danger  " href="../CentroServicio/assets/controler/lockout.php"><i
                            class="fas fa-door-open"></i> Salir</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Conf Modal-->
<div class="modal fade" id="confModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-left-danger shadow ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Configuración</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <?php 
                $sql = "SELECT * FROM tab_users WHERE code_user=".$_SESSION['code_user'];
                $resultado = mysqli_query($con, $sql) or die("Error de consulta");
                $user = mysqli_fetch_array($resultado);
                
                print_r($user); 
                
                
                ?>
                
                <form class="form" id="cleanForm" action="assets/controler/usuario/altaUsuario.php"
                                        method="POST">

                                        <!-- form usuario -->
                                        <fieldset class='border p-2'>
                                            <legend class='w-auto'>Cambiar contraseña:</legend>
                                            <div class="row">



                                                <!--Campo Nombre -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Nombres:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Nombre"
                                                            name="formUseNom" required>
                                                    </div>
                                                </div>

                                                <!--Campo usuario -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Usuario:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Usuario"
                                                            name="formUseUsu" required>
                                                    </div>
                                                </div>

                                                <!--Campo Contraseña -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Contraseña:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control" placeholder="Contraseña"
                                                            name="formUseCon" aria-describedby="passwordHelpInline" required>
                                                    </div>
                                                </div>

                                                <!--Campo Privilegios -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Privilegios:</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-tag"></i>
                                                            </span>
                                                        </div>
                                                        <select name="fromUsePriv" class="custom-select" required>
                                                            <option value="" selected disabled>SELECCIONE UNO
                                                            </option>
                                                            <option value="1">ADMINISTRADOR</option>
                                                            <option value="2">VENDEDOR/MOSTRADOR</option>
                                                            <option value="3">TALLER/TÉCNICO</option>
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
                                                    <button type="submit" class="btn btn-outline-danger btn-block"><i
                                                            class="fas fa-paper-plane"></i> Enviar</button>
                                                </div>
                                            </div>

                                            <!--/. form-->
                                        </fieldset>
                                    </form>





                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary " type="button" data-dismiss="modal"><i
                            class="fas fa-times"></i> Cancelar</button>
                    <button type="button" class="btn btn-outline-danger "><i class="fas fa-save"></i>
                        Guardar</button>

                </div>
            </div>
        </div>
    </div>
</div>