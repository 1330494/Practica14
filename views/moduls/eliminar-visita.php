<?php 

if(isset($_GET["idVisita"])){
	$idVisita = $_GET["idVisita"];
}

if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new Controlador_MVC();
	$eliminar -> deleteVisitaController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idVisita" id="idVisita" value="<?php echo $idVisita; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idVisita').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar esta visita?");

	if (resp && confirmed!="true") {
			alert("Visita eliminada correctamente.");
			var timer = 1;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=eliminar-visita&idVisita="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=ver-visitas";
	}

</script>