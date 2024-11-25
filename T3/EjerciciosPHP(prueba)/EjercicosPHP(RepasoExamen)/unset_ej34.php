<?php 
$animal=["gato", "perro" , "loro"];

unset($animal[1]);

print_r($animal);

print_r($animal);
// escribirá solo : "gato" "perro"
?>