<?php 
	$proyecto = $_GET["proyecto"];
	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
	@mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
	$res = @mysql_query("SELECT c.idCategoria, c.name
							FROM categoria c
							WHERE c.enable=1 AND c.idProyecto = '".$proyecto."'");
	$categorias = array();
	while($row = @mysql_fetch_array($res))
	{
		$data['id'] = $row[0];
		$data['nombre'] = $row[1];
		array_push($categorias, $data);
	}
	$datos['categorias'] = $categorias;

	echo json_encode($datos);
?>