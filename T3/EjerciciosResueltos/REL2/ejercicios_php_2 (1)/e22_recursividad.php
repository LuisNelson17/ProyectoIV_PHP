<?php
/**
* Ejercicio realizado por P.Lluyot. 2DAW
*/
// Función recursiva para calcular el factorial de un número
function factorial($n) {
    if ($n <= 1) {
        return 1; // Caso base: el factorial de 0 o 1 es 1
    } else {
        return $n * factorial($n - 1); // Llamada recursiva
    }
}

// Ejemplos de uso
echo "Factorial de 5: " . factorial(5) . "<br>"; // 120
echo "Factorial de 7: " . factorial(7) . "<br>"; // 5040
?>
