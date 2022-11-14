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
        <?php   //esta pagina puede estar sin html sin problemas
            session_unset();    //vacia la sesion
            foreach($_COOKIE as $key => $value) 
            {
                setcookie("$key", "", time() - 3600);    //borra los datos de las cookies a excepcion de la id de sesion
            }
            session_destroy();  //y elimina la id de sesion 
            header("Location: pruebaInicio.php");
        ?>
    </body>
</html>  