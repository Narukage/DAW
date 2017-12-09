<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="es">
		<?php
		$title= "Prueba AES";
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

		<br>
		<p id="informacion">
      <?php

      $texto = $_POST["aes"];
      $clave = randomString(32);

      echo "<b>Texto sin encriptar:</b> ".$texto;
      echo "<br><br>";
			echo "<b>Clave privada:</b> ".$clave;
			echo "<br><br>";

      $encriptado = encriptar_AES($texto, $clave);
      $desencriptado = desencriptar_AES($encriptado, $clave);

		function randomString($length){
		$rand = '';
		$salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

  for ($i = 0; $i < $length; $i++) {
        //Loop hasta que el string aleatorio contenga la longitud ingresada.
        $num = rand() % strlen($salt);
        $tmp = substr($salt, $num, 1);
        $rand = $rand . $tmp;
    }
    //Retorno del string aleatorio.
    return $rand;
}

    function encriptar_AES($texto, $clave){

      //Abre el módulo del algoritmo y el metodo de cifrado
     $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
     //Crea los ivs(vectores de inicializacion) del tamanio del td(128 bits) usando valores aleatorios
     $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM );
     //Inicializa todos los buffers requeridos para el cifrado
     mcrypt_generic_init($td, $clave, $iv);
     //Genera el mensaje encriptado
     $encrypted_data_bin = mcrypt_generic($td, $texto);
     //Deinicializa el módulo de cifrado td
     mcrypt_generic_deinit($td);
     //Cierra el módulo mcrypt
     mcrypt_module_close($td);
     //bin2hex convierte datos binarios en su representación hexadecimal
     $encrypted_data_hex = bin2hex($iv).bin2hex($encrypted_data_bin);

     return $encrypted_data_hex;
    }

    function desencriptar_AES($encrypted_data_hex, $clave){

     $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
     $iv_size_hex = mcrypt_enc_get_iv_size($td)*2;
     $iv = pack("H*", substr($encrypted_data_hex, 0, $iv_size_hex));
     $encrypted_data_bin = pack("H*", substr($encrypted_data_hex, $iv_size_hex));
     mcrypt_generic_init($td, $clave, $iv);
     $decrypted = mdecrypt_generic($td, $encrypted_data_bin);
     mcrypt_generic_deinit($td);
     mcrypt_module_close($td);

     return $decrypted;
    }



      echo "<b>Texto encriptado:</b> ".$encriptado;
      echo "<br><br>";
      echo "<b>Texto desencriptado:</b> ".$desencriptado;

      ?>


<?php

// Create the keypair
$res=openssl_pkey_new();

// Get private key
openssl_pkey_export($res, $privatekey);

// Get public key
$publickey=openssl_pkey_get_details($res);
$publickey=$publickey["key"];

echo "<br>";
echo "<br>";

echo "<b>Clave Privada RSA:<BR></b>$privatekey<br><br><b>Clave pública RSA:<BR></b>$publickey<BR><BR>";

echo "<br>";
echo "<b>Clave AES:<br></b>$clave<BR><BR>";

openssl_public_encrypt($clave, $crypttext, $publickey);

echo "<br>";
echo "<b>Clave AES encriptada:</b><br>$crypttext<BR><BR>";

openssl_private_decrypt($crypttext, $decrypted, $privatekey);

echo "<br>";
echo "<b>Clave AES desencriptada:<BR></b>$decrypted<br><br>";
?>

		<br>
		<br>
			<a id="nuevafoto" href="aes.php">Volver</a>
		</p>
  </form>









		<?php

		require_once("inc/footer.inc.php");
		?>

	</body>
</html>
