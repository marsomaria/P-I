<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Baja";
require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
require_once("navegador.php"); ?>


<main class="contenedor2">
    <div>
        <?php
        if (!empty($_POST['contra'])) {
            $idUsuario = $_SESSION['idUsuario'];
            $contra = $_POST['contra'];
            //$sentencia = 'DELETE from usuarios where email="' . $iniciado . '" ';

            $sentencia = 'DELETE FROM usuarios WHERE IdUsuario = ' . $idUsuario . ' AND Clave = TO_BASE64("' . $contra . '")';
            //$resultado = peticionPIBD($sentencia);

            if (peticionPIBD($sentencia))    //devuelve true si se ha llevado a cabo
            {
                echo "La cuenta se ha eliminado, te echaremos de menos " . $_SESSION['nombreUsuario']; //esto no se va a ver pero es un detalle
                header("Location: cerrarSesion.php");
            } else {
                echo "La contraseña introducida no es correcta"; //esto no se va a ver pero es un detalle
                //header("Location: baja.php");
            }
        } else {
            echo "Debe introducir la contraseña para darse de baja"; //esto no se va a ver pero es un detalle
            //header("Location: baja.php");
        }
        ?>

        <?php
        /*
$micontra = "";
function sacaContraseña()
{
    $iniciado = $_SESSION['usuario'];
    $sentencia = 'SELECT * from usuarios where email="' . $iniciado . '" ';
    $resultado = peticionPIBD($sentencia);

    // Recorre el resultado y lo muestra en forma de tabla HTML
    while ($fila = $resultado->fetch_assoc()) {
        // echo $fila['Clave'];
        $micontra = $fila['Contraseña'];
        // echo $fila['Contraseña'];
        // echo "saco cositas";


    }
    /*
    // echo $iniciado;
    // Conecta con el servidor de MySQL
    $mysqli = @new mysqli(
        'localhost', // El servidor
        'root', // El usuario
        '', // La contraseña
        'pibd'
    ); // La base de datos
    if ($mysqli->connect_errno) {
        echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
        echo '</p>';
        exit;
    }
    // Ejecuta una sentencia SQL
    $sentencia = 'SELECT * from usuarios where email="' . $iniciado . '" ';

    if (!($resultado = $mysqli->query($sentencia))) {
        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }

    // Recorre el resultado y lo muestra en forma de tabla HTML
    while ($fila = $resultado->fetch_assoc()) {
        // echo $fila['Clave'];
        $micontra = $fila['Contraseña'];
        // echo $fila['Contraseña'];
        // echo "saco cositas";


    }


    // Libera la memoria ocupada por el resultado
    $resultado->close();

    // Cierra la conexión
    $mysqli->close();

    return $micontra;
}

function elimina()
{
    $iniciado = $_SESSION['usuario'];
    // echo $iniciado;
    // Conecta con el servidor de MySQL
    $mysqli = @new mysqli(
        'localhost', // El servidor
        'root', // El usuario
        '', // La contraseña
        'pibd'
    ); // La base de datos
    if ($mysqli->connect_errno) {
        echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
        echo '</p>';
        exit;
    }
    // Ejecuta una sentencia SQL
    $sentencia = 'DELETE from usuarios where email="' . $iniciado . '" ';

    if (!($resultado = $mysqli->query($sentencia))) {
        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    header("Location:index.php");



    // Recorre el resultado y lo muestra en forma de tabla HTML
    // while($fila = $resultado->fetch_assoc()) {

    // }

    // Libera la memoria ocupada por el resultado
    // $resultado->close();

    // Cierra la conexión
    $mysqli->close();
}

?>



        <?php

sacaContraseña();
$co = sacaContraseña();
if ($_POST['contra'] != "") {
    if ($_POST['contra'] == $co) {
        elimina();
        header("Location:index.php");
    } else {
        header("Location:" . $_SERVER['HTTP_REFERER']);
    }
} else {
    header("Location:" . $_SERVER['HTTP_REFERER']);
}
*/
        ?>
    </div>
</main>

<?php require_once("pie.php"); ?>