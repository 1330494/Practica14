<?php
	//session_start();
	if (isset($_SESSION['validar'])) {
		$_SESSION['validar'] = null;
		$_SESSION["rol"] = null;
		$_SESSION["password"] = null;
		session_destroy();
		echo "
		<script type='text/javascript'>
		    window.location = 'index.php?action=salio';
		</script>";		
	}else{
		echo "
		<script type='text/javascript'>
		    window.location = 'index.php';
		</script>";
	}
?>
