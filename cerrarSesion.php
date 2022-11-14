<?php   
    session_name('idSesion');
    session_start();    //se carga la sesion con el nombre idSesion
?>

<!doctype html>                
<html>              
    <body>
        <?php   //esta pagina puede estar sin html sin problemas
          //vacia la sesion
            foreach($_COOKIE as $key => $value) 
            {
                setcookie("$key", "", time() - 3600);    //borra los datos de las cookies a excepcion de la id de sesion
            }
            session_destroy();  //y elimina la id de sesion 
            header("Location: index.php");
        ?>
    </body>
</html>  