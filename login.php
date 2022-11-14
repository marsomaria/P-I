<?php require_once("acceso_solo_no_registrados.php"); ?>


<?php $title = "Inicio de sesión";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>
    
<main>
    <?php
        if(!empty($_COOKIE['usuario']) && !empty($_COOKIE['contra']) && !empty($_COOKIE['fecha']) && !empty($_COOKIE['hora'])) //si ya hay una cookie con los datos del usuario muestra el mensaje personalizado
        {
            echo "<fieldset class='contenedor2'>
                    <legend>Inicio de sesión</legend>

                    <div class='datos'>
                        <p>Bienvenido de nuevo ", base64_decode($_COOKIE['usuario']), ", su última visita fue el ", $_COOKIE['fecha'], " a las ", $_COOKIE['hora'], "</p>
                    </div>

                    <p class='datos'>
                        <a href='cerrarSesion.php'>Cerrar sesión</a>
                        <a href='accesoSesion.php'>Iniciar sesión</a>
                    </p>
                </fieldset>";
        }
        else    //si no hay cookies guardadas para este sitio muestra el formulario normal
        {
            echo "<form action='accesoSesion.php' method='POST' class='formulario'>
                    <fieldset>
                        <legend>Inicio de sesión</legend>

                        <div id='usuVacio' class='masR'>
                        </div>

                        <div class='datos'>
                            <label for='email' class='campo'>Correo: </label>
                            <div class='tooltip'>
                                <span class='tooltiptext' id='info'> Introduce tu dirección de correo</span>
                                <input type='text' id='email' name='email' class='caja'   >
                            </div>
                            <!-- <input type='email' id='email' name='email' class='caja' onblur='return comprobarUsuarioLogin(this);'> -->
                        </div>

                        <div id='contraVacia' class='masR'>
                        </div>
                        <div class='datos'>
                            <label for='contra' class='campo'>Contraseña: </label>

                            <div class='tooltip'>
                                <span class='tooltiptext' id='info'> Introduce tu clave</span>
                                <input type='password' id='contra' name='contra' class='caja'  >
                            </div>
                            <!-- <input type='password' id='contra' name='contra' class='caja'
                                onblur='return comprobarContraLogin(this);'> -->
                        </div>

                        <p class='datos'>
                            <a href='registro.php' id='notengo'>¿Aún no tienes cuenta?</a>
                            <br>
                            <input type='checkbox' name='cookies' id='cookies' value='cookies'> Recuérdame
                            <br>
                            <input type='submit' value='Iniciar sesión' class='boton'>
                        </p>
                    </fieldset>
                </form>";
        }
    ?> 
    
</main>

<?php require_once('pie.php'); ?>