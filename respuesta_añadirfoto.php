<?php
require_once("inc/conexion.inc.php");

?>

<!DOCTYPE HTML>


<html lang="ES">
<?php
	$title= "PICSY-Foto añadida";

 require_once("inc/head.inc.php");




?>
	<body>



	<?php
	// llamamos al pie de página
		if(isset($_SESSION["usuario"])){

			require_once("inc/header2.inc.php");

		}else{
			require_once("inc/header.inc.php");
		}
	?>



	<?php


		$titulo=$_POST['titulo'];
		$descripcion=$_POST['descripcion'];
		$fecha=$_POST['fecha'];
		$album=$_POST['album'];
		$pais=$_POST['pais'];
		$foto="imagen.jpg";
		$hora = date ("Y-m-d H:i:s"); // para la fecha de registro

		$msg="";


	//arreglo lo de la clave ajena de Albumes

		$conAlbum = "SELECT * FROM albumes WHERE Titulo='" .$album. "'";

		$resultado = mysqli_query($link, $conAlbum);

		$fila=mysqli_fetch_assoc($resultado);

	//Comprobamos que la imagen a subir es correcta
	$error=false;

	if ($_FILES["imagen"]["error"] != 0)
		{
		 echo "Error de archivo".$_FILES["imagen"]["error"]."<br/>";
		}

		if($_FILES["imagen"]["type"] == ("image/jpeg") //Formatos de imagen validos
			|| $_FILES["imagen"]["type"] ==("image/gif")
			|| $_FILES["imagen"]["type"] ==("image/jpg")
			|| $_FILES["imagen"]["type"] ==("image/png")
			|| $_FILES["imagen"]["type"] == ("image/bmp")
			|| $_FILES["imagen"]["type"] ==("image/vnd.microsoft.icon")
			|| $_FILES["imagen"]["type"] ==("image/tiff")
			|| $_FILES["imagen"]["type"] ==("image/svg+xml")
			){
		}else{
			$error=true;
			echo "<p id='error'>El formato de la imagen no es correcto. Solo se soportan formatos png, jpg-jpeg-jpe, bmp, gif, tiff o svg.</p>";
		}

		if(ceil($_FILES["imagen"]["size"]/(1024*1024))>50){ //Tamanio de imagen valido
			$error=true;
			echo "<p id='error'>Archivo demasiado grande, suba uno más pequeño.</p>";
		}

		$num = rand(0, 1000);

		if(!$error){
			//SUBIDA IMAGEN
			$dir_subida = 'C:\xampp\htdocs\PARALUJAN\dec\\'; //Movemos la imagen subida a la carpeta dec\
			//Aniado tanto el nombre del usuario como un numero aleatorio para que no se chafen los archivos
			$fichero_subido = $dir_subida . $titulo . $fecha . $num . basename($_FILES['imagen']['name']);

			if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
					echo "<h2 id='titulos'>¡Imagen subida correctamente!</h2>";
			} else {
				echo "<p id='error'>Error en la subida de imagen.</p><br>";
			}

			$fichero_subido = addslashes('/PARALUJAN/dec/' . $titulo . $fecha . $num . basename($_FILES['imagen']['name']));

			//aqui hago la sentencia insert
			$sentencia="INSERT INTO fotos(Titulo, Descripcion, Fecha, Pais, Album, Fichero, Fregistro)
						VALUES ('".$titulo."','" .$descripcion. "','" .$fecha. "','" .$pais. "','" .$fila['idAlbum']. "','" .$fichero_subido. "','" .$hora. "')";
			if($resultado = $link->query($sentencia)) {
					?>
		<div class="detalle">
		<form action="index.php">
		<fieldset>
		<legend>Foto subida con éxito </legend>
		<div class="datos">
		<?php



			$consulta3 = 'SELECT * FROM paises WHERE IdPais="' . $_POST['pais'] . '"';
			$resultado3 = mysqli_query($link, $consulta3);
			$fila=mysqli_fetch_assoc($resultado3);
			/*if($foto!=""){ echo "<b>Sexo:</b> " . $_POST['sexo'] . "<br>";}*/
			if($titulo!=""){ echo "<b>Título:</b> " . $titulo . "<br>";}
			if($descripcion!=""){ echo "<b>Descripción: </b>" . $descripcion. "<br>";}
			if($_POST['pais']!=""){ echo "<b>Pais: </b>" . $fila['NomPais']. "<br>";}
			if($album!=""){ echo "<b>Álbum: </b> " . $album. "<br>";}
			if($fecha!=""){ echo "<b>Fecha: </b> " . $fecha. "<br>";}

		}

		?>


		<input type="submit" value="Volver al inicio">

		</fieldset>

		</form>
	<?php
			}else{
				//error de sentencia
				echo "<p>Error al ejecutar la sentencia <b>" .$sentencia. "</b>: " . $link->error;
				echo "</p>";
				exit;
			}


?>



	<?php
	// llamamos al pie de página
		require_once("inc/footer.inc.php");
	?>



	</body>

</html>
