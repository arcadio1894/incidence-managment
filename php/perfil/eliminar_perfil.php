<?php
	header('Content-type: application/json');
	$idPerfil = $_POST["id"];

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($idPerfil == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario indicar el perfil a eliminar.']);
        return;
    }

    $profile = @mysql_query("SELECT name FROM perfil WHERE idPerfil = '".$idPerfil."'");
	$numero = @mysql_num_rows($profile);

	if ($numero == 0) {
		echo json_encode(['error' => true, 'message' => 'No existe el perfil a eliminar.']);
		return;
	}

	$perfil_level = @mysql_query("SELECT * FROM nivel WHERE idPerfil = '".$idPerfil."'");
	$num = @mysql_num_rows($perfil_level);

	if ($num > 0) {
		echo json_encode(['error' => true, 'message' => 'No se puede eliminar el perfil porque ya fue asignado a un nivel.']);
		return;
	}

    // Insert
    @mysql_query("UPDATE perfil SET enable='0' WHERE idPerfil=".$idPerfil)or die ('Ha fallado la modificacion: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>