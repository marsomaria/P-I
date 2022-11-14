<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Prueba de file</title>
</head>
<body>
    <?php
        if(($fichero = @file("ejemploFOTO.php")) == false){
            echo "No se ha podido abrir el fichero";
        }else{
            echo "<pre>\n";
            foreach($fichero as $numLinea => $linea){
                echo "Línea #<b>" . sprintf(" %03d", $numLinea) . "</b> : ";
                echo htmlspecialchars($linea);
            }
            echo "</pre>\n";
        }
    ?>
</body>
</html>