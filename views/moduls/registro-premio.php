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
      <h1 class="page-header-title">Nuevo Premio</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php?action=inicio"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item ">
            <a href="index.php?action=ver-premios"> <i class="ion-ribbon-b"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-plus"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->

<?php 
if(isset($_GET["resp"])){
  if($_GET["resp"] == "ok"){
    ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-success alert-dissmissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
          <strong>Exito!</strong> Nuevo Premio registrado.
        </div>  
      </div>
    </div>
    <script type="text/javascript">
      var timer = 3;
      var idInterval = null;

      function time() {
        timer--;
        if (timer==0) {
          clearInterval(idInterval);
          window.location = "index.php?action=ver-premios";
        }
      }

      idInterval = setInterval(time,1000);  
    </script>
    <?php
  }
}
?>

<div class="row">
  <div class="col-lg-3"></div>
  <!-- End col-lg-3 -->
  
  <div class="col-lg-6">
  <!-- widget -->
    <div class="widget has-shadow">
      <div class="widget-header bordered no-actions align-items-center">
        <center>
          <h2 ><i class="ion-ribbon-b text-success" style="font-size: 40px;"></i> </h2>
        </center>
      </div>

      <!-- form start -->
      <form role="form" method="POST">
      <div class="widget-body">

        <label class="text-success">Nombre:</label>
        <div class="input-group mb-3 has-success">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-person text-success"></i></span>
          </div>
          <input type="text" id="usuario" name="nombrePremio" placeholder="Nombre" required class="form-control">
        </div>
	    
        <label class="text-success">Descripcion:</label>
        <div class="input-group mb-3 has-success">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-document-text text-success"></i></span>
          </div>
          <textarea name="descripcionPremio" class="form-control" placeholder="Descripcion..." required></textarea>
        </div>

        <label class="text-success">Puntos:</label>
        <div class="input-group mb-3 has-success">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-flash-off text-success"></i></span>
          </div>
          <input type="number" name="puntosPremio" class="form-control" placeholder="Puntos" required>
        </div>

      </div>
      <!-- End widget-body -->

      <div class="widget-footer bordered no-actions align-items-center">
        <center> 
          <button type="submit" name="GuardarPremio" class="btn btn-outline-success"> 
            <i class="ti ti-save"></i>  Guardar
          </button>
        </center>
      </div>
      <!-- End widget-body -->
      </form>      
    </div>
        <!-- End widget -->
  </div>
  <!-- End col-lg-6 -->

  <div class="col-lg-3"></div>
  <!-- End col-lg-3 -->

</div>
<!-- End Row -->  

<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevoPremioController();
?>