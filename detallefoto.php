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

		<ul class=navegacion>
			<li ><a id="atras" title="Atrás" href="index.php">Volver al menú principal</a></li>
			<li ><a id="atras" title="Atrás" href="misalbumes.php">Mis albumes</a></li>
			<li><a href="cerrarsesion.php">Cerrar sesión</a></li>
		</ul>
		<br>

		<?php

		if(isset($_SESSION["usuario"])){

 			// Ejecuta una sentencia SQL
 			$sentencia = 'SELECT * FROM fotos,paises,albumes,usuarios
 							 WHERE fotos.IdFoto="' . $_GET['id'] . '"
							AND fotos.pais=paises.IdPais
							AND fotos.album=albumes.IdAlbum
							AND albumes.Usuario=usuarios.IdUsuario'; //Select de la foto que corresponde con ese id

							if(!($resultado = @mysqli_query($link,$sentencia))) {
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
					   echo '</p>';
					   exit;
					 }

 			$resultado = mysqli_query($link, $sentencia);
				while($fila=mysqli_fetch_assoc($resultado)){
					echo "<h1><img  src='" . $fila['Fichero'] . "' alt='" . $fila['Descripcion'] . "'></h1>";
			        echo "<p><b>País:</b> " . $fila['NomPais'] . "</p>";
			        echo "<p><b>Autor:</b> <a href='perfil.php?nombre=" . $fila['NomUsuario'] . "'>" . $fila['NomUsuario'] . "</a></p>";
			        echo "<p><b>Título:</b> " . $fila['Titulo'] . "</p>";
			        echo "<p><b>Fecha de publicación:</b> " . $fila['FRegistro'] . "</p>";
				}



		}else{

			echo "<h1 class=titulos>Necesitas estar logueado para ver el contenido de esta página</h1>";
		}

		?>




		<?php

		require_once("inc/footer.inc.php");
		?>

	</body>
</html>
