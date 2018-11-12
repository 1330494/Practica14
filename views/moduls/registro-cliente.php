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
      <h1 class="page-header-title">Nuevo Cliente</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php?action=inicio"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item ">
            <a href="index.php?action=ver-usuarios"> <i class="ion-model-s"></i></a> 
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
          <strong>Exito!</strong> Nuevo Cliente registrado.
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
          window.location = "index.php?action=ver-clientes";
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
          <h2 ><i class="ion-model-s text-primary" style="font-size: 40px;"></i> </h2>
        </center>
      </div>

      <!-- form start -->
      <form method="POST" enctype="multipart/form-data">
      <div class="widget-body">

        <label class="text-primary">Nombre:</label>
        <div class="input-group mb-3 has-primary">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-person text-primary"></i></span>
          </div>
          <input type="text" id="nombreCliente" name="nombreCliente" placeholder="Nombre" required class="form-control">
        </div>
	    
        <label class="text-primary">Apellidos:</label>
        <div class="input-group mb-3 has-primary">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-person text-primary"></i></span>
          </div>
          <input type="text" id="apellidosCliente" name="apellidosCliente" placeholder="Apellidos" required class="form-control">
        </div>

        <label class="text-primary">Direccion:</label>
        <div class="input-group mb-3 has-primary">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-card text-primary"></i></span>
          </div>
          <textarea name="direccionCliente" class="form-control" placeholder="Descripcion..." required></textarea>
        </div>

        <label class="text-primary">Telefono:</label>
        <div class="input-group mb-3 has-primary">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="la la-phone text-primary"></i></span>
          </div>
          <input type="number" id="telefonoCliente" min="1111111111" max="9999999999" name="telefonoCliente" placeholder="Telefono" required class="form-control">
        </div>

        <label class="text-primary">Password:</label>
        <div class="input-group mb-3 has-primary">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-key text-primary"></i></span>
          </div>
          <input type="password" id="passwordCliente" name="passwordCliente" placeholder="Password" required class="form-control">
        </div>

        <label class="text-primary">Puntos:</label>
        <div class="input-group mb-3 has-primary">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-flash-off text-primary"></i></span>
          </div>
          <input type="number" min="0" max="99" id="puntosCliente" name="puntosCliente" placeholder="Puntos" required class="form-control">
        </div>

        <label class="text-primary">Imagen Perfil:</label>
        <div class="input-group mb-3 has-primary">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion-image text-primary"></i></span>
          </div>
          <input type="file" id="imagenCliente" accept="image/*" name="imagenCliente" placeholder="Imagen" class="form-control">
        </div>

        <center><output id="foto"></output></center>

        <script type="text/javascript">
          function archivo(evt) 
          {
            var files = evt.target.files; // FileList object
            //Obtenemos la imagen del campo "file". 
            for (var i = 0, f; f = files[i]; i++) {         
              //Solo admitimos imágenes.
              if (!f.type.match('image.*')) {
                alert('Formato de imagen no valido.');
                break;
              }else{
                var reader = new FileReader();
                   
                reader.onload = (function(theFile) {
                  return function(e) {
                    // Creamos la imagen.
                    document.getElementById("foto").innerHTML = ['<img width="200" height="200" class="avatar rounded-circle" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                  };
                })(f);
                reader.readAsDataURL(f);
              }
            }
          }
          document.getElementById('imagenCliente').addEventListener('change', archivo, false);
        </script>

      </div>
      <!-- End widget-body -->

      <div class="widget-footer bordered no-actions align-items-center">
        <center> 
          <button type="submit" name="GuardarCliente" class="btn btn-outline-primary"> 
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
//se invoca la función nuevoAlumnoController de la clase MvcController:
$registro -> nuevoClienteController();
?>
