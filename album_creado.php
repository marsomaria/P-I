<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Craer Álbum";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>
    

<?php
    $veces=0;
    $album=0;
    // SELECT count(*) esenombre FROM `albumes` WHERE Titulo LIKE "mar" and Usuario=10
    $creado=false;
    
    function YAexiste(){
        $creado=false;

        $tit=$_SESSION['nuevoTITULOa'];
        $yo= $_SESSION['idUsuario'];
            /*
            // Conecta con el servidor de MySQL
            $mysqli = @new mysqli(
                'localhost', // El servidor
                'root', // El usuario
                '', // La contraseña
                'pibs'); // La base de datos
        if($mysqli->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }

        $sentencia = 'SELECT count(*) esenombre FROM `albumes` WHERE Titulo LIKE "'.$tit.'" and Usuario='.$yo.'';
        
        // Ejecuta la sentencia SQL
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
                
            }

            while($fila = $resultado->fetch_assoc() ) {
                if($fila['esenombre']==1){
                    $creado=true;
                    $veces=1;
                }
            }
        
        
        
        // Cierra la conexión
        $mysqli->close();
        */

        $sentencia = 'SELECT count(*) esenombre FROM `albumes` WHERE Titulo LIKE "'.$tit.'" and Usuario='.$yo.'';
        $resultado = peticionPIBD($sentencia);
        
        while($fila = $resultado->fetch_assoc() ) {
            if($fila['esenombre']==1){
                $creado=true;
                $veces=1;
            }
        }

        return $creado;
    }

   
    $titulo=$_POST['titulo'];
    
    function subeALBUM(){
       
            $usu=$_SESSION['idUsuario'];
            $titulo=$_POST['titulo'];
            $desc=$_POST['descripcion'];
            $_SESSION['nuevoTITULOa']=$_POST['titulo'];
            $_SESSION['nuevoaDESCRa']=$desc;
            
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

            $sentencia = "INSERT INTO albumes (IdAlbum,Titulo, Descripcion, Usuario) 
                                        VALUES (null, '$titulo' , '$desc', $usu ) ";
            $veces=0;
        
            if(YAexiste()){
                echo "ya existe ese album";
                echo '<p><button class="boton" onclick="window.location.href=`nuevo_album.php`;"  >crear otro</button>';
                echo '<button class="boton" onclick="window.location.href=`agregar_foto.php?album='.$titulo.'`;"  >Subir fotos</button></p>';
            }else{
                // Ejecuta la sentencia SQL
            
                if(!($resultado = $mysqli->query($sentencia))) {
                    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                    echo '</p>';
                    exit;
                }
                // require_once("datos_registro.php"); 
                // echo 'Se ha insertado un nuevo libro en la base de datos. ';
                $direccionFOTO = '$titulo';
            
                // require_once("creadoALBUM.php"); 

                echo '<h1>ÁLBUM CREADO</h1>';
                echo '<div>
                            <p>Nombre álbum: <b>';echo $_POST["titulo"]; echo '</b></p>

                            <p>Descripción: <b>'; echo $_POST["descripcion"]; echo'</b> </p>';
                    echo '<button class="boton" onclick="window.location.href=`agregar_foto.php?album='.$_SESSION['nuevoTITULOa'].'`;"  >SUBIR FOTOS</button>';
                    // onclick="window.location.href=`agregar_foto.php?album='.$titulo.'`;"
                    
                echo "</div>";
                


            }
            // Cierra la conexión
            $mysqli->close();
        
    }
    // $direccionFOTO = "agregar_foto.php?album="+ $titulo;
    // echo $direccionFOTO;
?>

<main class="contenedor2">

    <?php 
    
   if($_POST['titulo']==""){
    header('Location: nuevo_album.php');
   }else{
    subeALBUM();
   }
        
        
        ?>
</main>

<?php require_once("pie.php"); ?>

