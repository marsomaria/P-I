<?php require_once("acceso_solo_no_registrados.php"); ?>

<?php $title = "Búsqueda";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>
    
<main>
        <form action="error.php" method="GET" class="contenedor3">
            <fieldset>
                <legend>Búsqueda detallada</legend>

                <p class="rellena">
                    <label class="campo">Título: </label>
                    <input class="caja3" type="text" id="titulo" name="titulo">
                </p>

                <p class="rellena">
                    <label class="campo">Fecha entre: </label>
                    <input class="caja3" type="date" id="fechaini" name="fechaini">

                    <label> y : </label>
                    <input class="caja3" type="date" id="fechafin" name="fechafin">
                </p>

                <p class="rellena">
                    <label class="campo">País: </label>
                    <select class="caja3" id="pais" name="pais" >
                        <option value="_"> </option>
                        <?php
                            $sentencia = 'SELECT * FROM paises';
                            $resultado = peticionPIBD($sentencia);
                            while($fila = $resultado->fetch_assoc()) {
                                echo '<option>'. $fila['NomPais'].'</option>';
                            }
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
                                // Ejecuta una sentencia SQL
                                $sentencia = 'SELECT * FROM paises';
                                if(!($resultado = $mysqli->query($sentencia))) {
                                    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                                    echo '</p>';
                                    exit;
                                }
                                
                                // Recorre el resultado y lo muestra en forma de tabla HTML
                                while($fila = $resultado->fetch_assoc()) {
                                    echo '<option>'. $fila['NomPais'].'</option>';
                                }
                                
                                // Libera la memoria ocupada por el resultado
                                $resultado->close();
                                // Cierra la conexión
                                $mysqli->close();
                                */
                            ?>
                    </select>
                </p>

                <input class="boton" type="submit" value="Buscar">

            </fieldset>
        </form>
    </main>
<?php require_once("pie.php"); ?>