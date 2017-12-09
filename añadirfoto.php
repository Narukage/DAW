<?php
require_once("inc/conexion.inc.php");

?>

<!DOCTYPE HTML>
<html lang="es">

	<?php
		$title= "PICSY- Añadir foto";
		require_once("inc/head.inc.php");
		?>

	<body>

	<main>
		<?php

			if(isset($_SESSION["usuario"])){

				require_once("inc/header2.inc.php");

			}else{
				require_once("inc/header.inc.php");
			}
			?>

			<ul class=navegacion>
				<li ><a id="atras" title="Atrás" href="menuusuarioregistrado.php">Atrás</a></li>
			</ul>
			<br>

			<h2 class='titulos'>Añade una foto</h2>

			<form method="post" enctype="multipart/form-data" action="respuesta_añadirfoto.php" >
			<fieldset>

				<legend>Rellena los datos</legend>


							<p><label for="titulo">Título:</label> <input type="text" name="titulo" accept="image/*" id="titulo" required ></p>
							<p><label for="titulo">Descripción:</label> <input type="text" name="descripcion" accept="image/*" id="titulo" required ></p>
							<p>
								<label for="fecha">Fecha:</label> <input type="date" name="fecha" id="fecha" required />
							</p>

							<label class="labelForm" for="pais">País</label>
							<select name="pais" id="pais">
								<?php

								$sentencia= 'SELECT * FROM paises';

								$resultado = mysqli_query($link, $sentencia);

									echo "<option value=''></option>";

									while($fila=mysqli_fetch_assoc($resultado)){
										echo "<option value=".$fila['IdPais'].">".$fila['NomPais']."</option>";
									}

									mysqli_free_result($resultado);
								?>
							</select>
							<p><label>Álbum:</label>




								<?php

									$link = @new mysqli(
											 'localhost',   // El servidor
											 'root',    // El usuario
											 '',          // La contraseña
											 'picsy'); // La base de datos

									 if($link->connect_errno) {
									   echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
									   echo '</p>';
									   exit;
									 }
									 $nombre = $_SESSION["usuario"];
									 // Ejecuta una sentencia SQL
									 $sentencia2 = "SELECT IdUsuario from usuarios WHERE NomUsuario='" .$nombre. "'";
									 if(!($resultado = @mysqli_query($link,$sentencia2))) {
									   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
									   echo '</p>';
									   exit;
									 }
									 $fila = mysqli_fetch_assoc($resultado);

									 $sentencia = "SELECT * FROM albumes WHERE albumes.Usuario='" .$fila['IdUsuario']. "'";
									 



									 if(!($resultado = @mysqli_query($link,$sentencia))) {
									   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
									   echo '</p>';
									   exit;
									 }

									  echo '<select name="album">';

									  echo '<option name="album" value=""></option>';
									 while($fila = mysqli_fetch_assoc($resultado)){


										echo '<option name="album" value='.$fila['Titulo'].'>'. $fila['Titulo'] . '</option>';





									 }
									echo '</select>';

							?>
							</p>
		<p><label><b>Foto:</b></label>
    	<input type="file" name="imagen">
			</p>
			<input title="Añadir foto" value="Añadir foto" type="submit" class="centrado" >



		</fieldset>


		</form>


	</main>

		<?php

		require_once("inc/footer.inc.php");
		?>

	</body>

</html>
