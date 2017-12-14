<?php
require_once("inc/conexion.inc.php");

?>

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

?>

	<body>

			<?php

		if(isset($_SESSION["usuario"])){

			require_once("inc/header2.inc.php");

		}else{
			require_once("inc/header.inc.php");
		}

		?>

    <?php
    //Modificar los datos de la base de datos por los introducidos en el formulario utilizando los $_POST

    $vacio_email=false;
	$error_email=false;

	$vacio_ciudad=false;
	$error_ciudad=false;
	
	$vacio_foto=false;
	$error_foto=false;
	$error_formato=false;
	$error_tamanyo=false;

    $vacio_pass=false;
	$no_iguales=false;
	$error_pass=false;

	$email=null;
	$ciudad=null;
	$pass=null;
	$foto=null;

	$hay_modificaciones=false;



    $sentencia='SELECT * FROM Usuarios WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
    $resultado = mysqli_query($link,$sentencia);
    $fila=mysqli_fetch_assoc($resultado);
    if(isset($_POST['email_control']) && empty($_POST['email_control']==false)){ //Si ha metido el email, y no está vacío.
	
      if(filter_var($_POST['email_control'], FILTER_VALIDATE_EMAIL)){ //Si el email coincide con el formato de e-mail
		  $email = $_POST['email_control'];
		  $hay_modificaciones=true;
      }
	  else{
	
		  $error_email=true;
	  }
    }
	else{

		  $vacio_email=true;
	}



    if(isset($_POST['ciudad_control']) && empty($_POST['ciudad_control']==false)){
      if(!filter_var($ciudad, FILTER_SANITIZE_STRING)){ //ESTE FILTRO NO HACE NADA EH
		  $ciudad=$_POST['ciudad_control'];
		   $hay_modificaciones=true;
      }
	  else{
		  $error_ciudad=true;
	  }
    }
	else{
		 $vacio_ciudad=true; //Vacío
	}

	

	if(isset($_FILES["foto"]["tmp_name"]) && empty($_FILES["foto"]["tmp_name"])==false ){ //ojito con esta condisión
		if ($_FILES["foto"]["error"]==0){ // no hay errores en la subida
			 if($_FILES["foto"]["type"] == ("image/jpeg") // cumple con los formatos
				 || $_FILES["foto"]["type"] ==("image/gif")
				 || $_FILES["foto"]["type"] ==("image/jpg")
				 || $_FILES["foto"]["type"] ==("image/png")
				 || $_FILES["foto"]["type"] == ("image/bmp")
				 || $_FILES["foto"]["type"] ==("image/vnd.microsoft.icon")
				 || $_FILES["foto"]["type"] ==("image/tiff")
				 || $_FILES["foto"]["type"] ==("image/svg+xml")
				 ){
					 if(ceil($_FILES["foto"]["size"]<2097152)){
						 $foto=$_FILES["foto"]["tmp_name"];
						 $hay_modificaciones=true; //porque todo va de puta madre
					 }
					 else{
						 $error_tamanyo=true;
					 }
					 
		 }
		 else{
			 $error_formato=true;
		 }
		 
		}
		else{

			$error_foto=true;
		}
	}
	else{
		
		$vacio_foto=true; //no ha modificado la foto
	}

	
    if((isset($_POST['pass_control']) && isset($_POST['pass_control2']) && empty($_POST['pass_control']==false) && empty($_POST['pass_control2']==false))) {
        if(strcmp($_POST['pass_control'], $_POST['pass_control2'])==0){
			if(preg_match("/(?!^[0-9]*$)(?!^[a-z]*$)(?!^[A-Z]*$)^([\w]{6,15})$/",$_POST['pass_control'])){
            $pass=$_POST['pass_control']; //las contraseñas son iguales
			$hay_modificaciones=true;
			}
			else{
				$error_pass=true; //NO CUMPLE CON LOS FILTROS
			}
          }
        else{
			  $no_iguales=true; //las contraseñas no son iguales
            }
	}
	else{
		$vacio_pass=true; //Una de las dos contraseñas o las dos están vacías
	}
	/*
			echo '1' . $error_email;
			echo '<br>';
			echo '2' . $error_ciudad;
				echo '<br>';
			echo '3' . $error_pass;
				echo '<br>';
			echo '4' . $error_foto;
				echo '<br>';
			echo '5'. $error_formato;
				echo '<br>';
			echo '6' . $error_tamanyo;
				echo '<br>';
			echo '7' . $hay_modificaciones;

	*/

            if(!$error_email && !$error_ciudad && !$error_pass && !$no_iguales && !$error_foto && !$error_formato && !$error_tamanyo && $hay_modificaciones ){

              echo '<br>';
              echo '<h2 class="titulos">Modificaciones:</h2>';
              echo '<br>';
              echo '<form><fieldset>';

              if($email!=null){
				  
                  echo '<p><b>Nuevo e-mail: </b>'.$email.'</p>';
                  $sentencia2='UPDATE usuarios SET Email="'.$email.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
                  mysqli_query($link,$sentencia2);
              }
              if($ciudad!=null){
				  
                  echo '<p><b>Nueva ciudad: </b>'.$ciudad.'</p>';
                  $sentencia2='UPDATE usuarios SET Ciudad="'.$ciudad.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
                  mysqli_query($link,$sentencia2);
              }
              if($pass!=null){
                  echo '<p><b>Nueva contraseña: </b>'.$pass.'</p>';
                  $sentencia2='UPDATE usuarios SET Clave="'.$pass.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
                  mysqli_query($link,$sentencia2);
              }

				if($foto!=null){
						 $num = rand(0, 1000);
						//SUBIDA FOTO DE PERFIL
						$dir_subida = 'C:\xampp\htdocs\PARALUJAN\perfil\\'; //Movemos la imagen subida a la carpeta perfil\
						//Aniado tanto el nombre del usuario como un numero aleatorio para que no se chafen los archivos
						$fichero_subido = $dir_subida . $num . basename($_FILES['foto']['name']);

						if (!move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {

							echo "<p id='error'>Error en la subida de la foto de perfil.</p><br>";
						}

						$fichero_subido = addslashes('\PARALUJAN\perfil\\' . $num . basename($_FILES['foto']['name']));

						$sentenciafoto='UPDATE usuarios SET Foto="'.$fichero_subido.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
						mysqli_query($link,$sentenciafoto);
						$sentencia ='SELECT * FROM usuarios u, paises p WHERE u.NomUsuario="'.$_SESSION['usuario'].'" AND u.Pais=p.IdPais';
						$resultado = mysqli_query($link,$sentencia);
						$fila=mysqli_fetch_assoc($resultado);

						echo '<p><b>Nueva foto de perfil</b>:  <img src="'.$fila['Foto'].'"></p>';
					}

				  echo '<p><a id="nuevafoto" href="menuusuarioregistrado.php">Volver</a></p>';
				  echo '</fieldset></form>';
				}

          else{

			if($error_email){
              echo '<p id="informacion">
                      Revisa la estructura del e-mail que has introducido, es incorrecta
                    </p>';
            }
            if($error_ciudad){
              echo '<p id="informacion">
                      Revisa el formato de ciudad que has introducido, es incorrecto
                    </p>';
            }
            if($error_pass){
              echo '<p id="informacion">
                      La contraseña no cumple con los requisitos
                    </p>';
            }
			if($no_iguales){
              echo '<p id="informacion">
                          Las contraseñas no coinciden
                    </p>';
            }
			
			if($error_foto){
				
						$msgError = array(0 => "No hay error, el fichero se subió con éxito",
							1 => "Archivo demasiado grande, suba uno más pequeño.",
							2 => "El tamaño del fichero supera la directiva MAX_FILE_SIZE especificada en el formulario HTML",
							3 => "El fichero fue parcialmente subido",
							4 => "No se ha subido un fichero",
							6 => "<p id='error'>No existe un directorio temporal</p>",
							7 => "Fallo al escribir el fichero al disco",
							8 => "La subida del fichero fue detenida por la extensión");
				
							echo "<p id='error'>Mensaje: ".$msgError[$_FILES["foto"]["error"]]."</p><br/>";

			}
			
			if($error_formato){
				 echo "<p id='error'>El formato de la imagen no es correcto. Solo se soportan formatos png, jpg-jpeg-jpe, bmp, gif, tiff o svg.</p>";
				
			}
			
			if($error_tamanyo){
				
				echo "<p id='error'>Archivo demasiado grande, suba uno más pequeño.</p>";
				
			}
			

			if(!$hay_modificaciones && !$error_email && !$error_ciudad && !$error_pass && !$no_iguales && !$error_foto && !$error_tamanyo && !$error_formato
			){

				echo '<p id="informacion">No has realizado ninguna modificación</p>';

			}
        echo '<a href="modifdatos.php" id="nuevafoto">Volver</a>';
    }
    ?>

		<?php
    mysqli_close($link);
		require_once("inc/footer.inc.php");
		?>

	</body>
</html>
