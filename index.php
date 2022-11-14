<?php require_once("acceso_solo_no_registrados.php"); ?>

<?php $title = "Página principal";
require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
require_once("navegador.php"); ?>

<?php
require_once("index_cargar_foto_dia.php");

require_once("index_cargar_consejos.php");

require_once("index_cargar_fotos.php");
?>

<?php require_once("pie.php"); ?>