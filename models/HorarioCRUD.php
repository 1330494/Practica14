<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del models/Connector.php:
class HorarioData extends DBConnector{

	# METODO PARA REGISTRAR UN NUEVO HORARIO
	#-------------------------------------
	public static function newHorarioModel($HorarioModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (descripcion) VALUES (:descripcion)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":descripcion", $HorarioModel["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE HORARIO
	#-------------------------------------

	public static function viewHorarioModel(){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM horario");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR EL HORARIO
	#------------------------------------
	public static function deleteHorarioModel($HorarioModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $HorarioModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UN SERVICIO
	#------------------------------------
	public static function actualizarHorarioModel($HorarioModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET descripcion=:descripcion WHERE id = :id");
		$stmt->bindParam(":descripcion", $HorarioModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $HorarioModel["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

}
?>