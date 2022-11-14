<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <?php
        // sacaESTILOACTUAL();
        // echo $_SESSION['estiloUsuario'];
        if(!empty($_SESSION['estiloUsuario']))
        {
            switch($_SESSION['estiloUsuario'])
                {
                    case 8:
                        echo "<link rel='alternate stylesheet' href='estilos/estilo.css' title='Estándar'>
                        <link rel='stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                        <link rel='alternate stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                        <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                        <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                        <link rel='stylesheet' type='text/css' href='estilos/v_imprimir.css' media='print'>";
                    break;
                    case 4:
                        echo "<link rel='alternate stylesheet' href='estilos/estilo.css' title='Estándar'>
                        <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                        <link rel='stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                        <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                        <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                        <link rel='stylesheet' type='text/css' href='estilos/v_imprimir.css' media='print'>";
                    break;
                    case 7:
                        echo "<link rel='alternate stylesheet' href='estilos/estilo.css' title='Estándar'>
                        <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                        <link rel='alternate stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                        <link rel='stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                        <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                        <link rel='stylesheet' type='text/css' href='estilos/v_imprimir.css' media='print'>";
                    break;
                    case 5:
                        echo "<link rel='alternate stylesheet' href='estilos/estilo.css' title='Estándar'>
                        <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                        <link rel='alternate stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                        <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                        <link rel='stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                        <link rel='stylesheet' type='text/css' href='estilos/v_imprimir.css' media='print'>";
                    break;
                    case 6:
                        echo "<link rel='stylesheet' href='estilos/estilo.css' title='Estándar'>
                        <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                        <link rel='alternate stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                        <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                        <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                        <link rel='stylesheet' type='text/css' href='./estilos/v_imprimir.css' media='print'>";
                    break;
                    case 9:
                        echo "<link rel='alternate stylesheet' href='estilos/estilo.css' title='Estándar'>
                        <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                        <link rel='stylesheet' href='estilos/v_imprimir.css' title='Alto contraste'>
                        <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                        <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                        <link rel='stylesheet' type='text/css' href='estilos/v_imprimir.css' media='print'>";
                    break;
                    default:
                        echo "<link rel='stylesheet' href='estilos/estilo.css' title='Estándar'>
                        <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                        <link rel='alternate stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                        <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                        <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                        <link rel='stylesheet' type='text/css' href='./estilos/v_imprimir.css' media='print'>";
                    break;
                }

            /*switch($_SESSION['usuario'])
            {
                case 'usuario1@ua.es':
                    echo "<link rel='alternate stylesheet' href='estilos/estilo.css' title='Estándar'>
                    <link rel='stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                    <link rel='alternate stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                    <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                    <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                    <link rel='stylesheet' type='text/css' href='estilos/v_imprimir.css' media='print'>";
                break;
                case 'usuario2@ua.es':
                    echo "<link rel='alternate stylesheet' href='estilos/estilo.css' title='Estándar'>
                    <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                    <link rel='stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                    <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                    <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                    <link rel='stylesheet' type='text/css' href='estilos/v_imprimir.css' media='print'>";
                break;
                case 'usuario3@ua.es':
                    echo "<link rel='alternate stylesheet' href='estilos/estilo.css' title='Estándar'>
                    <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                    <link rel='alternate stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                    <link rel='stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                    <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                    <link rel='stylesheet' type='text/css' href='estilos/v_imprimir.css' media='print'>";
                break;
                case 'usuario4@ua.es':
                    echo "<link rel='alternate stylesheet' href='estilos/estilo.css' title='Estándar'>
                    <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
                    <link rel='alternate stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
                    <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
                    <link rel='stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
                    <link rel='stylesheet' type='text/css' href='estilos/v_imprimir.css' media='print'>";
                break;
            }*/
        }
        else
        {
            echo "<link rel='stylesheet' href='estilos/estilo.css' title='Estándar'>
            <link rel='alternate stylesheet' href='estilos/oscuro.css' title='Oscuro'>
            <link rel='alternate stylesheet' href='estilos/altoContraste.css' title='Alto contraste'>
            <link rel='alternate stylesheet' href='estilos/letraGrande.css' title='Letras grandes'>
            <link rel='alternate stylesheet' href='estilos/contrasteMasLetra.css' title='Alto contraste y letras grandes'>
            <link rel='stylesheet' type='text/css' href='./estilos/v_imprimir.css' media='print'>";
        }
    ?>
    <link rel="stylesheet" href="fontello/css/fontello.css">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="imgs/logo.png" />
</head>

<?php
    /*  //Ya se crea en el acceso_solo_registrado y no registrado
    if (!function_exists('peticionPIBD'))
    {
        include 'accesoBaseDatos.php';
    }
    */
?>