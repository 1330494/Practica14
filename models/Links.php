<?php 

class Pages{
	
	public static function linksModel($links){

		if($links == "ver-clientes" || $links == "ver-usuarios"  || $links == "ver-premios" || $links == "ver-servicios"
			|| $links == "ver-promociones" || $links == "ver-visitas" || $links == "registro-cliente" 
			|| $links == "registro-premio" || $links == "registro-visita" || $links == "registro-servicio"  
			|| $links == "registro-usuario" || $links == "registro-promocion" || $links == "eliminar-promocion" 
			|| $links == "eliminar-usuario" || $links == "eliminar-cliente" || $links == "eliminar-premio" 
			|| $links == "eliminar-servicio" || $links == "eliminar-visita" || $links == "editar-cliente" 
			|| $links == "editar-promocion" || $links == "editar-servicio" || $links == "promocion"
			|| $links == "editar-usuario" || $links == "editar-premio" || $links == "nosotros"
			|| $links == "salir" || $links == "premio" || $links == "servicio" || $links == "mis-visitas")
		{
			$module =  "views/moduls/".$links.".php";
		}/**else if($links == "ingresar"){
			$module =  "login.php";
		}*/else if($links == "ok"){
			$module =  "views/moduls/inicio.php?";
		}/*else if($links == "fallo"){
			$module =  "login.php";
		}*/else{
			$module =  "views/moduls/inicio.php";
		}
		return $module; 
	}
}

?>