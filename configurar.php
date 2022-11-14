<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Configuración";
    require_once("cabeza.php"); ?>
<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<main>
    <fieldset class='contenedor2'>
        <h1 style='color:var(--acento);'>ESTILO ACTUAL</h1>
        <?php
            $idUsuario=$_SESSION['idUsuario'];

            $sentencia2 = 'SELECT * FROM estilos JOIN usuarios ON (IdEstilos=Estilo) WHERE IdUsuario = ' . $idUsuario . '';
            $sentencia = 'SELECT * FROM estilos WHERE IdEstilos>3  AND  IdEstilos != (SELECT IdEstilos FROM estilos JOIN usuarios ON (IdEstilos=Estilo) WHERE IdUsuario = ' . $idUsuario  . ')' ;

            $resultado = peticionPIBD($sentencia);
            $resultado2 = peticionPIBD($sentencia2);

            while($fila2 = $resultado2->fetch_assoc()) 
            {                   
                echo " <p class='rellena2'>
                            <strong><em style='color:var(--acento);'>" . $fila2['Nombre'] . "</em></strong>
                            <h9>" . $fila2['Descripcion'] . " </h9>
                        </p>";      
            }


            echo " <h1>ELIGE TU PROPIO ESTILO</h1>";
            // Recorre el resultado y lo muestra en forma de tabla HTML
            while($fila = $resultado->fetch_assoc()) 
            {
                echo " <p class='rellena2'>
                            <a href='configurar_respuesta.php?idEstilo=" . $fila['IdEstilos'] . "'><strong><em>" . $fila['Nombre'] . "</em></strong></a>
                            <h9>". $fila['Descripcion'] ." </h9>
                        </p>";    
            }
        ?>
    </fieldset>
</main>

<?php require_once("pie.php"); ?>