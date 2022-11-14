<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Álbum";
    require_once("cabeza.php"); ?>
<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

    <?php
        function sacaDATOS(){
            $id = $_GET["id"];
            $fotillo=1;
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
            $sentencia = 'SELECT f.IdFoto,f.Pais,p.NomPais, f.Titulo,f.Fecha, f.Fichero,f.Alternativo,f.Album ,a.Titulo NombreAlbum, a.Descripcion, u.Email
                            
                            FROM fotos f join albumes a on (Album=IdAlbum) join paises p on (f.Pais=p.IdPais) join usuarios u on (Usuario=IdUsuario) where Album='.$id.' order by Fecha' ;

            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            // echo '<table><tr>';
            // echo '<th>IdFoto</th> <th>Pais</th> <th>NombrePais</th> <th>Título</th> <th>Fecha</th>';
            // echo '<th>Fichero</th>  <th>Alternativo</th> <th>Album</th>';
            // echo '<th>NombreAlbum</th> <th>Descripcion</th>  ';
            // echo '</tr>';
            $info=0;
            // Recorre el resultado y lo muestra en forma de tabla HTML
            while($fila = $resultado->fetch_assoc()) {

                if($info<1){
                    echo "
                                
                    <p class='datos'> <span class='icon-picture-1'></span>".$fila["NombreAlbum"]."</p>
                    <p class='datos'> <span class='icon-info-circled-alt'></span>" . $fila['Descripcion'] . "</p> ";
                    
                    if($_SESSION['usuario']==$fila['Email']){
                            echo "<p class='datos'> 
                                        <a href='agregar_foto.php?album=".$fila["NombreAlbum"]."'>
                                            <span class='icon-plus-circled' style='color:var(--acento);'></span>Subir foto</span>
                                        </a>
                                </p>";        
                    }
                   
                    $info+=1;
                }
                    // echo '<tr>';
                    // echo '<td>' . $fila['IdFoto'] . '</td>';
                    // echo '<td>' . $fila['Pais'] . '</td>';
                    // echo '<td>' . $fila['NomPais'] . '</td>';

                    // echo '<td>' . $fila['Titulo'] . '</td>';
                    // echo '<td>' . $fila['Fecha'] . '</td>';
                    // echo '<td>' . $fila['Fichero'] . '</td>';
                    // echo '<td>' . $fila['Alternativo'] . '</td>';
                    // echo '<td>' . $fila['Album'] . '</td>';
                    // echo '<td>' . $fila['NombreAlbum'] . '</td>';
                    // echo '<td>' . $fila['Descripcion'] . '</td>';
                    // echo '</tr>';
            }
            
            // echo '</table>';
            // Libera la memoria ocupada por el resultado
            $resultado->close();
            // Cierra la conexión
            $mysqli->close();

            if(albumVACIO()==0){
                echo "<h1>Álbum vacio</h1>";

                $id = $_GET["id"];
            $fotillo=1;
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
            $sentencia = 'SELECT * FROM albumes where IdAlbum= '.$id.'' ;

            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            
            $info=0;
            // Recorre el resultado y lo muestra en forma de tabla HTML
            while($fila = $resultado->fetch_assoc()) {

                if($info<1){
                    echo "
                                
                    <p class='datos'> <span class='icon-picture-1'></span>".$fila["Titulo"]."</p>
                    <p class='datos'> <span class='icon-info-circled-alt'></span>" . $fila['Descripcion'] . "</p>
                    <p class='datos'> <a href='agregar_foto.php?album=".$fila["Titulo"]."'><span class='icon-plus-circled' style='color:var(--acento);'></span>Subir foto</span></a></p>
        
                    ";
                    $info+=1;
                }
                   
            }
            
            // Libera la memoria ocupada por el resultado
            $resultado->close();
            // Cierra la conexión
            $mysqli->close();
            }
        }
    
    $avacio=0;
    function albumVACIO(){
        $id=$_GET['id'];

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
        $sentencia = 'SELECT count(*)fotos from albumes join fotos on (IdAlbum=Album) and IdAlbum='.$id.'';

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        while($fila = $resultado->fetch_assoc()) {

            // echo $fila['fotos'];
           
            if($fila['fotos']==0){
                $avacio=0;
            }else{
                $avacio=$fila['fotos'];
            }
            
               
        }
        
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
        // echo $avacio;
        return $avacio;
    }
    
    
        function sacaFOTOs(){
            $id = $_GET["id"];
            $fotillo=1;
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
            $sentencia = 'SELECT  DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY,f.IdFoto,f.Pais,p.NomPais, f.Titulo,f.Fecha, f.Fichero,f.Alternativo,f.Album ,a.Titulo NombreAlbum, a.Descripcion
                            
                            FROM fotos f join albumes a on (Album=IdAlbum) join paises p on (f.Pais=p.IdPais) where Album='.$id.' order by Fecha' ;

            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }

        
                    // echo '<table><tr>';
                    // echo '<th>IdFoto</th> <th>Pais</th> <th>NombrePais</th> <th>Título</th> <th>Fecha</th>';
                    // echo '<th>Fichero</th>  <th>Alternativo</th> <th>Album</th>';
                    // echo '<th>NombreAlbum</th> <th>Descripcion</th>  ';
                    // echo '</tr>';
            $info=0;
            // Recorre el resultado y lo muestra en forma de tabla HTML
            while($fila = $resultado->fetch_assoc()) {
                if(albumVACIO()<1){
                    echo albumVACIO();
                    echo "NO HAY FOTOS EN EL ÁLBUM";

                }
                else{
                    if($fila['NomPais']=="_"){
                        $ubi="SIN UBICACIÓN";
                        // echo "SIN UBICACION";
                    }else{
                        $ubi=$fila['NomPais'];
                    }
                    echo  "
                        <div class='imagind'>
                        <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='Fotografia' width='300'></a>
                            <p class='datos'>". $fila['Titulo'] ."</p>
                            <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                            <p class='datos'> <span class='icon-location-1'></span>". $ubi."</p>
                            
                        </div>";

                        // echo '<tr>';
                        // echo '<td>' . $fila['IdFoto'] . '</td>';
                        // echo '<td>' . $fila['Pais'] . '</td>';
                        // echo '<td>' . $fila['NomPais'] . '</td>';

                        // echo '<td>' . $fila['Titulo'] . '</td>';
                        // echo '<td>' . $fila['Fecha'] . '</td>';
                        // echo '<td>' . $fila['Fichero'] . '</td>';
                        // echo '<td>' . $fila['Alternativo'] . '</td>';
                        // echo '<td>' . $fila['Album'] . '</td>';
                        // echo '<td>' . $fila['NombreAlbum'] . '</td>';
                        // echo '<td>' . $fila['Descripcion'] . '</td>';
                        // echo '</tr>';
            
                }
            }
            
            // echo '</table>';
            // Libera la memoria ocupada por el resultado
            $resultado->close();
            // Cierra la conexión
            $mysqli->close();
        }
    


    function intervalo(){
        $id=$_GET['id'];
        $fotillo=1;
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
        $sentencia = 'select DATEDIFF((SELECT MAX(f.Fecha) FROM fotos f join albumes a on (Album=IdAlbum)  where Album='.$id.'),  
            (SELECT MIN(f.Fecha) FROM fotos f join albumes a on (Album=IdAlbum)  where Album='.$id.'))  diferencia FROM fotos f join albumes a on (Album=IdAlbum) where Album='.$id ;

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
            // echo '<table><tr>';
            // echo '<th>dIFERENCIA</th>  ';
            // echo '</tr>';
        echo "<p class='datos'>";
        $info=0;
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc()) {

            if($info<1){
                    echo "<span class='icon-calendar'></span> Hay un intevalo de " . $fila['diferencia']." dias entre la foto de fecha más antigua y la de más reciente";
                    // echo '<tr>';
                    // echo '<td>' . $fila['diferencia'] . '</td>';
                    // echo '</tr>';
                $info+=1;
            }

        }
        echo "</p>";
            // echo '</table>';
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }
    
    ?>

<main>
    <div class='contenedorRESULTADO'>
        
        <?php 
        sacaDATOS();
        intervalo();?>


    </div>
    <?php sacaFOTOs();
    ?>
</main>

<?php require_once("pie.php"); ?>
