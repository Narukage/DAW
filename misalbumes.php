<?php
require_once("inc/conexion.inc.php");

?>
<!DOCTYPE HTML>

<!--Contiene un formulario con los datos necesarios para crear un álbum (título, descripción, fecha y país).-->
<html lang="es">
	<?php
		$title= "PICSY-Mis álbumes";
		require_once("inc/head.inc.php");
		?>

	<body>

			<?php

		if(isset($_SESSION["usuario"])){

			$nombre = $_SESSION["usuario"];
			require_once("inc/header2.inc.php");
				}

		else{
			require_once("inc/header.inc.php");
		}
		?>

		<ul class=navegacion>
			<li ><a id="atras" title="Atrás" href="menuusuarioregistrado.php">Atrás</a></li>
		</ul>
		<br>

		<h2 class="titulos">Elige tu álbum</h2>

			<form action="veralbum.php" method="POST">
			<fieldset title="Formulario de elección de álbum">
				<legend id="album">Elige tu álbum</legend>
				<p>

				<p>
							<?php

					 // Ejecuta una sentencia SQL
					 $sentencia = "SELECT * FROM albumes, usuarios WHERE usuarios.NomUsuario='$nombre' AND albumes.Usuario=usuarios.IdUsuario";
					 if(!($resultado = @mysqli_query($link,$sentencia))) {
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
					   echo '</p>';
					   exit;
					 }
			
					$cont = 0;
					
					
					
					$puesto=false;
					
					 while($fila=mysqli_fetch_assoc($resultado)){
						 if(!empty($fila)){
							$puesto=true;
						 	if($cont==0){
								
								 echo '<select name= "album">';
								 echo '<option value=""></option>';
							}

							$cont=$cont+1;
							echo '<option value='.$fila['Titulo'].'>'. $fila['Titulo'] . '</option>';
						 }
					}
					if($puesto){
						echo '</select>';
						echo '<p><input type="submit" title="ver album" id="albumnuevo" value="Ver Album" class="centrado"></input></p>';
					}
					else{
						 echo '<p id="informacion" >Todavía no tienes álbumes</p>';
					 }
					?>
				</p>

			</fieldset>
		</form>

	<?php

		require_once("inc/footer.inc.php");
		?>
	</body>

</html>
