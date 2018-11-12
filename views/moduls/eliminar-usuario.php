<?php 

if(isset($_GET["idUsuario"])){
	$idUsuario = $_GET["idUsuario"];
}


if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new Controlador_MVC();
	$eliminar -> deleteUsuarioController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $idUsuario; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idUsuario').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar el usuario?");

	if (resp && confirmed!="true") {
			alert("Eliminado correctamente.");
			var timer = 1;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=eliminar-usuario&idUsuario="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=ver-usuarios";
	}

</script>
