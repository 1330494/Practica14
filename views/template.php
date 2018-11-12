<?php session_start(); ?>
<!DOCTYPE html>
<!--
Item Name: Elisyam - Web App & Admin Dashboard Template
Version: 1.5
Author: SAEROX

** A license must be purchased in order to legally use this template for your project **
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Kush - Wash Co.</title>
        <meta name="description" content="Kush-Wash Co. Es una empresa encargada del cuidado y atencion a tu vehiculo.">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
        
        <!-- Stylesheet -->
        <link rel="stylesheet" href="assets/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendors/css/base/elisyam-1.5-dark.min.css">
        <link rel="stylesheet" href="assets/css/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/owl-carousel/owl.theme.min.css">
        <link rel="stylesheet" href="assets/css/datatables/datatables.min.css">

        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
<body id="page-top">
         
    <?php 
      # Controlador MVC
      $controler = new Controlador_MVC();
      if (isset($_SESSION['validar'])) {
        //Cargamos contenido de la pagina
        echo '
        <!-- Begin Preloader -->
        <!--div id="preloader">
            <div class="canvas">
                <img src="assets/img/logo-2.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div-->
        <!-- End Preloader -->
        
        ';
        if ($_SESSION['rol']==1) {
            echo "<div class='page'>";
        }else{
            echo "<div class='db-smarthome page'>";
        }
        
            // Mostramos navegacion izquierda
            if ($_SESSION['rol']==1) {
                /* Navegacion */
                // Si hay sesion en 1, se muestra navegacion de administrador
                include 'moduls/Admin-navigation.php';
                
                echo '
                <!-- Begin Page Content -->
                <div class="page-content d-flex align-items-stretch">';
                include 'moduls/Left-Navigation.php';
                echo '
                <div class="content-inner">
                    <div class="container-fluid">';
                    // Cargamos vista del controlador
                    $controler -> linksController();
                echo '
                    </div>
                    <!-- End Container -->

                    <!-- Begin Page Footer-->
                    <footer class="main-footer">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-start justify-content-lg-start justify-content-md-start justify-content-center">
                                <p class="text-gradient-02">Design By Louis & Carl</p>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-center">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Kush-Wash Co.</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </footer>
                    <!-- End Page Footer -->
                    <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
                </div>
                <!-- End Content-inner -->';                    
            }else{
                // Si la sesion es 2, mostramos vista de cliente
                echo '
                <!-- Begin Page Content -->
                <div class="page-content">
                    <div class="content-inner boxed w-100">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-xl-9">';
                                include 'moduls/Left-Custom-Navigation.php';
                                // Cargamos vista del controlador
                                $controler -> linksController();
                echo '          
                                <!-- Begin Page Footer-->
                                <footer class="second-footer text-center">
                                    <p>Copyright © 2018 Kush-Wash Co. - Design by Louis & Carl</p>
                                    <ul class="nav mt-3 justify-content-center">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Acerca de nosotros.</a>
                                        </li>
                                    </ul>
                                </footer>
                                <!-- End Page Footer -->
                                </div> 
                                <!-- End col-xl-9 -->
                            </div> 
                            <!-- End row -->
                        </div> 
                        <!-- End container-fluid -->
                        <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
                    </div> 
                    <!-- End Content-inner -->
                </div> 
                <!-- End page-content -->';
            }

        echo '
        </div>
        <!-- End Page o Smarthome -->';
      }else{
        // Si no hay sesion se muestra formulario para login
        $controler -> showLoginPage();
      }

    ?>

    <!-- REQUIRED SCRIPTS -->
    <!-- Begin Vendor Js -->
    <script src="assets/vendors/js/base/jquery.min.js"></script>
    <script src="assets/vendors/js/base/jquery.ui.min.js"></script>
    <script src="assets/vendors/js/base/core.min.js"></script>
    <!-- End Vendor Js -->
    <!-- Begin Page Vendor Js -->
    <script src="assets/vendors/js/nicescroll/nicescroll.min.js"></script>
    <script src="assets/vendors/js/chart/chart.min.js"></script>
    <script src="assets/vendors/js/progress/circle-progress.min.js"></script>
    <script src="assets/vendors/js/calendar/moment.min.js"></script>
    <script src="assets/vendors/js/calendar/fullcalendar.min.js"></script>
    <script src="assets/vendors/js/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/vendors/js/app/app.js"></script>
    <script src="assets/vendors/js/datatables/datatables.min.js"></script>
    <script src="assets/vendors/js/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/vendors/js/datatables/jszip.min.js"></script>
    <script src="assets/vendors/js/datatables/buttons.html5.min.js"></script>
    <script src="assets/vendors/js/datatables/pdfmake.min.js"></script>
    <script src="assets/vendors/js/datatables/vfs_fonts.js"></script>
    <script src="assets/vendors/js/datatables/buttons.print.min.js"></script>
    <!-- End Page Vendor Js -->
    
    <?php if (isset($_SESSION['validar'])): ?>
        <?php if ($_SESSION['rol']==1): ?>
            <!-- Begin Page Snippets -->
            <script src="assets/js/dashboard/db-default-dark.js"></script>
            <script src="assets/js/components/tables/tables.js"></script>
            <!-- End Page Snippets -->
        <?php endif ?>
         <?php if ($_SESSION['rol']==2): ?>
            <!-- Begin Page Snippets -->
            <script src="assets/js/dashboard/db-smarthome-dark.min.js"></script>
            <script src="assets/js/components/music/music-player.min.js"></script>
            <!-- End Page Snippets -->
        <?php endif ?>    
    <?php endif ?>
  </body>
</html>
