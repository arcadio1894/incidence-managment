<?php
	header('Content-type: application/json');
	$idPerfil = $_POST["idPerfil"];
	$name = $_POST["name"];
	$nivel = $_POST["nivel"];


	//echo($realname);

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($name == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar el nombre del perfil.']);
        return;
    }

    if ($nivel == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario especificar el nivel de acceso.']);
        return;
    }

    // Update
    @mysql_query("UPDATE perfil SET name='".$name."', nivel='".$nivel."' WHERE idPerfil=".$idPerfil)or die ('Ha fallado la conexión: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>