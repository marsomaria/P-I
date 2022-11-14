<?php require_once("acceso_solo_registrados.php"); ?>

<?php $title = "Impresión de álbum";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php $menu_usuario = "";
    require_once("navegador.php"); ?>

<?php
    function calcularPrecio(){
        $paginas = 10; //parametro aleatorio
        $fotos = 30; //parametro aleatorio
        $copias = $_POST["copias"];
        $resolucion = $_POST["res"];
        $color = $_POST["color"];

        if($paginas < 5){
            $costePaginas = 0.1;
        }
        else if($paginas <= 11){
            $costePaginas = 0.08;
        }
        else{
            $costePaginas = 0.07;
        }

        if($resolucion > 300){
            $costeResolucion = 0.02;
        }
        else{
            $costeResolucion = 0;
        }
        if($color == "blancoYNegro"){
            $costeColor = 0;
        }
        else{
            $costeColor = 0.05;
        }
        
        $precio = $copias * (($paginas * $costePaginas) + ($fotos * ($costeResolucion + $costeColor)));
        return $precio;
    }
    $fechita="";
    if($_POST['recep']!=""){
        $arr = explode('-', $_POST["recep"]);
        $fechita=$arr[2].'/'.$arr[1].'/'.$arr[0];
    }else{
        $fechita="";
    }
    

    function sacaIdALbum(){
            $al=$_POST['album'];
            // echo $al;
            // Conecta con el servidor de MySQL
            $mysqli = @new mysqli(
                'localhost', // El servidor
                'root', // El usuario
                '', // La contraseña
                'pibd'); // La base de datos
        if($mysqli->connect_error) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }

        $sentencia = 'SELECT * FROM albumes where Titulo like "'.$al.'" ';
        $albumid=0;

            // Ejecuta la sentencia SQL
        
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            while($fila = $resultado->fetch_assoc()) {
                $albumid= $fila['IdAlbum'];
                // echo  $fila['IdAlbum'];
            }
        
        
        // Cierra la conexión
        $mysqli->close();
        return $albumid;
    }
?>
<?php
    $nombreLLENO=false;
    function nombreCOMPLETO(){
        // echo $_POST["nombre"];
        if($_POST["nombre"]!= " " && !empty( $_POST["nombre"])){
            // echo "//nombre bien/";
            $nombreLLENO=true;
        }else{
            // echo "//nombre vacio//";
            $nombreLLENO=false;
        }

        return $nombreLLENO;
    }


    $apellidoLLENO=false;
    function apellidoCOMPLETO(){
        // echo $_POST["apellidos"];
        if($_POST["apellidos"]!= " " && !empty( $_POST["apellidos"])){
            // echo "//apellido bien//";
            $apellidoLLENO=true;
        }else{
            // echo "//apellido vacio//";
            $apellidoLLENO=false;
        }

        return $apellidoLLENO;
    }


    $titLLENO=false;
    function titCOMPLETO(){
        // echo $_POST["titulo"];
        if($_POST["titulo"]!= " " && !empty( $_POST["titulo"])){
            // echo "//titulo bien//";
            $titLLENO=true;
        }else{
            // echo "//titulo vacio//";
            $titLLENO=false;
        }

        return $titLLENO;
    }


    $mailLLENO=false;
    function mailCOMPLETO(){
        // echo $_POST["email"];
        if($_POST["email"]!= " " && !empty( $_POST["email"])){
            // echo "//email bien//";
            $mailLLENO=true;
        }else{
            // echo "//email vacio//";
            $mailLLENO=false;
        }

        return $mailLLENO;
    }

    $dir=false;
    function direccionB(){
        if(calleCOMPLETO() && locCOMPLETO() && numCOMPLETO()){
            $dir=true;
            // echo "||DIRECCION BIEN ||";
        }else{
            $dir=false;
            // echo "||DIRECCION mal ||";
        }

        return $dir;
    }

        $calleLLENO=false;
        function calleCOMPLETO(){
            // echo $_POST["calle"];
            if($_POST["calle"]!= " " && !empty( $_POST["calle"])){
                // echo "//calle bien//";
                $calleLLENO=true;
            }else{
                // echo "//calle vacio//";
                $calleLLENO=false;
            }

            return $calleLLENO;
        }

        $locLLENO=false;
        function locCOMPLETO(){
            // echo $_POST["loc"];
            if($_POST["loc"]!= " " && !empty( $_POST["loc"])){
                // echo "//loc bien//";
                $locLLENO=true;
            }else{
                // echo "//loc vacio//";
                $locLLENO=false;
            }

            return $locLLENO;
        }

        $numLLENO=false;
        function numCOMPLETO(){
            // echo $_POST["numcalle"];
            if($_POST["numcalle"]!= " " && !empty( $_POST["numcalle"])){
                // echo "//numcalle bien//";
                $numLLENO=true;
            }else{
                // echo "//numcalle vacio//";
                $numLLENO=false;
            }

            return $numLLENO;
        }

        $aLLENO=false;
        function albumI(){
            if($_POST['album']=="_"){
                $aLLENO=false;
                // echo "ELIGE ALBUM JODER";

            }else{
                $aLLENO=true;
                // echo "MI AKBUM";
            }

            return $aLLENO;
        }

?>





<?php
    function subeIMPRESO(){
        $album = sacaIdALbum();
        $nombre = $_POST['nombre']; // varchar
        $apellidos = $_POST['apellidos']; // varchar               
        $titulo = $_POST['titulo'];
            
        if($_POST['desc']==""){
            $descripcion="-";
        }else{
            $descripcion = $_POST['desc'];
        }
            
        $email = $_POST['email'];
        $dir = "calle" .$_POST['calle']. "numero" .$_POST['numcalle']. "localidad" .$_POST['loc'] ;
        $color = $_POST['portada'];
        $copias = $_POST['copias'];
        $res = $_POST['res'];
       
        if($_POST['color']=='blancoYNegro'){
            $icolor = 0;
        }else{
            $icolor=1;
        }

        if( $_POST['recep'] ==""){
            $fecha = "0000-00-00";
        }else{
            $fecha = $_POST['recep'];
        }
        $coste = calcularPrecio();


            // Conecta con el servidor de MySQL
            $mysqli = @new mysqli(
                'localhost', // El servidor
                'root', // El usuario
                '', // La contraseña
                'pibd'); // La base de datos
        if($mysqli->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }
        $sentencia = "INSERT INTO solicitudes (IdSolicitud,Album ,Nombre, Apellidos, Titulo, Descripcion, Email, Direccion, Color, Copias, Resolucion, Fecha, IColor, FRegistro, Coste) 
                                    VALUES (null, $album,'$nombre' , '$apellidos',  '$titulo', '$descripcion','$email','$dir', '$color', $copias, $res,'$fecha', $icolor,  CURRENT_TIMESTAMP,$coste) ";
        
        // Ejecuta la sentencia SQL
        $dentro=0;
        // if( !contrasenya() && !contrasenya2() && iguales() && !nombre() && !mailvacio() && !fecha() && !sexo()){
        if($dentro<1){
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }

            if(nombreCOMPLETO() && apellidoCOMPLETO() && titCOMPLETO() && mailCOMPLETO() && albumI() && direccionB()){
                require_once("respuesta_solicitar_album.php"); 
            }else{
                header("Location:".$_SERVER['HTTP_REFERER']);            }
            $dentro +=1;
            // echo 'Se ha insertado un nuevo libro en la base de datos. ';
        }

        // }else{
            // header("Location:".$_SERVER['HTTP_REFERER']);
        // }
        
        // Cierra la conexión
        $mysqli->close();
    }

?>

<main>
        <?php  
        // nombreCOMPLETO();
        // apellidoCOMPLETO();
        // titCOMPLETO();
        // mailCOMPLETO();
        // albumI();
        // // calleCOMPLETO();
        // // numCOMPLETO();
        // // locCOMPLETO();
        // direccionB();
        subeIMPRESO();
        // if(nombreCOMPLETO() && apellidoCOMPLETO() && titCOMPLETO() && mailCOMPLETO() && albumI() && direccionB()){
        //     subeIMPRESO();
        // }else{
        //     echo "hastalue";
        // }
        
        ?>
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
</main>


<?php 
//require_once("respuesta_solicitar_album.php"); 
require_once("pie.php"); ?>