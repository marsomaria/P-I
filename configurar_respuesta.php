<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Configuración";
require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
require_once("navegador.php"); ?>

<main>
    <fieldset class='contenedor2'>
        <h1 style='color:var(--acento);'>Cambio de estilo</h1>

        <?php
        $idUsuario = $_SESSION['idUsuario'];
        if(!empty($_GET['idEstilo']))
        {
            $idEstilo = $_GET['idEstilo'];
            $sentencia = 'SELECT * FROM estilos WHERE IdEstilos = ' . $idEstilo . '';

            $resultado = peticionPIBD($sentencia);  //si existe ese estilo y el usuario no ha saboterado la url
            while ($fila = $resultado->fetch_assoc()) 
            {
                echo " <p class='rellena2'>
                            <strong><em style='color:var(--oscuro);'>" . $fila['Nombre'] . "</em></strong>
                            <h9>" . $fila['Descripcion'] . " </h9><br>
                            <h9>Los cambios se harán visibles al recargar la página</h9>
                        </p>";

                $sentencia = 'UPDATE usuarios SET Estilo = ' . $idEstilo . ' WHERE IdUsuario = ' . $_SESSION['idUsuario'] . '';
                if(peticionPIBD($sentencia))
                {
                    $_SESSION['estiloUsuario'] = $idEstilo;
                    //header("Location:configurar_respuesta.php");
                    //header("Location:".$_SERVER['HTTP_REFERER']);
                }
                else
                {
                    echo 'Lo sentimos ' . $_SESSION['nombreUsuario'] . ', no se ha podido cambiar el estilo visual<br>
                    <a href="configurar.php">Volver a intentar</a>';
                }
            }
        }
        else 
        {
            echo 'Lo sentimos ' . $_SESSION['nombreUsuario'] . ', si quieres cambiar el estilo debes hacerlo desde <a href="configurar.php">esta página</a>';
        }
        ?>
    </fieldset>
</main>