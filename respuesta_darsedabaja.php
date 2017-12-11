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
		
		//Aquí extraemos el ID, ya que es la clave primaria y a lo que apuntan todas las foreign key
		$sentenciaId = "SELECT * FROM usuario WHERE NomUsuario='".$_SESSION['usuario']."'";
		if(!($resultadoId = $mysqli->query($sentenciaId))) {
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
		echo "</p>";
		exit;
		}
		else{
			$filaId = $resultadoId->fetch_assoc();
			$IDusu = $filaId['IdUsuario'];
		}
		
		//Eliminamos a ese usuario con esa ID, y todo lo demás gracias a las FOREIGN KEY DELETE ON CASCADE.
		$sentencia = "DELETE FROM usuarios WHERE WHERE NomUsuario='".$_SESSION['usuario']."'";
		if(!($resultado = $mysqli->query($sentencia))) {
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
		echo "</p>";
		exit;
		}
		else{
			
			
			echo "Tu usuario ha sido eliminado correctamente. Hasta pronto";
			
			
		}
		
		
		$mysqli->close();
		
		session_destroy();
		
		
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
		exit;








	?>




		
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

</html>