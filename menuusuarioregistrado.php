<?php
require_once("inc/conexion.inc.php");

?>

<?php

if(!isset($_SESSION["usuario"])){ //ESTO HAY QUE HACERLO??

	$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$pag = 'index.php';
				header("Location: http://$host$uri/$pag");


				}

?>


<!DOCTYPE HTML>
<html lang="es">

	<?php
		$title= "PICSY- Menú usuario registrado";
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


		<main>

			<section>
				<ul class=navegacion>
					<li ><a id="atras" title="Atrás" href="index-registrado.php">Atrás</a></li>
					<li><a href="paginaSolicitarAlbum.php">Solicitar album</a></li>
					<li><a href="cerrarsesion.php">Cerrar sesión</a></li>
					<li><a href="darsedebaja.php">Darme de baja</a></li>
				</ul>

				<p class="contenedorb">
					<a href="misalbumes.php" id="misalbumes">Mis álbumes</a></li>
					<a href="crearalbum.php" id="albumnuevo">Crear álbum</a></li>
					<a href="añadirfoto.php" id="nuevafoto">Añadir foto</a></li>
					<a href="misdatos.php" id="nuevafoto">Mis Datos</a></li>

				</p>
			</section>

			<?php
			if(isset($_SESSION["usuario"]) && isset($_COOKIE["usuario"])){
						if(($_POST["usuario"]=="usuario1" && $_POST["password"]=="uno")
				|| ($_POST["usuario"]=="usuario2" && $_POST["password"]=="dos")
				|| ($_POST["usuario"]=="usuario3" && $_POST["password"]=="tres")){
				echo "<p id='informacion'> Bienvenido/a " . $_SESSION["usuario"] . "<br>" ."Su última conexión fue el " . $_COOKIE["fecha"] . " a las " . $_COOKIE["hora"] . "<br>
				<a href='salir.php' id='fuera'> Salir </a></p>";
				}
			}
			else{

				echo "<p id='informacion'> Bienvenido/a " . $_SESSION["usuario"] . " por primera vez <br>" ."<br>
				<a href='salir.php' id='fuera'> Salir </a></p>";
				}

			?>


		</main>

	<?php

		require_once("inc/footer.inc.php");
		?>

	</body>

</html>
