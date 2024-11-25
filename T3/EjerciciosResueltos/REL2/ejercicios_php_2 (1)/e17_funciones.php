<?php
/**
* Ejercicio realizado por P.Lluyot. 2DAW
*/
    function print_array($array){
        if (!empty($array)) {
            return "<pre>".print_r($array,true)."</pre>";
        } else return "";
    }
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>P.Lluyot</title>
    <link rel='stylesheet' href='https://cdn.simplecss.org/simple.min.css'>
</head>
<body>
    <head><h3></h3></head>
    <main>
        <!-- código php -->
        <?php
            echo print_array([1,22,42,1,23,4]);
        ?>
    </main>
    <footer>P.Lluyot</footer>
</body>
</html>