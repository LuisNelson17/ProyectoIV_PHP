<?php
    /**
    * Ejercicio realizado por P.Lluyot. 2DAW
    */
    // Función para generar una tabla HTML
    function generarTabla($n)
    {
        if ($n<=0) return "";
        // Inicializar la cadena de texto para la tabla HTML
        $tablaHTML = "<table>"; // Solo comenzamos con la tabla

        // Generar las filas y columnas de la tabla
        $numero = 1; // Inicializar el número para las celdas
        for ($fila = 0; $fila < $n; $fila++) {
            $tablaHTML .= "<tr>"; // Iniciar una nueva fila
            for ($columna = 0; $columna < $n; $columna++) {
                $tablaHTML .= "<td>$numero</td>"; // Añadir una celda con el número correlativo
                $numero++; // Incrementar el número
            }
            $tablaHTML .= "</tr>"; // Cerrar la fila
        }

        $tablaHTML .= "</table>"; // Cerrar la tabla
        return $tablaHTML; // Devolver la cadena de texto de la tabla
    }
?> 
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Tablas</title>
    <style>
        th,
        td {
            border: 1px solid #000;
            /* Color del borde de las celdas */
            padding: 8px;
            /* Espaciado interno de las celdas */
            text-align: center;
            /* Alinear el texto al centro */
        }

    </style>
</head>

<body>

    <?php
    // Llamar a la función con diferentes tamaños de tabla y mostrar los resultados
    echo generarTabla(3); // Tabla de 3x3
    echo "<br><br>"; // Añadir espacio entre las tablas
    echo generarTabla(4); // Tabla de 4x4
    echo "<br><br>"; // Añadir espacio entre las tablas
    echo generarTabla(5); // Tabla de 5x5
    ?>

</body>

</html>