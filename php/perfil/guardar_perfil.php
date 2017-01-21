<?php
	header('Content-type: application/json');
	$name = $_POST["name"];
	$nivel = $_POST["nivel"];


	//echo($realname);

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
	if ($name == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar el nombre del perfil.']);
        return;
    }

    if ($nivel == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario especificar el nivel de acceso.']);
        return;
    }

    $perfil = @mysql_query("SELECT name FROM perfil WHERE name = '".$name."'");
	$numero = @mysql_num_rows($perfil);

	if ($numero>0) {
		echo json_encode(['error' => true, 'message' => 'Ya existe un perfil con este nombre, ingrese otro o edite el actual.']);
		return;
	}
    $fecha=date("y-m-d");

    // Insert
    @mysql_query("INSERT INTO perfil(name, nivel, created_at, enable) VALUES ('".$name."', '".$nivel."', '".$fecha."', '1')")or die ('Ha fallado la conexión: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>