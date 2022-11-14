<?php   
    session_name('idSesion');
    session_start();    //se carga la sesion con el nombre idSesion
?>

<!doctype html>                
<html>              
    <p><a href='pruebaInicio.php'>pruebaInicio</a></p>
    <p><a href='pruebaCookies.php'>pruebaCookies</a></p>
    <p><a href='pruebaSesion.php'>pruebaSesion</a></p>
    <p><a href='pruebaSalir.php'>pruebaSalir</a></p> 
    <body>
        <?php
            if(isset($_COOKIE['usuario']) && isset($_COOKIE['contra']) && isset($_COOKIE['fecha']) && isset($_COOKIE['hora'])) //si ya hay una cookie con los datos del usuario muestra el mensaje personalizado
            {
                echo "<p>Bienvenido de nuevo ", base64_decode($_COOKIE['usuario']), ", su última visita fue el ", $_COOKIE['fecha'], " a las ", $_COOKIE['hora'], "</p>
                <a href='pruebaSalir.php'>Cerrar sesión</a>
                <a href='pruebaCookies.php'>Iniciar sesión</a>";
            }
            else    //si no hay cookies guardadas para este sitio muestra el formulario normal
            {
                echo "<form action='pruebaCookies.php' method='POST'>
                <input type='text' name='nombreUsuario' placeholder='Introduce un nombre de usuario'>
                <input type='password' name='contraUsuario' placeholder='Introduce una contraseña'>
                <input type='checkbox' name='cookies' value='Cookies'> Recuérdame
                <input type='submit' name='formulario' value='Iniciar sesión'></input>
                </form>";
            }
        ?>  
    </body>
</html>