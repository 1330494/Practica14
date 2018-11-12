<?php 
$user = ClienteData::editarClienteModel($_SESSION['user'],'clientes');
$visitas = count(VisitaData::viewVisitasClienteModel($user['id'],'visitas'));
$imagen = '';
if ($user['imagen']) {
    $imagen = "clientes/".$user['imagen'];
}else{
    $imagen = "assets/img/avatar/avatar-01.jpg";
}
?>
<!-- Begin Header -->
<header class="header">
    <nav class="navbar">         
        <!-- Begin Topbar -->
        <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
            <!-- Begin Logo -->
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">
                    <div class="brand-image brand-big">
                        <img src="assets/img/logo-big-2.png" alt="logo" class="logo-big">
                    </div>
                    <div class="brand-image brand-small">
                        <img src="assets/img/logo-2.png" alt="logo" class="logo-small">
                    </div>
                </a>
            </div>
            <!-- End Logo -->
            <!-- Begin Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                <!-- User -->
                <li class="nav-item dropdown">
                    <a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                        <span class="badge-pulse-green"></span>
                        <img src="<?php echo $imagen ?>" alt="..." class="avatar rounded-circle">

                    </a>
                    <ul aria-labelledby="user" class="user-size dropdown-menu">
                        <li class="welcome">
                            <a href="#" class="edit-profil"><i class="la la-eye"></i></a>
                            <img src="<?php echo $imagen ?>" alt="..." class="img-fluid rounded-circle">
                        </li>
                        <li>
                            <a href="index.php?action=editar-cliente&idCliente=<?php echo $user['id'] ?>" class="dropdown-item"> 
                                Perfil
                            </a>
                            <a href="index.php?action=horario" class="dropdown-item"> 
                                Horario
                            </a>
                            <a href="index.php?action=como-llegar" class="dropdown-item"> 
                                Como llegar
                            </a>
                        </li>
                        <li class="separator"></li>
                        <li>
                            <a href="index.php?action=nosotros" class="dropdown-item no-padding-top"> 
                                Acerca de
                            </a>
                        </li>
                        <li><a rel="nofollow" href="index.php?action=salir" class="dropdown-item logout text-center"><i class="ti-power-off"></i></a></li>
                    </ul>
                </li>
                <!-- End User -->
                <!-- Begin Quick Actions -->
                <li class="nav-item"><a href="#off-canvas" class="open-sidebar "><i class="la la-cog"></i></a></li>
                <!-- End Quick Actions -->
            </ul>
            <!-- End Navbar Menu -->
        </div>
        <!-- End Topbar -->
    </nav>
</header>
<!-- End Header -->

<!-- Offcanvas Sidebar -->
<div class="off-sidebar from-right ">
    <div class="off-sidebar-container mini bg-dark">
        <header class="off-sidebar-header bg-dark">
            <a href="#off-canvas" class="off-sidebar-close"></a>
        </header>
        <div class="off-sidebar-content offcanvas-scroll auto-scroll">
            <!-- Begin Detalles -->
            <div class="sidebar-heading text-center text-light">Detalles</div>
            <div class="widget-26">
                <div class="q-settings">
                    <div class="row m-0">

                        <div class="col-xl-12 text-center mt-0 bg-gradient-05 rounded-circle">
                            <i class="ion-key text-info"></i>
                            <div class="t-title text-light">ID</div>
                            <div class="mt-3">
                                <label>
                                    <strong>
                                    <?php if ($user['id']<9): ?>
                                        <?php echo "00".$user['id']; ?>
                                    <?php endif ?>
                                    <?php if ($user['id']>9 && $user['id']<99): ?>
                                        <?php echo "0".$user['id']; ?>
                                    <?php endif ?>
                                    <?php if ($user['id']>99): ?>
                                        <?php echo $user['id']; ?>
                                    <?php endif ?>
                                    </strong>
                                    <span>
                                        <span></span>
                                    </span>                                    
                                </label>
                            </div>
                        </div>

                        <div class="col-xl-12 text-center mt-4 bg-gradient-05 rounded-circle">
                            <i class="ion-flash-off text-success"></i>
                            <div class="t-title text-light">Puntos</div>
                            <div class="mt-3">
                                <label>
                                    <strong>
                                    <?php echo $user['puntos']; ?>
                                    </strong>
                                    <span>
                                        <span></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-xl-12 text-center mt-4 bg-gradient-05 rounded-circle">
                            <i class="ion-location text-danger"></i>
                            <div class="t-title text-light">Visitas</div>
                            <div class="mt-3">
                                <label>
                                    <strong>
                                    <?php echo $visitas; ?>
                                    </strong>
                                    <span>
                                        <span></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Offcanvas Container -->
    </div>
    <!-- End Offsidebar Container -->
</div>
<!-- End Offcanvas Sidebar -->
        