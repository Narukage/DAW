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

	<main>
			<ul class=navegacion>
			<li ><a id="atras" title="Atrás" href="misdatos.php">Atrás</a></li>
		</ul>

    <?php
    if(isset($_SESSION["usuario"])){

      $sentencia ='UPDATE usuarios SET Foto="" WHERE usuarios.NomUsuario="'.$_SESSION['usuario'].'"';
      $resultado = mysqli_query($link,$sentencia);
        echo '<p id="informacion">Su foto ha sido eliminada correctamente</p>';
    }

    ?>

  </main>

  <?php
  require_once("inc/footer.inc.php");
  ?>

  </body>
  </html>
