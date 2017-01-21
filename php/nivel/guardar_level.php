<?php
	header('Content-type: application/json');
	$categoria = $_POST["categoria"];
	$perfil = $_POST["perfil"];
	$usuario = $_POST["usuario"];

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($categoria == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar la cetagoría.']);
        return;
    }

    if ($perfil == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario especificar el perfil.']);
        return;
    }

    if ($usuario == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario especificar el usuario.']);
        return;
    }

    $level = @mysql_query("SELECT * FROM nivel WHERE enable=1 AND idCategoria = '".$categoria."' AND idPerfil='".$perfil."' AND idUsuario='".$usuario."'");
	$numero = @mysql_num_rows($level);

	if ($numero>0) {
		echo json_encode(['error' => true, 'message' => 'Ya existe un nivel asignado con estos datos.']);
		return;
	}

	$levelRepeated = @mysql_query("SELECT * FROM nivel WHERE enable=1 AND idCategoria = '".$categoria."' AND idUsuario='".$usuario."'");
	$numerito = @mysql_num_rows($levelRepeated);

	if ($numerito>0) {
		echo json_encode(['error' => true, 'message' => 'Ya existe un nivel con el usuario indicado.']);
		return;
	}
    $fecha=date("y-m-d");

    // Insert
    @mysql_query("INSERT INTO nivel(idCategoria, idPerfil, idUsuario, created_at, enable) VALUES ('".$categoria."', '".$perfil."', '".$usuario."', '".$fecha."', '1')")or die ('Ha fallado la conexión: '.@mysql_error());
	
	$niveles = @mysql_query("SELECT n.idNivel, c.name, p.name, u.username
							FROM nivel n
							INNER JOIN categoria c ON n.idCategoria = c.idCategoria
							INNER JOIN perfil p ON n.idPerfil = p.idPerfil
							INNER JOIN usuario u ON n.idUsuario = u.idUsuario 
							WHERE enable=1 AND idCategoria = '".$categoria."'");
	$levels = [];
	while($row = @mysql_fetch_array($niveles))
	{
		$levels[] = array('id' => $row[0], 'category' => $row[1], 'profile' => $row[2], 'user' => $row[3]);
	}
	// Adjuntar el nuevo
	// Id que le debe pertenecer
	$max_id=0;
	$id = @mysql_query("SELECT MAX(idNivel) FROM nivel ");
	while($row2 = @mysql_fetch_array($id))
	{ $max_id = $row2[0]; }

	$nameCategory="";
	$cat = @mysql_query("SELECT name FROM categoria WHERE idCategoria='".$categoria."'");
	while($row2 = @mysql_fetch_array($cat))
	{ $nameCategory = $row2[0]; }

	$nameProfile="";
	$per = @mysql_query("SELECT name FROM perfil WHERE idPerfil='".$perfil."'");
	while($row3 = @mysql_fetch_array($per))
	{ $nameProfile = $row3[0]; }

	$nameUser="";
	$use = @mysql_query("SELECT username FROM usuario WHERE idUsuario='".$usuario."'");
	while($row4 = @mysql_fetch_array($use))
	{ $nameUser = $row4[0]; }


	$levels[] = array('id' => $max_id, 'category' => $nameCategory, 'profile' => $nameProfile, 'user' => $nameUser);
	//echo $levels;
	echo json_encode(['error' => false, 'array' => $levels]);
	return;
?>