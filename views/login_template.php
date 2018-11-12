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
        <title>Elisyam - Login</title>
        <meta name="description" content="Chino Louis es la mera paipa">
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
        <link rel="stylesheet" href="assets/vendors/css/base/elisyam-1.5.min.css">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body class="bg-white">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="assets/img/logo.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
       
        <!-- Begin Container -->
        <div class="container-fluid no-padding h-100">
            <div class="row flex-row h-100 bg-white">
                <!-- Begin Left Content -->
                <div class="col-xl-8 col-lg-6 col-md-5 no-padding">
                    <div class="elisyam-bg background-01">
                        <div class="elisyam-overlay overlay-01"></div>
                        <div class="authentication-col-content mx-auto">
                            <h1 class="gradient-text-01">
                                Bienvenido a Kush - Wash Co.!
                            </h1>
                            <span class="description">
                                El mejor servicio para el cuidado de tu auto. 
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Left Content -->
                <!-- Begin Right Content -->
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto no-padding">
                    <!-- Begin Form -->
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="index.php">
                                <img src="assets/img/logo.png" alt="logo">
                            </a>
                        </div>
                        <h3>Ingresar a Kush Wash Co.</h3>
                        <form method="POST" action="">
                            <div class="group material-input">
							    <input type="text" required name="usuarioIngreso">
							    <span class="highlight"></span>
							    <span class="bar"></span>
							    <label>Usuario/ID:</label>
                            </div>
                            <div class="group material-input">
							    <input type="password" required name="passwordIngreso">
							    <span class="highlight"></span>
							    <span class="bar"></span>
							    <label>Contraseña:</label>
                            </div>
                        
                        <div class="row">
                            <div class="col text-left">
                                <div class="styled-checkbox">
                                    <input type="checkbox" name="admin" id="remeber">
                                    <label for="remeber">Iniciar como administrador</label>
                                </div>
                            </div>
                            <div class="col text-right">
                                <a href="#">Olvidó su contraseña ?</a>
                            </div>
                        </div>
                        <div class="sign-btn text-center">                            
                            <button type="submit" name="SubmitUsuario" class="btn btn-lg btn-gradient-01">
                                <i class="ion-log-in"></i> Ingresar
                            </button>                              
                        </div>
                        </form>
                        <?php
                        $ingreso = new Controlador_MVC();
                        $ingreso -> SessionController();

                        if(isset($_GET["action"])){
                            if($_GET["action"] == "fallo"){
                            ?>
                            <br>
                            <div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <strong>Hey!</strong> Falló al ingresar.
                            </div>        
                            <?php
                            }
                            if($_GET["action"] == "salio"){
                            ?>
                            <br>
                            <div class="alert alert-info alert-dissmissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <strong>Logout!</strong> cerró sesion.
                            </div>        
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- End Form -->                        
                </div>
                <!-- End Right Content -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Container -->    
        <!-- Begin Vendor Js -->
        <script src="assets/vendors/js/base/jquery.min.js"></script>
        <script src="assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="assets/vendors/js/app/app.min.js"></script>
        <!-- End Page Vendor Js -->
    </body>
</html>
