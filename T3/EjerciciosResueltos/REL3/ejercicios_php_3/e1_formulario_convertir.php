<?php
/**
 * Ejercicio realizado por P.Lluyot. 2DAW
 */
// Inicializamos las variables
$celsius = "";
$fahrenheit = "";

// Verificamos si el formulario ha sido enviado y el campo 'celsius' está definido
//no sería necesario verificar el método pero lo incluyo para que se conozca com oobtenerlo.
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['convertir'])) {
    // Comprobamos que el campo celsius no esté vacío
    if (isset($_GET['celsius']) && !empty($_GET['celsius'])) {
        // Recuperamos el valor ingresado, lo convertimos a float y calculamos Fahrenheit
        $celsius = floatval($_GET['celsius']);
        $fahrenheit = ($celsius * 9 / 5) + 32;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Celsius a Fahrenheit</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <header>
        <h2>Conversor de Celsius a Fahrenheit</h2>
    </header>
    <main>
        <!-- Mostrar el resultado si se ha realizado la conversión -->
        <?php if ($fahrenheit !== "") {
            echo "<h3>Resultado: $celsius °C son $fahrenheit °F</h3>";
        } ?>
        <p><a href="e1_formulario_get.php">volver</a></p>
    </main>
    <footer>
        <p>P.Lluyot</p>
    </footer>
</body>

</html>