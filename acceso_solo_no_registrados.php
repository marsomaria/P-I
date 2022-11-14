<?php         
    include 'accesoBaseDatos.php';  
?>

<?php
    session_name('idSesion');
    session_start();    //se carga la sesion con el nombre idSesion

    if(!empty($_SESSION['idUsuario']) && !empty($_SESSION['usuario'])) //si se ha guardado el nombre de usuario en la sesion
    {

        $sentencia = 'SELECT NomUsuario FROM usuarios WHERE  usuarios.IdUsuario = ' . $_SESSION['idUsuario'] . ' AND usuarios.Email = "' . $_SESSION['usuario'] . '"';
        $resultado = peticionPIBD($sentencia);

        if($fila = $resultado->fetch_assoc())    //Si hay una sesion abierta y es un usuario valido
        {
            header('Location: index_reg.php');
        }
    }
?>