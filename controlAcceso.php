
<?php

	require_once("inc/conexion.inc.php");

	if(isset($_COOKIE["nombre"])){
		$nombre=$_COOKIE["nombre"];
		$password=$_COOKIE["password"];

	}else{
		if(isset($_POST["nombre"])){
			$nombre=$_POST["nombre"];
			$password=$_POST["password"];

		}
	}
	$existe=false;

	$sentencia= 'SELECT * FROM usuarios where usuarios.NomUsuario="'.$nombre.'"';

	$resultado = mysqli_query($link, $sentencia);
//si el usuario y contraseña si son correctos - redirecciona a index-registrado.php donde si esta logueado
	while($fila=mysqli_fetch_assoc($resultado)){
		if($nombre){
			if(strcmp($nombre,$fila["NomUsuario"])==0 && strcmp($password,$fila["Clave"])==0){
				$existe=true;

			}
		}
	}
	if($existe){
		if(isset($_POST["recuerda"])){ //genera las cookies con los datos del usuario
			setcookie("usuario",$_POST["usuario"],time()+3600*24*30);
			setcookie("password",$_POST["password"],time()+3600*24*30);
			setcookie("fecha",date("d.m.y"),time()+3600*24*30);
			setcookie("hora",date("H:i:s"),time()+3600*24*30);
		}

		$_SESSION["usuario"] = $nombre; //si no, solo genera la sesion

		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$pag = 'menuusuarioregistrado.php';
		header("Location: http://$host$uri/$pag");
	//si no son correctos - redirecciona a index.php, donde no esta logueado
	}else{
		$host = $_SERVER['HTTP_HOST'];+
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$pag = 'index.php?incorrecto=true';
		header("Location: http://$host$uri/$pag");
	}

	mysqli_free_result($resultado);

  ?>
