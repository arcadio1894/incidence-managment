<?php
	session_start();
	header('Content-type: application/json');
	$idProyecto = $_POST["proyectos"];
	$idCategoria = $_POST["categorias"];
	$reproductibilidad = $_POST["reproductibilidad"];
	$severidad = $_POST["severidad"];
	$prioridad = $_POST["prioridad"];
	$resumen = $_POST["resumen"];
	$descripcion = $_POST["descripcion"];
	$info = $_POST["info"];
	$pasos = $_POST["pasos"];
	$visibilidad = $_POST["visibilidad"];
	$plataforma = $_POST["plataforma"];
	$so = $_POST["so"];
	$version = $_POST["version"];
	$idUsuario = $_SESSION['idUsuario'];

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones

    if ($idProyecto == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario especificar el proyecto.']);
        return;
    }

	if ($idCategoria == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario especificar la cetagoría.']);
        return;
    }

    if ($resumen == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar el resumen breve de la incidencia.']);
        return;
    }

	if ($descripcion == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar la descripcion de la incidencia.']);
        return;
    }

    if ($pasos == "")
    {
        echo json_encode(['error' => true, 'message' => 'Es necesario ingresar los pasos a reproducir de la incidencia.']);
        return;
    }

    $category = @mysql_query("SELECT name FROM categoria WHERE enable=1 AND idCategoria='".$idCategoria."'");
	$numero = @mysql_num_rows($category);

	if ($numero==0) {
		echo json_encode(['error' => true, 'message' => 'No existe la categoria especificada con este nombre.']);
		return;
	}

	$niv = @mysql_query("SELECT * FROM nivel WHERE enable=1 AND idCategoria='".$idCategoria."'");
	$numerito = @mysql_num_rows($niv);

	if ($numerito==0) {
		echo json_encode(['error' => true, 'message' => 'No existe la niveles en la categoráa especificada con este nombre.']);
		return;
	}

	$project = @mysql_query("SELECT name FROM proyecto WHERE enable=1 AND idProyecto='".$idProyecto."'");
	$numero2 = @mysql_num_rows($project);

	if ($numero2==0) {
		echo json_encode(['error' => true, 'message' => 'No existe el proyecto especificado con este nombre.']);
		return;
	}

    $fecha=date("y-m-d");

    // Insert Incidencia
    @mysql_query("INSERT INTO incidencia(idProyecto, idCategoria, reproductibilidad, severidad, prioridad, resumen, descripcion, infoAdicional, pasosReproducir, visibilidad, plataforma, so, version_so, idUsuario, state, result, created_at, enable) 
    							VALUES ('".$idProyecto."', '".$idCategoria."', '".$reproductibilidad."', '".$severidad."', '".$prioridad."', '".$resumen."', '".$descripcion."', '".$info."', '".$pasos."', '".$visibilidad."', '".$plataforma."', '".$so."', '".$version."', '".$idUsuario."', 'Nuevo', '', '".$fecha."', '1')")or die ('Ha fallado la conexión: '.@mysql_error());

   	// Obtener el max id de Incidencia
    $max_id=0;
	$id = @mysql_query("SELECT MAX(idIncidencia) FROM incidencia");
	while($row = @mysql_fetch_array($id))
	{ $max_id = $row[0]; }

   	// Select de niveles de esa categoria ordenado por nivel de acceso
   	$result = @mysql_query("SELECT * 
							FROM nivel n
							INNER JOIN perfil p on n.idPerfil = p.idPerfil
							WHERE n.idCategoria = '".$idCategoria."' 
							ORDER BY p.nivel DESC")or die ('Ha fallado el select: '.@mysql_error());
   	$orden = 1;
  	while($row2 = @mysql_fetch_array($result))
	{
		// Insert Incidencia Asignada -- Solo al primero enable = 1 los demas enable = 0
		if ($orden == 1) {
			@mysql_query("INSERT INTO incidencia_asignada(idIncidencia, idUsuario, orden, created_at, enable) 
		    					VALUES ('".$max_id."', '".$row2[3]."', '".$orden."', '".$fecha."', '1')")or die ('Ha fallado la conexión: '.@mysql_error());
		} else {
			@mysql_query("INSERT INTO incidencia_asignada(idIncidencia, idUsuario, orden, created_at, enable) 
		    					VALUES ('".$max_id."', '".$row2[3]."', '".$orden."', '".$fecha."', '0')")or die ('Ha fallado la conexión: '.@mysql_error());
		}
		$orden = $orden + 1;
	}

	echo json_encode(['error' => false]);
	return;
?>