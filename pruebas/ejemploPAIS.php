<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Prueba de SELECT y mysqli orientado a objetos</title>
</head>
<body>
    <h1>BASE DE DATOS pibs</h1>
    <h2>TODOS LOS PAISES</h2>

    <?php
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
        echo '<table><tr>';
        echo '<th>IdPais</th><th>NomPais</th>';
        echo '</tr>';
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $fila['IdPais'] . '</td>';
            echo '<td>' . $fila['NomPais'] . '</td>';
            // echo '<td>' . $fila['Clave'] . '</td>';
            // echo '<td>' . $fila['Email'] . '</td>';
            // echo '<td>' . $fila['Sexo'] . '</td>';
            // echo '<td>' . $fila['FNacimiento'] . '</td>';
            // echo '<td>' . $fila['Ciudad'] . '</td>';
            // echo '<td>' . $fila['Pais'] . '</td>';
            // echo '<td>' . $fila['Foto'] . '</td>';
            // echo '<td>' . $fila['FRegistro'] . '</td>';
            // echo '<td>' . $fila['Estilo'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
    ?>
</body>
</html>