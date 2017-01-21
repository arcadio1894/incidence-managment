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
    $estadoAc = $_POST["estado"];

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
    
    if ($estadoAc == "Cerrado" && $estado != "Cerrado")
    {
        echo json_encode(['error' => true, 'message' => 'La incidencia ha sido cerrada, si desea ingrese otra vez la incidencia.']);
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

	echo json_encode(['error' => false]);
	return;
?>