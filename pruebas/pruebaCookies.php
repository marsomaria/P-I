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
        <?php   //esta pagina puede estar sin html sin problemas, solo habria que tratar la situacion en la que el usuario no llene ningun campo y comprobar que los usuarios sean validos para controlAcceso
            if(isset($_POST['nombreUsuario']) && isset($_POST['contraUsuario']))    //si los campos no estan vacios
            {
                $nombreUsuario = $_POST['nombreUsuario']; //coge los datos que ha introducido el usuario en el formulario
                $contraUsuario = $_POST['contraUsuario'];
                if(isset($_POST['cookies']))    //guarda los datos en una cookie si ha marcado la casilla cookies
                {
                    setcookie('usuario', base64_encode($nombreUsuario), time() + 90 * 24 * 60 * 60);
                    setcookie('contra', base64_encode($contraUsuario), time() + 90 * 24 * 60 * 60);
                    //setcookie('contra', password_hash('$contraUsuario', PASSWORD_DEFAULT), time() + 90 * 24 * 60 * 60); usaria este pero no se desencriptarlo sin guardar la clave
                    setcookie('fecha', date('d-m-Y'), time() + 90 * 24 * 60 * 60);
                    setcookie('hora', date('H:i'), time() + 90 * 24 * 60 * 60);
                }
                $_SESSION['usuario'] = $nombreUsuario;  //guarda el nombre de usuario en la sesion

                header('Location: pruebaSesion.php');
            }
            else
            {
                if(isset($_COOKIE["usuario"]) && isset($_COOKIE["contra"]) && isset($_COOKIE["fecha"]) && isset($_COOKIE["hora"]))  //si se ha accedido desde iniciar sesion con los datos de las cookies 
                {
                    $nombreUsuario = base64_decode($_COOKIE['usuario']);
                    $contraUsuario = base64_decode($_COOKIE['contra']);
                    setcookie('usuario', base64_encode($nombreUsuario), time() + 90 * 24 * 60 * 60);  //resetea los valores y la cuenta atras de 90 dias
                    setcookie('contra', base64_encode($contraUsuario), time() + 90 * 24 * 60 * 60);
                    setcookie('fecha', date('d-m-Y'), time() + 90 * 24 * 60 * 60);
                    setcookie('hora', date('H:i'), time() + 90 * 24 * 60 * 60);
                    
                    header('Location: pruebaSesion.php');
                }
                else    //si el formulario estaba vacio y no se ha iniciado sesion con los datos de las cookies
                {
                    //echo "No puede dejar los campos vacíos";    //cambiar esto por un mensaje de error sobre los inputs o algo asi o volver a la pantalla de login
                    header('Location: pruebaInicio.php');
                }
            }
        ?>
    </body>
</html>