<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Foto";
require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
require_once("navegador.php"); ?>

<?php
function mostrarFoto()
{
    $id = $_GET["id"];


    //$fotillo=1;
    // Conecta con el servidor de MySQL
    $mysqli = @new mysqli(
        'localhost', // El servidor
        'root', // El usuario
        '', // La contraseña
        'pibd'
    ); // La base de datos
    if ($mysqli->connect_error) {
        echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
        echo '</p>';
        exit;
    }
    // Ejecuta una sentencia SQL
    $sentencia = 'SELECT *, DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) join albumes a on (Album=a.IdAlbum) where IdFoto=' . $id;
    $sentencia2 = 'SELECT * FROM albumes join fotos on (IdAlbum=Album) join usuarios on (Usuario=IdUsuario) where IdFoto=' . $id;
    if (!($resultado = $mysqli->query($sentencia))) {
        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    if (!($resultado2 = $mysqli->query($sentencia2))) {
        echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }

    // Recorre el resultado y lo muestra en forma de tabla HTML
    while ($fila = $resultado->fetch_assoc()) {
        while ($fila2 = $resultado2->fetch_assoc()) {
            if ($fila['NomPais'] == "_") {
                $ubi = "SIN UBICACIÓN";
                // echo "SIN UBICACION";
            } else {
                $ubi = $fila['NomPais'];
            }
            if (!preg_match_all('#[1-9]+#', $fila['fechaDMY'])) {
                echo  " <fieldset class='todasf'>
                            <div class='imag'>
                                <img src='./imgs/" . $fila["Fichero"] . "'alt='" . $fila["Alternativo"] . "' width='300'>
                                <p class='datos'>" . $fila2['Titulo'] . "</p>
                                <p class='datos'> <span class='icon-info-circled-alt'></span>" . $fila2['Descripcion'] . "</p>
                                <p class='datos'> <span class='icon-calendar'></span>Sin fecha</p>
                                <p class='datos'> <span class='icon-location-1'></span>" . $ubi . "</p>
                                <p class='datos'> <a href='ver_album.php?id=" . $fila['IdAlbum'] . "'><span class='icon-picture-1'></span>" . $fila["Titulo"] . "</a></p>
                                <p class='datos'> <a href='perfilUSUARIO.php?id=" . $fila['Usuario'] . "'><span class='icon-user'></span>@" . $fila2["NomUsuario"] . "</a></p>
                            </div>
                        </fieldset>";
            } else {
                echo  " <fieldset class='todasf'>
                            <div class='imag'>
                                <img src='./imgs/" . $fila["Fichero"] . "'alt='" . $fila["Alternativo"] . "' width='300'>
                                <p class='datos'>" . $fila2['Titulo'] . "</p>
                                <p class='datos'> <span class='icon-info-circled-alt'></span>" . $fila2['Descripcion'] . "</p>
                                <p class='datos'> <span class='icon-calendar'></span>" . $fila['fechaDMY'] . "</p>
                                <p class='datos'> <span class='icon-location-1'></span>" . $ubi . "</p>
                                <p class='datos'> <a href='ver_album.php?id=" . $fila['IdAlbum'] . "'><span class='icon-picture-1'></span>" . $fila["Titulo"] . "</a></p>
                                <p class='datos'> <a href='perfilUSUARIO.php?id=" . $fila['Usuario'] . "'><span class='icon-user'></span>@" . $fila2["NomUsuario"] . "</a></p>
                            </div>
                        </fieldset>";
            }
        }
    }

    // Libera la memoria ocupada por el resultado
    $resultado->close();
    $resultado2->close();
    // Cierra la conexión
    $mysqli->close();
}
?>
<main>
    <?php mostrarFoto(); ?>

</main>
<?php require_once("pie.php"); ?>