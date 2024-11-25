<?php
/**
* Ejercicio realizado por P.Lluyot. 2DAW
*/
function sumaNaturales($n) {
    // Caso base: si n es 0, la suma es 0
    if ($n == 0) {
        return 0;
    }
    // Caso recursivo: n + sumaNaturales(n - 1)
    return $n + sumaNaturales($n - 1);
}

// Ejemplo de uso
$numero = 5;
echo "La suma de los primeros $numero números naturales es " . sumaNaturales($numero);
?>
