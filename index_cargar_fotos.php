<main class='flexbox-container'>
    <?php
    $tope = 0;
    $sentencia = 'SELECT *, DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on Pais=IdPais order by FRegistro desc'; //join paises join albumes where Pais==IdPais and Album==IdAlbum
    if ($resultado = peticionPIBD($sentencia)) {
        // Recorre el resultado y lo muestra en el body de HTML
        while (($fila = $resultado->fetch_assoc()) && $tope < 5)    //si la cantidad de fotos que hay es menor que 5-> para que solo saque 5
        {
            if ($fila['NomPais'] == "_") {
                $ubi = "SIN UBICACIÓN";
            } else {
                $ubi = $fila['NomPais'];
            }

            if ($reg == true) {
                if (!preg_match_all('#[1-9]+#', $fila['fechaDMY'])) {
                    echo  "
                    <div class='imagind'>
                    <a href='foto.php?id=" . $fila['IdFoto'] . "'><img src='./imgs/" . $fila['Fichero'] . "' 'alt='" . $fila['Alternativo'] . "' width='300'></a>
                        <p class='datos'>" . $fila['Titulo'] . "</p>
                        <p class='datos'> <span class='icon-calendar'></span>Sin fecha</p>
                        <p class='datos'> <span class='icon-location-1'></span>" . $ubi . "</p>
                    </div>";
                } else {
                    echo  "
                    <div class='imagind'>
                    <a href='foto.php?id=" . $fila['IdFoto'] . "'><img src='./imgs/" . $fila['Fichero'] . "' 'alt='" . $fila['Alternativo'] . "' width='300'></a>
                        <p class='datos'>" . $fila['Titulo'] . "</p>
                        <p class='datos'> <span class='icon-calendar'></span>" . $fila['fechaDMY'] . "</p>
                        <p class='datos'> <span class='icon-location-1'></span>" . $ubi . "</p>
                    </div>";
                } 

            } else {
                if (!preg_match_all('#[1-9]+#', $fila['fechaDMY'])) {
                    echo  "
                    <div class='imagind'>
                    <a href='error.php'><img src='./imgs/" . $fila['Fichero'] . "' 'alt='" . $fila['Alternativo'] . "' width='300'></a>
                        <p class='datos'>" . $fila['Titulo'] . "</p>
                        <p class='datos'> <span class='icon-calendar'></span>Sin fecha</p>
                        <p class='datos'> <span class='icon-location-1'></span>" . $ubi . "</p>
                        
                    </div>";
                } else {
                    echo  "
                    <div class='imagind'>
                    <a href='error.php'><img src='./imgs/" . $fila['Fichero'] . "' 'alt='" . $fila['Alternativo'] . "' width='300'></a>
                        <p class='datos'>" . $fila['Titulo'] . "</p>
                        <p class='datos'> <span class='icon-calendar'></span>" . $fila['fechaDMY'] . "</p>
                        <p class='datos'> <span class='icon-location-1'></span>" . $ubi . "</p>
                        
                    </div>";
                } 

            }
            $tope += 1; //sumamos 1 a la cantidad de fotos
        }
    }
    ?>
</main>