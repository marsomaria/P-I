<?php   
    session_name('idSesion');
    session_start();    //se carga la sesion con el nombre idSesion
    if(!isset($_SESSION['usuario'])) //si se ha guardado el nombre de usuario en la sesion
    {
        header('Location: error.php');
    }
?>

<!doctype html>                
<html>              
    <p><a href='pruebaInicio.php'>pruebaInicio</a></p>
    <p><a href='pruebaCookies.php'>pruebaCookies</a></p>
    <p><a href='pruebaSesion.php'>pruebaSesion</a></p>
    <p><a href='pruebaSalir.php'>pruebaSalir</a></p>
    <body>
        <?php
            if(isset($_SESSION['usuario'])) //si se ha guardado el nombre de usuario en la sesion
            {
                echo 'Se ha iniciado sesión, ', $_SESSION['usuario'], '<br>';
                if(isset($_COOKIE['usuario']) && isset($_COOKIE['contra'])) //si se han almacenado datos en una cookie
                {
                    echo 'y has elegido que recordemos tus datos';
                }
            }
            /*else    //si el nombre no se ha guardado en la sesion es un error y vuelve a la pagina de login
            {
                header('Location: pruebaInicio.php');
            }*/
        ?>
    </body>
</html>  