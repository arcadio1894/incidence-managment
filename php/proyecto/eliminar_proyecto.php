<?php
	header('Content-type: application/json');
	$idProyecto = $_POST["id"];

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($idProyecto == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario indicar la cetagoría a eliminar.']);
        return;
    }

    $project = @mysql_query("SELECT name FROM proyecto WHERE idProyecto = '".$idProyecto."'");
	$numero = @mysql_num_rows($project);

	if ($numero == 0) {
		echo json_encode(['error' => true, 'message' => 'No existe el proyecto a eliminar.']);
		return;
	}

	$project_cat = @mysql_query("SELECT * FROM categoria WHERE idProyecto = '".$idProyecto."'");
	$num = @mysql_num_rows($project_cat);

	if ($num > 0) {
		echo json_encode(['error' => true, 'message' => 'No se puede eliminar el proyecto porque ya tiene categorias asignadas.']);
		return;
	}

    // Insert
    @mysql_query("UPDATE proyecto SET enable='0' WHERE idProyecto=".$idProyecto)or die ('Ha fallado la modificacion: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>