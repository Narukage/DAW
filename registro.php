<?php
require_once("inc/conexion.inc.php");

?>

<!DOCTYPE HTML>
<html lang="es">

	<?php
		$title= "PICSY-Registro";
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

		<h2 class="titulos">Registro</h2>

		<form enctype="multipart/form-data" id="registro" action="nuevoregistro.php" method="POST">
			<fieldset title="Formulario de registro">
				<legend id="regis">Datos de usuario</legend>
				<p>
					<label for="nombre">Nombre de usuario:</label> <input type="text" id="nombre" name="nombre" required  >
				</p>
				<p>
					<label for="contraseña">Contraseña:</label> <input type="password" name="contra" id="contraseña" required>
				</p>
				<p>
					<label for="repetir">Repetir contraseña:</label> <input type="password" name="contra2" id="repetir" required>
				</p>
				<p>
					<label for="correo" id="email">Email:</label> <input type="email" name="email" placeholder="miusuario@hotmail.com" id="correo" required >
				</p>

				<p>
					Sexo:
				</p>
				<p>
					<label>Hombre<input type="radio" name="sexo" value="Hombre" checked required > </label>
					<label>Mujer<input type="radio" name="sexo" value="Mujer" required > </label>
				</p>
				<p>
					<label for="nacimiento">Fecha de nacimiento:</label> <input type="date" name="fecha" id="nacimiento" required />
				</p>
				<p>
					<label for="ciudad">Ciudad:</label> <input type="text" id="ciudad" name="ciudad">
				</p>
				<p>
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
				</p>
				<p>
					<label for="foto">Foto de perfil:</label> <input type="file" name="foto" id="foto" accept="" required>
				</p>
				<p>
					<input title="Crear usuario" type="submit" value="Registrarme" class="centrado" >
				</p>
			</fieldset>
				</form>

	<?php

		require_once("inc/footer.inc.php");
		mysqli_close($link);
		?>

	</body>

</html>
