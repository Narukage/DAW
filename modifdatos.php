<?php
require_once("inc/conexion.inc.php");

?>
<!DOCTYPE html>
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
	<hr>
	<main>
        <?php
        if(isset($_SESSION["usuario"])){
            $sentencia ='SELECT * FROM usuarios u WHERE u.NomUsuario="'.$_SESSION['usuario'].'"';
            $resultado = mysqli_query($link,$sentencia);
            $error=false;
            if(!mysqli_query($link, $sentencia)){
                $error=true;
            }
            if($error){
                $desc_error=mysqli_error($link);
                echo '<div class="alert">
                        No se ha podido acceder a los datos de perfil, debes iniciar sesion.'.$desc_error.'
                </div>';
            }else{
                $fila=mysqli_fetch_assoc($resultado);
                if($fila['Sexo']==1){
                    $sexo="Hombre";
                }
                else{
                    $sexo="Mujer";
                }
                echo '<form action="respuesta_modifdatos.php" method="POST">
                        <fieldset>
                        <legend>Modificar datos</legend>
                        <p>
                        <label>E-mail:</label><input type="text" name="email_control" value="'.$fila['Email'].'"pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required />
                        </p>
                        <p>
                        <label>Ciudad:</label><input type="text" name="ciudad_control" value="'.$fila['Ciudad'].'" required/>
                        </p>
                        <p>
                        <label>Nueva contraseña:</label><input type="text" name="pass_control" >
                        </p>
                        <p>
                        <label>Repetir contraseña:</label><input type="text" name="pass_control2" >
                        </p>
                        <p>
                        <label></label><input type="submit" name="submit_control" value="Confirmar">
                        </p>
                        </fieldset>
                        </form>';


            }
        }
        ?>
	</main>

	<?php
		require_once("inc/footer.inc.php");
	?>

</body>
</html>
