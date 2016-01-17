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
            <fieldset>
                <legend>Pregunta Nº.1</legend> <br>
                La Alquimia se compone de cuatro elementos básicos: Tierra, Agua, Aire y ... <br>
                <input type="radio" name="elemento" value="Éter"> Eter<br>
                <input type="radio" name="elemento" value="Fuego"> Fuego<br>
                <input type="radio" name="elemento" value="Hielo"> Hielo<br>
                <input type="radio" name="elemento" value="Luz"> Luz<br>
            </fieldset>
            <fieldset>
                <legend>Pregunta Nº.2</legend> <br>
                En el relato de "Las Reliquias de la Muerte", ¿cuál de las tres reliquias posée Dumbledore? <br>
                <input type="radio" name="reliquia" value="Filosofal"> La piedra Filosofal<br>
                <input type="radio" name="reliquia" value="Capa"> La capa de la invisibilidad<br>
                <input type="radio" name="reliquia" value="Varita"> La Varita de Sáuco<br>
                <input type="radio" name="reliquia" value="Caliz"> El Cáliz de fuego<br>
            </fieldset>
            <fieldset>
                <legend>Pregunta Nº.3</legend> <br>
                ¿Cuál de estos personajes de "Star Wars" mató a Lord Sidious? <br>
                <input type="radio" name="pj" value="Vader"> Darth Vader<br>
                <input type="radio" name="pj" value="Luke"> Luke Skywalker<br>
                <input type="radio" name="pj" value="Solo"> Han Solo<br>
                <input type="radio" name="pj" value="Kenobi"> Obi-Wan Kenobi<br>
            </fieldset>
            <fieldset>
                <legend>Pregunta Nº.4</legend> <br>
                ¿En qué año fue 1+1? <br>
                    <input type="radio" name="simpsons" value="2"> ¿2? <br>
                    <input type="radio" name="simpsons" value="para"> Pa k kieres saber eso jaja salu2<br>
                    <input type="radio" name="simpsons" value="7"> 1+1 son sieteeeee....<br>
                    <input type="radio" name="simpsons" value="ralph"> La respuesta es el FANTÁSTICO Ralph<br>
            </fieldset>
            <fieldset>
                <legend>Pregunta Nº.5</legend>
                ¿Qué jugador de waterpolo debe llevar el gorro número 1 a la hora de jugar un partido? <br>
                    <input type="radio" name="water" value="captain"> El capitán<br>
                    <input type="radio" name="water" value="boya"> El boya<br>
                    <input type="radio" name="water" value="puerta"> El portero<br>
                    <input type="radio" name="water" value="defensa"> El defensor de boya<br>
            </fieldset>
                </form>
                <?php
                ?>
                </body>
                </html>
