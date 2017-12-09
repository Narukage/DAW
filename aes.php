<?php
require_once("inc/conexion.inc.php");

?>

<!DOCTYPE HTML>
<html lang="es">
		<?php
		$title= "Prueba AES";
		require_once("inc/head.inc.php");
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
    <form id="registro" name="busqueda" action="encriptacion.php" method="POST">
		<p id="informacion">

    <label for="aes">Introduzca el texto que desea encriptar: </label> <input name="aes" type="text" id="nombre" required  >

		<br>
		<br>
			<input type="submit" value= "Encriptar"/>
		</p>
  </form>









		<?php

		require_once("inc/footer.inc.php");
		?>

	</body>
</html>
