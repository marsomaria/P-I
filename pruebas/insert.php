<!DOCTYPE html>

<?php include 'accesoBaseDatos.php' ?>

<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Prueba de INSERT y MySQL</title>
    </head>
    <body>
        <p>
            <?php
                // Recoge los datos del formulario
                $nombre = $_POST['nombre']; // varchar
                $contra = $_POST['contra']; // varchar               
                $contrarep = $_POST['contrarep']; //varchar
                $email = $_POST['email']; // text
                $sexo = $_POST['sexo']; // int
                $nacimiento = $_POST['fecha']; // date
                $ciudad = $_POST['ciudad']; // text
                $pais = $_POST['pais']; // int
                $foto = $_POST['foto']; // int
                // $registro= CURRENT_TIMESTAMP ;

                // echo "soy ".$_SESSION['usuario'];
                // $iniciado=$_SESSION['usuario'];
                // $id=1;
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
                $sentencia = "INSERT INTO usuarios (IdUsuario,NomUsuario,Clave, Contraseña, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro, Estilo) 
                                             VALUES (null, '$nombre' ,MD5('".$contra."'), '$contra', '$email', $sexo, '$nacimiento','$ciudad',$pais, '$foto', CURRENT_TIMESTAMP,0) ";
                
                // Ejecuta la sentencia SQL
                if(!($resultado = $mysqli->query($sentencia))) {
                    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                    echo '</p>';
                    exit;
                }
                echo 'Se ha insertado un nuevo libro en la base de datos. ';
                // echo '¿Filas insertadas? ' . mysqli_affected_rows($sentencia);
                
                // Cierra la conexión con la base de datos
            
       
                // Cierra la conexión
                $mysqli->close();
            
            ?>
        </p>
    </body>
</html>