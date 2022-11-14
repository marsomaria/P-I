<?php require_once("acceso_solo_no_registrados.php"); ?>

<?php   
if(!empty($_POST['email']) && !empty($_POST['contra']))
{
    
        $emailUsuario = $_POST['email']; 
        $contraUsuario = $_POST['contra'];
        //$sentencia = 'SELECT * FROM usuarios WHERE usuarios.Email = "' . $emailUsuario . '" AND usuarios.Clave = TO_BASE64("' . $contraUsuario.'")';
        $sentencia = 'SELECT * FROM usuarios WHERE Email = "' . $emailUsuario . '" AND FROM_BASE64(Clave) = "' . $contraUsuario.'"';
        $resultado = peticionPIBD($sentencia);

        $inicio = false;
        while($fila = $resultado->fetch_assoc())
        {
            if(!empty($_POST['cookies']))    //guarda los datos en una cookie si ha marcado la casilla cookies
                {
                    //setcookie('usuario', base64_encode($fila['Email']), time() + 90 * 24 * 60 * 60);
                    //setcookie('contra', base64_encode($fila['Clave']), time() + 90 * 24 * 60 * 60);
                    setcookie('usuario', base64_encode($fila['Email']), time() + 90 * 24 * 60 * 60);
                    setcookie('contra', base64_encode(base64_decode($fila['Clave'])), time() + 90 * 24 * 60 * 60);  //redundante pero el concepto seria el mas realista
                    setcookie('fecha', date('d-m-Y'), time() + 90 * 24 * 60 * 60);
                    setcookie('hora', date('H:i'), time() + 90 * 24 * 60 * 60);
                }
                $_SESSION['usuario'] = $fila['Email'];  
                $_SESSION['idUsuario'] = $fila['IdUsuario'];
                $_SESSION['nombreUsuario'] = $fila['NomUsuario']; 
                $_SESSION['estiloUsuario'] = $fila['Estilo'];

                
                $inicio = true;
                header('Location: index_reg.php');
        }
        if($inicio == false)
        {
            header('Location: index_error.php');
        }
}
else    //si los campos estan vacios
{
    if(!empty($_COOKIE["usuario"]) && !empty($_COOKIE["contra"]) && !empty($_COOKIE["fecha"]) && !empty($_COOKIE["hora"]))  //si se ha accedido desde iniciar sesion con los datos de las cookies 
    {
        $emailUsuario = base64_decode($_COOKIE['usuario']);
        $contraUsuario = base64_decode($_COOKIE['contra']);

        //$sentencia = 'SELECTXD * FROM usuarios WHERE usuarios.Email = "' . base64_decode($_COOKIE['usuario']) . '" AND FROM_BASE64(usuarios.Clave) = "' . base64_decode($_COOKIE['contra']).'"';
        //$sentencia = 'SELECT * FROM usuarios WHERE usuarios.Email = "' . base64_decode($_COOKIE['usuario']) . '" AND usuarios.Clave = "' . $_COOKIE['contra'].'"';
        $sentencia = 'SELECT * FROM usuarios WHERE Email = "' . $emailUsuario . '" AND FROM_BASE64(Clave) = "' . $contraUsuario.'"';
        $resultado = peticionPIBD($sentencia);

        $inicio = false;
        while($fila = $resultado->fetch_assoc())
        {
            if(!empty($_POST['cookies']))    //guarda los datos en una cookie si ha marcado la casilla cookies
                {
                    //setcookie('usuario', base64_encode($fila['Email']), time() + 90 * 24 * 60 * 60);
                    //setcookie('contra', base64_encode($fila['Clave']), time() + 90 * 24 * 60 * 60);
                    setcookie('usuario', base64_encode($fila['Email']), time() + 90 * 24 * 60 * 60);
                    setcookie('contra', base64_encode(base64_decode($fila['Clave'])), time() + 90 * 24 * 60 * 60);  //redundante pero el concepto seria el mas realista
                    setcookie('fecha', date('d-m-Y'), time() + 90 * 24 * 60 * 60);
                    setcookie('hora', date('H:i'), time() + 90 * 24 * 60 * 60);
                }
                $_SESSION['usuario'] = $fila['Email'];  
                $_SESSION['idUsuario'] = $fila['IdUsuario'];
                $_SESSION['nombreUsuario'] = $fila['NomUsuario']; 
                $_SESSION['estiloUsuario'] = $fila['Estilo'];
                
                $inicio = true;
                header('Location: index_reg.php');
        }
        if($inicio == false)
        {
            header('Location: index_error.php');
        }
    }
    else    //si el formulario estaba vacio y no se ha iniciado sesion con los datos de las cookies
    {
        //echo "No puede dejar los campos vacíos";
        header('Location: login.php');
    }
}
?>