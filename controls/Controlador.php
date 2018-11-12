<?php 

/**
* Clase controlador que permite la funcionabilidad del sistema 
* por medio de MVC.
*/
class Controlador_MVC
{

	// Metodo que permite mostrar la plantilla del login
	public function showLoginPage()
	{
		include "views/login_template.php";
	}

	// Metodo que permite mostrar la plantilla de la pagina
	public function showPage()
	{
		include "views/template.php";
	}

	// Metodo que permite el control de los enlaces y las vistas finales.
	public function linksController()
	{
		if(isset( $_GET['action'])){ // Se obtiene el valor de la variable action
			$enlaces = $_GET['action'];		
		}else{ // De lo contrario se le asigna el valor index
			$enlaces = "index";
		}

		// Obtenemos la respuesta del modelo
		$respuesta = Pages::linksModel($enlaces); 

		include $respuesta;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para INICIO +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function DataBaseTablesCounterController()
	{
		$usuarios = UsuarioData::viewUsuariosModel("usuarios");
		$clientes = ClienteData::viewClientesModel("clientes");
		$promociones = PromocionData::viewPromocionesModel("promociones");
		$premios = PremioData::viewPremiosModel("premios");
		$servicios = ServicioData::viewServiciosModel("servicios");
		$visitas = VisitaData::viewVisitasModel("visitas");

		$counter = array(
				'usuarios'=>count($usuarios),
				'clientes'=>count($clientes),
				'promociones'=>count($promociones),
				'premios'=>count($premios),
				'servicios'=>count($servicios),
				'visitas'=>count($visitas)
			);

		return $counter;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para la Sesion ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function SessionController()
	{
		if(isset($_POST["SubmitUsuario"])){

			if(!isset($_POST['admin'])) {
				$datosController = array( 
					"id"=>$_POST["usuarioIngreso"], 
					"password"=>$_POST["passwordIngreso"]
				);	
				echo "Sesion Cliente";
				$this->ingresoClienteController($datosController);
			}else{
				$datosController = array( 
					"usuario"=>$_POST["usuarioIngreso"], 
					"password"=>$_POST["passwordIngreso"]
				);	
				//echo "Sesion Admin";
				$this->ingresoUsuarioController($datosController);
			}
						
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para USUARIOS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR USUARIO
	#------------------------------------
	public function deleteUsuarioController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idUsuario"])){
			$datosController = $_GET["idUsuario"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = UsuarioData::deleteUsuarioModel($datosController, "usuarios");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de usuarios
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-usuarios';
			  	</script>";
			}
		}
	}

	# REGISTRO DE USUARIO
	#------------------------------------
	public function nuevoUsuarioController(){

		if(isset($_POST["GuardarUsuario"])){
			//Recibe a traves del método POST el name (html) de username y password, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (username, password):
			$datosController = array( 
				"usuario"=>$_POST['usuario'],
				"password"=>$_POST['password1']
			);

			//Se le dice al modelo models/UsuarioCrud.php (UsuarioData::registroUsuarioModel),que en la clase "UsuarioData", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = UsuarioData::newUsuarioModel($datosController, "usuarios");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-usuario&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}
	}

	# VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = UsuarioData::viewUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<table id="export-table" class="table mb-0">
			<thead>
				<tr>
					<th>Id</th>
					<th>Usuario</th>
					<th>Password</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>';
			foreach($respuesta as $usuario){
			echo'<tr>
				<td><span class="badge-text badge-text-small danger">'.$usuario["id"].'</span></td>
				<td>'.$usuario["usuario"].'</td>
				<td>'.crypt($usuario["password"],$usuario["password"]).'</td>
				<td style="text-align:center;"><a href="index.php?action=editar-usuario&idUsuario='.$usuario["id"].'"><i class="ion-gear-a animated infinite swing text-info" style="font-size:25px;"></i></a></td>
				<td  style="text-align:center;"><a href="index.php?action=eliminar-usuario&idUsuario='.$usuario["id"].'"><i class="ion-trash-b text-danger" style="font-size:25px;"></i></a></td>
				</tr>
			';
			}
			echo '</tbody>
		</table>';
	}

	#INGRESO DE USUARIO
	#------------------------------------
	public function ingresoUsuarioController($datosController)
	{
			$respuesta = UsuarioData::ingresoUsuarioModel($datosController, "usuarios");
			//Valiación de la respuesta del modelo para ver si es un Usuario correcto.
			if($respuesta["usuario"] == $datosController["usuario"] && $respuesta["password"] == $datosController["password"]){
				//session_start();
				// Se crea la sesion
				$_SESSION['user'] = $respuesta['id'];
				$_SESSION['rol'] = 1;
				$_SESSION["validar"] = true;
				$_SESSION["password"] = $respuesta["password"];
				
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=fallo';
			  	</script>";
			}
	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["idUsuario"];
		$respuesta = UsuarioData::editarUsuarioModel($datosController, "usuarios");

		echo'
			<!-- widget -->
		    <div class="widget has-shadow">
		      	<div class="widget-header bordered no-actions align-items-center">
		      		<center>
		        		<h2 ><i class="ion-person text-danger" style="font-size: 40px;"></i></h2>
		        	</center>
		    	</div>
    		<!-- form start -->
    		<form role="form" method="POST">
    			<div class="widget-body">
    				<input type="hidden" name="pwUser" id="pwUser" value="'.$respuesta['password'].'">
    				<input type="hidden" name="idUser" id="idUser" value="'.$respuesta['id'].'">        		        			
        			<label class="text-danger">Usuario:</label>
        			<div class="input-group mb-3 has-danger">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="ion-person text-danger"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required class="form-control">
					</div>
					<label class="text-danger">Nueva Contraseña:</label>
					<div class="input-group mb-3 has-danger">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="ti ti-key text-danger"></i></span>
				        </div>
              			<input type="password" id="PW1" name="password1Editar" placeholder="Nueva contraseña" class="form-control">
					</div>					

 				</div>
        		<!-- /.widget-body -->
        		<div class="widget-footer bordered no-actions  align-items-center">
           			<center><button type="submit" name="UsuarioEditar" class="btn btn-outline-danger">Actualizar <i class="ti ti-reload"></i></button></center>
        		</div>
    		</form>
    	';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["UsuarioEditar"])){

			$datosController = array();

			if (isset($_POST['password1Editar']) && $_POST['password1Editar']) {
				$datosController = array( 
					"usuario"=>$_POST["usuarioEditar"],
			        "password"=>$_POST["password1Editar"],
			        "id"=>$_POST['idUser']
			    );
			}else{
				$datosController = array( 
					"usuario"=>$_POST["usuarioEditar"],
			        "password"=>$_POST["pwUser"],
			        "id"=>$_POST['idUser']
			    );
			}
			
			$respuesta = UsuarioData::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-usuarios';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}	

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para Promociones   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR PROMOCION
	#------------------------------------
	public function deletePromocionController(){
		// Obtenemos el ID del promocion a borrar
		if(isset($_GET["idPromocion"])){
			$datosController = $_GET["idPromocion"];
			// Mandamos los datos al modelo de la promocion a eliminar
			$respuesta = PromocionData::deletePromocionModel($datosController, "promociones");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de Promociones
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-promociones';
			  	</script>";
			}
		}
	}

	# VISTA DE PROMOCIONES
	#------------------------------------

	public function vistaPromocionesController(){

		$respuesta = PromocionData::viewPromocionesModel("promociones");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<table id="export-table" class="table mb-0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nombre</th>
							<th>Descripcion</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>';
					foreach($respuesta as $promocion){
					echo'<tr>
						<td> <span class="badge-text badge-text-small info">'.$promocion["id"].'</span></td>
						<td>'.$promocion["nombre"].'</td>
						<td>'.$promocion["descripcion"].'</td>						
						<td><a href="index.php?action=editar-promocion&idPromocion='.$promocion["id"].'"><i class="ion-gear-a animated infinite swing text-info" style="font-size:25px;"></i></a></td>
						<td><a href="index.php?action=eliminar-promocion&idPromocion='.$promocion["id"].'"><i class="fa ion-trash-b text-danger" style="font-size:25px;"></i></a></td>
					</tr>';
					}
					echo '</tbody>
				</table>
	    ';
	}

	# REGISTRO DE PROMOCION
	#------------------------------------
	public function nuevaPromocionController(){

		if(isset($_POST["GuardarPromocion"])){
			//Recibe a traves del método POST el name (html) el nombre y la categoria, y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre, categoria):
			$datosController = array(
				"nombre"=>$_POST['nombrePromocion'],
				"descripcion"=>$_POST['descripcionPromocion']
			);

			//Se le dice al modelo models/crud.php (PromocionData::newPromocionModel),que en la clase "PromocionData", la funcion "newPromocionModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "promociones":
			$respuesta = PromocionData::newPromocionModel($datosController, "promociones");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-promocion&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	#EDITAR PROMOCION
	#------------------------------------

	public function editarPromocionController(){

		$datosController = $_GET["idPromocion"];
		$respuesta = PromocionData::editarPromocionModel($datosController, "promociones");

		echo '
			<!-- widget -->
		    <div class="widget has-shadow">
		      	<div class="widget-header bordered no-actions  align-items-center">
		        	<center>
		        	<h2 ><i class="ion-star text-info" style="font-size: 40px;"></i></h2>
		        	</center>
		    	</div>
    		<!-- form start -->
    		<form role="form" method="POST">
    			<div class="widget-body">
    			
    				<input type="hidden" name="idPromocion" id="idPromocion" value="'.$respuesta['id'].'">

        			<label class="text-info">Nombre:</label>
        			<div class="input-group mb-3 has-info">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="ion-film-marker text-info"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["nombre"].'" name="nombrePromocionEditar" required class="form-control">
					</div>

					<label class="text-info">Descripcion:</label>
			        <div class="input-group mb-3 has-info">
			          <div class="input-group-prepend">
			            <span class="input-group-text"><i class="ion-document-text text-info"></i></span>
			          </div>
			          <textarea name="descripcionPromocionEditar" class="form-control" placeholder="Descripcion..." required>'.$respuesta['descripcion'].'</textarea>
			        </div>
										
 				</div>
        		<!-- /.widget-body -->
        		<div class="widget-footer bordered no-actions  align-items-center">
           			<center><button type="submit" name="PromocionEditar" class="btn btn-outline-info">Actualizar <i class="ti ti-reload"></i></button></center>
        		</div>
    		</form>';
	}

	#ACTUALIZAR PROMOCION
	#------------------------------------
	public function actualizarPromocionController(){

		if(isset($_POST["PromocionEditar"])){

			$datosController = array( 
				"id"=>$_POST["idPromocion"],
		        "nombre"=>$_POST["nombrePromocionEditar"],
		        "descripcion"=>$_POST["descripcionPromocionEditar"]
		    );
			
			$respuesta = PromocionData::actualizarPromocionModel($datosController, "promociones");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-promociones';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	# VER PROMOCIONES DISPONIBLES AL CLIENTE.
	#------------------------------------

	public function vistaPromocionesClienteController(){
		$promos = PromocionData::viewPromocionesModel('promociones');
		foreach ($promos as $promo){
		  	echo '
			    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 ">
			      <div class="widget widget-23 bg-gradient-05 d-flex justify-content-center align-items-center alert alert-outline-success">
			        <div class="widget-body text-center ">
			          <i class="ti ti-medall-alt text-info"></i>
			          <div class="title text-warning">'.$promo['nombre'].'</div>
			          <div class="number text-light">'.$promo['descripcion'].'</div>
			          <div class="text-center mt-3 mb-3">
			              <button type="button" class="btn btn-info has-shadow">
			                  Visitanos
			              </button>
			          </div>
			        </div>
			      </div>
			    </div>
			';  		 
  		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para CLIENTES  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR CLIENTE
	#------------------------------------
	public function deleteClienteController(){
		// Obtenemos el ID del cliente a borrar
		if(isset($_GET["idCliente"])){
			$datosController = $_GET["idCliente"];
			// Mandamos los datos al modelo del cliente a eliminar
			$respuesta = ClienteData::deleteClienteModel($datosController, "clientes");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de clientes
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-clientes';
			  	</script>";
			}
		}
	}

	# VISTA DE CLIENTES
	#------------------------------------

	public function vistaClientesController(){

		$respuesta = ClienteData::viewClientesModel("clientes");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<table id="export-table" class="table mb-0">
			<thead>
				<tr>
					<th>ID</th>
					<th>Imagen</th>					
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>Password</th>
					<th>Registro</th>
					<th>Puntos</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>';
			foreach($respuesta as $cliente){
				$imagen = '';
				if ($cliente['imagen']) {
					$imagen = 'clientes/'.$cliente['imagen'];
				}else{
					$imagen = 'assets/img/avatar/avatar-07.jpg';
				}
			echo'
			<tr>
				<td> <span class="badge-text badge-text-small info">'.$cliente["id"].'</span></td>
				<td> 
					<div class="media-left align-self-center user">
                        <a href=""><img width="40" height="40" src="'.$imagen.'" class="rounded-circle" alt="..."></a>
                    </div>
                </td>
				<td> '.$cliente["nombre"].'</td>
				<td>'.$cliente["apellidos"].'</td>
				<td>'.$cliente["direccion"].'</td>
				<td>'.$cliente["telefono"].'</td>
				<td>'.crypt($cliente["password"], $cliente["password"]).'</td>
				<td>'.$cliente["fecha_registro"].'</td>
				<td> <span class="badge-text badge-text-small danger">'.$cliente["puntos"].'</span></td>
				<td><a href="index.php?action=editar-cliente&idCliente='.$cliente["id"].'"><i class="ion-gear-a animated infinite swing text-info" style="font-size:25px;"></i></a></td>
				<td><a href="index.php?action=eliminar-cliente&idCliente='.$cliente["id"].'"><i class="ion-trash-b text-danger" style="font-size:25px;"></i></a></td>				
			</tr>';

			}
			echo '</tbody>
		</table>';
	}

	# REGISTRO DE UN CLIENTE
	#------------------------------------
	public function nuevoClienteController(){

		if(isset($_POST["GuardarCliente"])){

			$archivoTemp = $_FILES['imagenCliente']['tmp_name'];
			$image =$_FILES['imagenCliente']['name'];
			$format = explode('.', $image);

			// Si seleccionamos la imagen del cliente
			$datosController = array();
			if( $image ){

				// Creamos id-name de imagen unico de cada cliente
				$id_image = $_POST['nombreCliente'][0];
				$id_image .= $_POST['apellidosCliente'][0];
				$id_image .= count(ClienteData::viewClientesModel('clientes'))+1;
				//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades:
				$datosController = array(
					"nombre"=>$_POST['nombreCliente'],
					"apellidos"=>$_POST['apellidosCliente'],
					"direccion"=>$_POST['direccionCliente'],
					"telefono"=>$_POST['telefonoCliente'],
					"password"=>$_POST['passwordCliente'],
					"puntos"=>$_POST['puntosCliente'],
					"imagen"=>$id_image.'.'.$format[1]
				);

			}else{
				//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades:
				$datosController = array(
					"nombre"=>$_POST['nombreCliente'],
					"apellidos"=>$_POST['apellidosCliente'],
					"direccion"=>$_POST['direccionCliente'],
					"telefono"=>$_POST['telefonoCliente'],
					"password"=>$_POST['passwordCliente'],
					"puntos"=>$_POST['puntosCliente'],
					"imagen"=>""
				);
			}


			//Se le dice al modelo models/crud.php (ClienteData::newClienteModel),que en la clase "ClienteData", la funcion "newClienteModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "clientes":
			$respuesta = ClienteData::newClienteModel($datosController, "clientes");
			move_uploaded_file($archivoTemp, 'clientes/'.$id_image.".".$format[1]);
			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-cliente&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	# EDITAR CLIENTE
	#------------------------------------

	public function editarClienteController(){

		$datosController = $_GET["idCliente"];
		$respuesta = ClienteData::editarClienteModel($datosController, "clientes");
		$imagen = '';
		if ($respuesta['imagen']) {
		    $imagen = "clientes/".$respuesta['imagen'];
		}else{
		    $imagen = "assets/img/avatar/avatar-01.jpg";
		}
		echo '
			<!-- widget -->
		    <div class="widget has-shadow">
		      	<div class="widget-header bordered no-actions  align-items-center">
		        	<center>
		        	<div class="mt-5">
                        <img src="'.$imagen.'" alt="..." style="width: 120px;" class="avatar rounded-circle d-block mx-auto">
                    </div>
		        	</center>
		    	</div>
    		<!-- form start -->
    		<form role="form" method="POST">
    			<div class="widget-body">
    			
    				<label class="text-primary">ID:</label>
        			<div class="input-group mb-3 has-danger">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="ion-information-circled 	 text-primary"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["id"].'" class="form-control" name="idCliente" readonly>
					</div>

        			<label class="text-primary">Nombre:</label>
        			<div class="input-group mb-3 has-primary">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="ion-person text-primary"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["nombre"].'" name="nombreClienteEditar" required class="form-control">
					</div>
					
					<label class="text-primary">Apellidos:</label>
			        <div class="input-group mb-3 has-primary">
			          <div class="input-group-prepend">
			            <span class="input-group-text"><i class="ion-person text-primary"></i></span>
			          </div>
			          <input type="text" value="'.$respuesta["apellidos"].'" name="apellidosClienteEditar" placeholder="Apellidos" required class="form-control">
			        </div>

			        <label class="text-primary">Direccion:</label>
			        <div class="input-group mb-3 has-primary">
			          <div class="input-group-prepend">
			            <span class="input-group-text"><i class="ion-card text-primary"></i></span>
			          </div>
			          <textarea name="direccionClienteEditar" class="form-control" placeholder="Descripcion..." required>'.$respuesta["direccion"].'</textarea>
			        </div>

			        <label class="text-primary">Telefono:</label>
			        <div class="input-group mb-3 has-primary">
			          <div class="input-group-prepend">
			            <span class="input-group-text"><i class="la la-phone text-primary"></i></span>
			          </div>
			          <input type="number" value="'.$respuesta["telefono"].'" min="1111111111" max="9999999999" name="telefonoClienteEditar" placeholder="Telefono" required class="form-control">
			        </div>
			        <label class="text-primary">Password:</label>
				        <div class="input-group mb-3 has-primary">
				          <div class="input-group-prepend">
				            <span class="input-group-text"><i class="ion-key text-primary"></i></span>
			          	</div>
			        	<input type="password" value="'.$respuesta["password"].'" name="passwordClienteEditar" placeholder="Password" required class="form-control">
			       	</div>
			        ';
			        // Validamos la session para modificar puntos
			        // El usuario no puede modificar sus puntos.
			        if ($_SESSION['rol']==1) {
				        echo '<label class="text-primary">Puntos:</label>
				        <div class="input-group mb-3 has-primary">
				          <div class="input-group-prepend">
				            <span class="input-group-text"><i class="ion-flash-off text-primary"></i></span>
				          </div>
				          <input type="number" min="0" max="99" value="'.$respuesta["puntos"].'" name="puntosClienteEditar" placeholder="Puntos" required class="form-control">
				        </div>';
			        }
			        if ($_SESSION['rol']==2) {
				        echo '
				          <input type="hidden" value="'.$respuesta["puntos"].'" name="puntosClienteEditar">';
			        }
			        echo '				
 				</div>
        		<!-- /.widget-body -->
        		<div class="widget-footer bordered no-actions  align-items-center">
           			<center><button type="submit" name="ClienteEditar" class="btn btn-outline-primary">Actualizar <i class="ti ti-reload"></i></button></center>
        		</div>
    		</form>';

	}

	# ACTUALIZAR CLIENTE
	#------------------------------------
	public function actualizarClienteController(){

		if(isset($_POST["ClienteEditar"])){

			$datosController = array( 
				"id"=>$_POST["idCliente"],
				"nombre"=>$_POST["nombreClienteEditar"],
		        "apellidos"=>$_POST["apellidosClienteEditar"],
		        "direccion"=>$_POST["direccionClienteEditar"],
		        "telefono"=>$_POST["telefonoClienteEditar"],
		        "password"=>$_POST["passwordClienteEditar"],
		        "puntos"=>$_POST["puntosClienteEditar"]
		    );
			
			$respuesta = ClienteData::actualizarClienteModel($datosController, "clientes");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-clientes';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	#INGRESO DE CLIENTE
	#------------------------------------
	public function ingresoClienteController($datosController)
	{
			$respuesta = ClienteData::ingresoClienteModel($datosController, "clientes");
			//Valiación de la respuesta del modelo para ver si es un Usuario correcto.
			if($respuesta["id"] == $datosController["id"] && $respuesta["password"] == $datosController["password"]){
				//session_start();
				// Se crea la sesion
				$_SESSION['user'] = $respuesta['id'];
				$_SESSION['rol'] = 2;
				$_SESSION["validar"] = true;
				$_SESSION["password"] = $respuesta["password"];
				
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=fallo';
			  	</script>";
			}
	}

	# VISTA DE CLIENTES
	#------------------------------------

	public function vistaBusquedaClientesController(){

		$respuesta = ClienteData::viewClientesModel("clientes");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<table id="sorting-table" class="table mb-0">
			<thead>
				<tr>					
					<th>Foto</th>
					<th>ID</th>					
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Teléfono</th>
				</tr>
			</thead>
			<tbody>';
			foreach($respuesta as $cliente){
				$imagen = '';
				if ($cliente['imagen']) {
					$imagen = 'clientes/'.$cliente['imagen'];
				}else{
					$imagen = 'assets/img/avatar/avatar-07.jpg';
				}
			echo'
			<tr>				
				<td> 
					<div class="media-left align-self-center user">
                        <a href=""><img width="40" height="40" src="'.$imagen.'" class="rounded-circle" alt="..."></a>
                    </div>
                </td>
                <td> <span class="badge-text badge-text-small info">'.$cliente["id"].'</span></td>
				<td> '.$cliente["nombre"].'</td>
				<td>'.$cliente["apellidos"].'</td>
				<td>'.$cliente["telefono"].'</td>						
			</tr>';

			}
			echo '</tbody>
		</table>';
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para PREMIOS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


	# BORRAR PREMIO
	#------------------------------------
	public function deletePremioController(){
		// Obtenemos el ID del premio a borrar
		if(isset($_GET["idPremio"])){
			$datosController = $_GET["idPremio"];
			// Mandamos los datos al modelo del premio a eliminar
			$respuesta = PremioData::deletePremioModel($datosController, "premios");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de premios
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-premios';
			  	</script>";
			}
		}
	}

	# REGISTRO DE UN NUEVO PREMIO
	#------------------------------------
	public function nuevoPremioController(){

		if(isset($_POST["GuardarPremio"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre, descripcion):
			$datosController = array(
				"nombre"=>$_POST['nombrePremio'],
				"descripcion"=>$_POST['descripcionPremio'],
				"puntos"=>$_POST['puntosPremio']
				
			);

			//Se le dice al modelo models/crud.php (PremioData::newPremioModel),que en la clase "PremioData", la funcion "newPremioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "premios":
			$respuesta = PremioData::newPremioModel($datosController, "premios");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-premio&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	# VISTA DE PREMIOS
	#------------------------------------

	public function vistaPremiosController(){

		$respuesta = PremioData::viewPremiosModel("premios");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<table id="export-table" class="table mb-0">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Puntos</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>';
			foreach($respuesta as $premio){
			echo'
			<tr>
				<td> <span class="badge-text badge-text-small success">'.$premio["id"].'</span></td>
				<td>'.$premio["nombre"].'</td>
				<td>'.$premio["descripcion"].'</td>
				<td> <span class="badge-text badge-text-small danger">'.$premio["puntos"].'</span></td>
				<td><a href="index.php?action=editar-premio&idPremio='.$premio["id"].'"><i class="ion-gear-a animated infinite swing text-info" style="font-size:25px;"></i></a></td>
				<td><a href="index.php?action=eliminar-premio&idPremio='.$premio["id"].'"><i class="ion-trash-b text-danger" style="font-size:25px;"></i></a></td>				
			</tr>';

			}
			echo '</tbody>
		</table>';
	}

	#EDITAR PREMIO
	#------------------------------------

	public function editarPremioController(){

		$datosController = $_GET["idPremio"];
		$respuesta = PremioData::editarPremioModel($datosController, "premios");

		echo '
			<!-- widget -->
		    <div class="widget has-shadow">
		      	<div class="widget-header bordered no-actions align-items-center">
		        	<center>
		        		<h2 ><i class="ion-ribbon-b text-success" style="font-size: 40px;"></i></h2>
		        	</center>
		    	</div>
    		<!-- form start -->
    		<form role="form" method="POST">
    			<div class="widget-body">
    			
    				<input type="hidden" name="idPremio" id="idPremio" value="'.$respuesta['id'].'">

        			<label class="text-success">Nombre:</label>
        			<div class="input-group mb-3 has-success">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="ion-film-marker text-success"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["nombre"].'" name="nombrePremioEditar" required class="form-control">
					</div>

					<label class="text-success">Descripcion:</label>
			        <div class="input-group mb-3 has-success">
			          <div class="input-group-prepend">
			            <span class="input-group-text"><i class="ion-document-text text-success"></i></span>
			          </div>
			          <textarea name="descripcionPremioEditar" class="form-control" placeholder="Descripcion..." required>'.$respuesta['descripcion'].'</textarea>
			        </div>

			        <label class="text-success">Puntos:</label>
			        <div class="input-group mb-3 has-success">
			          <div class="input-group-prepend">
			            <span class="input-group-text"><i class="ion-flash-off text-success"></i></span>
			          </div>
			          <input type="number" name="puntosPremioEditar" class="form-control" placeholder="Puntos" value="'.$respuesta['puntos'].'" required>
			        </div>
										
 				</div>
        		<!-- /.widget-body -->
        		<div class="widget-footer bordered no-actions  align-items-center">
           			<center><button type="submit" name="PremioEditar" class="btn btn-outline-success">Actualizar <i class="ti ti-reload"></i></button></center>
        		</div>
    		</form>';
	}

	#ACTUALIZAR PREMIO
	#------------------------------------
	public function actualizarPremioController(){

		if(isset($_POST["PremioEditar"])){

			$datosController = array( 
				"id"=>$_POST["idPremio"],
		        "nombre"=>$_POST["nombrePremioEditar"],
		        "descripcion"=>$_POST["descripcionPremioEditar"],
		        "puntos"=>$_POST["puntosPremioEditar"]
		    );
			
			$respuesta = PremioData::actualizarPremioModel($datosController, "premios");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-premios';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	# VER PREMIOS ESPECIFICOS DE UN CLIENTE, DISPONIBLES Y NO DISPONIBLES.
	#------------------------------------

	public function vistaPremiosClienteController($datosController){
		$premios_disp = PremioData::verPremiosDisponiblesModel($datosController['puntos'], 'premios');
		$premios_noDisp = PremioData::verPremiosNoDisponiblesModel($datosController['puntos'], 'premios');
		$this->imprimirPremiosDisponiblesController($premios_disp);
		$this->imprimirPremiosNoDisponiblesController($premios_noDisp);
	}

	// Metodo para imprimir premios en modo disponible al usuario.
	public function imprimirPremiosDisponiblesController($premiosModel)
	{
		foreach ($premiosModel as $premio){
		  	echo '
			    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 ">
			      <div class="widget widget-23 bg-gradient-05 d-flex justify-content-center align-items-center alert alert-outline-success">
			        <div class="widget-body text-center ">
			          <i class="ti ti-medall-alt text-info"></i>
			          <div class="title text-warning">'.$premio['nombre'].'</div>
			          <div class="number text-light">'.$premio['descripcion'].'</div>
			          <div class="text-center mt-3 mb-3">
			              <button type="button" class="btn btn-danger has-shadow">
			                  '.$premio['puntos'].' Puntos
			              </button>
			              <button type="button" class="btn btn-outline-success">
			                  Reclamar
			              </button>
			          </div>
			        </div>
			      </div>
			    </div>
			';  		 
  		}
	}

	// Metodo para imprimir premios en modo no disponible al usuario.
	public function imprimirPremiosNoDisponiblesController($premiosModel)
	{
		foreach ($premiosModel as $premio){
		  	echo '
			    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			      <div class="widget widget-23 bg-gradient-05 d-flex justify-content-center align-items-center alert alert-outline-primary ">
			        <div class="widget-body text-center">
			          <i class="ti ti-medall-alt text-info"></i>
			          <div class="title text-warning">'.$premio['nombre'].'</div>
			          <div class="number text-light">'.$premio['descripcion'].'</div>
			          <div class="text-center mt-3 mb-3">
			              <button type="button" class="btn btn-primary">
			                  '.$premio['puntos'].' Puntos
			              </button>
			              <button type="button" disabled class="btn btn-outline-info">
			                  :'."'(".'
			              </button>
			          </div>
			        </div>
			      </div>
			    </div>
			';  		 
  		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para Servicios   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR SERVICIO
	#------------------------------------
	public function deleteServicioController(){
		// Obtenemos el ID del servicio a borrar
		if(isset($_GET["idServicio"])){
			$datosController = $_GET["idServicio"];
			// Mandamos los datos al modelo del servicio a eliminar
			$respuesta = ServicioData::deleteServicioModel($datosController, "servicios");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de servicios
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-servicios';
			  	</script>";
			}
		}
	}

	# VISTA DE SERVICIOS
	#------------------------------------

	public function vistaServiciosController(){

		$respuesta = ServicioData::viewServiciosModel("servicios");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<table id="export-table" class="table mb-0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nombre</th>
							<th>Descripcion</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>';
					foreach($respuesta as $servicio){
					echo'<tr>
						<td> <span class="badge-text badge-text-small info">'.$servicio["id"].'</span></td>
						<td>'.$servicio["nombre"].'</td>
						<td>'.$servicio["descripcion"].'</td>
						<td><a href="index.php?action=editar-servicio&idServicio='.$servicio["id"].'"><i class="ion-gear-a animated infinite swing text-info" style="font-size:25px;"></i></a></td>
						<td><a href="index.php?action=eliminar-servicio&idServicio='.$servicio["id"].'"><i class="fa ion-trash-b text-danger" style="font-size:25px;"></i></a></td>
					</tr>';
					}
					echo '</tbody>
				</table>
	    ';
	}

	# REGISTRO DE SERVICIO
	#------------------------------------
	public function nuevoServicioController(){

		if(isset($_POST["GuardarServicio"])){
			//Recibe a traves del método POST el name (html) el nombre y la categoria, y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre, categoria):
			$datosController = array(
				"nombre"=>$_POST['nombreServicio'],
				"descripcion"=>$_POST['descripcionServicio']
			);

			//Se le dice al modelo models/crud.php (ServicioData::newServicioModel),que en la clase "ServicioData", la funcion "newServicioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "servicios":
			$respuesta = ServicioData::newServicioModel($datosController, "servicios");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-servicio&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	#EDITAR SERVICIO
	#------------------------------------

	public function editarServicioController(){

		$datosController = $_GET["idServicio"];
		$respuesta = ServicioData::editarServicioModel($datosController, "servicios");

		echo '
			<!-- widget -->
		    <div class="widget has-shadow">
		      	<div class="widget-header bordered no-actions  align-items-center">
		        	<center>
		        	<h2 ><i class="ion-wrench text-warning" style="font-size: 40px;"></i></h2>
		        	</center>
		    	</div>
    		<!-- form start -->
    		<form role="form" method="POST">
    			<div class="widget-body">
    			
    				<input type="hidden" name="idServicio" id="idServicio" value="'.$respuesta['id'].'">

        			<label class="text-warning">Nombre:</label>
        			<div class="input-group mb-3 has-warning">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="ion-network text-warning"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["nombre"].'" name="nombreServicioEditar" required class="form-control">
					</div>

					<label class="text-warning">Descripcion:</label>
			        <div class="input-group mb-3 has-warning">
			          <div class="input-group-prepend">
			            <span class="input-group-text"><i class="ion-document-text text-warning"></i></span>
			          </div>
			          <textarea name="descripcionServicioEditar" class="form-control" placeholder="Descripcion..." required>'.$respuesta['descripcion'].'</textarea>
			        </div>
										
 				</div>
        		<!-- /.widget-body -->
        		<div class="widget-footer bordered no-actions  align-items-center">
           			<center><button type="submit" name="ServicioEditar" class="btn btn-outline-warning">Actualizar <i class="ti ti-reload"></i></button></center>
        		</div>
    		</form>';
	}

	#ACTUALIZAR SERVICIO
	#------------------------------------
	public function actualizarServicioController(){

		if(isset($_POST["ServicioEditar"])){

			$datosController = array( 
				"id"=>$_POST["idServicio"],
		        "nombre"=>$_POST["nombreServicioEditar"],
		        "descripcion"=>$_POST["descripcionServicioEditar"]
		    );
			
			$respuesta = ServicioData::actualizarServicioModel($datosController, "servicios");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-servicios';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para Visitas   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR UNA VISITA
	#------------------------------------
	public function deleteVisitaController(){
		// Obtenemos el ID del visita a borrar
		if(isset($_GET["idVisita"])){
			$datosController = $_GET["idVisita"];
			// Mandamos los datos al modelo de la visita a eliminar
			$respuesta = ServicioData::deleteServicioModel($datosController, "visitas");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de visitas
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-visitas';
			  	</script>";
			}
		}
	}

	# VISTA DE VISITAS
	#------------------------------------

	public function vistaVisitasController(){

		$respuesta = VisitaData::viewVisitasModel("visitas");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<table id="export-table" class="table mb-0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Cliente</th>
							<th>Hora</th>
							<th>Fecha</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>';
					foreach($respuesta as $visita){
						$cliente = ClienteData::editarClienteModel($visita['id_cliente'],'clientes');
					echo'<tr>
						<td> <span class="badge-text badge-text-small info">'.$visita["id"].'</span></td>
						<td>'.$cliente["nombre"].' '.$cliente["apellidos"].'</td>
						<td>'.Time::MEXICAN_FORMAT_TIME($visita["hora"]).'</td>
						<td>'.$visita['fecha'].'</td>	
						<td><a href="index.php?action=eliminar-visita&idVisita='.$visita["id"].'"><i class="fa ion-trash-b text-danger" style="font-size:25px;"></i></a></td>
					</tr>';
					}
					echo '</tbody>
				</table>
	    ';
	}

	# REGISTRO DE UNA NUEVA VISITA
	#------------------------------------
	public function nuevaVisitaController(){

		if(isset($_POST["GuardarVisita"])){
			//Recibe a traves del método POST el name (html) el id del cliente, y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (id_cliente):
			$datosVisitaController = array(
				"id_cliente"=>$_POST['idCliente']
			);

			$datosPuntosController = array(
				"id"=>$_POST['idCliente'],
				"puntos"=>$_POST['puntosVisita']
			);

			//Se le dice al modelo models/ServicioCRUD.php (ServicioData::newServicioModel),que en la clase "ServicioData", la funcion "newServicioModel" reciba en sus 2 parametros los valores "$datosVisitaController" y el nombre de la tabla a conectarnos la cual es "visitas":
			
			$respuesta = VisitaData::newVisitaModel($datosVisitaController, "visitas");
			
			$respuesta2 = ClienteData::agregarPuntosClienteModel($datosPuntosController, 'clientes');

			
			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-visita&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
			
		}

	}
}
?>
