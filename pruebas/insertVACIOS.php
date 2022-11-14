<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Prueba de INSERT y MySQL</title>
    </head>
    <body>
        <p>

            <?php 
                function usuValido(){
                    // let introducido = document.getElementById("nombre").value;
                    // let html='';
                    // var expreg = new RegExp("^[a-zA-Z0-9]+$ , i");
                    $introducido=$_POST['nombre'];
                    $nombreVALIDO=false;

                    if($introducido!=''){ // SI LA CADENA NO ES VACIA

                        if($introducido.length>=3 ){// SI TIENE 3 O MAS CARACTERES
                           if($introducido.length<=15){// SITIENE 15 O MENOS CARACTERES

                                if($introducido[0] == '0' || $introducido[0] == '1'|| $introducido[0] == '2'|| $introducido[0] == '3'
                                    || $introducido[0] == '4' || $introducido[0] == '5' || $introducido[0] == '6' || $introducido[0] == '7'
                                    || $introducido[0] == '8'|| $introducido[0] == '9') {// SI EL PRIMER CARACTER ES UN NUMERO
                            
                                    // alert('No puede empezar por numero');
                                    // console.log('No puede empezar por numero');
                                    // html += '<p class="icon-cancel-circled" id="mensajeUsu">No puede empezar por número</p>';
                                    $nombreVALIDO=false;
                                    echo "<script> console.log('NO PUEDE EMPEZAR POR NUMERO');</script>";

                                }else{// SI EL PRIMER CARACTER NO ES UN NUMERO
                                    
                                    if($expreg.test($introducido)){//SI LOS CARACTERES SON VALIDOS SEGUN regExp
                                        // alert("El nombre es válido"); 
                                        // console.log("El nombre es válido segun RegExp");
                                        // html += '<p class="icon-ok-circled" id="mensajeUsu">Nombre válido</p>';
                                        $nombreVALIDO=true;
                                    }else{
                                        // alert("El nombre NO es válido"); 
                                        $nombreVALIDO=false;

                                        // console.log("El nombre NO es válido segunRegExp");
                                        // html += '<p class="icon-cancel-circled" id="mensajeUsu">No es válido</p>';
                                    }
                                        
                                }
                            }else{ // SI TIENE MAS DE 15 CARACTERES
                                // alert("El nombre NO es válido, mas de 15 caracteres"); 
                                $nombreVALIDO=false;
                                // console.log("El nombre NO es válido, mas de 15 caracteres");
                                // html += '<p class="icon-cancel-circled" id="mensajeUsu">Demasiado largo</p>';
                    
                            }
                        }else{// SI TIENE MENOS DE 3 CARACTERES
                            // alert("El nombre NO es válido, menos de 3 caracteres"); 
                            $nombreVALIDO=false;
                            // console.log("El nombre NO es válido, menos de 3 caracteres");
                            // html += '<p class="icon-cancel-circled" id="mensajeUsu">Demasiado corto</p>';
                        }  

                    }else{//SI LA CADENA ES VACIA
                        // alert("Introduce nombre de usuario"); 
                        $nombreVALIDO=false;
                        // console.log("Introduce nombre de usuario");
                        // html += '<p class="icon-cancel-circled" id="mensajeUsu">Introduce un nombre</p>';

                    }

                    // document.querySelector('#usuCorrecto').innerHTML=html;
                    return $nombreVALIDO;
                } 
                
                function compruebopass(){
                    // let html='';
                    // let contra=document.getElementById("contra").value;
                    // var expcontra = new RegExp("^[a-z]{1,15} + [A-Z]{1,15} + [0-9]{1,15} + [_-] +$ , i");// admite min 1 mayuscula + min 1 miscula + min numeros  + - +  _
                    $contraVALIDA=false;
                    $contra=$_POST["contra"];
                    $expcontra=new RegExp("^[a-z]{1,15} + [A-Z]{1,15} + [0-9]{1,15} + [_-] +$ , i");// admite min 1 mayuscula + min 1 miscula + min numeros  + - +  _
                    
                    if($contra!=''){//SI NO ES CADENA VACIA
                
                        if($contra.length>=6){//SI TIENE MA DE 6 CARACTERES
                            if($contra.length<=15){// SI TIENE MESNOS DE 15 CARACTERES
                
                                if($expcontra.test($contra)){//SI LOS CARACTERES SON VALIDOS SEGUN RegExp
                                    // alert("La contraseña es válida"); 
                                    $contraVALIDA=true;
                                    // console.log("La contraseña es válida");
                                    // html += '<p class="icon-ok-circled" id="mensajePwd">Contraseña válida</p>';
                                }else{
                                    // alert("La contraseña NO es válida"); 
                                    $contraVALIDA=false;
                                    // console.log("La contraseña NO es válida");
                                    // html += '<p class="icon-cancel-circled" id="mensajePwd">Contraseña NO válida</p>';
                                }
                            }else{//SI TIENE MAS DE 15 CARACTERES
                                // alert("La contraseñaes demasiado larga"); 
                                $contraVALIDA=false;
                                // console.log("La contraseña es larga");
                                // html += '<p class="icon-cancel-circled" id="mensajePwd">Contraseña muy larga</p>';
                
                            }
                        }else{//SI TIENE MENOS DE 6 CARACTERES
                            // alert("La contraseñaes demasiado corta");
                            $contraVALIDA=false; 
                            // console.log("La contraseña es corta");
                            // html += '<p class="icon-cancel-circled" id="mensajePwd">Contraseña muy corta</p>';
                        }
                
                    }else{//SI ES UNA CADENA VACIA
                        $contraVALIDA=false;
                        // html='<p id="mensajePwd" class="icon-cancel-circled"> Introduce contraseña </p>';
                    }
                
                    //SACCO EL MENSAJE DE HTML EN EL DIV CON EL ID pwdCorrecto
                    //arriba de el label contraseña
                    // document.querySelector('#pwdCorrecto').innerHTML=html;
                    return $contraVALIDA;
                }

                function llenos(){
                    if ( nombre() || contrasenya() || contrasenya2() || mailvacio() || fecha() || sexo()){
                        header("Location:".$_SERVER['HTTP_REFERER']);
                    }
                }

                function nombre(){  // comprueba si el nombre es vacio y devuelve trueVACIO o falseLLENO
                    $nombreREG = $_POST["nombre"];
                    $vacio=false;
                    if(  empty($nombreREG) || $nombreREG ==" " ){
                        // echo "no puede estar vacia";
                        $vacio =true;
                    }
                        
                    
                    return $vacio;
                }

                $contraREG = $_POST["contra"];
                function contrasenya(){// comprueba si el contra es vacio y devuelve trueVACIO o false
                    $contraREG = $_POST["contra"];
                    $contravacia=false;
                    if(empty($contraREG)|| $contraREG ==" "  ){ 
                        echo "no puede contra estar vacia";
                        $contravacia=true;
                        
                    }
                    return $contravacia;
                }

                $contraREG2 = $_POST["contrarep"];
                function contrasenya2(){ // comprueba si contrarep es vacio y devuelve true o false
                    $contraREG2 = $_POST["contrarep"];
                    $contravacia2=false;
                    if( empty($contraREG2) || $contraREG2 == " "  ){ 
                        
                            echo "no puede contra estar vacia";
                            $contravacia2=true;
                        
                    }
                    return $contravacia2;
                }
                
                function mailvacio(){//devuelve TRUE si el campo correo esta vacio o es un espacio
                    $correo = $_POST["email"];
                    $vacioCORREO=false;
                    if(  empty($correo) || $correo ==" " ){
                        // echo "no puede estar vacia";
                        $vacioCORREO =true;
                    }
                    return $vacioCORREO;
                }
                
                function fecha(){ //devuelve TRUE si la fecha esta vacia
                    $nace = $_POST["fecha"];
                    $vacioFECHA=false;
                    if(  empty($nace) || $nace ==" " ){
                        // echo "no puede estar vacia";
                        $vacioFECHA =true;
                    }
                    return $vacioFECHA;
                }

                function sexo(){ // devuelve TRUE si no ha elegido sexo
                    $genero = $_POST["fecha"];
                    $vacioGEN=false;
                    if(  empty($genero) || $genero ==" " ){
                        // echo "no puede estar vacia";
                        $vacioGEN =true;
                    }
                    return $vacioGEN;
                }


                function iguales(){// comprueba si el contra y contrarep son iguales y devuelve true o false
                    $cigualitas=false;
                    $contraREGg = $_POST["contra"];
                    $contraREG2g = $_POST["contrarep"];
                    if(!contrasenya() && !contrasenya2()){
                        if($contraREGg == $contraREG2g){
                            $cigualitas=true;
                            
                        }
                    }
                    return $cigualitas;
                }
            ?>

            
            <?php
                // Recoge los datos del formulario
                $nombre = $_POST['nombre']; // varchar
                $contra = $_POST['contra']; // varchar               
                $contrarep = $_POST['contrarep']; //varchar
                
                
                // if($_POST['email']==""){
                //     $email = "-"; // text
                // }else{
                $email = $_POST['email']; // text
                // }
                // if($_POST['sexo']=="_"){
                //     $sexo = 1; // int
                // }else{
                $sexo = $_POST['sexo']; // int
                // }
                
                // if($_POST['fecha']==""){
                //     $nacimiento = "0000-00-00"; // date
                // }else{
                $nacimiento = $_POST['fecha']; // date
                // }
                
                if($_POST['ciudad']==""){
                    $ciudad = "-"; // text
                }else{
                    $ciudad = $_POST['ciudad']; // text
                }
                
                
                if($_POST['pais']=="_"){
                    $pais = 0;
                }else{
                    $pais = $_POST['pais'];// int
                }
                
                if($_POST['foto']==""){
                    $foto="vacio.png";
                }else{
                    $foto = $_POST['foto']; // int
                }
               
                $estilo=6;
                
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
                $sentencia = "INSERT INTO usuarios (IdUsuario,NomUsuario,Clave, Contraseña, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro, Estilo) 
                                             VALUES (null, '$nombre' ,MD5('".$contra."'), '$contra', '$email', $sexo, '$nacimiento','$ciudad',$pais, '$foto', CURRENT_TIMESTAMP,$estilo) ";
                
                // Ejecuta la sentencia SQL
                if( !contrasenya() && !contrasenya2() && iguales() && !nombre() && !mailvacio() && !fecha() && !sexo()){
                    if(!($resultado = $mysqli->query($sentencia))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
                        echo '</p>';
                        exit;
                    }
                    require_once("datos_registro.php"); 
                    // echo 'Se ha insertado un nuevo libro en la base de datos. ';


                }else{
                    header("Location:".$_SERVER['HTTP_REFERER']);

                    echo "<script> console.log('rellena el nombre y contraseñas que sean iguales');</script>";
                }
                // echo '¿Filas insertadas? ' . mysqli_affected_rows($sentencia);
                // echo "<script> window.location='index_reg.php'; </script>";
                // Cierra la conexión con la base de datos
                
                
                // sacaRESPUESTA($nombre,$contra, $contrarep,$email, $sexo, $nacimiento, $ciudad, $pais, $foto);
       
                // Cierra la conexión
                $mysqli->close();
            
            ?>
        </p>
    </body>
</html>