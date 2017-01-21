<?php
	session_start();
	header('Content-type: application/json');
	$idIncidencia = $_POST["idIncidencia"];
	$idCategoria = $_POST["idCategoria"];

	$descripcion = $_POST["descripcion"];
	$info = $_POST["info"];
	$pasos = $_POST["pasos"];
	$resultado = $_POST["resultado"];
	$estado = $_POST["state"];

	$idUsuario = $_SESSION['idUsuario'];

	$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    
	// Validaciones
    
    // Usuario que registró la incidencia
    $usuario;
    $user = @mysql_query("SELECT idUsuario FROM incidencia WHERE idIncidencia ='".$idIncidencia."'");
    while($fila8 = @mysql_fetch_array($user))
    { $usuario = $fila8[0]; }

    if ($estado == "Cerrado" && $idUsuario != $usuario) {
        echo json_encode(['error' => true, 'message' => 'Lo sentimos, la única persona que puede cerrar la incidencia es el usuario que la registró.']);
        return;
    } 
    

    $per = 0;
	$profile = @mysql_query("SELECT idPerfil FROM nivel WHERE enable=1 AND idCategoria='".$idCategoria."' AND idUsuario='".$idUsuario."'");
	while($fila = @mysql_fetch_array($profile))
	{ $per = $fila[0]; }

	$cantLevel = 0;
	$nivel = @mysql_query("SELECT nivel FROM perfil WHERE enable=1 AND idPerfil='".$per."'");
	while($fila2 = @mysql_fetch_array($nivel))
	{ $cantLevel = $fila2[0]; }


    if ($cantLevel < 10)
    {
        echo json_encode(['error' => true, 'message' => 'Lo sentimos, usted no cuenta con el nivel necesario para modificar una incidencia solo de observar.']);
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

    $fecha=date("y-m-d");

    @mysql_query("UPDATE incidencia SET descripcion='".$descripcion."',
    					 				infoAdicional='".$info."',
    					 				pasosReproducir='".$pasos."',
    					 				result='".$resultado."',
    					 				state='".$estado."'
    					 				WHERE idIncidencia=".$idIncidencia)or die ('Ha fallado la modificacion: '.@mysql_error());

	// Hallar el nuevo orden
    $order = 0;
    $ord = @mysql_query("SELECT orden FROM incidencia_asignada WHERE idIncidencia='".$idIncidencia."' AND idUsuario='".$idUsuario."' LIMIT 1");
    while($fila3 = @mysql_fetch_array($ord))
    { $order = $fila3[0]+1; }

    // Derivar incidencia
    @mysql_query("UPDATE incidencia_asignada SET enable=1
                WHERE idIncidencia='".$idIncidencia."' AND orden='".$order."'")or die ('Ha fallado la modificacion: '.@mysql_error());

    echo json_encode(['error' => false]);
	return;
?>