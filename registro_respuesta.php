<?php require_once("acceso_solo_no_registrados.php"); ?>

<?php $title = "Nuevo usuario";
require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>
    
<?php

$existe=false;
$contador=0;
$si=false;
    function siEXISTO(){
        if(file_exists("./imgs/usuarios/" . $_FILES["fichero"]["name"])){
            $si=true;
            $contador=$_SESSION['contadorUSU'] +1;
                                        $_SESSION['contadorUSU']=$contador;
        }
        return $si;
    }
    function cambiaNOMBRE(){
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
                           
                            // $contador=$_SESSION['contadorUSU'] +1;
                            if(file_exists("./imgs/usuarios/" . $_FILES["fichero"]["name"])){
                                echo "sigo existiendo";
                                $contador=$_SESSION['contadorUSU'] +3;
                                $_SESSION['contadorUSU']=$contador;
                                if(file_exists("./imgs/usuarios/" . $_FILES["fichero"]["name"])){
                                    $contador=$_SESSION['contadorUSU'] +4;
                                    $_SESSION['contadorUSU']=$contador;
                                    if(siEXISTO()){
                                        $contador=$_SESSION['contadorUSU'] +1;
                                        $_SESSION['contadorUSU']=$contador;
                                    }
                                }
                            }else{
                                $contador=$_SESSION['contadorUSU'] +1;
                                $_SESSION['contadorUSU']=$contador;
                            }

                                // echo "Tamaño: " . ceil($_FILES["fichero"]["size"] / 1024) . " Kb<br />";
                            
                               
                                $_SESSION['contadorUSU']=$contador;
                                 echo $_SESSION['contadorUSU'];
                                $nuevoNOMBRE=explode(".",$_FILES["fichero"]["name"]);
                                $tipof=explode("/", $_FILES["fichero"]["type"]);
                                $foto=$nuevoNOMBRE[0].'('.$contador.').'.$tipof[1];
                                $_SESSION['fotousuario']=$foto;
                                move_uploaded_file($_FILES["fichero"]["tmp_name"],
                                                    "./imgs/usuarios/" . $foto);
                                echo "Almacenado en: " . "./imgs/usuarios/" . $foto;
                                echo "<p><b>NUEVO NOMBRE FOTO PERFIL: ".$foto."</b></p>";
                        }
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
                                                "./imgs/usuarios/" . $foto);
                            echo "Almacenado en: " . "./imgs/usuarios/" . $foto;
                            echo "<p><b>NUEVO NOMBRE FOTO PERFIL: ".$foto."</b></p>";
                        }
    }

    function existeESAFOTOP(){
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

        $sentencia = 'SELECT count(*)estoy FROM usuarios where Foto like "'.$_FILES["fichero"]["name"]. '"';
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
    
    $_SESSION['contadorUSU']=0;
    function esticyaperfil(){
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

        $sentencia = 'SELECT count(*)estoy FROM usuarios where Foto like "'.$_FILES["fichero"]["name"]. '"';
        $veces=0;

            // Ejecuta la sentencia SQL
        
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            while($fila = $resultado->fetch_assoc()){
                if($fila['estoy']>=1){
                    echo "YA EXISTE UN USUARIO CON ESE NOMBRE DE FOTO, TE LO CAMBIO<br>";
                    
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
                            // echo "Tipo: " . $_FILES["fichero"]["type"] . "<br />";
                            echo "Tamaño: " . ceil($_FILES["fichero"]["size"] / 1024) . " Kb<br />";
                            // echo "Nombre temporal: " . $_FILES["fichero"]["tmp_name"] . "<br />";
                            if(file_exists("./imgs/usuarios/" . $_FILES["fichero"]["name"])){
                                $contador=$_SESSION['contadorUSU']+1;
                                $_SESSION['contadorUSU']=$contador;
                                cambiaNOMBREunix();
                            
                                // echo $_FILES["fichero"]["name"] . " ya existe<br>";
                                // $nuevoNOMBRE=$_FILES["fichero"]["name"].'_usu_'.$_POST['email'];
                                // move_uploaded_file($_FILES["fichero"]["tmp_name"],
                                // "./imgs/usuarios/" . $nuevoNOMBRE);
                            } else{
                                $contador=$_SESSION['contadorUSU'] +1;
                                $_SESSION['contadorUSU']=$contador;
                                 echo $_SESSION['contadorUSU'];
                                $nuevoNOMBRE=explode(".",$_FILES["fichero"]["name"]);
                                // $ne=explode(".",$_POST['email']);
                                $tipof=explode("/", $_FILES["fichero"]["type"]);
                                $foto=$nuevoNOMBRE[0].'('.$contador.').'.$tipof[1];
                                $_SESSION['fotousuario']=$foto;
                                // echo $foto;
                                move_uploaded_file($_FILES["fichero"]["tmp_name"],
                                                    "./imgs/usuarios/" . $foto);
                                echo "Almacenado en: " . "./imgs/usuarios/" . $foto;
                                echo "<p><b>NUEVO NOMBRE FOTO PERFIL: ".$foto."</b></p>";

                            }

                            $estoySUBIDA=1;
                        }
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
                            if(file_exists("./imgs/usuarios/" . $_FILES["fichero"]["name"])){
                                $_SESSION['fotousuario']=$_FILES["fichero"]["name"];
                                echo $_FILES["fichero"]["name"] . " ya existe en la carpeta ./imgs/usuarios/ no hace falta que lo suba otra vez<br>";
                                
                            } else{
                                $_SESSION['fotousuario']=$_FILES["fichero"]["name"];
                                move_uploaded_file($_FILES["fichero"]["tmp_name"],
                                                    "./imgs/usuarios/" . $_FILES["fichero"]["name"]);
                                echo "Almacenado en: " . "./imgs/usuarios/" . $_FILES["fichero"]["name"];
                            }

                            $estoySUBIDA=1;
                        }
                }
            }
     
        // Cierra la conexión
        $mysqli->close();

        
    }

function realizarValidaciones()
{
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $contra = $_POST['contra'];
    $contrarep = $_POST['contrarep'];
    //$contra = filter_var($_POST['contra'], FILTER_SANITIZE_STRING);
    //$contrarep = filter_var($_POST['contrarep'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $sexo = filter_var($_POST['sexo'], FILTER_SANITIZE_NUMBER_INT);
    $fecha = $_POST['fecha'];
    $ciudad = filter_var($_POST['ciudad'], FILTER_SANITIZE_STRING);
    $pais = filter_var($_POST['pais'], FILTER_SANITIZE_STRING);
    $foto = $_FILES["fichero"]["name"];

    if (!empty($nombre) && !empty($contra) && !empty($contrarep) && !empty($email) && !empty($fecha)) {
        //__________Comprobacion Nombre
        $error_nombre = false;
        if (!preg_match_all('#^[a-zA-Z]+[a-zA-Z0-9]{2,13}#', $nombre)) {
            $error_nombre = true;
            echo $nombre . " no es un nombre válido<br>";
        } else {
            echo "Nombre: <b>" . $nombre . "</b><br>";
        }

        $array = str_split($contra);
        $error_contra = false;

        $mayus = false;
        $minus = false;
        $num = false;

        if (sizeof($array) >= 6 && sizeof($array) <= 15) {

            for ($n = 0; $n < sizeof($array); $n++) {
                if (
                    !(
                        ($array[$n] >= 'a' && $array[$n] <= 'z')
                        ||
                        ($array[$n] >= 'A' && $array[$n] <= 'Z')
                        ||
                        ($array[$n] >= '0' && $array[$n] <= '9')
                        ||
                        $array[$n] == '-'
                        ||
                        $array[$n] == '_')
                ) {
                    $error_contra = true;
                    break;
                } else if ($array[$n] >= 'a' && $array[$n] <= 'z') {
                    $minus = true;
                } else if ($array[$n] >= 'A' && $array[$n] <= 'Z') {
                    $mayus = true;
                } else if ($array[$n] >= '0' && $array[$n] <= '9') {
                    $num = true;
                }
            }

            if ($minus == false && $mayus == false && $num == false) {
                $error_contra = true;
            }
        } else {
            $error_contra = true;
        }

        if ($error_contra == true) {
            echo "No has introducido una contraseña válida<br>";
        }

        //_____________Comprobacion Contrarep
        $error_contrarep = false;
        if (strcmp($contra, $contrarep) != 0) {
            echo "<b style='color:var(--acento);'>Las contraseñas no coinciden</b><br>";
            $error_contrarep = true;
        } else {
            echo "Las contraseñas coinciden<br>";
            //echo "Contra: <b>" . $contra . "</b><br>";
        }

        //_____________Comprobacion Correo
        $error_correo = false;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_correo = true;
            echo $email . " no es una dirección de correo válida<br>";
        } else {
            echo "Correo: <b>" . $email . "</b><br>";
        }

        //_____________Comprobacion Sexo
        $error_sexo = false;
        if ($sexo < 1 && $sexo > 3) {
            $error_sexo = true;
            echo "Debes seleccionar un género<br>";
        } else {
            $genero = '';
            switch ($sexo) {
                case 1:
                    $genero = 'Otro';
                    break;
                case 2:
                    $genero = 'Hombre';
                    break;
                case 3:
                    $genero = 'Mujer';
                    break;
            }
            echo "Género: <b>" . $genero . "</b><br>";
        }


        //_____________Comprobacion Nacimiento
        $error_nacimiento = false;
        
        $fecha_nacimiento = date_parse_from_format("Y/m/d", $fecha);
        $presente = date("Y/m/d");

        if (!checkdate($fecha_nacimiento['day'], $fecha_nacimiento['month'], $fecha_nacimiento['year']) || strtotime($fecha) >= strtotime($presente)) {
            $error_nacimiento = true;
            echo $fecha . " no es una fecha de nacimiento válida<br>";
        } else {
            echo "Fecha de nacimiento: <b>" . $fecha . "</b><br>";
        }
        if($foto==""){
            $_SESSION['fotousuario']="vacio.jpg";
            $foto="vacio.jpg";
            echo "Foto de perfil: <b>SIN FOTO</b><br>";
            echo '<img src="">';
        }else{
            // $foto=$_POST['fichero'];
            // if(existeESAFOTOP()){
            //     echo "YA EXISTE UNA FOTO CON ESE NOMBRE, ELIGE OTRA O CAMBIAEL NOMBRE";
            // }else{
                echo "Foto de perfil: <b>".$_FILES["fichero"]["name"]."</b><br>";
                esticyaperfil();
                
            // }
               
        }

        if ($error_nombre == false && $error_contra == false && $error_contrarep == false && $error_correo == false && $error_sexo == false && $error_nacimiento == false) {
            //$contra64 = base64_encode($contra);
            //$sentencia = "INSERT INTO usuarios (IdUsuario,NomUsuario,Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro, Estilo) 
            //                              VALUES (null, '$nombre' , TO_BASE64('".$contra."'), '$email', $sexo, '$fecha','$ciudad', $pais, '$foto', CURRENT_TIMESTAMP, 6)";

            $sentencia = 'INSERT INTO usuarios (IdUsuario,NomUsuario,Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro, Estilo) 
                  VALUES (null, "' . $nombre . '" , TO_BASE64("' . $contra . '"), "' . $email . '",' . $sexo . ', "' . $fecha . '","' . $ciudad . '",  ' . $pais . ', "' . $_SESSION['fotousuario'] . '", CURRENT_TIMESTAMP, 6)';
            
            //$resultado = 
            peticionPIBD($sentencia);
            echo "<p class='datos' style='color:var(--oscuro);'><b>Enhorabuena " . $nombre . ", te has registrado como usuario de Pictures & Images</b></p>";
            echo "<p class='datos'>
                        <a href='login.php' id='notengo'>Inicia sesión</a>
                      </p>";
        }
    } else {
        header("Location: registro.php");
    }
}
?>

<main class="contenedor2">

    <div>
        <?php
        realizarValidaciones();
        // esticyaperfil();
        ?>
    </div>
</main>

<?php require_once("pie.php"); ?>