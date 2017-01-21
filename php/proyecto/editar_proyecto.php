<?php
	header('Content-type: application/json');
    $idProyecto = $_POST["idProyecto"];
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

    // Insert
    @mysql_query("UPDATE proyecto SET name='".$proyecto."', state='".$estado."', visibility='".$visibilidad."', description='".$descripcion."' WHERE idProyecto=".$idProyecto)or die ('Ha fallado la conexión: '.@mysql_error());

	echo json_encode(['error' => false]);
	return;
?>