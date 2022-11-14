<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Perfil";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "<li><a href='menu_usuario.php'><span class='icon-plus-circled'></span><span class='mt'></span></a></li>";
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
        if($mysqli->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }
        // Ejecuta una sentencia SQL
        $sentencia = 'SELECT *, DATE_FORMAT(FNacimiento,"%d/%m/%Y")fechaDMY FROM usuarios, paises p where Email="'.$iniciado.'" and NomUsuario="'.$NOMBREiniciado.'"and Pais=p.IdPais';
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

        echo "<fieldset class='contenedor3'>";
        // Recorre el resultado y lo muestra en forma de tabla HTML
        while($fila = $resultado->fetch_assoc()) {
            echo "  <img src='./imgs/usuarios/". $fila['Foto'] ." 'alt=".$fila['NomUsuario'].">
                    <h2>". $fila['NomUsuario'] ."</h2>
                    <p class='datos'><span class='icon-mail'></span>". $fila['Email'] ."</p>
            
            ";

            if($fila['Sexo']==1){
                echo "<p class='datos'><span class='icon-user-pair'></span>sexo:OTRO</p>";
            }else{
                if($fila['Sexo']==2){
                    echo "<p class='datos'><span class='icon-user-pair'></span>sexo:HOMBRE</p>";
                }else{
                    if($fila['Sexo']==2){
                        echo "<p class='datos'><span class='icon-user-pair'></span>sexo:MUJER</p>";
                    }
                }
            }
            echo "<p class='datos'><span class='icon-calendar'></span>". $fila['fechaDMY'] ."</p>";
            echo "<p class='datos'><span class='icon-location-1'></span>". $fila['NomPais'] ."</p>";
                
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
    <?php datosUSU();?>
        
    </main>

<?php require_once("pie.php"); ?>