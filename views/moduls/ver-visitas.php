<?php
// Si no hay session redirecionamos al inicio
if(!isset($_SESSION["validar"])){
  echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}
// Si la session es modo admin [1] mostramos opciones de administrador
if($_SESSION['rol']==1)
{

?>
<!-- Begin Page Header-->
<div class="row">
  <div class="page-header">
    <div class="d-flex align-items-center">
      <h1 class="page-header-title">Visitas</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-location"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->

<div class="row">
    <div class="col-xl-12 ">
        <!-- Sorting -->
        <div class="widget has-shadow has-info alert alert-outline-info">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h2 class="text-info">Lista de Visitas</h2>
            </div>
            <!-- End widget-header -->

            <div class="widget-body">
                <div class="table-responsive">
        				<?php

        				$vistaVisitas = new Controlador_MVC();
        				$vistaVisitas -> vistaVisitasController();

        				?>
      				</div>
      				<!-- End table-responsive -->					
			      </div>
            <!-- End widget-body -->
            
      			<div class="widget-footer bordered no-actions d-flex align-items-center">
                <a class="btn btn-outline-info" href="index.php?action=registro-visita">
      			      <i class="ion-location"></i> Registrar Visita
      			    </a>
            </div>
            <!-- End widget-footer -->			
		  </div>
      <!-- End Sorting -->
    </div>
    <!-- End col-xl-12 -->
</div>
<!-- End Row -->
<?php 
} else {
  $cliente = ClienteData::editarClienteModel($_SESSION['user'],'clientes');
  $visitas = VisitaData::viewVisitasClienteModel($cliente['id'],'visitas');
  $img = '';
  if (!$cliente['imagen']) {
    $img = 'assets/img/avatar/avatar-02.jpg';
  }else{
    $img = 'clientes/'.$cliente['imagen'];
  }
  ?>
  <!-- Begin Page Header-->
  <div class="row">
    <div class="page-header">
      <div class="d-flex align-items-center">
        <h1 class="page-header-title">Mis Visitas</h1>
        <div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item ">
              <a href="index.php?action=inicio"> <i class="ti ti-home"></i></a> 
            </li>
            <li class="breadcrumb-item active">
              <i class="ion-location"></i>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End Page Header -->  

  <div class="row flex-row">
  <?php if (count($visitas)==0): ?>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">      
      <div class="widget widget-18 has-shadow">
          <!-- Begin Widget Header -->
          <div class="widget-header bordered d-flex align-items-center">
            <h2 class="text-danger">Sin visitas. <i class="ti ti-face-sad"></i></h2>    
          </div>
      </div>
    </div>
  <?php endif ?>

  <?php if (count($visitas)!=0): ?>
    <?php $index = 1; ?>
    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 ">
      <div class="widget widget-18 has-shadow">
          <!-- Begin Widget Header -->
          <div class="widget-header bordered d-flex align-items-center">
              <h2>Lista - <?php $retVal = (count($visitas)==1) ? count($visitas)." Visita" : count($visitas)." Visitas" ; ?>
                <?php echo $retVal; ?>.
              </h2>            
          </div>
          <!-- End Widget Header -->
          <div class="widget-body">
              <ul class="list-group w-100 mt-2">
                  <?php foreach ($visitas as $visita): ?>
                    <li class="list-group-item">
                      <div class="new-message">
                        <div class="media">
                          <div class="media-left align-self-center mr-3">
                            <h4><?php echo $index; ?></h4>
                            <img src="<?php echo $img; ?>" alt="..." class="img-fluid rounded-circle" style="width: 50px;">
                          </div>
                          <div class="media-body align-self-center">
                            <div class="other-message-sender">
                              <h2 class="text-danger">
                                <?php echo Time::MEXICAN_FORMAT_DATE($visita['fecha']); ?>
                              </h2>
                            </div>
                            <div class="other-message-time">
                              <h3 class="text-warning">
                                <?php echo Time::MEXICAN_FORMAT_TIME($visita['hora']); ?>
                              </h3>
                            </div>
                          </div>
                          <div class="media-right align-self-center">
                            <div class="actions">
                                <a ><i class="la la-eye"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <?php $index++; ?>
                  <?php endforeach ?>
              </ul>
          </div>
      </div>
    </div>                  
  <?php endif ?>
  </div>

  <?php
}
  ?>




