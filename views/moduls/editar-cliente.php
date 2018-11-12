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
  /*echo "<script type='text/javascript'>
    window.location = 'index.php?action=inicio';
  </script>";
  */
  $icon = "";
}

?>

<!-- Begin Page Header-->
<div class="row">
  <div class="page-header">
    <div class="d-flex align-items-center">
      <?php 
        if ($_SESSION['rol']==1) {
          echo '<h1 class="page-header-title">Editar Cliente</h1>';
        }else{
          echo '<h1 class="page-header-title">Editar Perfil</h1>';
        }
       ?>
      
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php?action=inicio"> <i class="ti ti-home"></i></a> 
          </li>

          <?php if ($_SESSION['rol']==1): ?>
            <li class="breadcrumb-item ">
              <a href="index.php?action=ver-clientes"> <i class="ion-model-s"></i></a> 
            </li>
            <li class="breadcrumb-item active">
              <i class="ion-edit"></i>
            </li>           
          <?php endif ?>

          <?php if ($_SESSION['rol']==2): ?>
            <li class="breadcrumb-item active">
              <i class="ion-edit"></i>
            </li>            
          <?php endif ?>          
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->

<div class="row">
 	<div class="col-lg-3"></div>
  	<!-- End col-lg-3 -->
  
  	<div class="col-lg-6">
	<?php 
	$editarCliente = new Controlador_MVC();	
	$editarCliente -> editarClienteController();
	$editarCliente -> actualizarClienteController();
	?>
	</div>
  	<!-- End col-lg-6 -->

	<div class="col-lg-3"></div>
	<!-- End col-lg-3 -->

</div>
<!-- End Row -->  