<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Menu usuario";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>
<main>
        <fieldset class="contenedor2">

            <p class="datosenlace">
                <a href="mis_datos.php">Modificar datos</a>
            </p>

            <p class="datosenlace">
                <a href="configurar.php">Configurar visualmente</a>
            </p>

            <p class="datosenlace">
                <a href="mis_fotos.php">Mis fotos</a>
            </p>
            
            <p class="datosenlace">
                <a href="mis_albumes.php">Mis álbumes</a>
            </p>

            <p class="datosenlace">
                <a href="nuevo_album.php">Crear nuevo álbum</a>
            </p>

            <p class="datosenlace">
                <a href="agregar_foto.php?album=">Añadir foto a álbum</a>
            </p>

            <p class="datosenlace">
                <a href="solicitar_impreso_album.php">Solicitar álbum impreso</a>
            </p>

            <p class="datosenlace">
                <a href="baja.php">Darse de baja</a>
            </p>

            <p class="datosenlace">
                <a href="cerrarSesion.php">Salir</a>
            </p>

        </fieldset>
    </main>
<?php require_once("pie.php"); ?>