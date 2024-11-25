<?php

/**
 *  función que devuelve un array impreso (string)
 */
function print_array($array)
{
    if (!empty($array)) {
        return "<pre>" . print_r($array, true) . "</pre>";
    } else return "";
}


// Función para generar una tabla HTML a partir de un array bidimensional
function tablaArrayHTML($arrayBidimensional)
{
    // Si el array está vacío, retorna una cadena vacía
    if (empty($arrayBidimensional)) return "Error: El array está vacío.";

    // Obtener el número de columnas de la primera fila
    $numeroColumnas = count($arrayBidimensional[0]);

    // Inicializar la cadena de texto para la tabla HTML
    $tablaHTML = "<table border='1'>\n<tr>"; // Comenzar la tabla y primera fila de cabecera

    // Crear las cabeceras de la tabla usando los índices del primer elemento
    foreach ($arrayBidimensional[0] as $indice => $valor) {
        // Escapar los valores para evitar problemas de seguridad (XSS)
        $tablaHTML .= "<th>" . htmlspecialchars($indice) . "</th>";
    }

    $tablaHTML .= "</tr>\n"; // Cerrar la fila de cabecera

    // Recorrer cada fila del array bidimensional
    foreach ($arrayBidimensional as $fila) {
        // Comprobar si el número de columnas de la fila coincide con la primera fila
        if (count($fila) != $numeroColumnas) {
            // Retornar error si el número de columnas no coincide
            return "Error: Diferente número de columnas en una fila.";
        }

        $tablaHTML .= "<tr>"; // Iniciar una nueva fila

        // Recorrer cada valor de la fila
        foreach ($fila as $valor) {
            // Escapar los valores para mayor seguridad
            $tablaHTML .= "<td>" . htmlspecialchars($valor) . "</td>";
        }

        $tablaHTML .= "</tr>\n"; // Cerrar la fila actual
    }

    $tablaHTML .= "</table>"; // Cerrar la tabla

    // Devolver la tabla HTML generada
    return $tablaHTML;
}
