<?php

// Establecemos la recogida de datos provenientes de "cuestionario.php".

$c1 = $_REQUEST['1'];
$c2 = $_REQUEST['2'];
$c3 = $_REQUEST['3'];
$c4 = $_REQUEST['4'];
$c5 = $_REQUEST['5'];
$usuario = $_REQUEST['usuario'];

// Si no se responde la pregunta, entonces le especificamos que devuelva "0".

if($c1 == NULL) $c1=0;
if($c2 == NULL) $c2=0;
if($c3 == NULL) $c3=0;
if($c4 == NULL) $c4=0;
if($c5 == NULL) $c5=0;

// Guardamos las respuestas en su tabla correspondiente: "respuestas".

$sql = "INSERT INTO respuestas "
        . "(idAlumno, idPregunta, idRespuesta) "
        . "VALUES "
        . "($usuario, 1, $c1), "
        . "($usuario, 2, $c2), "
        . "($usuario, 3, $c3), "
        . "($usuario, 4, $c4), "
        . "($usuario, 5, $c5) ";

// Añadimos la conexión proveniente de "conexion.php".

include "conexion.php";

$conexion->query($sql);

// Ahora realizamos la consulta que comparará los resultados obtenidos
// con los almacenados en la Base de Datos.

$sql = "SELECT p.correcta as a, r.idRespuesta as b "
        . "FROM preguntas p, respuestas r "
        . "WHERE r.idAlumno=$usuario AND p.idPregunta=r.idPregunta";

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
        $blanco++;
    } elseif ($fila['b'] == $fila['a']) {
        $aciertos++;
    } else {
        $errores++;
    }
    echo $fila['a'], " ==> ", $fila['b'], "<br>";
}

// Una vez obtenido la cantidad de: aciertos, errores y preguntas vacías
// realizamos el cálculo del resultado final y lo redondeamos a 2 decimales.

$calificacion = round((($aciertos - ($errores/3))*2),2);

// Se lo mostramos por pantalla al alumno.

echo "<br>", "Has tenido $aciertos aciertos, $vacíos preguntas sin responder y has cometido $errores fallos";
echo "<br>", "Tu nota final es $calificacion";

?>