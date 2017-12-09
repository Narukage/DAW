<?php session_start(); ?>



<!DOCTYPE HTML>
<html lang="es">
		<?php
		$title= "PICSY-Detalle fotografía";
		require_once("inc/head.inc.php");
		?>
		
<?php

if(!isset($_SESSION["usuario"])){
	
	$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$pag = 'index.php';
				header("Location: http://$host$uri/$pag");	
}

?>

	<legend>
	
		<p>Si pulsa a Aceptar, su usuario desaparecerá </p>
		
			<li><a href="menuusuarioregistrado.php">Volver</a></li>
			<li><a href="respuesta_darsedebaja.php">Darme de baja</a></li>
	
	
	
	
	</legend>
	
	
	









	<body>
		
			<?php
		
		if(isset($_SESSION["usuario"])){
		
			require_once("inc/header2.inc.php");

		}else{
			require_once("inc/header.inc.php");
		}

		?>

		
		
		
		
		
		
		
		


		
		<?php
		
		require_once("inc/footer.inc.php");
		?>
		
	</body>
</html>