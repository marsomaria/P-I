<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Mis datos";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php");?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<?php 


    function datosUSU(){
        $iniciado=$_SESSION['usuario'];
        $NOMBREiniciado=$_SESSION['nombreUsuario'];

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
        $sentencia = 'SELECT *,DATE_FORMAT(FNacimiento,"%d/%m/%Y")fechaDMY, DATE_FORMAT(FRegistro,"%d/%m/%Y  %h:%m:%s ")fechaDMYHM FROM usuarios, paises p where Email="'.$iniciado.'" and  NomUsuario="'.$NOMBREiniciado.'" and Pais=p.IdPais';
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        // echo '<table><tr>';
        // echo '<th>IdUsuario</th><th>Título</th><th>Clave</th>';
        // echo '<th>Email</th> <th>Sexo</th> <th>FNacimiento</th>';
        // echo '<th>Ciudad</th> <th>Pais</th> <th>NomPais</th> <th>Foto</th> <th>FRegistro</th> <th>Estilo</th>';
        // echo '</tr>';

        echo "<fieldset class='formularioDATOS'>";
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc()) {
            echo "  <img src='./imgs/usuarios/". $fila['Foto'] ." 'alt=".$fila['NomUsuario']." width='100'>
                    <div class='datos'>
                        NOMBRE:<button class='cajaDATOS'>". $fila['NomUsuario'] ."</button>
                    </div>
                    <div class='datos'>
                        <span class='icon-key'></span>CLAVE: <button class='cajaDATOS'>". $fila['Contraseña'] ."</button>
                    </div>
                    <div class='datos'>
                        <span class='icon-mail'></span>EMAIL: <button class='cajaDATOS'>". $fila['Email'] ."</button>
                    </div>
            
            ";

            if($fila['Sexo']==1){
                echo "<div class='datos'>
                            <span class='icon-user-pair'></span>SEXO: <button class='cajaDATOS'>OTRO</button>
                        </div>";
            }else{
                if($fila['Sexo']==2){
                    echo "<div class='datos'>
                            <span class='icon-user-pair'></span>SEXO: <button class='cajaDATOS'>HOMBRE</button>
                        </div>";
                }else{
                    if($fila['Sexo']==3){
                        echo "<div class='datos'>
                            <span class='icon-user-pair'></span>SEXO: <button class='cajaDATOS'>MUJER</button>
                        </div>";
                    }
                }
            }
            echo "<div class='datos'>
                            <span class='icon-calendar'></span>CUMPLE:<button class='cajaDATOS'>". $fila['fechaDMY'] ."</button>
                        </div>";
            echo "<div class='datos'>
                        <span class='icon-map-pin'></span>CIUDAD:<button class='cajaDATOS'>". $fila['Ciudad'] ."</button>
                    </div>";  
            
            echo "<div class='datos'>
                        <span class='icon-location-1'></span>PAIS:<button class='cajaDATOS'>". $fila['NomPais'] ."</button>
                    </div>";
            
            echo "<div class='datos'>
                    <span class='icon-user-circle-o'></span>FOTO:<button class='cajaDATOS'>". $fila['Foto'] ."</button>
                </div>";
            echo "<div class='datos'>
                    <span class='icon-calendar'></span>REGISTRO:<button class='cajaDATOS'>". $fila['fechaDMYHM'] ."</button>
                </div>";
            
                    
                
            // echo '<tr>';
            //     echo '<td>' . $fila['IdUsuario'] . '</td>';
            //     echo '<td>' . $fila['NomUsuario'] . '</td>';
            //     echo '<td>' . $fila['Clave'] . '</td>';
            //     echo '<td>' . $fila['Email'] . '</td>';
            //     echo '<td>' . $fila['Sexo'] . '</td>';
            //     echo '<td>' . $fila['FNacimiento'] . '</td>';
            //     echo '<td>' . $fila['Ciudad'] . '</td>';
            //     echo '<td>' . $fila['Pais'] . '</td>';
            //     echo '<td>' . $fila['NomPais'] . '</td>';
            //     echo '<td>' . $fila['Foto'] . '</td>';
            //     echo '<td>' . $fila['FRegistro'] . '</td>';
            //     echo '<td>' . $fila['Estilo'] . '</td>';
            //     echo '</tr>';
        }
        echo "</fieldset>";
        // echo '</table>';
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    }
?>

<main>
    <?php 
        //datosUSU(); 
        $sentencia = 'SELECT *,DATE_FORMAT(FNacimiento,"%d/%m/%Y")fechaDMY, DATE_FORMAT(FRegistro,"%d/%m/%Y  %h:%m:%s ")fechaDMYHM FROM usuarios, paises p where IdUsuario="'.$_SESSION['idUsuario'].'" and Pais=p.IdPais';
        $resultado = peticionPIBD($sentencia);
        $fila = $resultado->fetch_assoc();        
    ?>
    <form action="mis_datos_respuesta.php" method="POST" class="formulario">
        <fieldset>
            <legend>Formulario de modificación</legend>

            <?php echo "<img src=./imgs/usuarios/" . $fila['Foto'] . " alt=" . $fila['NomUsuario'] ." width='100'>";?>
            <p class="rellena" style="color:var(--error);">
                *Campos obligatorios
            </p>

            <div class="rellena">
                <label class="campo">Nombre(*): </label>

                <div class="tooltip">
                    <span class="tooltiptext" id="info">
                        El nombre sólo puede contener letras del alfabeto inglés (en mayúsculas y minúsculas) y números; no puede comenzar con un número; longitud mínima 3 caracteres y máxima 15
                    </span>
                    <?php echo "<input class='caja' type='text' id='nombre' name='nombre' value='" . $fila['NomUsuario'] . "'>";?>    
                </div>
            </div>

            <div class="rellena">
                <label class="campo" for="contra">Contraseña(*): </label>
                <div class="tooltip">
                    <span class="tooltiptext">
                        La contraseña sólo puede contener letras del alfabeto inglés (en mayúsculas y minúsculas), números, el guion y el guion bajo (subrayado); al menos debe contener una letra en mayúscula, una letra en minúscula y un número; longitud mínima 6 caracteres y máxima 15.
                    </span>
                    <?php echo "<input class='caja' type='password' id='contra' name='contra' value='" . $fila['Clave'] . "'>";?>    
                </div>
            </div>

            <p class="rellena">
                <label class="campo" for="contrarep">Repita la contraseña(*): </label>
                <div class="tooltip">
                    <span class="tooltiptext">
                        Las contraseñas deben ser iguales
                    </span>
                    <!--<input class="caja"  type="password" id="contrarep" name="contrarep">-->
                    <?php echo "<input class='caja' type='password' id='contrarep' name='contrarep' value='" . $fila['Clave'] . "'>";?>    

                </div>
            </p>

            <p class="rellena">
                <label class="campo" for="email">Correo electrónico(*): </label>

                <div class="tooltip">
                    <?php echo "<input class='caja' type='email' id='email' name='email' value='" . $fila['Email'] . "'>";?>    
                </div>
                
            </p>

            <p class="rellena">
            <label class="campo" for="sexo">Género(*): </label>
                <div class="tooltip">
                    <select class="caja"  id="sexo" name="sexo" >
                        <?php echo "<option value=" . $fila['Sexo'] . " selected>Mantener igual</option>";?>  
                        <option value="2">Hombre</option>
                        <option value="3">Mujer</option>
                        <option value="1">Otro</option>
                    </select>
                </div>
            </p>

            <div class="rellena">
                <label class="campo" for="fecha">Fecha de nacimiento(*): </label>
                <?php echo "<input class='caja' type='date' id='fecha' name='fecha' value='" . $fila['FNacimiento'] . "'>";?>    

            </div>

            <p class="rellena">
                <label class="campo" for="ciudad">Ciudad de residencia: </label>
                <?php echo "<input class='caja' type='text' id='ciudad' name='ciudad' value='" . $fila['Ciudad'] . "'>";?>    
            </p>

            <p class="rellena">
                <label class="campo" for="pais">País de residencia:</label>
                <select class="caja" id="pais" name="pais" >
                        <?php
                            $sentencia = 'SELECT * FROM paises';
                            $resultado = peticionPIBD($sentencia);
                            echo "<option value=" . $fila['IdPais'] . " selected>Mantener igual</option>";

                            while($fila = $resultado->fetch_assoc()) {
                                echo '<option value="'.$fila['IdPais'].' ">'. $fila['NomPais'].'</option>';
                            }
                        ?>
                </select>
            </p>

            <p class="rellena">
                <label class="campo" for="foto">Foto de perfil: </label>
                <input class="caja" type="file" id="foto" name="foto">
                <!--<?php /*echo "<input class='caja' type='file' id='foto' name='foto' value='" . $fila['Foto'] . "'>";*/ ?>-->
            </p>

            <div class="rellena">
                <label class="campo" for="contra">Contraseña actual(*): </label>
                <div class="tooltip">
                    <?php echo "<input class='caja' type='password' id='contraActual' name='contraActual'>";?>    
                </div>
            </div>

            <input class="boton" type="submit" value="Modificar Datos">

        </fieldset>
    </form>
</main>

<?php require_once("pie.php"); ?>