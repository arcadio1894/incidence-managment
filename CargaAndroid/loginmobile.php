<?php
    $username = $_GET["user"];
    $password = $_GET["pass"];
    @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
    @mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
    $result = @mysql_query("SELECT * FROM usuario WHERE username = '".$username."' AND password = '".$password."'");

        if($row = @mysql_fetch_array($result))
        {     
            if($row["password"] == $password)
            {
            //Creamos sesión
            session_start();  
            //Almacenamos el nombre de usuario en una variable de sesión usuario
            $usuario['id'] = $row["idUsuario"];
            $usuario['usuario'] = $username;
            $usuario['nombre'] = $row["fullname"];;
            $usuario['tipo'] = $row["type"];
            $usuario['email'] = $row["email"];
            //Redireccionamos a la pagina: index.php 
            $datos['error'] = false;
            $datos['mensaje'] = 'Ingreso exitoso!';
            $datos['usuario'] = $usuario;

            echo json_encode($datos);
            } else
            {
            //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
            $datos['error'] = true;
            $datos['mensaje'] = 'Password incorrecta!';
            $datos['usuario'] = null;
            echo json_encode($datos);
            }
        }
        else
        {
        //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
            $datos['error'] = true;
            $datos['mensaje'] = 'Usuario no registrado!';
            $datos['usuario'] = null;
            echo json_encode($datos);
        }
 
        //@mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
        @mysql_free_result($result);
         
        /*@mysql_close() se usa para cerrar la conexión a la Base de datos y es 
        **necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
        **programar una aplicación que tendrá muchas visitas ;) .*/
        @mysql_close();
?>