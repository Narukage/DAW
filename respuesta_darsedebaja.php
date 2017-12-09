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

		<?php
								if(isset($_SESSION["usuario"])){
										$nombre=$_SESSION['usuario'];
										setcookie("nombre","",time()-3700000);
										setcookie("password","",time()-37000000);
										setcookie("fecha","",time()-37000000);
										setcookie("hora","",time()-3700000);
										session_destroy();
										$sentencia3 = 'SELECT * FROM usuarios WHERE usuarios.NomUsuario="'.$nombre.'"';
										$resultado = mysqli_query($link,$sentencia3);
								    $fila=mysqli_fetch_assoc($resultado);
										echo $fila['IdUsuario'];

										$sentencia2='DELETE FROM albumes WHERE albumes.Usuario="'.$fila['IdUsuario'].'"';
										if(!($resultado2 = @mysqli_query($link,$sentencia2))) {
				 					   echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
				 					   echo '</p>';
				 					   exit;
				 					 }
										$sentencia='DELETE FROM usuarios WHERE usuarios.NomUsuario="'.$nombre.'"';
										mysqli_query($link,$sentencia2);
										mysqli_query($link,$sentencia);
										echo '<p id=informacion>
														El perfil ha sido borrado de nuestra base de datos.';
										echo '<a id="nuevafoto" href="index.php">Aceptar</a></p>';
									}
?>

		<?php

		require_once("inc/footer.inc.php");
		?>

	</body>
</html>
