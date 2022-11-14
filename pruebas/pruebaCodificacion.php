<?php
    $nocodi = "usuario1";
    $codi = base64_encode($nocodi);
    $decodi = base64_decode($codi);
    echo "Palabra: " . $nocodi . " y codificada: " . $codi . " y de vuelta: " . $decodi;
?>