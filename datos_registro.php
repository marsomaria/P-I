<?php require_once("acceso_solo_no_registrados.php"); ?>


<?php $title = "Nuevo usuario";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<main class="contenedor2">
    <h1> DATOS REGISTRO</h1>
<p>
    Nombre: <b><?php echo $_POST["nombre"];
    
     
                $nombreREG = $_POST["nombre"];
          
                if(nombre()){ //si es vacio redirige atras
                    echo "no puede estar vacia";
                    header("Location:".$_SERVER['HTTP_REFERER']); 
                    
                }else{
                    echo "<script>console.log('Nombre: " . $nombreREG . "' );</script>";

                }
                   
            
    
    
    ?></b>
    <br />
    
    
    Contraseña: <b><?php echo $_POST["contra"];
    
            if(contrasenya()){ //si es vacia redirige atras
                echo " contraseña no puede estar vacia";
                header("Location:".$_SERVER['HTTP_REFERER']); 
                
            }else{
                echo "<script>console.log('Contraseña: " . $contraREG . "' );</script>";

            }
       
    
    ?></b>
    <br />
    Contraseña2: <b><?php echo $_POST["contrarep"];?></b>
    <br />


    Contraseñas iguales: <b><?php //echo $_POST["contrarep"];
            if(contrasenya2()){
                echo " contraseña no puede estar vacia";
                header("Location:".$_SERVER['HTTP_REFERER']); 
                echo "<script>console.log('Contraseña repite: vacia' );</script>";
            }else{
                echo "<script>console.log('Contraseña repite: " . $contraREG2 . "' );</script>";
            }
            
            if(iguales()){
                echo "SI";
                echo "<script>console.log('ContraseñasIGUALES ' );</script>";
                
            }else{//si son DIFERENTES
                echo "NO";
                header("Location:".$_SERVER['HTTP_REFERER']); 
               
                echo "<script>console.log('Contraseñas DIFERENTES' );</script>";


            }
    ?></b>
    <br />


    Correo electrónico: <b><?php echo $_POST["email"];?></b>
    <br />
    Género: <b><?php 
                    if($_POST["sexo"]==1){
                        echo "Otro";
                    }else{
                        if($_POST["sexo"]==2){
                            echo "Hombre";
                        }else{
                            if($_POST["sexo"]==3)
                                echo "Mujer";
                        }
                    }
                    // echo $_POST["sexo"];
                ?>
            </b>
    <br />
    Fecha Nacimiento: <b><?php echo $_POST["fecha"];?></b>
    <br />
    Ciudad de residencia: <b><?php echo $_POST["ciudad"];?></b>
    <br />
    País de residencia: <b><?php echo $_POST["pais"];?></b>
    
            
</p>
<button class='botonopcion' onclick='window.location.href=`login.php`;'>Iniciar Sesión</button>

</main>
<?php require_once("pie.php"); ?>