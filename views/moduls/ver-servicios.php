<?php
// Si no hay session redirecionamos al inicio
if(!isset($_SESSION["validar"])){
  echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}
?>
<!-- Begin Page Header-->
<div class="row">
  <div class="page-header">
    <div class="d-flex align-items-center">
      <h1 class="page-header-title">Servicios</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php?action=inicio"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-wrench"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<?php
// Si la session es modo admin [1] mostramos vista para administrador
if($_SESSION['rol']==1)
{
 
?>

<div class="row">
    <div class="col-xl-12">
        <!-- Widget de servicios -->
        <div class="widget has-shadow has-warning alert alert-outline-warning">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h2 class="text-warning">Lista de Servicios</h2>
            </div>
            <!-- End widget-header -->

            <div class="widget-body">
                <div class="table-responsive">
        				<?php
        				$vistaServicios = new Controlador_MVC();
        				$vistaServicios -> vistaServiciosController();
        				?>
              	</div>
      			
            </div>
            <!-- End widget-body --> 

            <div class="widget-footer bordered no-actions d-flex align-items-center">
                  <a class="btn btn-outline-warning" href="index.php?action=registro-servicio">
                  <i class="ion-wrench"></i> Nuevo Servicio
                </a>
            </div>
            <!-- End widget-footer -->  		
		  </div>
      <!-- End widget -->
    </div>
    <!-- End col-xl-12 -->
</div>
<!-- End Row -->
<?php }else{
  $servicios = ServicioData::viewServiciosModel('servicios');
  ?>
  <div class="row flex-row">
    <?php foreach ($servicios as $servicio): ?>
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 ">
        <div class="widget widget-23 bg-gradient-05 d-flex justify-content-center align-items-center alert alert-outline-warning">
          <div class="widget-body text-center ">
            <i class="ion-wrench text-warning"></i>
            <div class="title text-success"><?php echo strtoupper( $servicio['nombre']); ?></div>
            <div class="number text-light"><?php echo $servicio['descripcion']; ?></div>
            <div class="text-center mt-3 mb-3">
                <button type="button" class="btn btn-info has-shadow">
                    Visitanos
                </button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
  <?php
} ?>