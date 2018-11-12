<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class PremioData extends DBConnector{

	# METODO PARA REGISTRAR NUEVOS PREMIOS
	#-------------------------------------
	public static function newPremioModel($PremioModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (nombre, descripcion, puntos) VALUES (:nombre, :descripcion, :puntos)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre", $PremioModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $PremioModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":puntos", $PremioModel["puntos"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE PREMIOS
	#-------------------------------------

	public static function viewPremiosModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	# METODO PARA BORRAR UN PREMIO
	#------------------------------------
	public static function deletePremioModel($PremioModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $PremioModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UN PREMIO
	#------------------------------------
	public static function editarPremioModel($PremioModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $PremioModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UN PREMIO
	#------------------------------------
	public static function actualizarPremioModel($PremioModel, $tabla_db){
		
		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET nombre=:nombre,descripcion=:descripcion, puntos=:puntos  WHERE id = :id");
		$stmt->bindParam(":nombre", $PremioModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $PremioModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":puntos", $PremioModel["puntos"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $PremioModel["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA VER LOS PREMIOS DISPONIBLES DE UN CLIENTE
	#------------------------------------
	public static function verPremiosDisponiblesModel($PremioModel, $tabla_db){
		
		$stmt = DBConnector::connect()->prepare("SELECT *  FROM $tabla_db WHERE puntos <= :puntos ORDER BY puntos ASC");
		$stmt->bindParam(":puntos", $PremioModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetchAll();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA VER LOS PREMIOS DISPONIBLES DE UN CLIENTE
	#------------------------------------
	public static function verPremiosNoDisponiblesModel($PremioModel, $tabla_db){
		
		$stmt = DBConnector::connect()->prepare("SELECT *  FROM $tabla_db WHERE puntos > :puntos ORDER BY puntos ASC");
		$stmt->bindParam(":puntos", $PremioModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetchAll();
		}else{
			return "error";
		}
		$stmt->close();
	}
}
?>