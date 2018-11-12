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

// Verificamos que el tipo de usuario a editar es la cuenta del admin u otro usuario
$type = '';
if ($_GET['idUsuario'] == $_SESSION['user']) {
  $type = "Perfil";
}else{
  $type = "Usuario";
}
?>


<!-- Begin Page Header-->
<div class="row">
  <div class="page-header">
    <div class="d-flex align-items-center">
      <h1 class="page-header-title">Editar <?php echo $type; ?></h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php?action=inicio"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item ">
            <a href="index.php?action=ver-usuarios"> <i class="ion-person-stalker"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-person"></i>
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

  	$editarUsuario = new Controlador_MVC();	
  	$editarUsuario -> editarUsuarioController();
  	$editarUsuario -> actualizarUsuarioController();

  	?>
    </div>
  	<!-- End col-lg-6 -->

	<div class="col-lg-3"></div>
	<!-- End col-lg-3 -->

</div>
<!-- End Row -->  