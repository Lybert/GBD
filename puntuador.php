<?php

// Establecemos la recogida de datos provenientes de "cuestionario.php".

$c1 = $_REQUEST['1'];
$c2 = $_REQUEST['2'];
$c3 = $_REQUEST['3'];
$c4 = $_REQUEST['4'];
$c5 = $_REQUEST['5'];
$usuario = $_REQUEST['usuario'];

// Si no se responde la pregunta, entonces le especificamos que devuelva "0".

if($c1 = NULL) $c1=0;
if($c2 = NULL) $c2=0;
if($c3 = NULL) $c3=0;
if($c4 = NULL) $c4=0;
if($c5 = NULL) $c5=0;

// Guardamos las respuestas en su tabla correspondiente: "respuestas".

$sql = "INSERT INTO respuestas "
        . "(idAlumno, idPregunta, idRespuesta) "
        . "VALUES "
        . "($usuario, 1, $c1) "
        . "($usuario, 2, $c2) "
        . "($usuario, 3, $c3) "
        . "($usuario, 4, $c4) "
        . "($usuario, 5, $c5) ";

// Añadimos la conexión proveniente de "conexion.php".

include "conexion.php";

$conexion->query($sql);

