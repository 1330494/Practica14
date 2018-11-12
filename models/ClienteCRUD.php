<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class ClienteData extends DBConnector{

	# METODO PARA REGISTRAR NUEVO CLIENTE
	#-------------------------------------
	public static function newClienteModel($ClienteModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (nombre, apellidos, direccion, telefono, password, fecha_registro, imagen, puntos) VALUES (:nombre, :apellidos, :direccion, :telefono, :password, CURDATE(), :imagen, :puntos)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":nombre", $ClienteModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $ClienteModel["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $ClienteModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $ClienteModel["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $ClienteModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $ClienteModel["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":puntos", $ClienteModel["puntos"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE CLIENTES
	#-------------------------------------

	public static function viewClientesModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR UN CLIENTE
	#------------------------------------
	public static function deleteClienteModel($ClienteModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $ClienteModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UN CLIENTE
	#------------------------------------
	public static function editarClienteModel($ClienteModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $ClienteModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UN CLIENTE
	#------------------------------------
	public static function actualizarClienteModel($ClienteModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET nombre=:nombre, apellidos=:apellidos, direccion=:direccion, telefono=:telefono, password=:password, puntos=:puntos WHERE id = :id");
		$stmt->bindParam(":nombre", $ClienteModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $ClienteModel["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $ClienteModel["direccion"], PDO::PARAM_STR);		
		$stmt->bindParam(":telefono", $ClienteModel["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $ClienteModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":puntos", $ClienteModel["puntos"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $ClienteModel["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA EL INGRESO DE UN CLIENTE
	#------------------------------------
	public static function ingresoClienteModel($ClienteModel, $tabla_db)
	{
		$stmt = DBConnector::connect()->prepare("SELECT id, password FROM $tabla_db WHERE id = :id AND password = :password");	
		$stmt->bindParam(":id", $ClienteModel["id"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $ClienteModel["password"], PDO::PARAM_STR);
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();
	}

	# METODO PARA DEVOLVER EL TOTAL DE PUNTOS DE UN CLIENTE
	#------------------------------------
	public static function puntosClienteModel($ClienteModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT puntos FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $ClienteModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}	

	# METODO PARA AGREGAR PUNTOS A UN CLIENTE
	#------------------------------------
	public static function agregarPuntosClienteModel($ClienteModel, $tabla_db){

		$resp = ClienteData::puntosClienteModel($ClienteModel["id"],'clientes');
		$puntos = $resp['puntos']+$ClienteModel["puntos"];
		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET puntos=:puntos WHERE id = :id");
		//echo $puntos;
		$stmt->bindParam(":puntos", $puntos, PDO::PARAM_INT);
		$stmt->bindParam(":id", $ClienteModel["id"], PDO::PARAM_INT);
		
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
		
	}

	# METODO PARA QUITAR PUNTOS A UN CLIENTE
	#------------------------------------
	public static function quitarPuntosClienteModel($ClienteModel, $tabla_db){

		$resp = ClienteData::puntosClienteModel($ClienteModel["id"],'clientes');
		$puntos = $resp['puntos']-$ClienteModel["puntos"];
		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET puntos=:puntos WHERE id = :id");
		$stmt->bindParam(":puntos", $puntos, PDO::PARAM_INT);
		$stmt->bindParam(":id", $ClienteModel["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}
}
?>
