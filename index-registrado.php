<?php
require_once("inc/conexion.inc.php");

?>


<!DOCTYPE HTML>

<html lang="es">

<?php

  $title=" PICSY- Página principal registrado";
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
		<section>

			<ul class="navegacion">

				<li>


				<form id="contenedorb">
					<input title="Introduzca nombre de la foto" type="text" name="search" placeholder="Buscar...">
					<input title="Buscar imagen" type="submit" type="submit" name="buscar" value="Buscar" >
				</form>


				</li>
				<li title="Desconectar tu usuario de la página" id="registrate"><a href="cerrarsesion.php">Cerrar sesión</a></li>
				<li title="Datos del usuario y acciones de usuario" id="menudelusuario"><a href="menuusuarioregistrado.php">Menú del usuario</a></li>
				<li title="Formulario de búsqueda avanzada" id="busqueda"><a href="busqueda.php">Búsqueda avanzada</a></li>
			</ul>

		</section>

		<section class="formulario">


	 	<ul>
			<?php

	            $sentencia= 'SELECT * FROM fotos,paises WHERE fotos.pais=paises.IdPais GROUP BY FRegistro DESC limit 5';
	            $resultado = mysqli_query($link, $sentencia);
				while($fila=mysqli_fetch_assoc($resultado)){
					echo "<li>
								<a href=";
								if(isset($_SESSION["usuario"])){
									echo "detallefoto.php?id=".$fila['IdFoto'];
								}else{
									echo "";
								}
					echo "		><img alt=".$fila['Titulo']." src='".$fila['Fichero']."'/></a>
							<p>
								<b>Título: ".$fila['Titulo']."</b>
							</p>
							<p>
								<b>País: ".$fila['NomPais']."</b>
							</p>
							<p>
								<b>Fecha: ".$fila['Fecha']."</b>
							</p></li>";
				}
				mysqli_free_result($resultado);

			    ?>
		 </ul>
		</section>

    <section class="formulario">
			<h2 class="titulos">Fotos seleccionadas por críticos fotógrafos</h2>
			<br>
			<br>
			<ul>
				<?php
					include("fotoseleccionada.php");
				?>
			</ul>
		</section>

<?php


 require_once("inc/footer.inc.php");




?>

	</body>

</html>
