<?php
	session_start(); 
	header('Content-type: application/json');

	$idIncidencia = $_POST["id"];

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    	
	$incidence = @mysql_query("SELECT u.fullname, ia.enable
						FROM incidencia_asignada ia
						INNER JOIN incidencia i on ia.idIncidencia=i.idIncidencia
						INNER JOIN usuario u on ia.idUsuario=u.idUsuario
						WHERE ia.idIncidencia = ".$idIncidencia."
						ORDER BY ia.orden
						")or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
	$incidencias = "";
	while($row = @mysql_fetch_array($incidence))
	{
		$incidencias = $incidencias.'<span class="label label-xlg label-grey arrowed-in-right arrowed-in">
									'.$row[0].'
									</span>

									<span class="label label-xlg label-success arrowed">';
									?> 
									<?php $row[1] = (1) ? $incidencias=$incidencias.'Revisado' : $incidencias=$incidencias.'Aun no revisa' ;?>
									<?php 
									$incidencias = $incidencias.'</span><br>
		';
	}

	echo json_encode(['message' => $incidencias]);
	return;
?>