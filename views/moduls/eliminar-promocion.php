<?php 

if(isset($_GET["idPromocion"])){
	$idPromocion = $_GET["idPromocion"];
}


if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new Controlador_MVC();
	$eliminar -> deletePromocionController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idPromocion" id="idPromocion" value="<?php echo $idPromocion; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idPromocion').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar esta promocion?");

	if (resp && confirmed!="true") {
			alert("Promocion eliminada correctamente.");
			var timer = 1;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=eliminar-promocion&idPromocion="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=ver-promociones";
	}

</script>