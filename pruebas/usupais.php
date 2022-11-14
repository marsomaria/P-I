<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Prueba de SELECT y mysqli orientado a objetos</title>
</head>
<body>
    <h1>BASE DE DATOS pibs</h1>
    <h2>TODOS LOS USUARIOS</h2>

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
        $sentencia = 'SELECT * FROM usuarios join paises on Pais=IdPais';
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        echo '<table><tr>';
        echo '<th>IdUsuario</th><th>Título</th><th>Clave</th>';
        echo '<th>Email</th> <th>Sexo</th> <th>FNacimiento</th>';
        echo '<th>Ciudad</th> <th>Pais</th> <th>Foto</th> <th>FRegistro</th> <th>Estilo</th>';
        echo '</tr>';
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $fila['IdUsuario'] . '</td>';
            echo '<td>' . $fila['NomUsuario'] . '</td>';
            echo '<td>' . $fila['Clave'] . '</td>';
            echo '<td>' . $fila['Email'] . '</td>';
            echo '<td>' . $fila['Sexo'] . '</td>';
            echo '<td>' . $fila['FNacimiento'] . '</td>';
            echo '<td>' . $fila['Ciudad'] . '</td>';
            echo '<td>' . $fila['NomPais'] . '</td>';
            echo '<td>' . $fila['Foto'] . '</td>';
            echo '<td>' . $fila['FRegistro'] . '</td>';
            echo '<td>' . $fila['Estilo'] . '</td>';
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