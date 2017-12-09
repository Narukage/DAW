<?php include("inc/conexion.inc.php"); ?>

<!DOCTYPE HTML>
	<html lang="es">

	<?php
		$title= "PICSY-Solicitud álbum";
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

			<main role="main"><!--medida de accesibilidad, esto no lo soporta Internet Explorer-->
					<section>

						<ul class=navegacion>
							<li ><a id="atras" title="Atrás" href="menuusuarioregistrado.php">Atrás</a></li>
						</ul>
						<br>
						<h2 class="titulos">Formulario de solicitud</h2>

						<p id="informacion">¡Aquí puedes solicitar tu album personalizado. Elige número de páginas, color de impresión, resolución y mucho más! ¿A qué esperas?</p>

						<aside>
							<table>
								<caption><h3>Precios</h3></caption>
								<thead>
									<tr>
										<th>Concepto</th>
										<th>Tarifa</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td> &lt;5 páginas</td>
										<td> 0.10€ por pág</td>

									</tr>
									<tr>
										<td> entre 5 y 10 páginas</td>
										<td> 0.08€ por pág</td>

									</tr>
									<tr>
										<td> > 11 páginas</td>
										<td> 0.07€ por pág</td>

									</tr>
									<tr>
										<td> Blanco y negro</td>
										<td> 0€</td>

									</tr>
									<tr>
										<td> Color</td>
										<td> 0.05€ por foto</td>

									</tr>
									<tr>
										<td> Resolución > 300 dpi</td>
										<td> 0.02€ por foto</td>

									</tr>
								</tbody>
							</table>


						</aside>

						<form id="busqueda" name="busqueda" action="respuestasolicitaralbum.php" method="POST">

						<br>

						<fieldset id="solicitudalbum">
							<legend id="iniciarsesion">Datos para la confección de tu álbum</legend>
							<p><b>Los campos marcados con (*) son obligatorios</b></p>

							<p>
								<label for="nombre"><b>(*)</b>Nombre completo:</label> <input type="text" name="nombre" id="nombre" maxlength="200" title="Nombre y apellidos" required  />
							</p>
							<p>
								<label for="tituloalbum"><b>(*)</b>Título del álbum:</label> <input type="text" name="titulo" id="tituloalbum" maxlength="200" required />
							</p>
							<p> <!-- tiene tope de escritura, 200 caracteres -->
								<label for="adicional">Texto adicional:</label> <textarea rows="4" cols="50" name="adicional" id="adicional" maxlength="4000" placeholder="dedicatoria, descripción de su contenido, etc,..."></textarea> <!-- tengo que añadir fucking mierda aquí-->
							</p>
							<p>
								<label for="correo"><b>(*)</b>Email:</label> <input type="email" name="email" placeholder="miusuario@hotmail.com" id="correo" maxlength="200" required />
							</p>

							<p id="direccion">Dirección:</p>

							<label for="calle">Calle:</label> <input name="calle" type="text" id="calle" required  />
							<label for="numero">Número:</label> <input name="numero" type="text" id="numero"  pattern="[0-9]{1,3}" required  />
							<p>
								<label for="piso">Piso:</label> <input name="piso" type="text" id="piso"  pattern="[0-9]{1,2}" required  />
								<label for="puerta">Puerta:</label> <input name="puerta" type="text" id="puerta" size="4" required  />
							</p>

							<label for="codpostal">CP:</label> <input name="cp" type="text" id="codpostal" size="5" title="código postal" pattern="[0-9]{5}" required  />
							<select name="localidad" required >   <!--el titulico de esto que se ponga bien-->
							<option value="">Localidad</option>
							<option value="palencia">Palencia</option>
							<option value="sanvicent">San Vicente del Raspeig</option>
							</select>
							<select name="provincia" required>
							<option value="">Provincia</option>
							<option value="alicante">Alicante</option>
							</select>


							<p>      <!-- no se me hace bieeeeeeeeeeen --> <!-- me deja escribir letras-->
								<label for="tfno">Teléfono:</label> <input type="tel" name="telf" id="tfno" title="Teléfono fijo o móvil de 9 números" pattern="[0-9]{9}" maxlength="9" size="9" />
							</p>
							<p>
								<label for="clr">Color:</label> <input type="color" id="clr" name="tipocolor" value="#000000" />
							</p>
							<p><label for="copias"><b>(*)</b>Número de copias:</label> <input type="number" name="copias" min="1" max="100" value="1" id="copias" required /></p>
							<p><label for="res">Resolución de impresión:</label>
							<input type="number" min="150" max="900" value="150" name="resolution_control" step="150" id="res" size="3" /> PDI</p>
							<p><label for="album"><b>(*)</b>Álbum:</label>

														<?php

					 if($link->connect_errno) {
					   echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
					   echo '</p>';
					   exit;
					 }

					 // Ejecuta una sentencia SQL
					 $nombre = $_SESSION["usuario"];
					 // Ejecuta una sentencia SQL
					 $sentencia2 = "SELECT IdUsuario from usuarios WHERE NomUsuario='" .$nombre. "'";
					 if(!($resultado = @mysqli_query($link,$sentencia2))) {
					 	echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
					 	echo '</p>';
					 	exit;
					 }
					 $fila = mysqli_fetch_assoc($resultado);

					 $sentencia = "SELECT * FROM albumes WHERE Usuario='" .$fila['IdUsuario']. "'";
					 if(!($resultado = @mysqli_query($link,$sentencia))) {
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
					   echo '</p>';
					   exit;
					 }

					  echo '<select name= "album" id="album" required>';

					  echo '<option value=""></option>';
					 while($fila = mysqli_fetch_assoc($resultado)){


						echo '<option value='.$fila['Titulo'].'>'. $fila['Titulo'] . '</option>';





					 }
					 echo '</select>';
					?>
							</p>
							<p><label for="desde">Fecha recepción entre:</label> <input type="date" name="fecha" id="desde" required  />
							<p>
							<label for="hasta">y:</label><input type="date" name="fecha" id="hasta" required />
							</p>

							<p>
							Color de impresión:
							</p>
							<p>
							<label for="coloreado">Coloreado</label><input type="radio" name="tipo" value= "Color" id="coloreado"  />
							<label for="byn">Blanco y negro</label><input type="radio" name="tipo" value="Blanco y negro" id="byn" checked />
							</p>

							<input type="submit" value= "Enviar"/>


							</fieldset>

						</form>

					</section>

				<br>
			</main>

	<?php

		require_once("inc/footer.inc.php");
		?>

		</body>

	</html>
