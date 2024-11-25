<?php
    /**
    * Ejercicio realizado por P.Lluyot. 2DAW
    */
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function sumar_digitos($num){
            if (empty($num)) return 0;
            return $num%10 + sumar_digitos(intval($num/10));
        }
        $minum=33123123456;
        echo "suma del numero $minum: ".sumar_digitos($minum);
    ?>
</body>
</html>