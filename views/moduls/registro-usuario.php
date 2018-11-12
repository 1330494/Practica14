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
      <h1 class="page-header-title">Nuevo Usuario</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php?action=inicio"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item ">
            <a href="index.php?action=ver-usuarios"> <i class="ion-person-stalker"></i></a> 
          </li>
          <li class="breadcrumb-item active">
            <i class="ion-person-add"></i>
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
          <strong>Exito!</strong> Nuevo usuario registrado.
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
          window.location = "index.php?action=ver-usuarios";
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
          <h2 ><i class="ion-person-add text-danger" style="font-size: 40px;"></i></h2>
        </center>
      </div>

      <!-- form start -->
      <form role="form" method="POST">
      <div class="widget-body">        
        <label class="text-danger">Usuario:</label>
        <div class="input-group mb-3 has-danger">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-person text-danger"></i></span>
          </div>
          <input type="text" id="usuario" name="usuario" placeholder="Usuario" required class="form-control">
        </div>

        <label class="text-danger">Contraseña:</label>
        <div class="input-group mb-3 has-danger">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ti ti-key text-danger"></i></span>
          </div>
          <input type="password" id="PW1" name="password1" placeholder="Contraseña" required class="form-control">
        </div>

        <label class="text-danger">Confirmar contraseña:</label>
        <div class="input-group mb-3 has-danger">
          <div class="input-group-prepend ">
            <span class="input-group-text"><i class="ti ti-key text-danger"></i></span>
          </div>
          <input type="password" id="PW2" name=password2" placeholder="Confirmar contraseña" required class="form-control">
        </div>

        <script type="text/javascript">
          document.getElementById("PW2").onchange = function(e){
            var PW1 = document.getElementById("PW1");
            if(this.value != PW1.value ){
              alert("Contraseñas no coinciden.");
              PW1.focus();
              this.value = "";
            }
          };
        </script>
                   
      </div>
      <!-- End widget-body -->

      <div class="widget-footer bordered no-actions align-items-center">
        <center> 
          <button type="submit" name="GuardarUsuario" class="btn btn-outline-danger"> 
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
$registro -> nuevoUsuarioController();

?>