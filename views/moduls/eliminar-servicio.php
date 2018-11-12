<?php 

if(isset($_GET["idServicio"])){
	$idServicio = $_GET["idServicio"];
}


if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new Controlador_MVC();
	$eliminar -> deleteServicioController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idServicio" id="idServicio" value="<?php echo $idServicio; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idServicio').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar este servicio?");

	if (resp && confirmed!="true") {
			alert("Servicio eliminado correctamente.");
			var timer = 1;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=eliminar-servicio&idServicio="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=ver-servicios";
	}

</script>