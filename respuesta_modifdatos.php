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
    $cambioemail=false;
    $cambiociudad=false;
    $cambiocontraseña=false;
    $erroremail=false;
    $errorpass=false;
    $errorciudad=false;


    $sentencia='SELECT * FROM Usuarios WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
    $resultado = mysqli_query($link,$sentencia);
    $fila=mysqli_fetch_assoc($resultado);
    if(isset($_POST['email_control'])){
      $email = $_POST['email_control'];
      if(!filter_var($email, FILTER_SANITIZE_EMAIL)){
        $erroremail=true;
      }
      else{
        if(strcmp($email,$fila['Email'])!=0){
          $cambioemail=true;
        }
      }
    }
    if(isset($_POST['ciudad_control'])){
      $ciudad=$_POST['ciudad_control'];
      if(!filter_var($ciudad, FILTER_SANITIZE_STRING)){
        $errorciudad=true;
      }
      else{
        if(strcmp($ciudad,$fila['Ciudad'])!=0){
          $cambiociudad=true;
        }
      }
    }
    if((isset($_POST['pass_control']) && isset($_POST['pass_control2'])) && $_POST['pass_control']!=null && $_POST['pass_control2']!=null) {
        if(strcmp($_POST['pass_control'], $_POST['pass_control2'])==0){
            $pass=$_POST['pass_control'];
            if(strcmp($pass, $fila['Clave'])!=0){
                $cambiocontraseña=true;
            }
          }
            else{
              $errorpass=true;
            }
          }
            else if((!isset($_POST['pass_control']) && isset($_POST['pass_control2'])) || (isset($_POST['pass_control']) && !isset($_POST['pass_control2']))){
              $errorpass=true;
            }

            if(!$erroremail && !$errorciudad && !$errorpass){
            if(!$cambioemail && !$cambiociudad && !$cambiocontraseña){
              //No se ha modificado ningun parametro
            }
            else{
              echo '<br>';
              echo '<h2 class="titulos">Modificaciones:</h2>';
              echo '<br>';
              echo '<form><fieldset>';

              if($cambioemail){
                  echo '<p>Nuevo e-mail: '.$email.'</p>';
                  $sentencia2='UPDATE usuarios SET Email="'.$email.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
                  mysqli_query($link,$sentencia2);
              }
              if($cambiociudad){
                  echo '<p>Nueva ciudad: '.$ciudad.'</p>';
                  $sentencia2='UPDATE usuarios SET Ciudad="'.$ciudad.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
                  mysqli_query($link,$sentencia2);
              }
              if($cambiocontraseña){
                  echo '<p>Nueva contraseña: '.$pass.'</p>';
                  $sentencia2='UPDATE usuarios SET Clave="'.$pass.'" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
                  mysqli_query($link,$sentencia2);
              }
              echo '<p><a id="nuevafoto" href="menuusuarioregistrado.php">Volver</a></p>';
              echo '</fieldset></form>';
            }
          }
          else{
            if($erroremail){
              echo '<p id="informacion">
                      Estructura de e-mail incorrecta
                    </p>';
            }
            if($errorciudad){
              echo '<p id="informacion">
                      Formato de ciudad incorrecto
                    </p>';
            }
            if($errorpass){
              echo '<p id="informacion">
                      Las contraseñas deben coincidir
                    </p>';
            }
            echo '<a href="menuusuarioregistrado.php" id="nuevafoto">Volver</a>';
          }
    ?>

		<?php
    mysqli_close($link);
		require_once("inc/footer.inc.php");
		?>

	</body>
</html>
