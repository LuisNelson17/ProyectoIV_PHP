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

<style>
    .rojo{
        color:red;
    }
    .azul {
        color:blue;
    }
</style>
</head>

<body>

    <?php 
    $x=7;
    for ($i = 1; $i <= 10; $i++) {
        $num = $x*$i;
        
        //$num%2 ? $class="rojo" : $class="azul";
        $class= $num%2 ? "rojo" : "azul";
        echo "<p class='$class'>$x x $i = $num</p>";
    }
    ?>
</body>

</html>