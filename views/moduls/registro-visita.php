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
$control = new Controlador_MVC();

$clientes = ClienteData::viewClientesModel('clientes');
?>

<!-- Begin Page Header-->
<div class="row">
  <div class="page-header">
    <div class="d-flex align-items-center">
      <h1 class="page-header-title">Nueva Visita</h1>
      <div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item ">
            <a href="index.php?action=inicio"> <i class="ti ti-home"></i></a> 
          </li>
          <li class="breadcrumb-item ">
            <a href="index.php?action=ver-visitas"> <i class="ion-location"></i></a> 
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
          <strong>Exito!</strong> Nueva visita registrada.
        </div>  
      </div>
    </div>
    <?php
  }
}
?>

<datalist id="clientes">
	<?php foreach ($clientes as $cliente): ?>
		<option value="<?php echo $cliente['id'] ?>"><?php echo $cliente['nombre'].' '.$cliente['apellidos'] ?></option>
	<?php endforeach ?>
</datalist>

<div class="row flex">
	<div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 alert alert-outline-warning">
		<h3 class="text-danger">Clientes</h3>
		<?php $control -> vistaBusquedaClientesController(); ?>
	</div>

	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 has-warning alert alert-outline-warning">		
		<form method="POST" action="">

			<label class="text-warning">ID del cliente:</label>
	        <div class="input-group mb-3 has-danger">
	          <div class="input-group-prepend">
	            <span class="input-group-text"><i class="la la-slack text-warning"></i></span>
	          </div>
	          <input type="number" name="idCliente" id="idCliente" list="clientes" class="form-control" required="" min="1" >
	        </div>

	        <label class="text-warning">Puntos por visita:</label>
	        <div class="input-group mb-3 has-danger">
	          <div class="input-group-prepend">
	            <span class="input-group-text"><i class="ion-flash-off text-warning"></i></span>
	          </div>
	          <input type="number" name="puntosVisita" id="puntosVisita"  class="form-control" required min="1" >
	        </div>

			<center>
				<button type="submit" class="btn btn-sm btn-outline-success" name="GuardarVisita">Guardar <i class="la la-save" class="form-control"></i></button>
			</center>
			<span id="result"></span>
			<script type="text/javascript">
				var clientes = document.getElementById('clientes');
				
				function existe(id) {
					var find = false;
					for (var i = 0; i < clientes.options.length; i++) {
						if (clientes.options[i].value==id) {
							find = true;
						}
					}
					return find;
				}

				document.getElementById('idCliente').onchange = function (e) {					
					if (this.value) {
						if(!existe(this.value)){
							document.getElementById('result').innerText = "Usuario no encontrado";
							this.value = "";
						}else{
							document.getElementById('result').innerText = "ID: "+this.value+"\nCliente:"+clientes.options[this.value-1].text;
						}
					}

				};
			</script>
		</form>
	</div>
</div>
<?php 
$control -> nuevaVisitaController();
 ?>