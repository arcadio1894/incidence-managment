<?php
	header('Content-type: application/json');
	$proyecto = $_POST["proyecto"];
	$estado = $_POST["estado"];
	$visibilidad = $_POST["visibilidad"];
	$descripcion = $_POST["descripcion"];

	//echo($realname);

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($proyecto == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar el nombre del proyecto.']);
        return;
    }

    if ($estado == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario especificar el estado del proyecto.']);
        return;
    }

    if ($visibilidad == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario especificar la visibilidad del proyecto.']);
        return;
    }

    $project = @mysql_query("SELECT name FROM proyecto WHERE name = '".$proyecto."'");
	$numero = @mysql_num_rows($project);

	if ($numero>0) {
		echo json_encode(['error' => true, 'message' => 'Ya existe un proyecto con este nombre.']);
		return;
	}
    $fecha=date("y-m-d");

    // Insert
    @mysql_query("INSERT INTO proyecto(name, state, created_at, visibility, description, enable) VALUES ('".$proyecto."', '".$estado."', '".$fecha."', '".$visibilidad."', '".$descripcion."', '1')")or die ('Ha fallado la conexión: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>