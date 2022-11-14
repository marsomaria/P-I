<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Crear álbum";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>
<main>
        <form action="album_creado.php" method="POST" class="formulario"  >
            <fieldset>
                <legend>Crear álbum</legend>
                <p class="rellena" style="color:var(--acento);">*Rellene este formulario para crear un álbum. Titulo obligatorio</p>
                <!-- <p class="rellena">
                    *Campos obligatorios
                </p> -->
                
                <p class="rellena">
                    <label for="titulo" class="campo">Título: </label>

                    <div class="tooltip">
                        <span class="tooltiptext">Rellena para continuar

                        </span>
                        <input type="text" id="titulo" name="titulo" class="caja" >
                    </div>
                    
                </p>

                <p class="rellena">
                    <label for="descripcion" class="campo">Descripción: </label>
                    <textarea id="descripcion" name="descripcion" class="caja" ></textarea>
                </p>

                

                <input type="submit" class="boton" value="Crear álbum">

            </fieldset>
        </form>
    </main>
<?php require_once("pie.php"); ?>