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
      <h1 class="page-header-title">Promociones</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-star"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->

<!-- Creamos el controlador -->
<?php $vista = new Controlador_MVC(); ?>

<?php
// Si la session es modo admin mostramos vista de administrador
if($_SESSION['rol']==1)
{

?>

<div class="row">
  <div class="col-xl-12">
    <!-- Sorting -->
      <div class="widget has-shadow has-info alert alert-outline-info">
        <div class="widget-header bordered no-actions d-flex align-items-center">
          <h4 class="text-info">Lista de promociones</h4>
        </div>
        <!-- End widget-header -->

        <div class="widget-body">
          <div class="table-responsive">	
				    <?php
				    
			      $vista -> vistaPromocionesController();
				    ?>
				  </div>
				  <!-- End table-responsive -->
			  </div>
			  <!-- End widget-body -->

        <div class="widget-footer bordered no-actions d-flex align-items-center">
          <a class="btn btn-outline-info" href="index.php?action=registro-promocion">
            <i class="ion-star"></i> Nueva Promocion
          </a>
        </div>
        <!-- End widget-footer -->  
		  </div>
      <!-- End Sorting -->
  </div>
  <!-- End col-xl-12 -->
</div>
<!-- End Row -->
<?php }else{
?>  
  <div class="row flex-row">
    <?php $vista -> vistaPromocionesClienteController(); ?>
  </div>
<?php
} ?>