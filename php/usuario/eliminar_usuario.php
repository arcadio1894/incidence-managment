<?php
	header('Content-type: application/json');
	$idUsuario = $_POST["id"];

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($idUsuario == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario indicar el usuario a eliminar.']);
        return;
    }

    $user = @mysql_query("SELECT username FROM usuario WHERE idUsuario = '".$idUsuario."'");
	$numero = @mysql_num_rows($user);

	if ($numero == 0) {
		echo json_encode(['error' => true, 'message' => 'No existe el usuario a eliminar.']);
		return;
	}

	$usuario_level = @mysql_query("SELECT * FROM nivel WHERE idUsuario = '".$idUsuario."'");
	$num = @mysql_num_rows($usuario_level);

	if ($num > 0) {
		echo json_encode(['error' => true, 'message' => 'No se puede eliminar el usuario porque ya fue asignado a un nivel.']);
		return;
	}


    // Insert
    @mysql_query("UPDATE usuario SET enable='0' WHERE idUsuario=".$idUsuario)or die ('Ha fallado la modificacion: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>