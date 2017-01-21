<?php
	header('Content-type: application/json');
	$categoria = $_POST["categoria"];
	//echo $categoria;
	
	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	$niveles = @mysql_query("SELECT n.idNivel, c.name, p.name, u.username
							FROM nivel n
							INNER JOIN categoria c ON n.idCategoria = c.idCategoria
							INNER JOIN perfil p ON n.idPerfil = p.idPerfil
							INNER JOIN usuario u ON n.idUsuario = u.idUsuario 
							WHERE n.enable=1 AND n.idCategoria = '".$categoria."' ORDER BY p.nivel DESC")or die ('Ha fallado la conexión: '.@mysql_error());
	$levels = [];
	while($row = @mysql_fetch_array($niveles))
	{
		$levels[] = array('id' => $row[0], 'category' => $row[1], 'profile' => $row[2], 'user' => $row[3]);
	}
	
	echo json_encode(['array' => $levels]);
	return;
?>