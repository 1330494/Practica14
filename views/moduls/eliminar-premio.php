<?php 

if(isset($_GET["idPremio"])){
	$idPremio = $_GET["idPremio"];
}


if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new Controlador_MVC();
	$eliminar -> deletePremioController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idPremio" id="idPremio" value="<?php echo $idPremio; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idPremio').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar este premio?");

	if (resp && confirmed!="true") {
			alert("Premio eliminado correctamente.");
			var timer = 1;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=eliminar-premio&idPremio="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=ver-premios";
	}

</script>