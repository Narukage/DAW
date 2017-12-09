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
		$pais=$_POST['pais'];
		$usuario=$_SESSION["usuario"];


		$msg="";




	//aquí ya hacemos el insert en la base de datos


	$nombre = $_SESSION["usuario"];
	$sentencia2 = "SELECT IdUsuario from usuarios WHERE NomUsuario='" .$nombre. "'";
	if(!($resultado = @mysqli_query($link,$sentencia2))) {
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
		echo '</p>';
		exit;
	}
	$fila = mysqli_fetch_assoc($resultado);

			//aqui hago la sentencia insert
			$sentencia="INSERT INTO albumes(Titulo, Descripcion, Fecha, Pais, Usuario)
						VALUES ('".$titulo."','" .$descripcion. "','" .$fecha. "','" .$pais. "','" .$fila['IdUsuario']. "')";
			if($resultado = $link->query($sentencia)) {
					?>
		<div class="detalle">
		<form action="index.php">
		<fieldset>
		<legend>Álbum creado con éxito </legend>
		<div class="datos">
		<?php




			$consulta3 = 'SELECT * FROM paises WHERE IdPais="' . $_POST['pais'] . '"';
			$resultado3 = mysqli_query($link, $consulta3);
			$fila=mysqli_fetch_assoc($resultado3);
			/*if($foto!=""){ echo "<b>Sexo:</b> " . $_POST['sexo'] . "<br>";}*/
			if($titulo!=""){ echo "<b>Título:</b> " . $titulo . "<br>";}
			if($descripcion!=""){ echo "<b>Descripción: </b>" . $descripcion. "<br>";}
			if($_POST['pais']!=""){ echo "<b>Pais: </b>" . $fila['NomPais']. "<br>";}
			if($usuario!=""){ echo "<b>Usuario: </b> " . $nombre. "<br>";}
			if($fecha!=""){ echo "<b>Fecha: </b> " . $fecha. "<br>";}



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
