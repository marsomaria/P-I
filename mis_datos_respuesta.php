<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Mis datos";
require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
require_once("navegador.php"); ?>

<?php

function realizarValidaciones()
{
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $contra = $_POST['contra'];
    $contrarep = $_POST['contrarep'];
    //$contra = filter_var($_POST['contra'], FILTER_SANITIZE_STRING);
    //$contrarep = filter_var($_POST['contrarep'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $sexo = filter_var($_POST['sexo'], FILTER_SANITIZE_NUMBER_INT);
    $fecha = $_POST['fecha'];
    $ciudad = filter_var($_POST['ciudad'], FILTER_SANITIZE_STRING);
    $pais = filter_var($_POST['pais'], FILTER_SANITIZE_NUMBER_INT);
    $foto = $_POST['foto'];
    $contraActual = $_POST['contraActual'];


    if (!empty($nombre) && !empty($contra) && !empty($contrarep) && !empty($email) && !empty($fecha) && !empty($contraActual)) {
        //__________Comprobacion Nombre
        $error_nombre = false;
        if (!preg_match_all('#^[a-zA-Z]+[a-zA-Z0-9]{2,13}#', $nombre)) {
            $error_nombre = true;
            echo $nombre . " no es un nombre válido<br>";
        } else {
            echo "Nombre: <b>" . $nombre . "</b><br>";
            $_SESSION['nombreUsuario']=$nombre;
        }

        //__________Comprobacion Contra
        $array = str_split($contra);
        $error_contra = false;

        $mayus = false;
        $minus = false;
        $num = false;

        if (sizeof($array) >= 6 && sizeof($array) <= 15) {

            for ($n = 0; $n < sizeof($array); $n++) {
                if (!(($array[$n] >= 'a' && $array[$n] <= 'z') ||
                        ($array[$n] >= 'A' && $array[$n] <= 'Z') || 
                        ($array[$n] >= '0' && $array[$n] <= '9') || 
                        $array[$n] == '-' || 
                        $array[$n] == '_')) 
                {
                    $error_contra = true;
                    break;
                } else if ($array[$n] >= 'a' && $array[$n] <= 'z') {
                    $minus = true;
                } else if ($array[$n] >= 'A' && $array[$n] <= 'Z') {
                    $mayus = true;
                } else if ($array[$n] >= '0' && $array[$n] <= '9') {
                    $num = true;
                }
            }

            if ($minus == false && $mayus == false && $num == false) {
                $error_contra = true;
            }
        } else {
            $error_contra = true;
        }

        if ($error_contra == true) {
            echo "No has introducido una contraseña válida<br>";
        }

        //_____________Comprobacion Contrarep
        $error_contrarep = false;
        if (strcmp($contra, $contrarep) != 0) {
            echo "Las contraseñas no coinciden<br>";
            $error_contrarep = true;
        } else {
            echo "Contraseña: <b>Válida</b><br>";
            //echo "Contra: <b>" . $contra . "</b><br>";
        }

        //_____________Comprobacion Correo
        $error_correo = false;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_correo = true;
            echo $email . " no es una dirección de correo válida<br>";
        } else {
            echo "Correo: <b>" . $email . "</b><br>";
            $_SESSION['usuario'] = $email;
        }

        //_____________Comprobacion Sexo
        $error_sexo = false;
        if ($sexo < 1 && $sexo > 3) {
            $error_sexo = true;
            echo "Debes seleccionar un género<br>";
        } else {
            $genero = '';
            switch ($sexo) {
                case 1:
                    $genero = 'Otro';
                    break;
                case 2:
                    $genero = 'Hombre';
                    break;
                case 3:
                    $genero = 'Mujer';
                    break;
            }
            echo "Género: <b>" . $genero . "</b><br>";
        }


        //_____________Comprobacion Nacimiento
        $error_nacimiento = false;

        $fecha_nacimiento = date_parse_from_format("Y/m/d", $fecha);
        $presente = date("Y/m/d");
        if (!checkdate($fecha_nacimiento['day'], $fecha_nacimiento['month'], $fecha_nacimiento['year']) || strtotime($fecha) >= strtotime($presente)) 
        {
            $error_nacimiento = true;
            echo $fecha . " no es una fecha de nacimiento válida<br>";
        } 
        else 
        {
            
            $arrn = explode('-', $fecha);
            $fechitaN=$arrn[2].'/'.$arrn[1].'/'.$arrn[0];
            echo "Fecha de nacimiento: <b>" . $fechitaN . "</b><br>";
        }

        if ($error_nombre == false && $error_contra == false && $error_contrarep == false && $error_correo == false && $error_sexo == false && $error_nacimiento == false) 
        {
            $id = $_SESSION['idUsuario'];
            // AND Clave = TO_BASE64("' . $contraActual . '")
            
            $sentencia = 'UPDATE usuarios SET
                                NomUsuario = "' . $nombre . '",
                                Clave = TO_BASE64("' . $contra . '"),
                                Email = "' . $email . '",
                                Sexo = ' . $sexo . ',
                                FNacimiento = "' . $fecha . '",
                                Ciudad = "' . $ciudad . '",
                                Pais = ' . $pais . ',
                                Foto = "' . $foto . '"
                                    WHERE IdUsuario = ' . $id ;

            if(peticionPIBD($sentencia))
            {
                echo "Se han modificado los datos correctamente, <b>" . $nombre . "</b>";
                $_SESSION['usuario'] = $email;  
                $_SESSION['nombreUsuario'] = $nombre; 

                if(!empty($_COOKIE["usuario"]) && !empty($_COOKIE["contra"]) && !empty($_COOKIE["fecha"]) && !empty($_COOKIE["hora"]))
                {
                    setcookie('usuario', base64_encode($email), time() + 90 * 24 * 60 * 60);
                    setcookie('contra', base64_encode(base64_decode($contra)), time() + 90 * 24 * 60 * 60);  //redundante pero el concepto seria el mas realista
                    setcookie('fecha', date('d-m-Y'), time() + 90 * 24 * 60 * 60);
                    setcookie('hora', date('H:i'), time() + 90 * 24 * 60 * 60);
                }
            }
            else
            {
                header("Location: mis_datos.php");
            }
        }
        else
        {
            header("Location: mis_datos.php");
        }
    }
    else
    {
        header("Location: mis_datos.php");
    }
}
?>

<main class="contenedor2">
    <div>
        <?php
        realizarValidaciones();
        ?>
    </div>
</main>

<?php require_once("pie.php"); ?>