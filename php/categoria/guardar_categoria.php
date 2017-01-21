<?php
	header('Content-type: application/json');
	$idProyecto = $_POST["idProyecto"];
	$categoria = $_POST["categoria"];


	//echo($realname);

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($categoria == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar la cetagoría.']);
        return;
    }

    if ($idProyecto == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario especificar el proyecto.']);
        return;
    }

    $category = @mysql_query("SELECT name FROM categoria WHERE enable=1 AND name = '".$categoria."' AND idProyecto='".$idProyecto."'");
	$numero = @mysql_num_rows($category);

	if ($numero>0) {
		echo json_encode(['error' => true, 'message' => 'Ya existe una categoria asignada a este proyecto con este nombre.']);
		return;
	}
    $fecha=date("y-m-d");

    // Insert
    @mysql_query("INSERT INTO categoria(name, idProyecto, created_at, enable) VALUES ('".$categoria."', '".$idProyecto."', '".$fecha."', '1')")or die ('Ha fallado la conexión: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>