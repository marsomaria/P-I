<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Prueba de subir fichero</title>
</head>
    <body>
        <form action="subirfichero.php" method="post" enctype="multipart/form-data">
            Fichero: <input type="file" name="fichero" />
            <br />
            <input type="submit" value="Enviar" />

            <p class="rellena">
                    <label class="campo" for="desc">Descripción:</label>
                    <textarea class="caja" id="desc" name="desc" rows="2"></textarea>
                </p>

                <p class="rellena">
                    <label class="campo" for="fecha">Fecha:</label>
                    <input class="caja" type="date" id="fecha" name="fecha">
                </p>



        </form>
    </body>
</html>