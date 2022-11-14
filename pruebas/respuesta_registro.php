<?php $title = "Nuevo usuario";
    require_once("cabeza.php"); ?>

<?php require_once("cabecera.php"); ?>

<?php require_once("navegador.php"); ?>

<?php 
    function llenos(){
        if ( nombre() || contrasenya() || contrasenya2()){
            header("Location:".$_SERVER['HTTP_REFERER']);
        }
    }

        function nombre(){  // comprueba si el nombre es vacio y devuelve true o false
            $nombreREG = $_POST["nombre"];
            $vacio=false;
            if(  empty($nombreREG) || $nombreREG ==" " ){
                // echo "no puede estar vacia";
                $vacio =true;
            }
                
            
        return $vacio;
        }

        $contraREG = $_POST["contra"];
        function contrasenya(){// comprueba si el contra es vacio y devuelve true o false
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

<main class="contenedor2">

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
    Género: <b><?php echo $_POST["sexo"];?></b>
    <br />
    Fecha Nacimiento: <b><?php echo $_POST["fecha"];?></b>
    <br />
    Ciudad de residencia: <b><?php echo $_POST["ciudad"];?></b>
    <br />
    País de residencia: <b><?php echo $_POST["pais"];?></b>
    

</p>

</main>

<?php require_once("pie.php"); ?>

