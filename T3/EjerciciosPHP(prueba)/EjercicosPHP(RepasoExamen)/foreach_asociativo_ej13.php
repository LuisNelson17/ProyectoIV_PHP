<?php 
$array=[
    "hola"=>"caracola",
    "mundo"=> "picola"
];

foreach($array as $key =>$valor){
echo "{$key}=>{$valor}<br>";
}
/* Salida: 

hola=>caracola
mundo=>picola

*/
?>