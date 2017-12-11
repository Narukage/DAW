<?php

if(($fichero = @file("seleccionadas.ini")) == false){
   echo "<p>No se ha podido abrir el fichero de fotos seleccionadas</p>";
 }else{
   $numLineas = count($fichero);
   $linea=rand(0,$numLineas-1); //Selecciona una linea aleatoria del fichero de entre las que existen
   $contenido=explode("-",$fichero[$linea]); //Divide el string separandolos por el elemento -

   $sentencia="SELECT * from fotos,paises where IdFoto='".$contenido[1]."' AND fotos.Pais=paises.IdPais";
   $resultado= mysqli_query($link, $sentencia);

   while($fila=mysqli_fetch_assoc($resultado)){
     echo "<li>
           <a href=";
           if(isset($_SESSION["nombre"])){
             echo "detalle.php?id=".$fila['IdFoto'];
           }else{
             echo "";
           }
     echo "		><img alt=".$fila['Titulo']." src='".$fila['Fichero']."'/></a>
         <p>
           <b>Título: ".$fila['Titulo']."</b>
         </p>
         <p>
           <b>País: ".$fila['NomPais']."</b>
         </p>
         <p>
           <b>Fecha: ".$fila['Fecha']."</b>
         </p>
         <p>
           <b>Crítico: ".$contenido[0]."</b>
         </p>
         <p>
           <b>Comentario: ".$contenido[2]."</b>
         </p>
         </li>";
   }
 }

?>
