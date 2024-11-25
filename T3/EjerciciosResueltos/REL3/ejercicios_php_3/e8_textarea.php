<?php
// Inicializamos las variables
$texto = '';
$errores = [];
//estadísticas
$longitud = 0;
$num_palabras = 0;
$num_lineas = 0;
$num_espacios = 0;
$porcentaje_espacios = 0;
$frecuencia_vocales = [];

// Función para sanitizar el texto
function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Comprobamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Recogemos el texto del textarea
    $texto = $_POST['texto'] ?? '';

    // Validamos que no esté vacío
    if (empty($texto)) {
        $errores['texto'] = "El campo de texto no puede estar vacío.";
    }
    // Validamos que no exceda los 500 caracteres
    elseif (strlen($texto) > 500) {
        $errores['texto'] = "El texto no puede exceder los 500 caracteres.";
    }

    // Si no hay errores, procesamos el texto
    if (empty($errores['texto'])) {
        //sanitizamos el texto
        $texto = test_input($texto);

        // Estadísticas del texto
        $longitud = strlen($texto);                          // Longitud del texto
        $num_palabras = str_word_count($texto);              // Número de palabras
        $num_lineas = substr_count($texto, "\n") + 1;        // Número de líneas
        $num_espacios = substr_count($texto, ' ');           // Número de espacios en blanco
        $porcentaje_espacios = ($num_espacios / $longitud) * 100;  // Porcentaje de espacios en blanco

        // Frecuencia de vocales
        $frecuencia_vocales = [
            'a' => substr_count(strtolower($texto), 'a'),
            'e' => substr_count(strtolower($texto), 'e'),
            'i' => substr_count(strtolower($texto), 'i'),
            'o' => substr_count(strtolower($texto), 'o'),
            'u' => substr_count(strtolower($texto), 'u')
        ];
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
        <h2>Estadísticas de un texto</h2>
    </header>
    <main>
        <!-- Formulario HTML -->
        <form method="POST" action="">
            <p>
            <label for="texto">Escribe tu texto:</label><br>
            <textarea name="texto" id="texto" rows="5" cols="50"><?php echo htmlspecialchars($texto); ?></textarea><br>
            <span><?php echo $errores['texto'] ?? ''; ?></span>
        </p>
            <input type="submit" name="submit" value="Analizar Texto">
        </form>
        <!-- Mostrar resultados si no hay errores -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errores)) { ?>
            <div class="notice">
                <h3>Estadísticas del texto:</h3>
                <p><strong>Longitud del texto:</strong> <?php echo $longitud; ?> caracteres</p>
                <p><strong>Número de palabras:</strong> <?php echo $num_palabras; ?></p>
                <p><strong>Número de líneas:</strong> <?php echo $num_lineas; ?></p>
                <p><strong>Porcentaje de espacios en blanco:</strong> <?php echo round($porcentaje_espacios, 2); ?>%</p>
                <p><strong>Frecuencia de vocales:</strong></p>
                <ul>
                    <li>a: <?php echo $frecuencia_vocales['a']; ?></li>
                    <li>e: <?php echo $frecuencia_vocales['e']; ?></li>
                    <li>i: <?php echo $frecuencia_vocales['i']; ?></li>
                    <li>o: <?php echo $frecuencia_vocales['o']; ?></li>
                    <li>u: <?php echo $frecuencia_vocales['u']; ?></li>
                </ul>
            </div>


        <?php  } ?>

    </main>
    <footer>
        <p>P.Lluyot</p>
    </footer>
</body>

</html>