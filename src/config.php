<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'test');

if ($mysqli->connect_errno) {
    echo 'Error al conectar con la base de datos: ' . $mysqli->connect_error;
}

?>
