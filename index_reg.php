<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Página principal";
require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
require_once("navegador.php"); ?>

<?php
echo "<div class='contenedorInicio'>";   
if(!empty($_SESSION['usuario'])) //si se ha guardado el nombre de usuario en la sesion
{

    echo 'Se ha iniciado sesión, <p  class="usu"><a href="perfil.php">', $_SESSION['usuario'], '</a></p>';

    if(!empty($_COOKIE['usuario']) && !empty($_COOKIE['contra'])) //si se han almacenado datos en una cookie
    {
        echo 'y has elegido que recordemos tus datos';
    }
}
echo "</div>";

require_once("index_cargar_foto_dia.php");

require_once("index_cargar_consejos.php");

require_once("index_cargar_fotos.php");
?>

<?php require_once("pie.php"); ?>