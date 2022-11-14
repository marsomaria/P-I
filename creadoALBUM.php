
<h1>ÁLBUM CREADO</h1>
<p>
  

    Nombre álbum: <b><?php echo $_POST["titulo"];?></b>
    <br />
    Género: <b><?php echo $_POST["descripcion"];?></b>
    <br />
    
    <button class="boton" onclick="window.location.href=`agregar_foto.php?album='.$_SESSION['nuevoTITULOa'].'`;"  >SUBIR FOTOS</button>

</p>
    <?php subeALBUM();?>
