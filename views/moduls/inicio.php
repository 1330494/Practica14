<?php
if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}

// Creamos el controlador
$control = new Controlador_MVC();
$contadores = $control->DataBaseTablesCounterController();

// Si rol es igual a 1, modo administrador
if($_SESSION['rol']==1){


 
?>

<!-- Begin Page Header-->
<div class="row">
  <div class="page-header">
    <div class="d-flex align-items-center">
      <h1 class="page-header-title">Inicio</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item active">
            <i class="ti ti-home"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->

<div class="row flex-row">

  <!-- Begin Servicios -->
  <div class="col-xl-4 col-md-6 col-sm-6">
    <a href="index.php?action=ver-servicios">
      <div class="widget widget-12 has-shadow">
          <div class="widget-body">
              <div class="media">
                  <div class="align-self-center ml-5 mr-5">
                    <i class="ion-wrench text-warning"></i>
                  </div>
                  <div class="media-body align-self-center">
                      <div class="title text-warning">Servicios</div>
                      <div class="number"><?php echo $contadores['servicios']; ?> Registros</div>
                  </div>
              </div>
          </div>
      </div>
    </a>
  </div>
  <!-- End Servicios -->

  <!-- Begin Clientes -->
  <div class="col-xl-4 col-md-6 col-sm-6">
    <a href="index.php?action=ver-clientes">
      <div class="widget widget-12 has-shadow">
          <div class="widget-body">
              <div class="media">
                  <div class="align-self-center ml-5 mr-5">
                      <i class="ion-model-s text-primary"></i>
                  </div>
                  <div class="media-body align-self-center">
                      <div class="title text-primary">Clientes</div>
                      <div class="number"><?php echo $contadores['clientes']; ?> Registros</div>
                  </div>
              </div>
          </div>
      </div>
    </a>
  </div>
  <!-- End Clientes -->

  <!-- Begin Premios -->
  <div class="col-xl-4 col-md-6 col-sm-6">
    <a href="index.php?action=ver-premios">
      <div class="widget widget-12 has-shadow">
          <div class="widget-body">
              <div class="media">
                  <div class="align-self-center ml-5 mr-5">
                      <i class="ion-ribbon-b text-success"></i>
                  </div>
                  <div class="media-body align-self-center">
                      <div class="title text-success">Premios</div>
                      <div class="number"><?php echo $contadores['premios']; ?> Registros</div>
                  </div>
              </div>
          </div>
      </div>
    </a>
  </div>
  <!-- End Premios -->

  <!-- Begin Promociones -->
  <div class="col-xl-4 col-md-6 col-sm-6">
    <a href="index.php?action=ver-promociones">
      <div class="widget widget-12 has-shadow">
          <div class="widget-body">
              <div class="media">
                  <div class="align-self-center ml-5 mr-5">
                      <i class="ion-star text-info"></i>
                  </div>
                  <div class="media-body align-self-center">
                      <div class="title text-info">Promociones</div>
                      <div class="number"><?php echo $contadores['promociones']; ?> Registros</div>
                  </div>
              </div>
          </div>
      </div>
    </a>
  </div>
  <!-- End Promociones -->

  <!-- Begin Usuarios -->
  <div class="col-xl-4 col-md-6 col-sm-6">
    <a href="index.php?action=ver-usuarios">
      <div class="widget widget-12 has-shadow">
          <div class="widget-body">
              <div class="media">
                  <div class="align-self-center ml-5 mr-5">
                      <i class="ion-person-stalker text-danger"></i>
                  </div>
                  <div class="media-body align-self-center">
                      <div class="title text-danger">Usuarios</div>
                      <div class="number"><?php echo $contadores['usuarios']; ?> Registros</div>
                  </div>
              </div>
          </div>
      </div>
    </a>
  </div>
  <!-- End Usuarios -->

  <!-- Begin Visitas -->
  <div class="col-xl-4 col-md-6 col-sm-6">
    <a href="index.php?action=ver-visitas">
      <div class="widget widget-12 has-shadow">
          <div class="widget-body">
              <div class="media">
                  <div class="align-self-center ml-5 mr-5">
                      <i class="ion-location text-facebook"></i>
                  </div>
                  <div class="media-body align-self-center">
                      <div class="title text-facebook">Visitas</div>
                      <div class="number"><?php echo $contadores['visitas']; ?> Registros</div>
                  </div>
              </div>
          </div>
      </div>
    </a>
  </div>
  <!-- End Visitas -->
</div>

<?php 
}else{
  // Si session es igual a 2 0 $_SESSION['rol']!=1 mostramos vista para el cliente.
  $user = ClienteData::editarClienteModel($_SESSION['user'],'clientes');
  $visitas = count(VisitaData::viewVisitasClienteModel($_SESSION['user'],'visitas'));
  $premios_disponibles = count(PremioData::verPremiosDisponiblesModel($user['puntos'],'premios'));
  $servicios = count(ServicioData::viewServiciosModel('servicios'));
  $promociones = count(PromocionData::viewPromocionesModel('promociones'));
  ?>
<!-- Begin Page Header-->
<div class="row flex-row">
    <div class="page-header mt-3">
        <div class="row d-flex align-items-center">
            <div class="col-xl-12 col-lg-12 col-md-12 d-flex justify-content-xl-center justify-content-lg-center justify-content-md-center justify-content-center">
                <h1 class="page-header-title text-danger" style="margin-right: 0 !important;">Bienvenido <?php echo $user['nombre']; ?></h1>
            </div>
        </div>
    </div>
</div>
<!-- End Page Header --> 

<!-- Begin Row -->
<div class="row d-flex align-items-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-xl-center justify-content-lg-center justify-content-md-center justify-content-center">
        <div class="widget no-bg">
          <!-- Begin Widget Header -->
          <div class="widget-header d-flex align-items-center">
            <h2 class="text-facebook"><i class="meteocons-cloudy3"></i> El Clima</h2>
          </div>
          <!-- End Widget Header -->
          <!-- www.tutiempo.net - Ancho:477px - Alto:91px -->
          <div class="has-shadow" id="TT_FCT1kkE1kB8BYFhUKAzDjDzzD6nULz1Fbt1tkcyoaEjImomo3">
            ChinoTimes - Tutiempo.net
          </div>
          <script type="text/javascript" src="https://www.tutiempo.net/s-widget/l_FCT1kkE1kB8BYFhUKAzDjDzzD6nULz1Fbt1tkcyoaEjImomo3"></script>  
        </div>
    </div>
</div>
<!-- End Row -->

<!-- Begin Row -->
<div class="row flex-row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
    <div class="widget-32 widget-image bg-image">
        <div class="overlay"></div>
        <div class="content">
            <div id="events-day"></div>
            <div id="events-date"></div>
            <div id="events-year"></div>
        </div>
        <div class="real-time">
            <div id="events-time"></div>
        </div>
    </div>
  </div>
  <div class="col-xl-9">
    <!-- Start Row-Flex -->
    <div class="row">

      <!--Seccion de Mis Visitas -->
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="widget-31 widget has-shadow">
            <div class="widget-body conso">
                <a href="index.php?action=ver-visitas">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <div class="conso-title">
                            <div class="title">Mis Visitas</div>
                        </div>
                    </div>
                    <!-- Begin Progress -->
                    <div class="col-xl-5 d-flex justify-content-center">
                        <div class="water"><canvas width="100" height="100"></canvas>
                            <div class="percent"><?php echo $visitas ?><i></i></div>
                        </div>
                    </div>
                    <!-- End Progress -->
                </div>
                <i class="icon-big ion-location"></i>
                </a>
            </div>
        </div>
      </div>


      <!--Seccion de Premios-->
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="widget-31 widget has-shadow">
            <div class="widget-body conso">
                <a href="index.php?action=ver-premios">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <div class="conso-title">
                            <div class="title">Premios</div>
                        </div>
                    </div>
                    <!-- Begin Progress -->
                    <div class="col-xl-5 d-flex justify-content-center">
                        <div class="water"><canvas width="100" height="100"></canvas>
                            <div class="percent"><?php echo $premios_disponibles ?><i>disponibles</i></div>
                        </div>
                    </div>
                    <!-- End Progress -->
                </div>
                <i class="icon-big ion-ribbon-b"></i>
                </a>
            </div>
        </div>
      </div>

      <!--Seccion de Promociones-->
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="widget-31 widget has-shadow">
            <div class="widget-body conso">
                <a href="index.php?action=ver-promociones">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <div class="conso-title">
                            <div class="title">Promociones</div>
                        </div>
                    </div>
                    <!-- Begin Progress -->
                    <div class="col-xl-5 d-flex justify-content-center">
                        <div class="water"><canvas width="100" height="100"></canvas>
                            <div class="percent"><?php echo $promociones ?><i>disponibles</i></div>
                        </div>
                    </div>
                    <!-- End Progress -->
                </div>
                <i class="icon-big ion-star"></i>
                </a>
            </div>
        </div>
      </div>

      <!--Seccion de Servicios-->
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="widget-31 widget has-shadow">
            <div class="widget-body conso">
                <a href="index.php?action=ver-servicios">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <div class="conso-title">
                            <div class="title">Servicios</div>
                        </div>
                    </div>
                    <!-- Begin Progress -->
                    <div class="col-xl-5 d-flex justify-content-center">
                        <div class="water"><canvas width="100" height="100"></canvas>
                            <div class="percent"><?php echo $servicios ?><i>disponibles</i></div>
                        </div>
                    </div>
                    <!-- End Progress -->
                </div>
                <i class="icon-big ion-wrench"></i>
                </a>
            </div>
        </div>
      </div>

    </div>
    <!-- End Row-Flex -->
  </div>
</div>
<!-- End Row -->
<?php } ?>