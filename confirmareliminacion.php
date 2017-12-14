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

            echo '<h2 id="titulos" class="titulos">Confirmación</h2>';
            echo '<p id="informacion">';
            echo '¿Desea borrar su foto de perfil?
            <a id="atras" title="Atrás" href="misdatos.php">Atrás</a><a href="fotoeliminada.php" id="nuevafoto">Confirmar</a></p>';

    }
    ?>

</main>

<?php
require_once("inc/footer.inc.php");
?>

</body>
</html>
