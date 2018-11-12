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
      <h1 class="page-header-title">Editar Horario</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php?action=inicio"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-clock"></i>
          </li>
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

  	$editarServicio = new Controlador_MVC();	
  	$editarServicio -> editarHorarioController();
  	$editarServicio -> actualizarHorarioController();

  	?>
    </div>
  	<!-- End col-lg-6 -->

	<div class="col-lg-3"></div>
	<!-- End col-lg-3 -->

</div>
<!-- End Row -->  