<?php
	header('Content-type: application/json');
	$realname = $_POST["realname"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$repeatpass = $_POST["repeatpass"];

	//echo($realname);

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($realname == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar el nombre real del usuario.']);
        return;
    }

    if ($email == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar el email del usuario.']);
        return;
    }

    if ($username == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar el username del usuario.']);
        return;
    }

    if ($password == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar el password del usuario.']);
        return;
    }

    if ($repeatpass == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar el password repetido del usuario.']);
        return;
    }

    if ($repeatpass != $password)
    {
        echo json_encode(['error' => true, 'message' => 'Las contraseñas no coinciden.']);
        return;
    }

    $usuario = @mysql_query("SELECT username FROM usuario WHERE username = '".$username."' AND password = '".$password."'");
	$numero = @mysql_num_rows($usuario);

	if ($numero>0) {
		echo json_encode(['error' => true, 'message' => 'Ya existe un usuario con estas credenciales.']);
		return;
	}

    $fecha=date("y-m-d");

    // Insert
    @mysql_query("INSERT INTO usuario (fullname, username, email, password, type, created_at, enable) VALUES ('".$realname."', '".$username."', '".$email."', '".$password."', 'externo', '".$fecha."', '1')")or die ('Ha fallado la conexión: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>