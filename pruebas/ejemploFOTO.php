<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>ejemploFOTO</title>
</head>
<body>
    <h1>BASE DE DATOS pibs</h1>
    <h2>TODO DE FOTO</h2>


    <?php
        function creoFichero(){
            fopne(todasfotos.php, lectura);
            file();
        }
    ?>

    <?php
        $fotillo=1;
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
        $sentencia = 'SELECT *, a.Titulo nalbum FROM fotos JOIN paises on (Pais=IdPais) join albumes a on (Album=IdAlbum)' ;
        // $sentencia2 = 'SELECT * FROM fotos join albumes on Pais=IdAlbum where IdFoto=' . $fotillo;
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }

      
        echo '<table><tr>';
        echo '<th>IdFoto</th><th>Título</th><th>Descripcion</th>';
        echo '<th>Fecha</th> <th>Pais</th> <th>Alternativo</th> <th>Album</th>';
        echo '<th>Fichero</th> <th>Alternativo</th> <th>FRegistro</th> ';
        echo '</tr>';
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $fila['IdFoto'] . '</td>';
            echo '<td>' . $fila['Titulo'] . '</td>';
            echo '<td>' . $fila['Descripcion'] . '</td>';
            echo '<td>' . $fila['Fecha'] . '</td>';
            echo '<td>' . $fila['Pais'] . '-' . $fila['NomPais'] . '</td>';
            echo '<td>' . $fila['Alternativo'] . '</td>';
            echo '<td>' . $fila['Album'] .'-'. $fila['nalbum'] . '</td>';
            echo '<td>' . $fila['Fichero'] . '</td>';
            echo '<td>' . $fila['Alternativo'] . '</td>';
            echo '<td>' . $fila['FRegistro'] . '</td>';
            echo '</tr>';
        }
        // while($fila2 = $resultado2->fetch_assoc()) {
        //     echo '<tr>';
        //     echo '<td>' . $fila2['IdFoto'] . '</td>';
        //     echo '<td>' . $fila2['Titulo'] . '</td>';
        //     echo '<td>' . $fila2['Descripcion'] . '</td>';
        //     echo '<td>' . $fila2['Fecha'] . '</td>';
        //     echo '<td>' . $fila2['Pais'] . '</td>';
        //     echo '<td>' . $fila2['Alternativo'] . '</td>';
        //     echo '<td>' . $fila2['Titulo'] . '</td>';
        //     echo '<td>' . $fila2['Fichero'] . '</td>';
        //     echo '<td>' . $fila2['Alternativo'] . '</td>';
        //     echo '<td>' . $fila2['FRegistro'] . '</td>';
        //     echo '</tr>';
        // }
        echo '</table>';
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // $resultado2->close();
        // Cierra la conexión
        $mysqli->close();
    ?>
</body>
</html>