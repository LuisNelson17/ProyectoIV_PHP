<?php
    /**
    * Ejercicio realizado por P.Lluyot. 2DAW
    */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $contador = 1;
    
    //mientras que el contador sea menor o igual que 10
    while ($contador <= 10) {
        //mostramos el contador
        echo $contador . "<br>";
        //aumentamos el contador
        $contador++;
    }
    
    ?>
</body>
</html>