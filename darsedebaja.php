<?php
require_once("inc/conexion.inc.php");

?>

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














	<body>

			<?php

		if(isset($_SESSION["usuario"])){

			require_once("inc/header2.inc.php");

		}else{
			require_once("inc/header.inc.php");
		}

		?>

		<br>

		<p id="informacion">

		Si pulsa a Aceptar, su usuario desaparecerá

		<br>
		<br>
			<a id="nuevafoto" href="menuusuarioregistrado.php">Volver</a>
			<a id="nuevafoto" href="respuesta_darsedebaja.php">Aceptar</a>
		</p>









		<?php

		require_once("inc/footer.inc.php");
		?>

	</body>
</html>
