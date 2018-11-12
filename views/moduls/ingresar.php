<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">

  <div class="card card-success">
    <div class="card-header">
      <center> 
        <h1 class="card-title"><i class="fa fa-user" style="font-size: 70px;"></i> <br>LOGIN
        </h1>
      </center>
    </div>
    <!-- /.card-header -->
      
    <!-- form start -->
    <form role="form" method="POST">
    <div class="card-body">

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-user text-success"></i></span>
        </div>
        <input type="text" required class="form-control" id="usuario" name="usuarioIngreso" placeholder="Usuario">
      </div>
      
      <div class="input-group mb-3">
        <br>
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-key text-success"></i></span>
        </div>
        <input type="password" required class="form-control" id="password" name="passwordIngreso" placeholder="Contraseña">
      </div>

  	</div>
  	<!-- /.card-body -->
  	
    <div class="card-footer">
      <center><button type="submit" name="SubmitUsuario" class="btn btn-success">Ingresar <i class="fa fa-check"></i></button></center>
    </div>
    <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div> <!-- /.col-md-4 -->

<div class="col-md-4"></div>

<?php

$ingreso = new Controlador_MVC();
$ingreso -> SessionController();

if(isset($_GET["action"])){
	if($_GET["action"] == "fallo"){
		echo "Fallo al ingresar";
	}
}

?>
