<?php
session_start(); // Iniciar la sesión

// Variables globales
$MAX_PERSONAS = 6;
$MAX_MESAS = 10;
$numeroMesa=0;
// Si no existe el array de reservas en la sesión, lo inicializamos
if (!isset($_SESSION['reservas'])) {
    $_SESSION['reservas'] = [];
}
$reservas = &$_SESSION['reservas']; // Referencia al array de reservas dentro de la sesión


function nombreRepetido($nombreCliente) {
    global $reservas;
    foreach ($reservas as $reserva) {
        if ($reserva['NOMBRE'] == $nombreCliente) {
            return true;
        }
    }
    return false;
}





function mesasOcupadas() {
    global $reservas;
    $mesasOcupadas = 0;
    foreach ($reservas as $reserva) {
        $mesasOcupadas += $reserva['MESAS_OCUPADAS']; // Sumamos las mesas que ocupa cada reserva
    }
    return $mesasOcupadas;
}




function mostrarMesasDisponibles() {
    global $MAX_MESAS;
    $mesasOcupadas = mesasOcupadas();
    $mesasDisponibles = $MAX_MESAS - $mesasOcupadas;

    // Mostrar las mesas disponibles
    if ($mesasDisponibles > 0) {
        echo "<h3>Mesas disponibles: $mesasDisponibles de $MAX_MESAS</h3>";
    } else {
        echo "<h3 style='color:red;'>No hay mesas disponibles.</h3>";
    }
}




function realizarReserva($nombreCliente, $numPersonas, $lugar, $horaReserva) {
    global $MAX_PERSONAS;
    global $reservas;
    global $MAX_MESAS;

    // Validar si el nombre de la reserva ya existe
    if (nombreRepetido($nombreCliente)) {
        echo "<p style='color:red;'>El nombre de la reserva '$nombreCliente' ya existe. No se puede añadir otra con el mismo nombre.</p>";
        return;
    }

    // Validar el número de personas
    if ($numPersonas > $MAX_PERSONAS) {
        echo "<p style='color:red;'>El número máximo de personas es $MAX_PERSONAS.</p>";
        return;
    }

    // Validar el lugar (exterior o interior)
    if ($lugar !== "exterior" && $lugar !== "interior") {
        echo "<p style='color:red;'>El lugar debe ser 'exterior' o 'interior'. Se asigna 'interior' por defecto.</p>";
        $lugar = "interior"; // Asignar valor por defecto si la validación falla
    }

      // Validar que la hora de reserva esté entre 20:00 y 22:00 comparando strings
      if ($horaReserva < "20:00" || $horaReserva > "22:00") {
        echo "<p style='color:red;'>El horario de reservas es de 20:00 a 22:00. La hora ingresada ($horaReserva) no es válida.</p>";
        return;
    }

    // Verificar si hay mesas disponibles antes de realizar la reserva
    $mesasDisponibles = $MAX_MESAS - mesasOcupadas();
    $mesasNecesarias = $numPersonas > 4 ? 2 : 1;

    if ($mesasNecesarias > $mesasDisponibles) {
        echo "<p style='color:red;'>No hay suficientes mesas disponibles para realizar la reserva.</p>";
        return;
    }

    // Generar el número de mesa (esto puede ser más de una mesa si es necesario)
    $numeroMesa = count($reservas) + 1;

    // Crear la nueva reserva
    $nuevaReserva = [
        'Nº' => $numeroMesa,
        'NOMBRE' => $nombreCliente,
        'PERSONAS' => $numPersonas,
        'UBICACION' => $lugar,
        'HORA' => $horaReserva,
        'MESAS_OCUPADAS' => $mesasNecesarias // Guardar cuántas mesas ocupa la reserva
    ];

    // Agregar la nueva reserva al array de reservas
    $reservas[] = $nuevaReserva;
    echo "<p style=color:green;>Reserva creada exitosamente.</p>";
}




function eliminarReserva($nombreCliente) {
    global $reservas;
    global $numeroMesa;
    // Buscar el índice de la reserva que queremos eliminar
    foreach ($reservas as $key => $reserva) {
        if ($reserva['NOMBRE'] === $nombreCliente) {
            // Eliminar la reserva del array
            unset($reservas[$key]);
            echo "<p style='color:green;'>Reserva de '$nombreCliente' eliminada correctamente.</p>";
            // Reindexamos el array para evitar huecos
            $reservas = array_values($reservas);
             $numeroMesa = count($reservas) - 1;
            return;
        }
    }

    // Si no se encuentra la reserva
    echo "<p style='color:red;'>No se encontró la reserva para '$nombreCliente'.</p>";
}





function mostrarReservas() {

    if (count($reservas) > 0) {
        echo "<h2>Reservas actuales:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Nº</th>
                    <th>Nombre</th>
                    <th>Nº Personas</th>
                    <th>Ubicación</th>
                    <th>Hora</th>
                </tr>";
        foreach ($reservas as $reserva) {
            echo "<tr>
                    <td>{$reserva['Nº']}</td>
                    <td>{$reserva['NOMBRE']}</td>
                    <td>{$reserva['PERSONAS']}</td>
                    <td>{$reserva['UBICACION']}</td>
                    <td>{$reserva['HORA']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay reservas en este momento.</p>";
    }
}
// Vemos si se ha pasado los parametros por URL
if (isset($_GET['NOMBRE']) && isset($_GET['PERSONAS'])) {
    $nombreCliente = $_GET['NOMBRE'];
    $numPersonas = intval($_GET['PERSONAS']);
    
    // si no se especifica la ubicacion o la hora ,pondremos los siguientes parametros por defecto
    $lugar = isset($_GET['UBICACION']) ? $_GET['UBICACION'] : "interior";
    $hora = isset($_GET['HORA']) ? $_GET['HORA'] : "21:00";

    // Realizamos la reserva
    realizarReserva($nombreCliente, $numPersonas, $lugar, $hora);
   
}

if (isset($_GET['ELIMINAR'])) {
    $nombreCliente = $_GET['ELIMINAR'];
    eliminarReserva($nombreCliente);
}



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Luis Nelson</title>
</head>
<body>

<?php   mostrarReservas($reservas);
        mostrarMesasDisponibles($reservas); ?>


</body>
</html>