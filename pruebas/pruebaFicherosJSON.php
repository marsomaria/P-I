<?php
// Lee el fichero en una variable,
// y convierte su contenido a una estructura de datos
if($str_datos = file_get_contents("../ficheros/consejos.json"))
{
      $datos = json_decode($str_datos, true);

      echo "Longitud: " . count($datos["Consejos"]) . "<br>";
      $tam = count($datos["Consejos"]);
      $pos = mt_rand(0, $tam - 1);
      echo "Random: " . $pos . "<br>";
      echo "Consejo del día: " . $datos["Consejos"][0]["Consejo"] . "<br>";
      
      // Modifica el valor, y escribe el fichero json de salida
      //
      $datos["responsable"]["Aficiones"][0] = "Natación Sincrotrónica";
      
      //$fh = fopen("datos_out.json", 'w')      //esto crea un fichero nuevo con ese nombre
      //      or die("Error al abrir fichero de salida");
      //fwrite($fh, json_encode($datos,JSON_UNESCAPED_UNICODE));
      //fclose($fh);
}
else
{
      echo "Vaya, no se han podido obtener los consejos del día.<br>";
}
?>