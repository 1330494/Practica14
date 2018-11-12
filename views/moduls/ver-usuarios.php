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
      <h1 class="page-header-title">Usuarios</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-person-stalker"></i>
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
        <div class="widget has-shadow has-danger alert alert-outline-danger">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h2 class="text-danger">Lista de usuarios</h2>
            </div>
            <!-- End widget-header -->

            <div class="widget-body">
                <div class="table-responsive">
        				<?php

        				$vistaUsuarios = new Controlador_MVC();
        				$vistaUsuarios -> vistaUsuariosController();

        				?>
      				</div>
      				<!-- End table-responsive -->					
			      </div>
            <!-- End widget-body -->
            
      			<div class="widget-footer bordered no-actions d-flex align-items-center">
                <a class="btn btn-outline-danger" href="index.php?action=registro-usuario">
      			      <i class="ion-person-add"></i> Nuevo Usuario
      			    </a>
            </div>
            <!-- End widget-footer -->			
		  </div>
      <!-- End Sorting -->
    </div>
    <!-- End col-xl-12 -->
</div>
<!-- End Row -->