    <div class='right'>

        <div id="consejo">
            <p class="masconsejo">
                <?php
                // Lee el fichero en una variable,
                // y convierte su contenido a una estructura de datos

                if($str_datos = file_get_contents("ficheros/consejos.json"))
                {
                    $datos = json_decode($str_datos, true);

                    //echo "Longitud: " . count($datos["Consejos"]) . "<br>";
                    $tam = count($datos["Consejos"]); //calcula cuantos consejos hay
                    $pos = mt_rand(0, $tam - 1);  //genera un random entre 0 y la ultima posicion del ultimo consejo
                    //echo "Random: " . $pos . "<br>";
                    echo "<b>Consejo del día: </b>" . $datos["Consejos"][$pos]["Consejo"] . "<br>";
                }
                else
                {
                    echo "Vaya, no se han podido obtener los consejos del día.<br>";
                }
                ?>
            </p>
        </div>
    </div>
</section>