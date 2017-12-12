<?php
require_once("inc/conexion.inc.php");

?>

<?php

if(!isset($_SESSION["usuario"])){

	$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$pag = 'index.php';
				header("Location: http://$host$uri/$pag");


				}

?>


<!DOCTYPE HTML>
<html lang="es">

	<?php
		$title= "PICSY- Menú usuario registrado";
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


		<main>

			<section>
				<ul class=navegacion>
          <li ><a id="atras" title="Atrás" href="menuusuarioregistrado.php">Atrás</a></li>
					<li><a href="cerrarsesion.php">Cerrar sesión</a></li>
				</ul>
        <br>

			<?php

			if(isset($_SESSION["usuario"])){

            $sentencia ='SELECT * FROM usuarios u, paises p WHERE u.NomUsuario="'.$_SESSION['usuario'].'" AND u.Pais=p.IdPais';
            $resultado = mysqli_query($link,$sentencia);
            $error=false;
            if(!mysqli_query($link, $sentencia)){
                $error=true;
            }
            if($error){
                $desc_error=mysqli_error($resultado);
                echo '<div class="alert">
                        No se ha podido acceder a los datos de perfil, debes iniciar sesion.'.$desc_error.'
                </div>';
            }else{
                $fila=mysqli_fetch_assoc($resultado);
            	}
                if($fila['Sexo']==1){
                    $sexo="Hombre";
                }
                else{
                    $sexo="Mujer";
                }
                echo '<form>
                	<fieldset>
                		<legend>Datos del perfil</legend>
                		<br></br>

                        <img src="'.$fila['Foto'].'">
                        <b>Nombre:</b> '.$fila['NomUsuario'].'
                        </p>
                        <p>
                        <b>Correo electrónico:</b>'.$fila['Email'].'
                        </p>
                        <p>
                        <p>
                        <b>Pais:</b> '.$fila['NomPais'].'
                        </p>
                        <p>
                        <b>Ciudad:</b> '.$fila['Ciudad'].'
                        </p>
                        <p>
                        <b>Sexo:</b> '.$sexo.'
                        </p>
                        <p>
                        <b>Nacimiento:</b> '.$fila['FNacimiento'].'
                        </p>
                        <br></br>

            <a href="modifdatos.php" id="nuevafoto">Modificar datos</a>
						<a href="darsedebaja.php" id="nuevafoto">Darse de baja</a>
						<br></br>
                        </fieldset>
                        </form>';
                    }
                ?>

		</main>

	<?php

		require_once("inc/footer.inc.php");
		?>

	</body>

</html>
