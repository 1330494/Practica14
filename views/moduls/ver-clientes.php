<?php
// Si no hay session redirecionamos al inicio
if(!isset($_SESSION["validar"])){
  echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}
// Si la session no es modo admin redirecionamos al inicio
if($_SESSION['rol']!=1)
{
  echo "<script type='text/javascript'>
    window.location = 'index.php?action=inicio';
  </script>";
}
?>
<!-- Begin Page Header-->
<div class="row">
  <div class="page-header">
    <div class="d-flex align-items-center">
      <h1 class="page-header-title">Clientes</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-model-s"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->

<div class="row">
    <div class="col-xl-12">
        <!-- Sorting -->
        <div class="widget has-shadow has-primary alert alert-outline-primary">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h2 class="text-primary">Lista de clientes</h2>
            </div>
            <!-- End widget-header -->

            <div class="widget-body">
                <div class="table-responsive">
				<?php
				$vistaClientes = new Controlador_MVC();
				$vistaClientes -> vistaClientesController();
				?>
            	</div>
      			<div class="widget-footer bordered no-actions d-flex align-items-center">
                	<a class="btn btn-outline-primary" href="index.php?action=registro-cliente">
      			      <i class="ion-model-s"></i> Nuevo Cliente
      			    </a>
            </div>
            <!-- End widget-footer -->			
		  </div>
      <!-- End Sorting -->
    </div>
    <!-- End col-xl-12 -->
</div>
<!-- End Row -->