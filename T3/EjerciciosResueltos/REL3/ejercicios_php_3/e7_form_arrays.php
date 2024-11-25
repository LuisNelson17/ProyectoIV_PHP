<?php

// Verificar si hay tareas serializadas en el POST
$tareas = [];
if ($_SERVER['REQUEST_METHOD'] === "POST" ) {
    $accion = $_POST['accion']??'';
    $accion = isset($_POST['accion']) ? htmlspecialchars($_POST['accion']) : '';

    switch ($accion) {
        case 'Borrar Tareas':
            $tareas = []; // Reiniciar el array de tareas
            break;
        case 'Agregar Tarea':
            // Verificar si el campo de tareas serializadas existe
            if (isset($_POST['tareas_serializadas'])) {
                // Deserializar las tareas
                $tareas = unserialize($_POST['tareas_serializadas']);
            }
            // Obtener la nueva tarea
            $nueva_tarea = trim($_POST['tarea']);

            // Validar que la tarea no esté vacía y sanitizarla
            if (!empty($nueva_tarea)) {
                $nueva_tarea = htmlspecialchars($nueva_tarea); // Sanitizar entrada
                                // Agregar la nueva tarea al array
                $tareas[] = $nueva_tarea;
            }
            break;
    }
}




?>
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>P.Lluyot</title>
    <link rel='stylesheet' href='https://cdn.simplecss.org/simple.min.css'>
</head>

<body>

    <header>
        <h1>Ejercicio con formularios y arrays serializados</h1>
    </header>
    <main>
        <h2>Registrar Tarea</h2>
        <form method="POST" action="">
            <p>
                <label for="tarea">Tarea:</label>
                <input type="text" id="tarea" name="tarea">
                <!-- Campo oculto para las tareas serializadas -->
                <input type="hidden" name="tareas_serializadas" value="<?php echo htmlspecialchars(serialize($tareas)); ?>">
            </p>
            <input type="submit" value="Agregar Tarea" name="accion">
            <input type="submit" value="Borrar Tareas" name="accion">
            <input type="reset" value="botón reset">
        </form>

        <h2>Tareas Registradas</h2>

        <?php 
        if (empty($tareas))
            echo "<p class='notice'>No hay tareas registradas.</p>";
        else {
            echo "<ol>";
            foreach ($tareas as $tarea) {
                echo "<li>" . htmlspecialchars($tarea) . "</li>";
            }
            echo "</ol>";
        }
        
        ?>

    </main>
    <footer>
        <p>P.Lluyot</p>
    </footer>
</body>

</html>