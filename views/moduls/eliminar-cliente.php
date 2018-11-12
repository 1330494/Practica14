<?php 

if(isset($_GET["idCliente"])){
	$idCliente = $_GET["idCliente"];
}

if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new Controlador_MVC();
	$eliminar -> deleteClienteController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idCliente" id="idCliente" value="<?php echo $idCliente; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idCliente').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar este cliente?");

	if (resp && confirmed!="true") {
			alert("Cliente eliminado correctamente.");
			var timer = 1;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=eliminar-cliente&idCliente="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=ver-clientes";
	}

</script>