<?php
// Si no hay session redirecionamos al inicio
if(!isset($_SESSION["validar"])){
  echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}

// Creamos el controlador a utilizar.
$vista = new Controlador_MVC();

?>
<!-- Begin Page Header-->
<div class="row">
  <div class="page-header">
    <div class="d-flex align-items-center">
      <h1 class="page-header-title">Premios</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-ribbon-b"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->	

<?php 
// Si la session es modo admin mostramos el inicio del administrador.
if($_SESSION['rol']==1)
{
  
?>
<div class="row">
  	<div class="col-xl-12">
    	<!-- Sorting -->
      	<div class="widget has-shadow has-success alert alert-outline-success">
        	<div class="widget-header bordered no-actions d-flex align-items-center">
          		<h4 class="text-success">Lista de premios</h4>
        	</div>
        	<!-- End widget-header -->

        	<div class="widget-body">
          		<div class="table-responsive">		
				<?php
					// Vista de premios en modo admin
					$vista -> vistaPremiosController();
				?>
				</div>
				<!-- End table-responsive -->
			</div>
			<!-- End widget-body -->

	        <div class="widget-footer bordered no-actions d-flex align-items-center">
	          	<a class="btn btn-outline-success" href="index.php?action=registro-premio">
        			<i class="ion-ribbon-b"></i> Nuevo Premio
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
  // Sino, y la session es modo cliente, mostramos premios disponibles del cliente.
  $user = ClienteData::editarClienteModel($_SESSION['user'],'clientes');    
  
  ?>
  <div class="row flex-row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
      <h2 class="text-light">Tus puntos: </h2> <h1 class="text-danger"><?php echo $user['puntos']; ?></h1>
    </div>
  </div>
  <div class="row flex-row">
    <?php $vista -> vistaPremiosClienteController($user); ?>
  </div>
  <?php 
}?>