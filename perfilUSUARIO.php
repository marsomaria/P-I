<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Foto";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<?php

    $id = $_GET["id"];
        // Conecta con el servidor de MySQL
    $mysqli = @new mysqli(
        'localhost', // El servidor
        'root', // El usuario
        '', // La contraseña
        'pibd'); // La base de datos
    if($mysqli->connect_errno) {
        echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
        echo '</p>';
        exit;
    }
    // Ejecuta una sentencia SQL
    $sentencia = 'SELECT *, DATE_FORMAT(FRegistro,"%d/%m/%Y  %h:%m:%s ")fechaDMYHM FROM usuarios join albumes on IdUsuario=Usuario where IdUsuario="'.$id.'"';
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
            $info=0;
    // Recorre el resultado y lo muestra en forma de tabla HTML
    while($fila = $resultado->fetch_assoc()) {
        $fotop=$fila["Foto"];

        if($fila["Foto"]==""){
            $fotop="vacio.jpg";
        }

        if($info<1){

        
            echo "<main>
                <fieldset class='contenedor3'>

                        <img src='./imgs/usuarios/" . $fotop ."' alt='Foto de usuario'>

                        <h2>". $fila['NomUsuario'] ."</h2>
                        <p class='datos'><span class='icon-calendar'></span>". $fila['fechaDMYHM'] ."</p>

                        ";    
            $info=1;
        }  
            echo "<p class='datos'> <a href='ver_album.php?id=".$fila['IdAlbum']."'><span class='icon-picture-1' style='color:var(--acento);'></span>". $fila["Titulo"] ."</a></p>
            ";
    }
    echo "</fieldset>
    </main>";
    
    // Libera la memoria ocupada por el resultado
    $resultado->close();
    // Cierra la conexión
    $mysqli->close();
?>

<?php require_once("pie.php"); ?>