<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Mis fotos";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<?php
        // Conecta con el servidor de MySQL
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

        // Ejecuta una sentencia SQL
        $sentencia = 'SELECT *, DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY, fotos.Titulo as NombreFoto FROM fotos join paises on Pais=IdPais join albumes on (Album=albumes.IdAlbum) where albumes.Usuario=' . $_SESSION['idUsuario'] . ' order by Fecha';
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        echo " <div class='contenedorInicio' style='margin-bottom:5%;margin-top:5%; padding:2%;height:20%;'>
                        <h1>TODAS MIS FOTOS</h1>
                    </div>";
        echo "<main class='flexbox-container'>";

            
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc() ) {
                $nomFoto= $fila["Titulo"];
                if($fila['NomPais']=="_"){
                    $ubi="SIN UBICACIÓN";
                    // echo "SIN UBICACION";
                }else{
                    $ubi=$fila['NomPais'];
                }
                if (!preg_match_all('#[1-9]+#', $fila['fechaDMY'])) {
                    echo  "<div class='imagind'>
                    <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila["Fichero"] ."'alt='".$fila["Alternativo"]."' width='300'></a>
                                <p class='datos'>" . $fila['NombreFoto'] . "</p>
                                <!--<p class='datos'> <span class='icon-info-circled-alt'></span>" . $fila['Descripcion'] . "</p>-->
                                <p class='datos'> <span class='icon-calendar'></span>Sin fecha</p>
                                <p class='datos'> <span class='icon-location-1'></span>". $ubi."</p>
                                <p class='datos'> <a href='album.php?id=".$fila['IdAlbum']."'><span class='icon-picture-1' style='color:var(--acento);'></span>". $fila["Titulo"] ."</a></p>
                                <!--<p class='datos'> <a href='perfilUSUARIO.php?id=".$_SESSION['idUsuario']."'><span class='icon-user' style='color:var(--acento);'></span>@".$_SESSION["usuario"]."</a></p>-->
                            </div>"; 
                } else {
                    echo  "<div class='imagind'>
                    <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila["Fichero"] ."'alt='".$fila["Alternativo"]."' width='300'></a>
                                <p class='datos'>" . $fila['NombreFoto'] . "</p>
                                <!--<p class='datos'> <span class='icon-info-circled-alt'></span>" . $fila['Descripcion'] . "</p>-->
                                <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                                <p class='datos'> <span class='icon-location-1'></span>". $ubi."</p>
                                <p class='datos'> <a href='album.php?id=".$fila['IdAlbum']."'><span class='icon-picture-1' style='color:var(--acento);'></span>". $fila["Titulo"] ."</a></p>
                                <!--<p class='datos'> <a href='perfilUSUARIO.php?id=".$_SESSION['idUsuario']."'><span class='icon-user' style='color:var(--acento);'></span>@".$_SESSION["usuario"]."</a></p>-->
                            </div>"; 
                }                
        }
    
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
        echo "</main>";
    ?>


<?php require_once("pie.php"); ?>