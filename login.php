<?php
        
        // Añadimos el archivo de sesiones, "functions.php"

        include_once "inc/functions.php";
        
        // 1º. Obtenemos los valores pasados a $usuario y $password
        
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        
        // 2º. Creamos la variable para conectarnos a la Base de Datos
        
         $conexion = new mysqli("localhost", "ausias", "ausias", "examen_web");
         if ($conexion->connect_errno) {
            die("Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error);
         }
         
         // Añadimos la protección frente a Inyección SQL.
         
         $usuario = $conexion->real_escape_string($usuario);
         $password = $conexion->real_escape_string($password);
         
         // 3º. Preparamos la consulta que queremos ejecutar
         
         $sql = "SELECT * "
                 ."FROM alumnos "
                 ."WHERE usuario=? AND password=?";
                 
         // 4º. Establecemos un "echo" para que se nos muestre la consulta
         
         // echo $sql, "<br>";
         
         // 5º. Creamos unas "Secuencias preparadas" para recoger los datos
         // obtenidos en la consulta. 
         // Establecemos la variable "$rows" para que guarde el número devuelto
         // por el atributo de "$stmt", "num_rows".
         
        $stmt=$conexion->prepare($sql);
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $stmt->store_result();
        $rows=$stmt->num_rows;
                
         // 6º. Creamos la condicion "if" para que cuando se encuentre
         // un registro coincidente nos devuelva un "echo" afirmandonos
         // que nos hemos conectado correctamente
         
         if($rows==1){
             echo "Bienvenido $usuario" ,"<br>";
             
             sec_session_start();
             
             // Aquí damos de alta al usuario durante la sesión que va a ocupar
             // durante el examen. Esta variable la podremos recoger a lo
             // largo de toda la aplicación.
             
             $_SESSION['usuario'] = $usuario;
             
             echo "<a href='./cuestionario.php'>Acceder al examen</a>";
         } else {
             echo "Login Incorrecto";
         }

        ?>

