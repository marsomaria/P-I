<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Resultados de búsqueda";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>


<?php $menu_usuario = "";
    require_once("navegador.php"); 
    
    if($_POST['fechaini']!=""){
        $arrINI = explode('-', $_POST["fechaini"]);
        $fechitaINI=$arrINI[2].'/'.$arrINI[1].'/'.$arrINI[0];
    }else{
        $fechitaINI=" ";
    }
    
    if($_POST['fechafin']!=""){
        $arrFIN = explode('-', $_POST["fechafin"]);
        $fechitaFIN=$arrFIN[2].'/'.$arrFIN[1].'/'.$arrFIN[0];
    }else{
        $fechitaFIN=" ";
    }
    

    ?>

<div class="contenedorRESULTADO">
    <p>Título: 
        <b> <?php echo $_POST["titulo"]; ?> </b>
    </p>

    <p> Fecha entre: 
        <b> <?php echo $fechitaINI; ?> </b>
        y 
        <b> <?php echo $fechitaFIN; ?> </b>
    </p>

    <p> País: 
        <b> <?php echo $_POST["pais"]; ?> </b>
    </p>
</div>



<?php 
    function vacio(){
        $camposVACIOS=false;
        if($_POST["titulo"]=="" && $_POST["fechaini"]=="" && $_POST["fechafin"]=="" && $_POST["pais"]=="_"){
            $camposVACIOS=True;
        }
        return $camposVACIOS;
    }

    function buscaVACIO(){
        echo "<main>
                <div class='contenedor2'>
                    <p>Debes llenar algún campo para buscar coincidencias</p>
                    <button class='botonResultado' onclick='window.location.href=`buscar_reg.php`;'>Realizar otra búsqueda</button>
                </div>
            </main>";
    }
    function SINRESULTADO(){
        echo "
                <div class='contenedor2'>
                    <p>No se han encotrado coincidencias</p>
                    <button class='botonResultado' onclick='window.location.href=`buscar_reg.php`;'>Realizar otra búsqueda</button>
                </div>
            ";
    }

    function buscaPAIS(){
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
        $sentencia = 'SELECT *, DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where NomPais="' . $_POST["pais"] .'" order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where NomPais="' . $_POST["pais"] .'" order by Fecha';

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        $fila2 = $resultado2->fetch_assoc();
        if($fila2['son'] == 0){
            SINRESULTADO();
            
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>            
                </div>";

        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    function buscaTITULO(){
        
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
        $sentencia = 'SELECT *, DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Titulo like"%' . $_POST["titulo"] .'%" order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Titulo like"%' . $_POST["titulo"] .'%" order by Fecha';

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";

        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
               
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>
                    
                </div>";
                
            
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();

    }

    function buscaENTRE(){
        
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
        $sentencia = 'SELECT *, DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha between "' . $_POST["fechaini"] .'"  and "' . $_POST["fechafin"] .'" order by Fecha ';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha between "' . $_POST["fechaini"] .'"  and "' . $_POST["fechafin"] .'" order by Fecha ';

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
                        
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) { 
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>
                    
                </div>";
                
            
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();

    }

    function buscaENTREPAIS(){
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha between "' . $_POST["fechaini"] .'"  and "' . $_POST["fechafin"] .'" and NomPais="' . $_POST["pais"] .'"  order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha between "' . $_POST["fechaini"] .'"  and "' . $_POST["fechafin"] .'" and NomPais="' . $_POST["pais"] .'"  order by Fecha';

        
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
            $fila2 = $resultado2->fetch_assoc();
            // echo "esta ".$fila2['son']."_";
            if($fila2['son'] == 0){
                SINRESULTADO();
                // echo "no encuentrp";
            }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            
            
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    function buscaDESDE(){
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha>"' . $_POST["fechaini"] .'" order by Fecha ';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha>"' . $_POST["fechaini"] .'" order by Fecha ';

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>    
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    
    function buscaDESDEPAIS(){
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha> "' . $_POST["fechaini"] .'"  and NomPais="' . $_POST["pais"] .'"  order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha> "' . $_POST["fechaini"] .'"  and NomPais="' . $_POST["pais"] .'"  order by Fecha';

      
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";

        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."  '><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    function buscaHASTA(){  
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha<="' . $_POST["fechafin"] .'" order by Fecha ';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha<="' . $_POST["fechafin"] .'" order by Fecha ';

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    function buscaHASTAPAIS(){
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha<= "' . $_POST["fechafin"] .'" and NomPais="' . $_POST["pais"] .'" order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha<= "' . $_POST["fechafin"] .'" and NomPais="' . $_POST["pais"] .'" order by Fecha';

      
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }

        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";

        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    function buscaTITULOPAIS(){
        $mysqli = @new mysqli(// Conecta con el servidor de MySQL
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where NomPais="' . $_POST["pais"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where NomPais="' . $_POST["pais"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';

      
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }
    function buscaTITULODESDE(){
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha>"' . $_POST["fechaini"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha>"' . $_POST["fechaini"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';

      
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }

        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    function buscaTITULOHASTA(){
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha<="' . $_POST["fechafin"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha<="' . $_POST["fechafin"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";

        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    function buscaTITULOENTRE(){
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha between "' . $_POST["fechaini"] .'"  and "' . $_POST["fechafin"] .'"  and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha between "' . $_POST["fechaini"] .'"  and "' . $_POST["fechafin"] .'"  and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';

      
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";

        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }


    function buscaTITULODESDEPAIS(){
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha>"' . $_POST["fechaini"] .'" and NomPais="' . $_POST["pais"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha>"' . $_POST["fechaini"] .'" and NomPais="' . $_POST["pais"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';

      
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    function buscaTITULOHASTAPAIS(){
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
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha<="' . $_POST["fechafin"] .'" and NomPais="' . $_POST["pais"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha<="' . $_POST["fechafin"] .'" and NomPais="' . $_POST["pais"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';

      
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }

        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
        
        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

    function buscaTODO(){
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
        // $sentencia = 'SELECT * FROM fotos join paises on (Pais=IdPais) where Fecha<="' . $_POST["fechafin"] .'" order by Fecha ';
        // $sentencia = 'SELECT * FROM fotos join paises on (Pais=IdPais) where Fecha between "2000-10-10"  and "2020-12-01" and NomPais="Francia" and Titulo like "%Monta%"  order by Fecha';
        $sentencia = 'SELECT *,DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on (Pais=IdPais) where Fecha between "' . $_POST["fechaini"] .'"  and "' . $_POST["fechafin"] .'" and NomPais="' . $_POST["pais"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';
        $sentencia2 = 'SELECT count(*) son FROM fotos join paises on (Pais=IdPais) where Fecha between "' . $_POST["fechaini"] .'"  and "' . $_POST["fechafin"] .'" and NomPais="' . $_POST["pais"] .'" and Titulo like "%' . $_POST["titulo"] .'%"  order by Fecha';

      
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        if(!($resultado2 = $mysqli->query($sentencia2))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // Recorre el resultado y lo muestra en forma de tabla HTML
        echo "<main class='flexbox-container'>";
        $fila2 = $resultado2->fetch_assoc();
        
        if($fila2['son'] == 0){
            SINRESULTADO();
           
        }
        // Recorre el resultado y lo muestra en el body de HTML
        while($fila = $resultado->fetch_assoc()) {
            //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5   
            echo  "
                <div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila['Fichero'] .   "' 'alt='".$fila['Alternativo']."' width='300'></a>
                    <p class='datos'>". $fila['Titulo'] ."</p>
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                    <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>                 
                </div>";
        }
        echo "</main>";
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }

?>


<?php

    if(vacio()){// SI TODOS LOS CAMPOS SON VACIOS
        // echo "campos vacios";
        buscaVACIO();
    }else{// SI HAY CAMPOS LLENOS O TODOS

            if($_POST["titulo"]!=""){//titulo llena
                if( $_POST["fechaini"]==""){//DESDE vacia
                    if($_POST["fechafin"]==""){//HASTA vacia
                        if($_POST["pais"]=="_"){//PAIS vacia
                            buscaTITULO();
                        }else{                  //PAIS llena
                            buscaTITULOPAIS();
                        }
                    }else{                  //HASTA llena
                        if($_POST["pais"]=="_"){ //PAIS vacia TITULO/HASTA llena
                            buscaTITULOHASTA();
                        }else{                     //TITULO/HASTA/PAIS llena
                            buscaTITULOHASTAPAIS();
                        }
                            
                    }
                }else{      //DESDE llena
                    if($_POST["fechafin"]==""){//HASTA vacia
                        if($_POST["pais"]=="_"){//PAIS vacia
                            buscaTITULODESDE();
                        }else{                  //PAIS/TITULO llena
                            buscaTITULODESDEPAIS();
                        }
                    }else{                  //HASTA llena
                        if($_POST["pais"]=="_"){ //TITULO/DESDE/HASTA llena
                            buscaTITULOENTRE();
                        }else{                     //TITULO/DESDE/HASTA/PAIS llena
                            buscaTODO();
                        }
                        
                        
                    }
                }
                
            }else{//TITULO vacia
                //&& $_POST["titulo"]==""
                if($_POST["fechaini"]!="" ){//DESDE llena
                    if($_POST["fechafin"]!=""){//HASTA llena
                        if($_POST["pais"]=="_"){//PAIS vacia
                            buscaENTRE();
                        }else{              //PAIS llena
                            buscaENTREPAIS();
                        }
                    }else{      //HASTA vacia
                        if($_POST["pais"]=="_"){ ///PAIS vacia
                            buscaDESDE();
                        }else{//PAIS llena
                            buscaDESDEPAIS();
                        }
                    }
                }else{ //DESDE vacia
                    if($_POST["fechafin"]!="" ){//HASTA llena
                        if($_POST["pais"]=="_"){//PAIS vacia
                            buscaHASTA();
                        }else{//PAIS llena
                            buscaHASTAPAIS();
                        }
                        
                    }else{//HASTA vacia
                        if($_POST["pais"]=="_"){//PAIS vacia
                            buscaVACIO();
                        }else{//PAIS llena
                            buscaPAIS();
                        }
                    }
                }
    
            }

            
        // }

    }

?>

<?php require_once("pie.php"); ?>