<section>
    <div class='left'>
        
        <?php
        if($lineas = file("ficheros/fotos_dia.txt"))
        {
            $pos = mt_rand(0, sizeof($lineas) - 1);
            
            if(($linea = explode(';',$lineas[$pos])) && sizeof($linea) == 3){
                $idFoto = $linea[0];
                $critico = $linea[1];
                $reseña = $linea[2];

                $sentencia = 'SELECT *, DATE_FORMAT(Fecha,"%d/%m/%Y")fechaDMY FROM fotos join paises on Pais=IdPais WHERE IdFoto = ' . $idFoto . '';
                if ($resultado = peticionPIBD($sentencia)) 
                {
                    while ($fila = $resultado->fetch_assoc())
                    {
                        if ($fila['NomPais'] == "_") {
                            $ubi = "SIN UBICACIÓN";
                            // echo "SIN UBICACION";
                        } 
                        else 
                        {
                            $ubi = $fila['NomPais'];
                        }
                        if($reg == true)
                        {
                            echo  "
                            <div class='imagdia'>
                            <b>Foto del día:</b><br>
                            <a href='foto.php?id=" . $fila['IdFoto'] . "'><img src='./imgs/" . $fila['Fichero'] . "' 'alt='" . $fila['Alternativo'] . "' width='300'></a>
                                <p class='datos'>" . $fila['Titulo'] . "</p>
                                <p class='datos'> <span class='icon-calendar'></span>" . $fila['fechaDMY'] . "</p>
                                <p class='datos'> <span class='icon-location-1'></span>" . $ubi . "</p>
                                <p class='datos'>" . $critico . "</p>
                                <p class='datos'>" . $reseña . "</p>
                            </div>";
                        }
                        else
                        {
                            echo  "
                            <div class='imagdia'>
                            <b>Foto del día:</b><br>
                            <a href='error.php'><img src='./imgs/" . $fila['Fichero'] . "' 'alt='" . $fila['Alternativo'] . "' width='300'></a>
                                <p class='datos'>" . $fila['Titulo'] . "</p>
                                <p class='datos'> <span class='icon-calendar'></span>" . $fila['fechaDMY'] . "</p>
                                <p class='datos'> <span class='icon-location-1'></span>" . $ubi . "</p>
                                <p class='datos'>" . $critico . "</p>
                                <p class='datos'>" . $reseña . "</p>
                            </div>";
                        }
                    }
                }
            }
            else
            {
                echo "Vaya, no se ha podido obtener la foto del día.<br>";
            }
        }
        else
        {
            echo "Vaya, no se ha podido obtener la foto del día.<br>";
        }
        ?>
    </div>