<?php
	header('Content-type: application/json');
	$proyecto = $_POST["proyecto"];
	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($proyecto == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar la categoría.']);
        return;
    }

    $project = @mysql_query("SELECT * FROM proyecto WHERE enable=1 AND idProyecto = '".$proyecto."'");
	$numero = @mysql_num_rows($project);

	if ($numero==0) {
		echo json_encode(['error' => true, 'message' => 'No existe el proyecto indicado.']);
		return;
	}
	
	$categories = @mysql_query("SELECT c.idCategoria, c.name
							FROM categoria c
							WHERE c.enable=1 AND c.idProyecto = '".$proyecto."'");
	$categorias = "";
	while($row = @mysql_fetch_array($categories))
	{
		$categorias = $categorias."<option value=".$row[0].">".$row[1]."</option>";
	}

	echo json_encode(['error' => false, 'message' => $categorias]);
	return;
?>