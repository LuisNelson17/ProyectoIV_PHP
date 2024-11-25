<?php
// Función para calcular la media de las notas
function calcularMedia($notas) {
    return array_sum($notas) / count($notas);
}

// Validación y lógica principal
if (isset($_GET["notas"])) {
    // Recibir y dividir las notas en un array usando coma como separador
    $notas = explode(",", $_GET["notas"]);
    $notas = array_map('floatval', $notas);  // Convertir cada nota a número
    $notaMax = 10;
    $notaMin = 0;
    $mensaje = "";
    $media = null;
    $aprobadas = 0;
    $suspendidas = 0;

    // Validar que todas las notas estén en el rango permitido
    foreach ($notas as $nota) {
        if ($nota > $notaMax || $nota < $notaMin) {
            $mensaje = "Las notas deben estar entre 0 y 10.";
            break;
        }
    }

    // Si no hay mensaje de error, calcular la media y contar aprobadas y suspendidas
    if ($mensaje === "") {
        $media = calcularMedia($notas);
        
        foreach ($notas as $nota) {
            if ($nota >= 5) {
                $aprobadas++;
            } else {
                $suspendidas++;
            }
        }

        // Determinar si el grupo aprueba o suspende
        $estadoGrupo = $media >= 5 ? "aprobado" : "suspendido";
        $mensaje = "La media del grupo es " . number_format($media, 2) . 
                   " y el grupo ha $estadoGrupo. Aprobadas: $aprobadas, Suspendidas: $suspendidas.";
    }
} else {
    $mensaje = "No se encontró ningún parámetro de notas en la URL.";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Notas</title>
</head>
<body>
    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
</body>
</html>