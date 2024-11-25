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
    <style>
        table{
            border-collapse: collapse;
        }
        th, td{
            border:1px solid black;
            padding:3px;
            min-width: 100px;
            text-align: center;
        }
        th {
            background-color: #FF000055;
        }
    </style>
</head>
<body>
    <?php
    //almacenamos los estudiantes en un array asociativo
    //donde el índice es el nombre del estudiante y la nota el valor.
    $estudiantes = Array(
        "Pepe" => 8.23,
        "Juan" => 4.34,
        "Ana" => 5.66,
        "Elena" => 9.66,
        "Pedro" => 2.14
    );
    //mostramos el contenido en una tabla HTML
    //generamos en primer lugar la cabecera de la tabla.
    echo "<table>
            <tr>
                <th>Estudiante</th>
                <th>Nota</th>
            </tr>";

    //inicializamos las variables min, max y número de aprobados.
    $max=0;$min=10;$aprob=0;

    //recorremos cada elemento del array asociativo
    foreach ($estudiantes as $nombre=>$nota){
        //comprobamos si la nota supera la nota máxima para almacenarla
        if ($nota > $max)  $max=$nota ;

        //comprobamos si la nota supera la nota mínmima para almacenarla
        if ($nota < $min)  $min=$nota ;

        //acumulamos las notas que sean superiores o iguales al 5
        if ($nota >=5) $aprob++;

        //generamos una fila de la tabla con los datos del estudiante
        echo "<tr>
                <td>$nombre</td>
                <td>$nota</td>
              </tr>";
    }
    //fin de la tabla, y lista de aprobados y nota máx y mín.
    echo "</table>
    <p>Número de aprobados: $aprob</p>
    <p>La nota máxima es $max</p>
    <p>La nota mínima es $min</p>";
    //fin
    ?>
</body>
</html>