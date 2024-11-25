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
    // Almacenar el día de la semana (1-7) en una variable
    $dia = 7; // Por ejemplo, 4 representa Jueves

    // Variable para almacenar el nombre del día
    $nombreDia = "";

    // Usar switch para determinar el nombre del día en español
    switch ($dia) {
        case 1:
            $nombreDia = "Lunes";
            break;
        case 2:
            $nombreDia = "Martes";
            break;
        case 3:
            $nombreDia = "Miércoles";
            break;
        case 4:
            $nombreDia = "Jueves";
            break;
        case 5:
            $nombreDia = "Viernes";
            break;
        case 6:
            $nombreDia = "Sábado";
            break;
        case 7:
            $nombreDia = "Domingo";
            break;
        default:
            echo "Error: El valor del día no es válido.";
            exit; // Salir del script si el día no es válido
    }

    // Mostrar el día de la semana
    echo "Día de la semana: " . $nombreDia . "<br>";

    // Calcular cuántos días quedan hasta el próximo domingo
    $diasHastaDomingo = ($dia == 7) ? 7 : (7 - $dia);

    // Mostrar la cantidad de días hasta el próximo domingo
    echo "Días hasta el próximo domingo: " . $diasHastaDomingo;
    ?>

</body>

</html>