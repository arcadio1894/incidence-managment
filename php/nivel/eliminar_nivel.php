<?php
	header('Content-type: application/json');
	$idNivel = $_POST["id"];

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($idNivel == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario indicar el nivel a eliminar.']);
        return;
    }

    $level = @mysql_query("SELECT * FROM nivel WHERE idNivel = '".$idNivel."'");
	$numero = @mysql_num_rows($level);

	if ($numero == 0) {
		echo json_encode(['error' => true, 'message' => 'No existe el nivel a eliminar.']);
		return;
	}

	$cat = @mysql_query("SELECT idCategoria FROM nivel WHERE idNivel = '".$idNivel."'");

	while($row = @mysql_fetch_array($cat))
	{
		$level_incid = @mysql_query("SELECT * FROM incidencia WHERE idCategoria = '".$row[0]."'");
		$number = @mysql_num_rows($level_incid);
		if ($number > 0) {
			echo json_encode(['error' => true, 'message' => 'No se puede eliminar el nivel porque pertenece a una categoria que ya tiene incidencias registradas.']);
			return;
		}
	}
    // Insert
    @mysql_query("UPDATE nivel SET enable='0' WHERE idNivel=".$idNivel)or die ('Ha fallado la conexión: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>