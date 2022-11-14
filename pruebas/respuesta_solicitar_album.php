        <form action="index_reg.php" method="POST" class="contenedorIMPRESO">
            <fieldset>
                <legend>Solicitud registrada con éxito</legend>


                <p class="datos">Mi Nombre: 
                    <b> <?php echo $_POST["nombre"]; ?> </b>
                </p>

                <p class="datos">
                    <span class="icon-picture-1" style="color:var(--acento);"></span> 
                        <b style="color:var(--acento);"> <?php echo $_POST["album"]; ?> </b>
                </p>

                <p class="datos">
                    <span class="icon-picture-1"></span>Titulo álbum impreso: 
                        <b> <?php echo $_POST["titulo"]; ?> </b>
                </p>

                <p class="datos">
                    <span class="icon-mail"></span>Correo electrónico: 
                        <b> <?php echo $_POST["email"]; ?> </b>
                </p>

                <p class="datos">
                    <span class="icon-map-pin"></span>Direccion envio: 
                        <b> <?php echo $dir; ?> </b>
                </p>

                <p class="datos">
                    <span class="icon-info-circled-alt"></span>Texto adicional: 
                        <b> <?php echo $_POST["desc"]; ?> </b>
                </p>


                <p class="datos">
                    <span class="icon-color-adjust"></span>Color de la portada: 
                        <b> <?php echo $_POST["portada"]; ?> </b>
                </p>

                <p class="datos">
                    <span class="icon-plus-circled"></span>Número de copias: 
                        <b> <?php echo $_POST["copias"]; ?> </b>
                </p>

                <p class="datos">
                    <span class="icon-money"></span> Precio:  
                        <b> <?php echo calcularprecio(); ?> </b>
                </p>

                <p class="datos">
                    <span class="icon-calendar"></span>Fecha recepción: 
                        <b> <?php echo $fechita; ?> </b>
                </p>

                

                <input class="boton" type="submit" value="Confirmar solicitud">

            </fieldset>
        </form>

