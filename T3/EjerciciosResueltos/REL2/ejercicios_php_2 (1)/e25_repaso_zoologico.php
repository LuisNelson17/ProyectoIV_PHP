<?php
/**
* Ejercicio realizado por P.Lluyot. 2DAW
*/
$animales = [
    ['nombre' => 'Simba', 'especie' => 'León', 'interacciones' => 4],
    ['nombre' => 'Dumbo', 'especie' => 'Elefante', 'interacciones' => 10],
    ['nombre' => 'George', 'especie' => 'Mono', 'interacciones' => 8] ,
    ['nombre' => 'Nala', 'especie' => 'León', 'interacciones' => 10],
    ['nombre' => 'Baloo', 'especie' => 'Oso', 'interacciones' => 7],
    ['nombre' => 'Akela', 'especie' => 'Lobo', 'interacciones' => 6],
    ['nombre' => 'Kaa', 'especie' => 'Cocodrilo', 'interacciones' => 9],
    ['nombre' => 'Rex', 'especie' => 'Elefante', 'interacciones' => 11],
    ['nombre' => 'Scar', 'especie' => 'León', 'interacciones' => 4],
    ['nombre' => 'Shere Khan', 'especie' => 'Oso', 'interacciones' => 8],
    ['nombre' => 'Rafiki', 'especie' => 'Mono', 'interacciones' => 9],
    ['nombre' => 'Timon', 'especie' => 'Mono', 'interacciones' => 6],
    ['nombre' => 'Pumba', 'especie' => 'Elefante', 'interacciones' => 10],
    ['nombre' => 'Bagheera', 'especie' => 'Lobo', 'interacciones' => 5],
    ['nombre' => 'Sebastián', 'especie' => 'Cocodrilo', 'interacciones' => 6],
    ['nombre' => 'Mufasa', 'especie' => 'León', 'interacciones' => 8],
    ['nombre' => 'Balto', 'especie' => 'Lobo', 'interacciones' => 7],
    ['nombre' => 'Louie', 'especie' => 'Oso', 'interacciones' => 5]
];
//función que aumenta en 1 la interacción con el animal
function registrar_interaccion(&$animales, $nombre_animal)
{
    //buscamos el nombre del animal en el array
    // usamos un valor por referencia del animal para actualizar el array de animales.
    if (empty($animales)) {
        echo "<p>Error al registrar interacción: No hay animales en el zoológico</p>";
    }
    foreach ($animales as &$animal) {

        if ($animal['nombre'] === $nombre_animal) {
            $animal['interacciones']++;
            return;
        }
    }
    echo "<p>Error al registrar interacción: No se encontró el animal $nombre_animal </p>";
}

function pintar_array($miarray)
{
    echo "<pre>";
    print_r($miarray);
    echo "</pre>";
}
//buscamos el animal más interactivo
function animal_mas_interactivo($animales)
{
    if (empty($animales)) {
        return "Error animal más interactivo: No hay animales registrados en el zoológico.<br>";
    }
    $max_interacciones = 0;
    $animales_mas_interactivo = [];
    //almacenamos en una variable las máximas interacciones
    /*foreach ($animales as $animal) {
        if ($animal['interacciones'] > $max_interacciones) {
            $max_interacciones = $animal['interacciones'];
        }
    }*/
    //podemos usar la función array_column y max
    $max_interacciones = max(array_column($animales, 'interacciones'));

    //recorremos los animales para obtener aquellos que tienen la max interaccion
    foreach ($animales as $animal) {
        if ($animal['interacciones'] == $max_interacciones) {
            $animales_mas_interactivo[] = $animal['nombre'];
        }
    }
    return $animales_mas_interactivo;
}

function  promedio_interacciones_por_especie($animales){
    if (empty($animales)) {
        return "Error promedio: No hay animales registrados en el zoológico.<br>";
    }
    
    $especies=[];
    $num_especies=[];
    /*foreach ($animales as $animal){
        $especie = $animal['especie'];
        $interacciones = $animal['interacciones'];
        if (isset($especies[$especie])) {
            $especies[$especie]+=$interacciones ;
            $num_especies[$especie]++ ;
            
        }else {
            $especies[$especie] = $interacciones;
            $num_especies[$especie]=1;
        }
    }
    $promedio_por_especie = [];
    foreach ($especies as $especie => $total) {
        $promedio_por_especie[$especie] = round($total / $num_especies[$especie],2);
    }    
    */
    foreach ($animales as $animal){
        $especies[$animal['especie']][]=$animal['interacciones']; //meto en el índice de la especie todas las interacciones posibles
    }
    $promedio_por_especie = [];
    foreach ($especies as $especie => $interaciones) {
        $promedio_por_especie[$especie] = round(array_sum($interaciones) / count($interaciones), 2); 
        
    }

    return $promedio_por_especie;
    
}

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

    pintar_array($animales);
    registrar_interaccion($animales, 'Simba');
       pintar_array($animales);
    /* registrar_interaccion ($animales, 'Dumbo');
    pintar_array($animales);
    registrar_interaccion ($animales, 'noexiste');
    pintar_array($animales);*/

    $int_animales = animal_mas_interactivo($animales);
    pintar_array($int_animales);

    $int_media = promedio_interacciones_por_especie($animales);
    pintar_array($int_media);

    ?>
</body>

</html>