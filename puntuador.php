<?php

// Conectarnos con la Base de Datos.
// Añadir también el archivo "functions.php" e iniciamos la sesión.

include "conexion.php";
include_once "inc/functions.php";

sec_session_start();

// Realizamos, de nuevo, la verificación de intentos.

if (checkattempts($_SESSION['usuario'], $conexion)) {
    echo "Has realizado 3 veces el examen. Suerte en la calificación final C:", "<br>";
} else {

// Establecemos la recogida de datos provenientes de "cuestionario.php".

$c1 = $_REQUEST['1'];
$c2 = $_REQUEST['2'];
$c3 = $_REQUEST['3'];
$c4 = $_REQUEST['4'];
$c5 = $_REQUEST['5'];
$usuario = $_SESSION['usuario'];

// Si no se responde la pregunta, entonces le especificamos que devuelva "0".

if($c1 == NULL) $c1=0;
if($c2 == NULL) $c2=0;
if($c3 == NULL) $c3=0;
if($c4 == NULL) $c4=0;
if($c5 == NULL) $c5=0;

// Entorno de pruebas.

// echo $c1," - ",$c2," - ",$c3," - ",$c4," - ",$c5;

// Guardamos las respuestas en su tabla correspondiente: "respuestas".

$sql = "INSERT INTO respuestas "
        . "(usuario, idPregunta, idOpcion) "
        . "VALUES "
        . "('$usuario', 1, $c1), "
        . "('$usuario', 2, $c2), "
        . "('$usuario', 3, $c3), "
        . "('$usuario', 4, $c4), "
        . "('$usuario', 5, $c5); ";

// Añadimos la conexión proveniente de "conexion.php".

// Entorno de pruebas: echo "jjjj ".$sql. " jjjj";

$conexion->query($sql);

// Ahora realizamos la consulta que comparará los resultados obtenidos
// con los almacenados en la Base de Datos.

$sql = "SELECT p.correcta as a, r.idOpcion as b "
        . "FROM preguntas p, respuestas r "
        . "WHERE r.usuario='$usuario' AND p.idPregunta=r.idPregunta";

// Guardamos los datos obtenidos de la consulta.
// Establecemos las variables para determinar la puntuación obtenida
// por el alumno.

$result_cons = $conexion->query($sql);
$aciertos = 0;
$errores = 0;
$vacio = 0;

// Creamos el bucle que calculará la puntuación obtenida por cada alumno.

while($fila = $result_cons->fetch_assoc()) {
    if($fila['b'] == 0) {
        $vacio++;
    } elseif ($fila['b'] == $fila['a']) {
        $aciertos++;
    } else {
        $errores++;
    }
    // Entorno de pruebas: echo $fila['a'], " ==> ", $fila['b'], "<br>";
}

// Una vez obtenido la cantidad de: aciertos, errores y preguntas vacías
// realizamos el cálculo del resultado final y lo redondeamos a 2 decimales.

$calificacion = round((($aciertos - ($errores/3))*2),2);

// Se lo mostramos por pantalla al alumno.

echo "<br>", "Has tenido $aciertos aciertos, $vacio preguntas sin responder y has cometido $errores fallos";
echo "<br>", "Tu nota final es $calificacion", "<br>";

// Comprobamos el número de intentos que el usuario ha realizado.

    if (checkattempts($usuario, $conexion)) {
	echo "Este era tu último intento.";
    } 
    
// Por último, guardamos la nota en la Base de Datos.

$sql = "INSERT INTO notas "
        . "(usuario, vacio, aciertos, errores, nota) "
        . "VALUES "
        . "('$usuario','$vacio','$aciertos','$errores','$calificacion');";

$conexion->query($sql);
$calificacion->free;

}
// Puede que las notas se sumen porque el usuario no cierra la sesion.
// Hay que comprobarlo con un logout.php
$conexion->close();
?>