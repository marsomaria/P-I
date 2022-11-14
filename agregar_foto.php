<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Añadir foto";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<?php  
     $tit=$_GET['album'];
    // $tit=$_POST['album'];
    // echo $tit;
?>

<main>
        <form action="agregar_foto_respuesta.php" enctype="multipart/form-data" method="post"  class="formulario">
            <fieldset>
                <legend>Formulario para añadir</legend>
                <p class="rellena" style ="color:var(--acento);">Rellene este formulario para poder añadir una foto al álbum que desee</p>
                <p class="rellena" style ="color:var(--acento);">
                    * Campos obligatorios
                </p>

                <p class="rellena">
                    <label class="campo" for="titulo">Título de la foto(*):</label>
                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar

                        </span>
                        <input class="caja" type="text" id="titulo" name="titulo">
                    </div>
                    
                    
                    
                </p>

                <p class="rellena">
                    <label class="campo" for="desc">Descripción:</label>
                    <textarea class="caja" id="desc" name="desc" rows="2"></textarea>
                </p>

                <p class="rellena">
                    <label class="campo" for="fecha">Fecha:</label>
                    <input class="caja" type="date" id="fecha" name="fecha">
                </p>
      
                <p class="rellena">
                    <label class="campo" for="pais">País:</label>
                    <select class="caja" id="pais" name="pais" >
                        <option value="_"></option>
                        <?php
                            $sentencia = 'SELECT * FROM paises';
                            $resultado = peticionPIBD($sentencia);

                            // Recorre el resultado y lo muestra en forma de tabla HTML
                            while($fila = $resultado->fetch_assoc()) {
                                echo '<option >'. $fila['NomPais'].'</option>';
                            }
                        ?>

                    </select>
                </p>
                <p class="rellena">
                    <label class="campo" for="foto">Foto: (*)</label>
                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar</span>
                        <input type="file" name="fichero"></input>
                        <!-- <input class="caja" type="file" id="foto" name="fichero"> -->
                    </div>



                </p>

                <p class="rellena">
                    <label class="campo" for="textAlt">Texto alternativo:</label>(*)
                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar. Longitud mínima de 10 caracteres y que no empiece por un texto redundante como “foto” o “imagen”</span>
                        <input class="caja" id="textAlt" name="textAlt"></input>
                    </div>
                    
                    
                    
                </p>

                <p class="rellena"> 
                    <label class="campo" for="album">Álbum:(*)</label>
                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar

                        </span>
                        <select class="caja" name="album" id="album">
                            <option value="-"></option>
                        <?php   //Para mostrar los otros albumes del usuario
                            echo $_GET["album"];
                            //$IDALBUM=0;
                            $mysqli = @new mysqli(
                                    'localhost', // El servidor
                                    'root', // El usuario
                                    '', // La contraseña
                                    'pibd'); // La base de datos
                            if($mysqli->connect_error) {
                                echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
                                echo '</p>';
                                exit;
                            }
                            if($tit!=""){
                                $sentencia = 'SELECT albumes.Titulo, albumes.IdAlbum From albumes Where albumes.Usuario = ' .  $_SESSION['idUsuario'] ; //and albumes.Titulo ="'.$tit.'"
                            }else{
                                $sentencia = 'SELECT albumes.Titulo, albumes.IdAlbum From albumes Where albumes.Usuario = ' .  $_SESSION['idUsuario'];
                            }
                                
                            if(!($resultado = $mysqli->query($sentencia))) {
                                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                                echo '</p>';
                                exit;
                            }
                            // $_SESSION['idalbumfoto']=0;
                            while($fila = $resultado->fetch_assoc()) {
                                // $IDALBUM= $fila['IdAlbum'];
                                // echo $IDALBUM;
                                // $_SESSION['idalbumfoto']=$IDALBUM;
                                if($tit==$fila['Titulo']){
                                    echo '<option selected>'. $fila['Titulo'].'</option>';
                                }else{
                                    echo '<option >'. $fila['Titulo'].'</option>';
                                }
                                
                            }
                            
                            $resultado->close();
                            $mysqli->close();
                        ?>

                    </select>                    
                    </div>
                </p>

                <input type="submit" class="boton" value="Agregar foto">

            </fieldset>
        </form>
    </main>
<?php require_once("pie.php"); ?>