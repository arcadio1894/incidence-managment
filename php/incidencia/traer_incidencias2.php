<?php
	session_start(); 
	header('Content-type: application/json');
	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
	


    if ($_SESSION['type'] == "Admin") {
    	$incidence = @mysql_query("SELECT i.idIncidencia, p.name, c.name, i.severidad, i.created_at, i.state, i.resumen
							FROM incidencia i
							INNER JOIN proyecto p on i.idProyecto=p.idProyecto
							INNER JOIN categoria c on i.idCategoria=c.idCategoria
							")or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    } else {
    	$incidence = @mysql_query("SELECT i.idIncidencia, p.name, c.name, i.severidad, i.created_at, i.state, i.resumen
							FROM incidencia i
							INNER JOIN proyecto p on i.idProyecto=p.idProyecto
							INNER JOIN categoria c on i.idCategoria=c.idCategoria
							INNER JOIN incidencia_asignada ia on i.idIncidencia=ia.idIncidencia
							WHERE ia.idUsuario = '".$_SESSION['idUsuario']."' AND ia.enable=1")or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    }
	
	$incidencias = "";
	while($row = @mysql_fetch_array($incidence))
	{
		$date = new DateTime($row[4]);
		$incidencias = $incidencias.'<tr class="'.$row[5].'">
										<td class="center">
											'.$row[0].'
										</td>

										<td class="center">
											'.$row[1].'
										</td>

										<td class="center">
											'.$row[2].'
										</td>
										<td class="hidden-480 center" >'.$row[3].'</td>
										<td class="center">'.$date->format('jS F Y').'</td>
										<td class="hidden-480 center">'.$row[5].'</td>

										<td class="hidden-480 center">'.$row[6].'</td>

										<td class="center">
											<div class="hidden-sm hidden-xs btn-group">

												<a href="verSeguimiento.php?idIncidencia='.$row[0].'" class="botoncito btn btn-xs btn-info">
													<i data-ver class="ace-icon glyphicon glyphicon-zoom-in bigger-120"></i>
												</a>
				
											</div>

											<div class="hidden-md hidden-lg">
												<div class="inline pos-rel">
													<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
														<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
													</button>

													<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
														<li>
															<a href="verSeguimiento.php?idIncidencia='.$row[0].'" class="tooltip-success" data-rel="tooltip" title="Edit">
																<span class="green">
																	<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>';
	}

	echo json_encode(['message' => $incidencias]);
	return;
?>