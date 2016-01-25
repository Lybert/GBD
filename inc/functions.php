<?php

function sec_session_start() {
    $session_name = 'examen_session_id'; // Asignamos un nombre de sesión.
    $secure = false; // Mejor en config.php Lo ideal sería true para trabajar con https.
    $httponly = true;
    
    // Obliga a la sesión a utilizar solo cookies.
    // Habilitar este ajuste previene de ataques que implican pasar el id de sesión en la URL.
    
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
    $action = "error";
    $error="No puedo iniciar una sesion segura (ini_set)";
    }
    
    // Obtener los parámetros de la cookie de sesión
    
    $cookies = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"],
	$cookieParams["domain"],
	$secure, //si es true la cookie sólo se enviará sobre conexiones seguras.
	$httponly); //Marca la cookie como accesible sólo a través del protocolo HTTP.
    
    // Esto siginifica que la cookie no será accesible por lenguajes de script, 
    // tales como JavaScript.
    // Este ajuste puede ayudar de manera efectiva a reducir robos de 
    // indentidad a través de ataques.
   
    // Incia la sesión PHP
    
    session_name($session_name);
    session_start();
    
    // Actualiza el id de sesión actual con uno generado más reciente.    
    // Ayuda a evitar ataques de fijación de sesión.
    
    session_regenerate_id(true);
}

// Esta función registra los intentos que ha tenido el usuario.

function checkattempts($usuario, $conexion) {
    if ($stmt = $conexion->prepare("SELECT idRespuesta
    FROM respuestas
    WHERE usuario = ?")) {
	$stmt->bind_param('s', '$usuario');
	$stmt->execute();
	$stmt->store_result();
        
	// Si han habido 5 preguntas * 3 intentos = 15 respuestas.
	
        if ($stmt->num_rows >= 15) { //luego intentos = 3;
	    return true;
	} else {
	    return false;
	}
    }
}

?>