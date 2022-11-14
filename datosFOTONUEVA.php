<?php
    $estoySUBIDA=-1;
    $yaexiste=false;
    $foto=$_FILES["fichero"]["name"];
    function yaexisteFOTO(){
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

        $sentencia = "SELECT IdFoto, Fichero FROM fotos";
        $veces=0;

            // Ejecuta la sentencia SQL
        
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            
            while($fila = $resultado->fetch_assoc()) {
                // echo "soy ".$fila['IdFoto']. "+".$fila["Fichero"];
                if($fila["Fichero"]==$_FILES["fichero"]["name"]){
                    $yaexiste=true;
                    echo 'true'.$yaexiste.'//';
                    $estoySUBIDA=2;
                    echo $estoySUBIDA;
                }
            }
        
            
        // Cierra la conexión
        $mysqli->close();

        return $yaexiste;
    }


    function esticya(){
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

        $sentencia = 'SELECT count(*)estoy FROM fotos where Fichero like "'.$_FILES["fichero"]["name"]. '"';
        $veces=0;

            // Ejecuta la sentencia SQL
        
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            while($fila = $resultado->fetch_assoc()){
                if($fila['estoy']>1){
                    // echo "YA ESTOY SUBIDA HUEVA";
                    cambiaNOMBREunix();
                }else{
                    $msgError = array(0 => "No hay error, el fichero se subió con éxito",
                                            1 => "El tamaño del fichero supera la directiva
                                                upload_max_filesize el php.ini",
                                            2 => "El tamaño del fichero supera la directiva
                                                MAX_FILE_SIZE especificada en el formulario HTML",
                                            3 => "El fichero fue parcialmente subido",
                                            4 => "No se ha subido un fichero",
                                            6 => "No existe un directorio temporal",
                                            7 => "Fallo al escribir el fichero al disco",
                                            8 => "La subida del fichero fue detenida por la extensión");
                        if($_FILES["fichero"]["error"] > 0){
                            echo "Error: " . $msgError[$_FILES["fichero"]["error"]] . "<br />";
                        }else{
                            
                            // echo "Nombre original: " . $_FILES["fichero"]["name"] . "<br />";
                            echo "Tipo: " . $_FILES["fichero"]["type"] . "<br />";
                            echo "Tamaño: " . ceil($_FILES["fichero"]["size"] / 1024) . " Kb<br />";
                            // echo "Nombre temporal: " . $_FILES["fichero"]["tmp_name"] . "<br />";
                            if(file_exists("./imgs/" . $_FILES["fichero"]["name"])){
                                echo $_FILES["fichero"]["name"] . " ya existe";
                                // cambiaNOMBREunix();  
                            } else{
                                move_uploaded_file($_FILES["fichero"]["tmp_name"],
                                                    "./imgs/" . $_FILES["fichero"]["name"]);
                                echo "Almacenado en: " . "./imgs/" . $_FILES["fichero"]["name"];
                            }

                            $estoySUBIDA=1;
                        }
                }
            }
     
        // Cierra la conexión
        $mysqli->close();

        
    }

   

   
?>




<form action="mis_fotos.php" method="POST" class="contenedor2">
    <fieldset>
        <legend>Solicitud registrada con éxito</legend>


        <p class="datos">
            Titulo: 
            <b> <?php echo $_POST["titulo"]; ?> </b>
        </p>

        <p class="datos">
            <span class="icon-info-circled"></span>Descripción: 
                <b> <?php echo $_POST["desc"]; ?> </b>
        </p>

        <p class="datos">
        <span class="icon-calendar">Fecha: 
                <b> <?php 
                        $fechita=$_POST['fecha'];
                        echo $fechita; 
                        
                        ?> </b>
        </p>

        <p class="datos">
            <span class="icon-location"></span>Pais: 
                <b> <?php echo $_POST["pais"]; ?> </b>
        </p>

        <p class="datos">
            <span class="icon-picture"></span>Foto: 
            <!-- $_POST["fichero"] -->

                <b>  <?php echo $_SESSION['fotousuario']?></b><br>
        
                    <?php  esticya();?>
            </p>

            <p class="datos">
                <span class="icon-info-circled-alt"></span>Texto alternativo: 
                    <b> <?php echo $_POST["textAlt"]; ?> </b>
            </p>

            <p class="datos">
                <span class="icon-picture-1"></span>Álbum: 
                    <b> <?php echo $_POST["album"]; ?> </b>
            </p>

        <input class="boton" type="submit" value="Confirmar foto">
       
    </fieldset>
</form>

