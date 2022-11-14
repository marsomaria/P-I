<?php/*   //Lectura de carpetas
$nomdir = './'; //Aqui pondremos una carpeta ficheros o algo asi para separar un poco
echo "<h1>Contenido del directorio $nomdir</h1>\n";
$dir = opendir($nomdir);
echo "<pre>\n";
echo "<b>";
echo str_pad("Nombre", 30);
echo str_pad("Fecha ult. mod.", 20);
echo str_pad("Tamaño", 10);
echo "</b></pre>\n";
echo "<hr /><pre>\n";
while (($fichero = readdir($dir)) != FALSE) {
    echo str_pad($fichero, 30);
    echo str_pad(date("d/m/Y H:i", filemtime($nomdir . $fichero)), 20);
    if (is_dir($nomdir . $fichero)) {
        echo "-";
    } else {
        echo str_pad(filesize($nomdir . $fichero), 10);
    }
    echo "<br />\n";
}
closedir($dir);
echo "</pre><hr />\n";
*/?>



<?php   //Lectura de ficheros
/*echo "<h1>Procedo a leer un fichero</h1>";
if (($fichero = @file("../ficheros/fotos_dia.txt")) == false) 
{
    echo "No se ha podido abrir el fichero";
}
else
{
    echo "<pre>\n";

    foreach ($fichero as $tam => $linea){}   //Se podría hacer que esto accediera a una linea aleaoria en base  aun numero aleatorio entre 0 y la ultima linea del fichero

    foreach ($fichero as $numLinea => $linea)
    {
        echo "Línea #<b>" . sprintf(" %03d", $numLinea) . "</b> : ";
        echo htmlspecialchars($linea);
    }
    //echo "Tamaño: " . ($tam + 1);
    $pos = mt_rand(0, $tam + 1);
    echo "</pre>\n";
}*/
?>

<?php
// Escribir un fichero en un array. En este ejemplo iremos a través de HTTP para
// obtener el código fuente HTML de un URL.
if($lineas = file("../ficheros/fotos_dia.txt"))
{
    $pos = mt_rand(0, sizeof($lineas) - 1);
    echo "Random: " . $pos . "<br>";
    // Recorrer nuestro array, mostrar el código fuente HTML como tal y mostrar tambíen los números de línea.
    //foreach ($lineas as $num_linea => $linea) {
     //   echo "Línea #<b>{$num_lineas}</b> : " . htmlspecialchars($linea) . "<br />\n";
    //}
    //echo "Pos: " . $pos . " Línea: " . $lineas[$pos];
  
    echo "Foto del día: " . $lineas[$pos] . "<br>";
    if($linea = explode(';',$lineas[$pos])){
        echo "Número de cadenas: " . sizeof($linea) . "<br>";
        for($n = 0; $n < sizeof($linea); $n ++)
        {
            echo "Pos: " . $n . " String: " . $linea[$n] . "<br>";
        }
    }
    else
    {
        echo "Vaya, no se ha podido obtener la foto del día.<br>";
    }

    /*
    // Otro ejemplo: vamos a escribir una página web en una cadena. Véase también file_get_contents().
    $html = implode('', file('http://www.example.com/'));

    // Utilizar el parámetro opcional flags a partir de PHP 5
    $recortes = file('fichero.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    */
}
else
{
    echo "Vaya, no se ha podido obtener la foto del día.<br>";
}
?>