<?php
    $username = $_POST["username"];
    $password = $_POST["password"];
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
            $_SESSION['idUsuario'] = $row["idUsuario"];
            $_SESSION['usuario'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['type'] = $row["type"];
            //Redireccionamos a la pagina: index.php
            ?>
            
            <?php
                if ($_SESSION['type'] == "Admin") {
                    header("Location: ../../panelAdmin.php");  
                } else {
                    header("Location: ../../panelAdmin.php");
                }
            
            } else

            {
            //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
?>
        <script languaje="javascript">
                alert("Contraseña Incorrecta. Por favor ingrese de nuevo.");
                location.href = "../../index.html";
        </script>
<?php
            }
        }
        else
        {
        //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
?>
        <script languaje="javascript">
        alert("El nombre de usuario o contraseña es incorrecto!");
        location.href = "../../index.html";
        </script>
<?php
        }
 
        //@mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
        @mysql_free_result($result);
         
        /*@mysql_close() se usa para cerrar la conexión a la Base de datos y es 
        **necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
        **programar una aplicación que tendrá muchas visitas ;) .*/
        @mysql_close();
?>