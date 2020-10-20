<?php session_start();?> 
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="inicio.php">
        <div class="sidebar-brand-icon">
            <center><img src="assets\img\Logo\logo.webp" class="img-responsive" style="width: 45px;" />
            </center>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Informe Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInforme"
            aria-expanded="true" aria-controls="collapseInforme">
            <i class="fas fa-fw fa-tachometer-alt"></i>
        </a>
        <div id="collapseInforme" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Heading -->
                <div class="sidebar-heading">
                    <span>Informe</span>
                </div>
                <!-- Item -->
                <a class="collapse-item" href="lobby.php">Informe</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Cliente Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCliente"
            aria-expanded="true" aria-controls="collapseCliente">
            <i class="fas fa-fw fa-address-book"></i>
        </a>
        <div id="collapseCliente" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Heading -->
                <div class="sidebar-heading">
                    <span>Cliente</span>
                </div>
                <!-- Item -->
                <a class="collapse-item" href="cliente.php">Nuevo Cliente</a>
                <a class="collapse-item" href="listaCliente.php">Lista Clientes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Orden Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrden" aria-expanded="true"
            aria-controls="collapseOrden">
            <i class="fas fa-fw fa-edit"></i>

        </a>
        <div id="collapseOrden" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Heading -->
                <div class="sidebar-heading">
                    <span>Orden</span>
                </div>
                <!-- Item -->
                <a class="collapse-item" href="orden.php">Nueva orden</a>
                <a class="collapse-item" href="listaOrden.php">Lista ordenes</a>
                <a class="collapse-item" href="listaPendiente.php">Ordenes Prendientes</a>
                <a class="collapse-item" href="listaCompleta.php">Ordenes Completas</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Prestamo Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePrestamo"
            aria-expanded="true" aria-controls="collapsePrestamo">
            <i class="fas fa-wrench"></i>
        </a>
        <div id="collapsePrestamo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Heading -->
                <div class="sidebar-heading">
                    <span>Prestamos</span>
                </div>
                <!-- Item -->
                <a class="collapse-item" href="herramienta.php">Alta Herramienta</a>
                <a class="collapse-item" href="prestamo.php">Nuevo Prestamo</a>
                <a class="collapse-item" href="listaPrestamo.php">Lista Prestamo</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Reportes Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes"
            aria-expanded="true" aria-controls="collapseReportes">
            <i class="fas fa-fw fa-clipboard"></i>
        </a>
        <div id="collapseReportes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Heading -->
                <div class="sidebar-heading">
                    <span>Reportes</span>
                </div>
                <!-- Item -->
                <a class="collapse-item" href="reportes.php">Reportes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Administrador Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdministrador"
            aria-expanded="true" aria-controls="collapseAdministrador">
            <i class="fas fa-fw fa-user-cog"></i>
        </a>
        <div id="collapseAdministrador" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Heading -->
                <div class="sidebar-heading">
                    <span>Administrador</span>
                </div>
                <!-- Item -->
                <a class="collapse-item" href="#.php">Alta Usuario</a>
                <a class="collapse-item" href="listaUsuario.php">Lista Usuario</a>
                <a class="collapse-item" href="#.php">Configuración</a>
            </div>
        </div>
    </li>

     <!-- Nav Item - Refacciones Collapse Menu -->
     <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRefacciones"
            aria-expanded="true" aria-controls="collapseRefacciones">
            <i class="fas fa-dolly"></i>
        </a>
        <div id="collapseRefacciones" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Heading -->
                <div class="sidebar-heading">
                    <span>Refacciones</span>
                </div>
                <!-- Item -->
                <a class="collapse-item" href="refaccion.php">Alta Refacciones</a>
                <a class="collapse-item" href="servicio.php">Alta Servicios</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Taller Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTaller" aria-expanded="true"
            aria-controls="collapseTaller">
            <i class="fas fa-toolbox"></i>

        </a>
        <div id="collapseTaller" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Heading -->
                <div class="sidebar-heading">
                    <span>Taller</span>
                </div>
                <!-- Item -->
                <a class="collapse-item" href="taller.php">Mesa de Trabajo</a>
                <a class="collapse-item" href="listaTaller.php">Ordenes Pendientes</a>
            </div>
        </div>
    </li>

</ul>