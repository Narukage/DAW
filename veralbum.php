<?php
require_once("inc/conexion.inc.php");

?>

<!DOCTYPE HTML>

<!--Contiene un formulario con los datos necesarios para crear un álbum (título, descripción, fecha y país).-->
<html lang="es">
	<?php
		$title= "PICSY-Ver álbum";
		require_once("inc/head.inc.php");
		?>

	<body>

			<?php

		if(isset($_SESSION["usuario"])){


			require_once("inc/header2.inc.php");
				}

		else{
			require_once("inc/header.inc.php");
		}
		?>

		<ul class=navegacion>
			<li ><a id="atras" title="Atrás" href="menuusuarioregistrado.php">Atrás</a></li>
			<li><a href="cerrarsesion.php">Cerrar sesión</a></li>
		</ul>
		<br>

		<h2 class="titulos">Elige tu álbum</h2>


				<p>

				<p>
							<?php
							
							$puesto=false;

							if(isset($_POST['album'])){
   					 $sentenciaIdAlbum ="SELECT * FROM fotos,albumes,paises WHERE albumes.Titulo= '".$_POST['album']."' AND fotos.Album = albumes.idAlbum AND fotos.Pais = paises.IdPais";


   					 $resultado = mysqli_query($link, $sentenciaIdAlbum);


   					 while($fila=mysqli_fetch_assoc($resultado)){

							$puesto=true;

   					 		echo "<ul>
								<a href=";

									echo "detallefoto.php?id=".$fila['IdFoto'];

					echo "		><img alt=".$fila['Titulo']." src='".$fila['Fichero']."'/></a>
							<p>
								<b>Título: ".$fila['Titulo']."</b>
							</p>
							<p>
								<b>País: ".$fila['NomPais']."</b>
							</p>
							<p>
								<b>Fecha: ".$fila['Fregistro']."</b>
							</p></ul>";
						}
					}
					if(!$puesto){
						echo "<p> El álbum seleccionado no tiene fotografías todavía </p>";
						echo "<a href='misalbumes.php' id='misalbumes'>Mis álbumes</a></li>";
					}


					?>
				</p>


	<?php

		require_once("inc/footer.inc.php");
		?>
	</body>

</html>
</html>
