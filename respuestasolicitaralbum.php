<?php
require_once("inc/conexion.inc.php");

?>

<!DOCTYPE HTML>
<html lang="es">

	<?php
		$title= "PICSY- Álbum solicitado";
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
		<br>





	<main>

		<?php
		$multiplicador=0;
		$resol=0;
		$text ="";
		//blanco y negro

		if(isset($_POST["tipo"]) && $_POST["tipo"] == 'Blanco y negro'){

				$text = $_POST["tipo"];


			}
			else{
				$text = $_POST["tipo"];
				$multiplicador=0.5;


			}

		//a color

		if(isset($_POST["resolution_control"])){
			if($_POST["resolution_control"] > 300){
				$resol=0.02;
			}
		}
		//$price = 2 + $_POST["copias"] * $multiplicador * $_POST["resolution_control"]/150*0.20;
		$price = (20 * 0.07 + ($multiplicador * 50) + (50 * $resol)) * $_POST["copias"];
		echo "
				<h2 class='titulos'>¡Solicitud de álbum registrada!</h2>

		<fieldset>
			<legend><h3 id='iniciarsesion'>Datos del álbum</h3></legend>";
		?>
		<?php

		$error=false;
		$msgError="";

		if(isset($_POST["fecha"])){
			if(($fecha= strtotime($_POST["fecha"]))===false){
				$error=true;
				$msgError.="<p>La fecha debe de ser del tipo dd/mm/aaaa o dd-mm-aaaa </p>";
			}else{
                $fecha=date("Y:m:d",strtotime($_POST["fecha"]));
            }
		}else{
			$fecha=null;
		}
		$album=$_POST["album"];
		filter_var($album,FILTER_SANITIZE_STRING);

		if(isset($_POST["adicional"])){
			$descripcion=$_POST["adicional"];
			filter_var($descripcion,FILTER_SANITIZE_STRING);
		}else{
			$descripcion="Sin descripción";
		}
		$nombre = $_POST['nombre'];
		$titulo = $_POST['titulo'];
		$email = $_POST['email'];
		filter_var($email,FILTER_SANITIZE_EMAIL);

		$color = $_POST["tipocolor"];
		$copias = $_POST["copias"];
		$resolucion = $_POST["resolution_control"];
		$tipo = $_POST["tipo"];

		if(isset($_POST["calle"]) && isset($_POST['numero']) && isset($_POST['piso'])
		 && isset($_POST['puerta']) && isset($_POST['cp'])){
			$direccion = $_POST["calle"]." , ".$_POST["numero"]." , ".$_POST["piso"] ." , ". $_POST["puerta"] ." , ". $_POST["cp"];
		}else if(isset($_POST['calle'])){
			$direccion = $_POST['calle'];
		}else{
			$direccion = "sin direccion";
		}

		$sentencia2 = 'SELECT idAlbum from albumes WHERE Titulo ="'. $_POST['album'].'"';
		if(!($resultado = @mysqli_query($link,$sentencia2))) {
			echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . mysqli_error($link);
			echo '</p>';
			exit;
		}
		 $fila = mysqli_fetch_assoc($resultado);

		if(!$error){
			$sentencia ='INSERT INTO solicitudes VALUES(null,"'.$fila['idAlbum'].'","'
				.$_POST['nombre'].'","'.$_POST['titulo'].'","'.
				$_POST['adicional'].'","'.$email.'","'.
				$direccion.'","'.$_POST['tipocolor'].
				'","'.$_POST['copias'].'","'.$_POST['resolution_control'].
				'","'.$fecha.'","'.$text.'",'.time().',"'.$price.'")';
			if(!$identificador=mysqli_query($link, $sentencia)){
				$desc_error=mysqli_error($link);
				echo '<div class="alert">
						No se ha podido insertar dentro de la base de datos.
						Descripción del error:'.$desc_error.'
					 </div>';
			}
			echo "</p>
			<p><b>Nombre: </b>". $nombre."</p>
			<p><b>Título del álbum: </b>". $titulo."</p>
			<p><b>Texto adicional: </b>". $descripcion."</p>
			<p><b>Direccion: </b>". $direccion."</p>
			<p><b>Color de portada: </b> </p>
			<input type='color' name='color-confirmacion' value='".$tipo."'/>
			<p><b>Número de copias: </b>". $copias."</p>
			<p><b>Resolución: </b>". $resolucion."</p>
			<p><b>Impresión a: </b>". $text."
			</p>


			<p><b>Precio final: </b>". $price ."€</p>
			<p><a type='submit'href='menuusuarioregistrado.php' id='albumnuevo' class='centrado'>Volver a la página principal<a></p>

		</fieldset>";
	}
		?>
	</main>

		<?php
		mysqli_close($link);
		require_once("inc/footer.inc.php");
		?>

	</body>

</html>
