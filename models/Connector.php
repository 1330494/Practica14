
<?php
// Clase para devolver una conexion a una base de datos especifica.
class DBConnector
{
	
	public static function connect()
	{
		// Devuelve la conexion a la base de datos.
		$tmp_conn = new PDO("mysql:host=localhost;dbname=practica14;port=3307;","root","usbw",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
		return $tmp_conn;
	}

}

/**
 * 
 */
class Time 
{
	
	
	# Funcion para de volver la fecha en un string en formato 
	# nombre de la semana, dia, mes y año actual.
	static function MEXICAN_FORMAT_DATE($date)
	{
		$M = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$date = explode('-', $date);
		$dia = $date[2];
		$mes = $date[1];
		$anio = $date[0];
		$fecha = $dia.' de '.$M[$mes-1].' del '.$anio;
		$dias_tot = 0;
		
		
		return $fecha;
	}

	# Funcion para de volver el tiempo en un string en formato 
	# hora, minutos, segundos y el meridiano de una fecha dada.
	static function MEXICAN_FORMAT_TIME($time)
	{
		$t = explode(':', $time);
		$tiempo = (int)$t[0];
		
		if ($tiempo >= 0 && $tiempo < 12) {
			if ($tiempo==0){ $tiempo = '12:'.$t[1].' a.m.'; }else{ $tiempo = $t[0].':'.$t[1].' a.m.'; }
			
		}else{
			if ($tiempo==12){ $tiempo = '12'; }
			if ($tiempo==13){ $tiempo = '01'; }
			if ($tiempo==14){ $tiempo = '02'; }
			if ($tiempo==15){ $tiempo = '03'; }
			if ($tiempo==16){ $tiempo = '04'; }
			if ($tiempo==17){ $tiempo = '05'; }
			if ($tiempo==18){ $tiempo = '06'; }
			if ($tiempo==19){ $tiempo = '07'; }
			if ($tiempo==20){ $tiempo = '08'; }
			if ($tiempo==21){ $tiempo = '09'; }
			if ($tiempo==22){ $tiempo = '10'; }
			if ($tiempo==23){ $tiempo = '11'; }
			
			$tiempo .= ':'.$t[1].':'.$t[2];
			$tiempo .= ' p.m.';
		}
		return $tiempo;
	}
}

?>
