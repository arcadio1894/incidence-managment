<?php
	header('Content-type: application/json');
    $idUsuario = $_POST["idUsuario"];
    $realname = $_POST["realname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $type = $_POST["nivel"];

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

    // Insert
    @mysql_query("UPDATE usuario SET fullname='".$realname."', username='".$username."', email='".$email."', password='".$password."', type='".$type."' WHERE idUsuario=".$idUsuario)or die ('Ha fallado la conexión: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>