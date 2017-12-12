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
	
    $vacio_pass=false;
	$no_iguales=false;
	$error_pass=false;
	
	$email=null;
	$ciudad=null;
	$pass=null;
	
	$hay_modificaciones=false;
	


    $sentencia='SELECT * FROM Usuarios WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
    $resultado = mysqli_query($link,$sentencia);
    $fila=mysqli_fetch_assoc($resultado);
    if(isset($_POST['email_control']) && empty($_POST['email_control']==false)){ //Si ha metido el email, y no está vacío.
			echo "entrooooooooo";
      if(filter_var($_POST['email_control'], FILTER_VALIDATE_EMAIL)){ //Si el email coincide con el formato de e-mail
	  echo "entrooooooooo";
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
		echo "entro3";
		 $vacio_ciudad=true; //Vacío 
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
		echo "entro4";
		$vacio_pass=true; //Una de las dos contraseñas o las dos están vacías
	}


            if(!$error_email && !$error_ciudad && !$error_pass && !$no_iguales && $hay_modificaciones ){

				

			 echo "entrooooooooo";
              echo '<br>';
              echo '<h2 class="titulos">Modificaciones:</h2>';
              echo '<br>';
              echo '<form><fieldset>';

              if($email!=null){
                  echo '<p>Nuevo e-mail: '.$email.'</p>';
                  $sentencia2='UPDATE usuarios SET Email="'.$email.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
                  mysqli_query($link,$sentencia2);
              }
              if($ciudad!=null){
                  echo '<p>Nueva ciudad: '.$ciudad.'</p>';
                  $sentencia2='UPDATE usuarios SET Ciudad="'.$ciudad.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
                  mysqli_query($link,$sentencia2);
              }
              if($pass!=null){
                  echo '<p>Nueva contraseña: '.$pass.'</p>';
                  $sentencia2='UPDATE usuarios SET Clave="'.$pass.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
                  mysqli_query($link,$sentencia2);
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
			if(!$hay_modificaciones && !$error_email && !$error_ciudad && !$error_pass && !$no_iguales){
				
				echo '<p id="informacion">
                      No has realizado ninguna modificación
                    </p>';
				
				
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
