<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Respuesta formulario</title>
</head>
<body>
<pre>
<?php
echo "Contenido de \$_GET:\n";
print_r($_GET);
echo "\n";
echo "Contenido de \$_POST:\n";
print_r($_POST);
echo "\n";
echo "Contenido de \$_REQUEST:\n";
print_r($_REQUEST);
?>
</pre>
<p>
Nombre: <b><?php echo $_POST["nombre"];?></b>
<br />
Apellidos: <b><?php echo $_POST["apellidos"];?></b>
</p>
</body>
</html>