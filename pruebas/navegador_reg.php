<nav>
    <label for="chkMenu"><span class="icon-menu"></span></label>
    <input type="checkbox" id="chkMenu">
    <ul>
        <?php
            if(!empty($_SESSION['usuario']))
            {
                echo "<li><a href='agregar_foto.php?album='><span class='icon-plus-circled'></span><span class='mt'>Subir foto</span></a></li>";
                echo "<li><a href='index_reg.php'><span class='icon-home'></span><span class='mt'>Inicio</span></a></li>";
                echo "<li><a href='buscar_reg.php'><span class='icon-search'></span><span class='mt'>Buscar</span></a></li>";
                echo "<li><a href='perfil.php'><span class='icon-user'></span><span class='mt'>", $_SESSION['nombreUsuario'], "</span></a></li>";
                echo "<li><a href='cerrarSesion.php'><span class='icon-logout'></span><span class='mt'>Cerrar sesión</span></a></li>";
                echo $menu_usuario; //Aqui se agrega el menu usuario solo desde la pagina de perfil -->
            }
            else
            {
                echo "<li><a href='index.php'><span class='icon-home'></span><span class='mt'>Inicio</span></a></li>";
                echo "<li><a href='buscar.php'><span class='icon-search'></span><span class='mt'>Buscar</span></a></li>";
                echo "<li><a href='registro.php'><span class='icon-user-plus'></span><span class='mt'>Nuevo usuario</span></a></li>";
                echo "<li><a href='login.php'><span class='icon-login'></span><span class='mt'>Iniciar Sesión</span></a></li>";
            }
        ?>
    </ul>
</nav>