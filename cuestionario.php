<?php

// Conectarnos con "config.php".
// Añadimos también el archivo "functions.php" e iniciamos la sesion.

include "conexion.php";
include_once "inc/functions.php";

sec_session_start();

// Creamos una condición "if" parar verificar que si el usuario ya ha realizado
// más de 3 intentos, muestre un mensaje. Si no, muestra el formulario.

if (checkattempts($_SESSION['usuario'], $conexion)) {
    echo "Has realizado 3 veces el examen. Suerte en la calificación final C:", "<br>";
} else {
    
// 1º. Preparamos la consulta SQL y guardamos el resultado en "$result".

$sql = "SELECT * "
        . "FROM preguntas";

$result_cons = $conexion->query($sql);

// 2º. Creamos el formulario con las preguntas y respuestas correspondientes.

echo '<form action="puntuador.php" method="post">';

// Mostramos la información, oculta para el alumno, que después recogeremos en
// "puntuador.php".
 
echo "<input type=\"hidden\" name=\"usuario\" value=\"$usuario\">";

// 3º. Establecemos un bucle "while" para que mientras se devuelva una fila,
// se muestren los datos de la misma, devueltos por la consulta.

    while($fila = $result_cons->fetch_assoc()) {
// Mostramos la pregunta con sus opciones.
        $idP = $fila['idPregunta'];
        $pregunta = $fila['enunciado'];
        $op1 = $fila['opcion1'];
        $op2 = $fila['opcion2'];
        $op3 = $fila['opcion3'];
        $op4 = $fila['opcion4'];
        
// Cuando tenemos los datos recogidos, ahora los mostramos al alumno.
        
        echo "<fieldset>";
        echo "<legend>Pregunta $idP</legend> <br>";
        echo "$pregunta <br>";
        echo "<input type='radio' name='$idP' value='1'> $op1 <br>";
        echo "<input type='radio' name='$idP' value='2'> $op2 <br>";
        echo "<input type='radio' name='$idP' value='3'> $op3 <br>";
        echo "<input type='radio' name='$idP' value='4'> $op4 <br>";
        echo "</fieldset>", "<br>";
    }

    echo "<input type='submit' name='submit' value='Calificar'>";
    echo "</form>";
}
    ?>