<?php
    function peticionPIBD($sentencia)
    {
        $resultado = null;
        // Conecta con el servidor de MySQL
        $mysqli = @new mysqli(
            'localhost', // El servidor
            'root', // El usuario
            '', // La contraseña
            'pibd'); // La base de datos
        if($mysqli->connect_error) 
        {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }

        // Ejecuta la sentencia SQL        
        if(!($resultado = $mysqli->query($sentencia))) 
        {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        $mysqli->close();

        return $resultado;
    }
?>