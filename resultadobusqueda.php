<?php
require_once("inc/conexion.inc.php");

?>
<!DOCTYPE HTML>

<html lang="es">



	<?php
		$title= "PICSY-Resultado búsqueda";
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


		<section class="formulario">
			<h2 class="titulos">Resultado de búsqueda</h2>

	 	<ul>
	 		<?php

	        	$metepais=false;
	        	$metefecha=false;






						$sentencia= 'SELECT * FROM fotos, paises WHERE fotos.Pais=paises.IdPais';



	        	if(isset($_POST["titulo"])){
	        		$sentencia.=" AND fotos.Titulo LIKE '%".$_POST['titulo']."%' ";


							if(!($resultado = @mysqli_query($link,$sentencia))) {
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
					   echo '</p>';
					   exit;
					 }

					 	}
				if(isset($_POST["fechadesde"])&& strcmp($_POST["fechadesde"],"")!=0){

					$metefecha=true;
					$sentencia.=" AND (fotos.Fecha BETWEEN '".$_POST['fechadesde']."' AND ";


				}
				if($metefecha){
					if(isset($_POST["fechahasta"])&& strcmp($_POST["fechahasta"],"")!=0){
					/*	if(strcmp($_POST["fechahasta"],"")!=0 && strtotime($_POST["fechahasta"])>=strtotime($_POST["fechadesde"])){
						$sentencia.=" '".$_POST["fechahasta"]."')";
						}*/
						$sentencia.=" '".$_POST["fechahasta"]."')";
			}
		}

				if(isset($_POST["pais"]) && strcmp($_POST["pais"],"")!=0 ){

					$metepais=true;
					$sentencia.=" AND paises.IdPais='".$_POST['pais']."'";


				}

				/*echo $sentencia;*/


				$puesto=false;
		$cosa = mysqli_query($link, $sentencia);
		while($fila=mysqli_fetch_assoc($cosa)){
			/*print_r($fila);*/
			if(!$puesto){
					echo "<legend><b>CRITERIOS DE BÚSQUEDA</b>";

				if(isset($_POST["titulo"]) && strcmp($_POST["titulo"],"")!=0){
					if(!$puesto){
						echo "<div class='alert2'>";
						$puesto=true;
					}
					echo "Has buscado el título: $_POST[titulo]";
				}
				if(isset($_POST["pais"]) && strcmp($_POST["pais"],"")!=0){
					if(!$puesto){
						echo "<div class='alert2'>";
						$puesto=true;
					}
					echo "<br>En el país: ".$fila['NomPais'];
				}
				if(isset($_POST["fechadesde"]) && strcmp($_POST["fechadesde"],"")!=0){
					if(!$puesto){
						echo "<div class='alert2'>";
						$puesto=true;
					}
					echo "<br>Entre las fechas: $_POST[fechadesde]";
				}
				if($metefecha){
					if(isset($_POST["fechahasta"]) && strcmp($_POST["fechahasta"],"")!=0){
						echo "<br> y : $_POST[fechahasta]";
					}else{
						echo"<br> y ahora";
					}
				}
				if($puesto){
					echo "</div>";
				}
					echo "</legend>";
			}
			$puesto=true;
			echo "<article>
				<figure>
					<a href=";
					if(isset($_SESSION["usuario"])){
						echo "detallefoto.php?id=".$fila['IdFoto'];
					}else{
						echo "";
					}
			echo "		><img alt=".$fila['Titulo']." src='".$fila['Fichero']."'/></a>
				</figure>
				<p>
					<b>Título: ".$fila['Titulo']."</b>
				</p>
				<p>
					<b>País: ".$fila['NomPais']."</b>
				</p>
				<p>
					<b>Fecha: ".$fila['Fecha']."</b>
				</p>
			</article>";
			$pais=$fila['NomPais'];
		}
		if(!$puesto){
			echo "<div class='alert'>
				No se han encontrado resultados
			</div>";
		}
		mysqli_free_result($cosa);








	        ?>
		 </ul>
		</section>


		<br>

		<?php
			require_once("inc/footer.inc.php");
			?>

	</body>

</html>
