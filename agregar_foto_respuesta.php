<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Foto agregada";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<?php
    $altvalido=false;
    function altVALIDO(){
        if($_POST['textAlt']!="" && !empty($_POST['textAlt'])){
            tamanyo();
            $altP= $_POST['textAlt'];
            // echo $altP.length();
            if(preg_match("/^foto/i", $altP)  || preg_match("/^imagen/i", $altP)){
                
                    // echo "empieza por foto o imagen";
                    $altvalido=false;
                    if (strlen ( $_POST['textAlt'] ) <10){
                        // echo "menor de 10 caracteres";
                        $altvalido=false;
                    }
            }else{
                // echo "no empieza por foto ni imagen y es mayor de 10";
                $altvalido=true;
            }
        }

        // echo $altvalido;
        
        return $altvalido;
    }

    function tamanyo(){
        $tm=strlen ( $_POST['textAlt'] ) ;
        // echo strlen ( $_POST['textAlt'] ) ;
        return $tm;
    }


    function sacaIdALbum(){
            $al=$_POST['album'];
            // echo $al;
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

        $sentencia = 'SELECT * FROM albumes where Titulo like "'.$al.'" ';
        $albumid=0;

            // Ejecuta la sentencia SQL
        
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            while($fila = $resultado->fetch_assoc()) {
                $albumid= $fila['IdAlbum'];
                // echo  $fila['IdAlbum'];
            }
        
        
        // Cierra la conexión
        $mysqli->close();
        return $albumid;
    }

    function sacaIdPais(){
            $pa=$_POST['pais'];
            // echo $al;
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

        $sentencia = 'SELECT * FROM paises where NomPais like "'.$pa.'" ';
        $paisid=0;

            // Ejecuta la sentencia SQL
        
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            while($fila = $resultado->fetch_assoc()) {
                $paisid= $fila['IdPais'];
                // echo  $fila['IdAlbum'];
            }
        
        
        // Cierra la conexión
        $mysqli->close();
        return $paisid;
    }

    function subeFOTO(){

            // $idA= $_SESSION['idalbumfoto'];
       
       
            $usu=$_SESSION['idUsuario'];


            $titulo=$_POST['titulo']; //text

            if($_POST['desc']==""){
                $descripcion="-"; //teext
            }else{
                $descripcion=$_POST['desc']; //teext
            }

            
            $fecha=$_POST['fecha']; //date
            
            if($_POST['pais']=="_"){
                $pais = 0;
            }else{
                $pais = sacaIdPais();// int
            }
            $album=sacaIdAlbum();
            
            
            
            $alt=$_POST['textAlt'];//text
           
                $foto =  $_FILES["fichero"]["name"]; // int



            
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

            $sentencia = "INSERT INTO fotos (IdFoto,Titulo, Descripcion, Fecha, Pais, Album, Fichero, Alternativo, FRegistro) 
                                        VALUES (null, '$titulo' , '$descripcion', '$fecha', $pais, $album, $foto, '$alt' ,CURRENT_TIMESTAMP) ";
            
                // Ejecuta la sentencia SQL
            
                if(!($resultado = $mysqli->query($sentencia))) {
                    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                    echo '</p>';
                    exit;
                }
                
                $direccionFOTO = '$titulo';
            
               
            // Cierra la conexión
            $mysqli->close();
        
    
    }

    function subeFOTOotro(){

        $usu=$_SESSION['idUsuario'];

        $titulo=$_POST['titulo']; //text

        if($_POST['desc']==""){
            $descripcion="-"; //teext
        }else{
            $descripcion=$_POST['desc']; //teext
        }

        $fecha=$_POST['fecha']; //date
        
        if($_POST['pais']=="_"){
            $pais = 0;
        }else{
            $pais = sacaIdPais();// int
        }
        $album=sacaIdAlbum();
        
        
        
        $alt=$_POST['textAlt'];//text
        
        $foto = $_SESSION['fotousuario']; // int
            

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

        $sentencia = "INSERT INTO fotos (IdFoto,Titulo, Descripcion, Fecha, Pais, Album, Fichero, Alternativo, FRegistro) 
                                    VALUES (null, '$titulo' , '$descripcion', '$fecha', $pais, $album, '$foto', '$alt' ,CURRENT_TIMESTAMP) ";
    
            // Ejecuta la sentencia SQL
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }

            // echo 'Se ha insertado un nuevo libro en la base de datos. ';
            $direccionFOTO = '$titulo';

        // Cierra la conexión
        $mysqli->close();
    

}

    function cambiaNOMBREunix(){
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
                           
                            $hoy = getdate();
    
                            // $_SESSION['contadorUSU']=$contador;
                            //  echo $_SESSION['contadorUSU'];
                            $nuevoNOMBRE=explode(".",$_FILES["fichero"]["name"]);
                            $tipof=explode("/", $_FILES["fichero"]["type"]);
                            $foto=$nuevoNOMBRE[0].'('.$hoy[0].').'.$tipof[1];
                            $_SESSION['fotousuario']=$foto;
                            move_uploaded_file($_FILES["fichero"]["tmp_name"],
                                                "./imgs/" . $foto);
                            echo "Almacenado en: " . "./imgs/" . $foto;
                            echo "<p><b>NUEVO NOMBRE FOTO PERFIL: ".$foto."</b></p>";
                            echo "<p><b>NUEVO NOMBRE FOTO PERFIL sesion: ". $_SESSION['fotousuario']."</b></p>";
                        }
    }

    $existe=false;
    function existeESAFOTO(){
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
                if($fila['estoy']>=1){
                    $existe=true;
                    // echo "YA ESTOY SUBIDA HUEVA";
                }else{
                    $existe=false;
                }
            }
     
        // Cierra la conexión
        $mysqli->close();
            // echo $existe;
        return $existe;
    }

    
    
?>

<main>


<?php 
 
         if(!empty($_POST['titulo']) && $_POST['album']!="-" &&  $_FILES["fichero"]["name"]!="" && $_POST['textAlt']!="" /*&& altVALIDO()*/){
            // subeFOTO();
            // sacaIdALbum();
            // require_once("datosFOTONUEVA.php");
            if (altVALIDO() && $_POST['textAlt']!="" ){
                // echo "ME VALEEEE";
                if(existeESAFOTO()){
                    // echo '<div class="contenedorERROR"> Ya hay una imagen llamada <p style="color:var(--error);">'.$_FILES["fichero"]["name"].'</p>
                    
                    //  </div>';
                     cambiaNOMBREunix();
                     subeFOTOotro();
                     require_once("datosFOTONUEVA.php");
                }else{
                    subeFOTO();
                    sacaIdALbum();
                    
                    require_once("datosFOTONUEVA.php");
                }
            }else{
                // echo "NO ME VALEEEEEE";
                header("Location:".$_SERVER['HTTP_REFERER']);
            }
         }else{
            header("Location:".$_SERVER['HTTP_REFERER']);
         }
                
        ?>
        
    </main>
<?php require_once("pie.php"); ?>