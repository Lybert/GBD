<?php
        // 1º. Lo primero es obtener los datos pasados en los campos anteriores
        // y almacenarlos en las variables correspondientes.

        $elemento = $_POST['1'];
        $reliquia = $_POST['2'];
        $pj = $_POST['3'];
        $simpsons = $_POST['4'];
        $water = $_POST['5'];

        // 2º. Realizar la conexión con la Base de Datos.

        $conexion = new mysqli("localhost", "ausias", "ausias", "examen_web");
        if ($conexion->connect_errno) {
            die("Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error);
        }

        // 3º. Preparamos la consulta SQL.

        $comprobar = "SELECT p.idPregunta, correcta "
                . "FROM preguntas p, respuestas r "
                . "WHERE p.idPregunta=r.idPregunta AND correcta=? ";
        
        echo $sql, "<br>";

        // 4º. Creamos la "Secuencia Preparada" donde se ejecutará nuestra consulta
        // de manera ordenada.

        $sentencia = $conexion->prepare($comprobar);
        $sentencia->bind_param("i", $correcta);
        $sentencia->execute();
        $sentencia->store_result();
        $resultado = $sentencia->get_result();

        // 5º. Creamos un array que recogerá las variables de las respuesta obtenidas
        // en el formulario. Añadimos también la variable "$puntos" y "fallos", que almacenará
        // la puntuación que ha obtenido el alumno.
        // También creamos una variable aux. para más adelante.

        $respuestas = array($elemento, $reliquia, $pj, $simpsons, $water);
        $preg = 1;
        $aciertos = 0;
        $fallos = 0;

        // 6º. Generamos un bucle while donde le especificamos que:
        // "Si el resultado obtenido coincide con el valor de la respuesta
        // obtenida en el formulario coinciden, entonces sumará 1 punto y 
        // devolverá la frase: "¡Correcto!". En caso contrario, restará
        // 0'3 puntos y devolverá la frase: "¡Has fallado la pregunta!".

        while($fila = $resultado->fecth_assoc()) {
            if ($resultado = $respuestas->fetch_array(MYSQLI_NUM)) {
                echo "<fieldset>";
                echo "<legend>Pregunta Nº.$preg</legend>";
                echo "¡Correcto!";
                echo "</fieldset>";
                $puntos = $puntos++;
                $preg = $preg++;
            } else {
                echo "<fieldset>";
                echo "<legend>Pregunta Nº.$preg</legend>";
                echo "¡Has fallado!";
                echo "</fieldset>";
                $errores = $errores++;
            }
        }
        
        // 7º. Ahora, calculamos la nota obtenida y se la mostramos al alumno.
        
        $nota = round((($puntos - ($errores/3))*2),2);
        
        echo "Has obtenido $nota puntos en este examen.";
            ?>