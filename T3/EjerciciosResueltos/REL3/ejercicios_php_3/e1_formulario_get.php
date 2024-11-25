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
    <title>Conversor de Celsius a Fahrenheit</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <header>
        <h2>Conversor de Celsius a Fahrenheit</h2>
    </header>
    <main>
        <!-- Formulario para ingresar la temperatura en Celsius -->
        <form action="e1_formulario_convertir.php" method="get">
            <p>
                <label for="celsius">Grados Celsius:</label>
                <input type="number" step="0.01" name="celsius" id="celsius" placeholder="Introduce la temperatura" required>
            </p>

            <!-- Botón para convertir -->
            <input type="submit" name="convertir" value="Convertir">
            <!-- Botón para limpiar el formulario -->
            <input type="reset" name="reset" value="Limpiar">
        </form>
    </main>
    <footer>
        <p>P.Lluyot</p>
    </footer>
</body>

</html>