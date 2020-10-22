<!DOCTYPE html>
<html lang="en">

<head>
    <?php  include("assets/common/bg.php");?>
    <?php  include("assets/common/header.php");?>
    <title> Centro de Servicio FMA | Login</title>
</head>

<body <?php echo $bgn; ?>>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-8 col-lg-10 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row card-color">

                            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-5 col-xs-5">
                                <div class="p-4">
                                    <div class="text-center">
                                        <center><img src="assets\img\Logo\logo.webp" class="mx-auto d-block"
                                                style="width: 100%;" onContextMenu="return false;" draggable="false" />
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-6 col-sm-7 col-xs-7">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Centro de Servicio</h1>
                                    </div>
                                    <form class="user" action="./assets/controler/login.php" method="POST">
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg" name="formUser"
                                                placeholder="Usuario" required>
                                        </div>

                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-key"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control form-control-lg" name="formPass"
                                                placeholder="Contraseña" aria-describedby="passwordHelpInline" required>
                                        </div>
                                        <br>

                                        <button type="submit" class="btn btn-outline-danger btn-block btn-lg"><i
                                                class="fas fa-paper-plane"></i> Inicio Sesion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- Alerts! -->
    <?php if(isset($_GET['alert']) && $_GET['alert']==0){ ?>
        <script>
            toastr["success"]("Vuelve Pronto! 😃")
        </script>
    <?php } if(isset($_GET['alert']) && $_GET['alert']==1){?>
        <script>
            toastr["error"]("Error al iniciar sesión intenta de nuevo 😅")
        </script>
    <?php } ?>
</body>

</html>