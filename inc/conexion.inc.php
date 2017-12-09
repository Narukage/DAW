<?php

session_start();
$link =mysqli_connect('localhost', 'root', '', 'picsy');
    mysqli_set_charset($link, "utf8");
    if(!mysqli_ping($link)){//Error al conectar con la base de datos
    die('<p>No pudo conectarse:'.mysqli_connect_error().'</p>');
    }

?>
