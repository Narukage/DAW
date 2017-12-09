<?php session_start(); ?>

<?php

	if(isset($_SESSION["usuario"])){
		echo "Entro1";
		// Borra todas las variables de sesión 
 		$_SESSION = array(); 
 
		 // Borra la cookie que almacena la sesión 
 		/*if(isset($_COOKIE["usuario"])) { 
  		 setcookie("usuario", ’’, time() - 42000, ’/’); 
 		} */
 
 	// Finalmente, destruye la sesión 
	 session_destroy(); 


	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$pag = 'index.php';
	header("Location: http://$host$uri/$pag");

	}


?>