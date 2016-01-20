<?php

// Paso de parámetros provenientes de "config.php".

    include "config.php";

// Conexión con la Base de Datos

$conexion = new mysqli($host, $username, $password, $db_name);
if ($conexion->connect_errno) { // Si se produce algún error finaliza con mensaje de error
die("Error de Conexión: " . $conexion->connect_error);
}
$conexion->set_charset("utf8");

