<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Baja";
require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
require_once("navegador.php"); ?>

<?php

function sacaAlbumes()
{
    // echo "soy ".$_SESSION['usuario'];
    $iniciado = $_SESSION['usuario'];
    $sentencia = 'SELECT IdAlbum, Titulo, Descripcion, NomUsuario, Email from albumes join usuarios on (Usuario=IdUsuario) where email="' . $iniciado . '" ';
    $resultado = peticionPIBD($sentencia);

    // echo "<fieldset >";
    echo "<div class='imag' style='margin:7%;margin-bottom:5%;margin-top:5%; border: 3px solid var(--principal);'>";
    echo " <h1>Mis álbumes y sus fotos</h1>";
    // Recorre el resultado y lo muestra en forma de tabla HTML
    while ($fila = $resultado->fetch_assoc()) {

        echo " <p class='datos'>
                            <a href='ver_album.php?id=" . $fila['IdAlbum'] . "'><span class='icon-picture-1'>" . $fila['Titulo'] . "</span></a>
                            <!--<h9>" . $fila['Descripcion'] . " </h9>-->
                        ";
        $sentencia2 = 'SELECT count(*) totala from fotos join albumes a on (a.IdAlbum=Album) join usuarios on (Usuario=IdUsuario) where email="' . $iniciado . '" and a.Titulo like "' . $fila['Titulo'] . '"';
        $resultado2 = peticionPIBD($sentencia2);

        while ($fila2 = $resultado2->fetch_assoc()) {
            echo $fila2['totala'];
        }
    }
    echo "</p></div>";
    // echo "</fieldset>";
}

function sacaFotosTotal()
{
    // echo "soy ".$_SESSION['usuario'];
    $iniciado = $_SESSION['usuario'];
    $sentencia = 'SELECT count(*)nfotos from fotos join albumes on (IdAlbum=Album) join usuarios on (Usuario=IdUsuario) where email="' . $iniciado . '" ';
    $resultado = peticionPIBD($sentencia);

    // echo "<fieldset >";
    echo "<div class='imag' style='margin:7%; border: 3px solid var(--principal);'>";
    echo " <h1>Fotos totales</h1>";
    // Recorre el resultado y lo muestra en forma de tabla HTML
    while ($fila = $resultado->fetch_assoc()) {

        echo " <p class='datos'>
                            <a href='mis_fotos.php'><span class='icon-picture' style='margin:10%;color:var(--acento);'>" . $fila['nfotos'] . "</span></a>
                            
                        ";
    }
    echo "</p></div>";
}
?>

<main>
    <?php
    sacaAlbumes();
    sacaFotosTotal();
    ?>
    <form class="imag" action="baja_respuesta.php" method="POST" style="margin:7%; border: 3px solid var(--acento);">
        <h1>Eliminar cuenta</h1>
        <p class="rellena">
            <label class="campo">Introduce tu contraseña:</label>
            <input class="caja3" type="password" id="contra" name="contra">
            <input class="botonopcion" type="submit" value="Confirmar">
        </p>
    </form>
</main>

<?php require_once("pie.php"); ?>