<?php
	session_start(); 
	header('Content-type: application/json');
	$con = @mysql_connect("localhost","root","")or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db("bd_incidence")or die ("Error al seleccionar la Base de Datos: ".@mysql_error());
	
    // Incidencias asignadas a mí
    $incidenceAssign = @mysql_query("SELECT i.idIncidencia, p.name, c.name, i.severidad, i.created_at, i.state, i.resumen, u.username
							FROM incidencia i
							INNER JOIN proyecto p on i.idProyecto=p.idProyecto
							INNER JOIN categoria c on i.idCategoria=c.idCategoria
							INNER JOIN incidencia_asignada ia on i.idIncidencia=ia.idIncidencia
							INNER JOIN usuario u on i.idUsuario=u.idUsuario
							WHERE ia.idUsuario = '".$_SESSION['idUsuario']."' AND ia.enable=1
							")or die ('Error en el select de asignadas: '.@mysql_error());

    // Incidencias reportadas por mí
    $incidenceReported = @mysql_query("SELECT i.idIncidencia, p.name, c.name, i.severidad, i.created_at, i.state, i.resumen, u.username
							FROM incidencia i
							INNER JOIN proyecto p on i.idProyecto=p.idProyecto
							INNER JOIN categoria c on i.idCategoria=c.idCategoria
							INNER JOIN usuario u on i.idUsuario=u.idUsuario
							WHERE i.idUsuario = ".$_SESSION['idUsuario']."
							")or die ('Error en el select de reportadas: '.@mysql_error());

    // Incidencias Resultas
    if ($_SESSION['type'] == "Admin") {
    	$incidenceResolved = @mysql_query("SELECT i.idIncidencia, p.name, c.name, i.severidad, i.created_at, i.state, i.resumen, u.username
							FROM incidencia i
							INNER JOIN proyecto p on i.idProyecto=p.idProyecto
							INNER JOIN categoria c on i.idCategoria=c.idCategoria
							INNER JOIN usuario u on i.idUsuario=u.idUsuario
							WHERE i.state = 'Resuelto'
							")or die ('Error en el select de resueltas: '.@mysql_error());
    } else {
    	$incidenceResolved = @mysql_query("SELECT i.idIncidencia, p.name, c.name, i.severidad, i.created_at, i.state, i.resumen, u.username
							FROM incidencia i
							INNER JOIN proyecto p on i.idProyecto=p.idProyecto
							INNER JOIN categoria c on i.idCategoria=c.idCategoria
							INNER JOIN incidencia_asignada ia on i.idIncidencia=ia.idIncidencia
							INNER JOIN usuario u on i.idUsuario=u.idUsuario
							WHERE i.state = 'Resuelto' AND ia.idUsuario = '".$_SESSION['idUsuario']."' AND ia.enable=1
							")or die ('Error en el select de resueltas: '.@mysql_error());
    }

    // Incidencias Cerradas
	if ($_SESSION['type'] == "Admin") {
    	$incidenceClose = @mysql_query("SELECT i.idIncidencia, p.name, c.name, i.severidad, i.created_at, i.state, i.resumen, u.username
							FROM incidencia i
							INNER JOIN proyecto p on i.idProyecto=p.idProyecto
							INNER JOIN categoria c on i.idCategoria=c.idCategoria
							INNER JOIN usuario u on i.idUsuario=u.idUsuario
							WHERE i.state = 'Cerrado'
							")or die ('Error en el select de cerradas: '.@mysql_error());
    } else {
    	$incidenceClose = @mysql_query("SELECT i.idIncidencia, p.name, c.name, i.severidad, i.created_at, i.state, i.resumen, u.username
							FROM incidencia i
							INNER JOIN proyecto p on i.idProyecto=p.idProyecto
							INNER JOIN categoria c on i.idCategoria=c.idCategoria
							INNER JOIN incidencia_asignada ia on i.idIncidencia=ia.idIncidencia
							INNER JOIN usuario u on i.idUsuario=u.idUsuario
							WHERE i.state = 'Cerrado' AND ia.idUsuario = '".$_SESSION['idUsuario']."' AND ia.enable=1
							")or die ('Error en el select de cerradas: '.@mysql_error());
    }

	$incidenciasAsignadas = "";
	$incidenciasReportadas = "";
	$incidenciasResueltas = "";
	$incidenciasCerradas = "";
	while($row = @mysql_fetch_array($incidenceAssign))
	{
		$date = new DateTime($row[4]);
		$incidenciasAsignadas = $incidenciasAsignadas.'<div class="'.$row[5].'">
															<p class="alert">
															Incidencia # '.$row[0].' : '.$row[6].'.<br/>Fecha: '.$date->format('jS F Y').'
															<br>Reportado por: '.$row[7].'
															<a href="RevisarIncidencia.php?idIncidencia='.$row[0].'" class="btn btn-xs btn-info pull-right">
															<i class="ace-icon glyphicon glyphicon-zoom-in bigger-120"></i>
															</a></p>
														</div>
														';
	}

	while($row2 = @mysql_fetch_array($incidenceReported))
	{
		$date = new DateTime($row2[4]);
		$incidenciasReportadas = $incidenciasReportadas.'<div class="'.$row2[5].'">
															<p class="alert">
															Incidencia # '.$row2[0].' : '.$row2[6].'.<br/>Fecha: '.$date->format('jS F Y').'
															<br>Reportado por: '.$row2[7].'
															<a href="RevisarIncidencia.php?idIncidencia='.$row2[0].'" class="btn btn-xs btn-info pull-right">
															<i class="ace-icon glyphicon glyphicon-zoom-in bigger-120"></i>
															</a></p>
														</div>
														';
	}

	while($row3 = @mysql_fetch_array($incidenceResolved))
	{
		$date = new DateTime($row3[4]);
		$incidenciasResueltas = $incidenciasResueltas.'<div class="'.$row3[5].'">
															<p class="alert">
															Incidencia # '.$row3[0].' : '.$row3[6].'.<br/>Fecha: '.$date->format('jS F Y').'
															<br>Reportado por: '.$row3[7].'
															<a href="RevisarIncidencia.php?idIncidencia='.$row3[0].'" class="btn btn-xs btn-info pull-right">
															<i class="ace-icon glyphicon glyphicon-zoom-in bigger-120"></i>
															</a></p>
														</div>
														';
	}

	while($row4 = @mysql_fetch_array($incidenceClose))
	{
		$date = new DateTime($row4[4]);
		$incidenciasCerradas = $incidenciasCerradas.'<div class="'.$row4[5].'">
															<p class="alert">
															Incidencia # '.$row4[0].' : '.$row4[6].'.<br/>Fecha: '.$date->format('jS F Y').'
															<br>Reportado por: '.$row4[7].'
															<a href="RevisarIncidencia.php?idIncidencia='.$row4[0].'" class="btn btn-xs btn-info pull-right">
															<i class="ace-icon glyphicon glyphicon-zoom-in bigger-120"></i>
															</a></p>
														</div>
														';
	}

	echo json_encode(['asignadas' => $incidenciasAsignadas, 'reportadas' => $incidenciasReportadas, 'resueltas' => $incidenciasResueltas, 'cerradas' => $incidenciasCerradas]);
	return;
?>