<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Mis Álbumes";
    require_once("cabeza.php"); ?>
<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

    <?php
       
    function sacaAlbumes(){
        // echo "soy ".$_SESSION['usuario'];
        $iniciado=$_SESSION['usuario'];
        // $id=1;
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
        $sentencia = 'SELECT IdAlbum, Titulo, Descripcion, NomUsuario, Email from albumes join usuarios on (Usuario=IdUsuario) where email="'.$iniciado .'" ';
       
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }

                

        // echo "<fieldset >";
        echo "<div class='imag' style='margin:10%;'>";
        echo " <h1>TODOS MIS ÁLBUMES</h1>";
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc()) {
                
                echo " <p class='datos'>
                            <a href='ver_album.php?id=". $fila['IdAlbum'] ."'><span class='icon-picture-1'>". $fila['Titulo'] ."</span></a>
                            <h9>". $fila['Descripcion'] ." </h9>
                        </p>";
                        
        }
        echo "</div>";
        // echo "</fieldset>";

        // Libera la memoria ocupada por el resultado
        $resultado->close();
       
        // Cierra la conexión
        $mysqli->close();
    }
    
    
    ?>

<main>
    <?php sacaAlbumes();  ?>
</main>

<?php require_once("pie.php"); ?>