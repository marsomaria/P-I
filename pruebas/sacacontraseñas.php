<?php 

$usu='usuario1';
    $encripta ="SELECT
                    CAST(N'' AS XML).value(
                        'xs:base64Binary(xs:hexBinary(sql:variable("Clave")))'
                        , 'VARCHAR(MAX)'
                    )   Base64Encoding
                FROM (
                    SELECT CAST(".$usu." AS VARBINARY(MAX)) AS Clave
                ) AS bin_sql_server_temp";


    $desencripta ="SELECT 
                    CAST(
                        CAST(N'' AS XML).value(
                            'xs:base64Binary("dXN1YXJpbzE=")'
                        , 'VARBINARY(MAX)'
                        ) 
                        AS VARCHAR(MAX)
                    )   ASCIIEncoding
                ";

?>

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
        $sentencia = $encripta;
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        
        echo '<table><tr>';
        echo '<th>Contra</th>';
        echo '</tr>';
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>'. $fila['Base64Encoding'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';

        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    ?>