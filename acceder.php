
<?php


	session_start();
	//si el usuario y contraseña si son correctos - redirecciona a index-registrado.php donde si esta logueado

	if(isset($_COOKIE["usuario"])){

					setcookie("fecha",date("d.m.y"),time()+3600*24*30);
					setcookie("hora",date("H:i:s"),time()+3600*24*30);

				$_SESSION["usuario"] = $_COOKIE["usuario"]; //si no, solo genera la sesion

				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$pag = 'menuusuarioregistrado.php';
				header("Location: http://$host$uri/$pag");
	//si no son correctos - redirecciona a index.php, donde no esta logueado
	}

  ?>
