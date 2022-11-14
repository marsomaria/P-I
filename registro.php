<?php require_once("acceso_solo_no_registrados.php"); ?>

<?php $title = "Nuevo usuario";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>
    
<main>
    <form action="registro_respuesta.php" enctype="multipart/form-data" method="post" class="formulario">
        <fieldset>
            <legend>Formulario de registro</legend>

            <p class="rellena" style="color:var(--error);">
                *Campos obligatorios
            </p>

            <div class="rellena">
                <label class="campo">Nombre(*): </label>

                <div class="tooltip">
                    <span class="tooltiptext" id="info">
                        El nombre sólo puede contener letras del alfabeto inglés (en mayúsculas y minúsculas) y números; no puede comenzar con un número; longitud mínima 3 caracteres y máxima 15
                    </span>
                    <input class="caja"   type="text" id="nombre" name="nombre" >
                </div>
            </div>

            <div class="rellena">

                <label class="campo" for="contra">Contraseña(*): </label>
                <div class="tooltip">
                    <span class="tooltiptext">
                        La contraseña sólo puede contener letras del alfabeto inglés (en mayúsculas y minúsculas), números, el guion y el guion bajo (subrayado); al menos debe contener una letra en mayúscula, una letra en minúscula y un número; longitud mínima 6 caracteres y máxima 15.
                    </span>
                    <input class="caja"   type="password" id="contra" name="contra" >
                </div>
            </div>

            <p class="rellena">
                <label class="campo" for="contrarep">Repita la contraseña(*): </label>
                <div class="tooltip">
                    <span class="tooltiptext">
                        Las contraseñas deben ser iguales
                    </span>
                    <input class="caja"  type="password" id="contrarep" name="contrarep">
                </div>
            </p>
            

            <p class="rellena">
                <label class="campo" for="email">Correo electrónico(*): </label>
                <div class="tooltip">
                    <input class="caja" type="text" id="email" name="email" >
                </div>
                
            </p>

            <p class="rellena">
            <label class="campo" for="sexo">Género(*): </label>
                <div class="tooltip">
                    <select class="caja"  id="sexo" name="sexo" >
                        <option value="0" selected> </option>
                        <option value="2">Hombre</option>
                        <option value="3">Mujer</option>
                        <option value="1">Otro</option>
                    </select>
                </div>
            </p>

            <div class="rellena">
                <label class="campo" for="fecha">Fecha de nacimiento(*): </label>
                <input type="date" class="caja" id="fecha" name="fecha">
            </div>

            <p class="rellena">
                <label class="campo" for="ciudad">Ciudad de residencia: </label>
                <input class="caja" type="text" id="ciudad" name="ciudad">
            </p>

            <p class="rellena">
                <label class="campo" for="pais">País de residencia:</label>
                <select class="caja" id="pais" name="pais" >
                        <?php
                            $sentencia = 'SELECT * FROM paises';
                            $resultado = peticionPIBD($sentencia);
                            while($fila = $resultado->fetch_assoc()) {
                                echo '<option value="'.$fila['IdPais'].' ">'. $fila['NomPais'].'</option>';
                            }
                        ?>
                </select>
            </p>

            <p class="rellena">
                <label class="campo" for="fichero">Foto de perfil: </label>
                <input class="caja" type="file" id="foto" name="fichero">
            </p>

            <p class="datos">
                <a href="login.php" id="notengo">¿Ya tienes cuenta?</a>
            </p>

            <input class="boton" type="submit" value="Registrarse">
            <input class="boton2" type="reset" value="Vaciar formulario">

        </fieldset>
    </form>
</main>

<?php require_once("pie.php"); ?>