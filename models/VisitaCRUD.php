<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class VisitaData extends DBConnector{

	# METODO PARA REGISTRAR UNA NUEVA VISITA
	#-------------------------------------
	public static function newVisitaModel($VisitaModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (id_cliente, fecha, hora) VALUES (:id_cliente, CURDATE(), CURTIME())");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":id_cliente", $VisitaModel["id_cliente"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE VISITAS
	#-------------------------------------

	public static function viewVisitasModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db ORDER BY fecha DESC");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR UNA PROMOCION
	#------------------------------------
	public static function deleteVisitaModel($VisitaModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $VisitaModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER LAS VISITAS ESPECIFICAS DE UN CLIENTE
	#------------------------------------
	public static function viewVisitasClienteModel($VisitaModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE id_cliente = :id ORDER BY fecha AND hora ASC");
		$stmt->bindParam(":id", $VisitaModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetchAll();
		}else{
			return "error";
		}
		$stmt->close();
	}


}
?>