<?php
	header('Content-type: application/json');
	$idCategoria = $_POST["id"];

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($idCategoria == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario indicar la cetagoría a eliminar.']);
        return;
    }

    $category = @mysql_query("SELECT name FROM categoria WHERE idCategoria = '".$idCategoria."'");
	$numero = @mysql_num_rows($category);

	if ($numero == 0) {
		echo json_encode(['error' => true, 'message' => 'No existe la categoria a eliminar.']);
		return;
	}

	$category_level = @mysql_query("SELECT * FROM nivel WHERE idCategoria = '".$idCategoria."'");
	$num = @mysql_num_rows($category_level);

	if ($num > 0) {
		echo json_encode(['error' => true, 'message' => 'No se puede eliminar la categoria porque ya tiene niveles asignados.']);
		return;
	}

    // Update
    @mysql_query("UPDATE categoria SET enable='0' WHERE idCategoria=".$idCategoria)or die ('Ha fallado la modificacion: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>