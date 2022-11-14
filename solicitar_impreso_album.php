<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Impresión de álbum";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<?php function generaTablaCostes() {
    $fil = 0;

     echo  "<table>
     <tbody><tr>
         <th></th>
         <th></th>
         <th colspan='2'>Blanco y negro</th>
         <th colspan='2'>Color</th>
     </tr>

     <tr>
         <th>Núm págs</th>
         <th>Núm fotos</th>
         <th>150-300 dpi</th>
         <th>450-900 dpi</th>
         <th>150-300 dpi</th>
         <th>450-900 dpi</th>
     </tr>";
     $coste = 0;
    for($fil = 0; $fil < 15; $fil ++){
        $pag = $fil + 1;
      
            if ($pag < 5) {
                $coste = $coste + 0.1;
            }
            else if ($pag >= 5 && $pag <= 11) {
                $coste = $coste + 0.08;
            }
            else {
                $coste = $coste + 0.07;
            }

            echo "<tr>";
            for ($col = 0; $col < 6; $col++) {
    
                switch ($col) {
                    case 0:
                        echo "<td>".$pag."</td>";
                        break;
                    case 1:
                        echo "<td>".$pag * 3 ."</td>";
                        break;
                    case 2:
                        $resultado = number_format($coste, '2', '.', '');
                        echo "<td>". $resultado ."</td>";
                        break;
                    case 3:
                        $resultado = number_format($coste + ($pag * 3 * 0.02), '2', '.', '');
                        echo "<td>". $resultado ."</td>";
                        break;
                    case 4:
                        $resultado = number_format($coste + ($pag * 3 * 0.05), '2', '.', '');
                        echo "<td>". $resultado ."</td>";
                        break;
                    case 5:
                        $resultado = number_format($coste + ($pag * 3 * 0.07), '2', '.', '');
                        echo "<td>". $resultado ."</td>";
                        break;
                    }
            }
            echo "</tr>";
        }


    echo "</tbody></table>";
}
?>


    <main>
        <form action="solicitar_impreso_album_respuesta.php" method="POST" class="formulario">
            <fieldset>
                <legend>Formulario de solicitud</legend>
                <p class="rellena">Rellene este formulario para poder imprimir el álbum que desee</p>
                <p class="rellena">
                    *Campos obligatorios
                </p>

                <table>
                    <tr>
                        <th>Concepto</th>
                        <th>Tarifa</th>
                    </tr>

                    <tr>
                        <td>Menos de 5 páginas</td>
                        <td>0.10€/pág</td>
                    </tr>

                    <tr>
                        <td>Entre 5 y 11 páginas</td>
                        <td>0.08€/pág</td>
                    </tr>

                    <tr>
                        <td>Más de 11 páginas</td>
                        <td>0.07€/pág</td>
                    </tr>

                    <tr>
                        <td>Blanco y negro</td>
                        <td>0€</td>
                    </tr>

                    <tr>
                        <td>A color</td>
                        <td>+0.05€/foto</td>
                    </tr>

                    <tr>
                        <td>+300 dpi</td>
                        <td>+0.02€/foto</td>
                    </tr>
                </table>

                <div id="tablaCostes" class="tcostes">
                    <?php
                        generaTablaCostes();
                    ?>
                </div>

                <p class="rellena">
                    <label class="campo" for="nombre">Nombre: </label>
                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar

                        </span>
                        <input class="caja" type="text" id="nombre" name="nombre" maxlength="100" > (*)
                    </div>


                </p>

                <p class="rellena">
                    <label class="campo" for="apellidos">Apellidos: </label>


                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar

                        </span>
                        <input class="caja" type="text" id="apellidos" name="apellidos" maxlength="100" > (*)
                    </div>
                </p>

                <p class="rellena">
                    <label class="campo" for="titulo">Titulo del álbum: </label>
                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar

                        </span>
                        <input class="caja" type="text" id="titulo" name="titulo" maxlength="200" > (*)
                    </div>


                </p>

                <p class="rellena">
                    <label class="campo" for="desc">Texto adicional: </label>
                    <textarea class="caja" id="desc" name="desc" rows="2" maxlength="4000"></textarea>
                </p>

                <p class="rellena">
                    <label class="campo" for="email">Correo electrónico: </label>
                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar

                        </span>
                        <input class="caja" type="email" id="email" name="email"> (*)
                    </div>



                </p>
                <span>Dirección</span>
                <label class="campo" for="calle">Calle:</label>(*)
                <input class="caja" type="text" id="calle" name="calle" placeholder="Calle" >
                <p class="rellena2">


                    <label class="campo2" for="numcalle">Número:</label>(*)
                    <input class="caja22" type="number" id="numcalle" name="numcalle" placeholder="Número" >
                    <label class="campo2" for="piso">Piso:</label>
                    <input class="caja22" type="number" id="piso" name="piso" placeholder="Piso" >
                    <label class="campo2" for="puerta">Puerta:</label>(*)
                    <input class="caja22" type="text" id="puerta" name="puerta" placeholder="Puerta" >
                    <label class="campo2" for="cp">Código postal:</label>
                    <input class="caja22" type="number" id="cp" name="cp" placeholder="CP" >
                    <label class="campo2" for="loc">Localidad:</label>(*)
                    <input class="caja2" type="text" id="loc" name="loc" placeholder="Localidad" >
                    <label class="campo2" for="prov">Provincia:</label>
                    <input class="caja2" type="text" id="prov" name="prov" placeholder="Provincia" >
                    <label class="campo2" for="pais">País:</label>
                    <input class="caja2" type="text" id="pais" name="pais" placeholder="País" > 
                </p>

                <p class="rellena2">
                    <label class="campo2" for="telf">Teléfono: </label>
                    <input class="caja2" type="tel" id="telf" name="telf">

                    <label class="campo2" for="portada">Color de portada: </label>
                    <input type="color" id="portada" name="portada">
                </p>

                <p class="rellena">

                </p>

                <p class="rellena2">
                    <label class="campo2" for="copias">Número de copias: </label>
                    <input class="caja22" type="number" id="copias" name="copias" min="1" value="1">

                    <label class="campo2" for="res">Resolución de impresión: </label>
                    <input class="caja2" type="number" id="res" name="res" step="150" min="150" max="900" value="150">


                </p>

                <!-- <p class="rellena">
                    </p> -->

                <p class="rellena">
                    <label class="campo" for="album">Álbum: </label>(*)

                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar

                        </span>
                            <select class="caja" name="album" id="album">
                                <option value="_"> </option>

                                <?php
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
                                    //$sentencia = 'SELECT albumes.Titulo From albumes Inner Join usuarios Where albumes.Usuario = usuarios.IdUsuario and usuarios.IdUsuario = ' .  $_SESSION['idUsuario'];
                                    $sentencia = 'SELECT albumes.Titulo From albumes Where albumes.Usuario = ' .  $_SESSION['idUsuario'];
                                    if(!($resultado = $mysqli->query($sentencia))) {
                                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                                        echo '</p>';
                                        exit;
                                    }
                                    
                                    // Recorre el resultado y lo muestra en forma de tabla HTML
                                    while($fila = $resultado->fetch_assoc()) {
                                        echo '<option>'. $fila['Titulo'].'</option>';
                                    }
                                    
                                    // Libera la memoria ocupada por el resultado
                                    $resultado->close();
                                    // Cierra la conexión
                                    $mysqli->close();
                                ?>

                            </select>
                    </div>
                </p>

                <p class="rellena">
                    <label class="campo" for="recep">Fecha recepción: </label>
                    <input class="caja" type="date" id="recep" name="recep">
                </p>

                <p class="rellena">
                    <label class="campo" for="blanconegro">Modo de impresión: </label>
                    <input type="radio" id="blanconegro" name="color" value="blancoYNegro" checked> Blanco/Negro
                    <input type="radio" id="color" name="color" value="aColor" > Color
                </p>

                <input type="submit" class="boton" value="Solicitar álbum">

            </fieldset>
        </form>
    </main>
<?php require_once("pie.php"); ?>