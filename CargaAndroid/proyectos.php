<?php 
	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
	@mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
	$res=@mysql_query("SELECT *
			FROM proyecto p
			where p.enable='1'") or die("Problemas en el select:".@mysql_error());
	$proyectos = array();
	while($row = @mysql_fetch_array($res))
	{
		$data['id'] = $row[0];
		$data['nombre'] = $row[1];
		array_push($proyectos, $data);
	}
	$datos['proyectos'] = $proyectos;

	echo json_encode($datos);
?>