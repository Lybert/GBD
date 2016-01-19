<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>EXAMEN</title>
    </head>
    <body>
        <h1>Examen</h1>
        <form action="cuestionario.php" method="post">
            <div>
                <fieldset>
                    <legend>Pregunta Nº.1</legend> <br>
                    La Alquimia se compone de cuatro elementos básicos: Tierra, Agua, Aire y ... <br>
                    <input type="radio" name="a" value="Éter"> Eter<br>
                    <input type="radio" name="a" value="Fuego"> Fuego<br>
                    <input type="radio" name="a" value="Hielo"> Hielo<br>
                    <input type="radio" name="a" value="Luz"> Luz<br>
                </fieldset>
                <fieldset>
                    <legend>Pregunta Nº.2</legend> <br>
                    En el relato de "Las Reliquias de la Muerte", ¿cuál de las tres reliquias posée Dumbledore? <br>
                    <input type="radio" name="b" value="Filosofal"> La piedra Filosofal<br>
                    <input type="radio" name="b" value="Capa"> La capa de la invisibilidad<br>
                    <input type="radio" name="b" value="Varita"> La Varita de Sáuco<br>
                    <input type="radio" name="b" value="Caliz"> El Cáliz de fuego<br>
                </fieldset>
                <fieldset>
                    <legend>Pregunta Nº.3</legend> <br>
                    ¿Cuál de estos personajes de "Star Wars" mató a Lord Sidious? <br>
                    <input type="radio" name="c" value="Vader"> Darth Vader<br>
                    <input type="radio" name="c" value="Luke"> Luke Skywalker<br>
                    <input type="radio" name="c" value="Solo"> Han Solo<br>
                    <input type="radio" name="c" value="Kenobi"> Ben Solo Organa<br>
                </fieldset>
                <fieldset>
                    <legend>Pregunta Nº.4</legend> <br>
                    ¿En qué año fue 1+1? <br>
                    <input type="radio" name="d" value="2"> ¿2?<br>
                    <input type="radio" name="d" value="para"> Pa k kieres saber eso jaja salu2<br>
                    <input type="radio" name="d" value="7"> 1+1 son sieteeeee....<br>
                    <input type="radio" name="d" value="ralph"> La respuesta es el FANTÁSTICO Ralph<br>
                </fieldset>
                <fieldset>
                    <legend>Pregunta Nº.5</legend> <br>
                    ¿Qué jugador de waterpolo debe llevar el gorro número 1 a la hora de jugar un partido? <br>
                    <input type="radio" name="e" value="captain"> El capitán<br>
                    <input type="radio" name="e" value="boya"> El boya<br>
                    <input type="radio" name="e" value="puerta"> El portero<br>
                    <input type="radio" name="e" value="defensa"> El defensor de boya<br>
                </fieldset> <br>
                <input type="submit" value="Enviar">
            </div>
        </form>
        <?php
        // 1º. Lo primero es obtener los datos pasados en los campos anteriores
        // y almacenarlos en las variables correspondientes.

        $elemento = $_POST['a'];
        $reliquia = $_POST['b'];
        $pj = $_POST['c'];
        $simpsons = $_POST['d'];
        $water = $_POST['e'];

        // 2º. Realizar la conexión con la Base de Datos.

        $conexion = new mysqli("localhost", "ausias", "ausias", "examen_web");
        if ($conexion->connect_errno) {
            die("Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error);
        }
        
        // 3º. Preparamos la consulta SQL.
        
        $comprobar = "SELECT * "
                ."FROM respuestas "
                . "WHERE idRespuesta=?"
        ?>
    </body>
</html>
