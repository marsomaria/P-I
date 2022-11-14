<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Álbum";
    require_once("cabeza.php"); ?>
<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<?php 
    $id=$_GET["id"];
    $info=0;
    $sentencia = 'SELECT f.IdFoto,f.Pais,p.NomPais, f.Titulo,f.Fecha, f.Fichero,f.Alternativo,f.Album ,a.Titulo, a.Descripcion FROM fotos f join albumes a on (Album=IdAlbum) join paises p on (f.Pais=p.IdPais) where Album=' . $id .' order by Fecha desc' ;

    $resultado = peticionPIBD($sentencia);
    // Recorre el resultado y lo muestra en forma de tabla HTML
    while($fila = $resultado->fetch_assoc()) {
        if($info<1){
            echo "<div class='contenedorRESULTADO'>
                        
            <p class='datos'> <span class='icon-picture-1'></span>".$fila["Titulo"]."</p>
            <p class='datos'> <span class='icon-info-circled-alt'></span>" . $fila['Descripcion'] . "</p>

            </div>";
            $info+=1;
        }                
    }
?>

<main>
    <?php 
        $id=$_GET["id"];
        $sentencia = 'SELECT  DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY,f.IdFoto,f.Pais,p.NomPais, f.Titulo,f.Fecha, f.Fichero,f.Alternativo,f.Album ,a.Titulo, a.Descripcion FROM fotos f join albumes a on (Album=IdAlbum) join paises p on (f.Pais=p.IdPais) where Album=' . $id .' order by f.Fecha ' ;
        $resultado = peticionPIBD($sentencia);

        echo "<fieldset class='todasf'>";
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc()) {
            if (!preg_match_all('#[1-9]+#', $fila['fechaDMY'])) {
                echo  "<div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila["Fichero"] ."'alt='".$fila["Alternativo"]."' width='300'></a>
                    <!--<p class='datos'>" . $fila['Titulo'] . "</p>-->
                    <p class='datos'> <span class='icon-calendar'></span>Sin fecha</p>
                <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>
                
                </div>";
            } else {
                echo  "<div class='imagind'>
                <a href='foto.php?id=".$fila['IdFoto']."'><img src='./imgs/" . $fila["Fichero"] ."'alt='".$fila["Alternativo"]."' width='300'></a>
                    <!--<p class='datos'>" . $fila['Titulo'] . "</p>-->
                    <p class='datos'> <span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>
                <p class='datos'> <span class='icon-location-1'></span>". $fila['NomPais'] ."</p>
                
                </div>";
            }
        }
        echo "</fieldset>";
    ?>
</main>


<?php require_once("pie.php"); ?>