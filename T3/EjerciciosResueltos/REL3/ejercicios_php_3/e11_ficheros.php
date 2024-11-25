<?php

$nombre_archivo = "";
$mensaje = "";
$errores = [];
$ruta_palabras = "palabras/"; // Ruta donde se guardarán los archivos

// Si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
    $nombre_archivo = trim($_POST['nombre']); // Obtener el nombre del archivo
    $fichero = $_FILES['fichero']; // Obtener la información del archivo

    // Validar el nombre del archivo
    if (empty($nombre_archivo) || strlen($nombre_archivo) < 3 || strlen($nombre_archivo) > 30) {
        $errores['nombre'] = "El nombre del archivo debe tener entre 3 y 30 caracteres.";
    }
    // Validar el fichero

    // Validar la extensión y tamaño
    $tipo = pathinfo($fichero['name'], PATHINFO_EXTENSION);
    $tamanyo = $fichero['size']; // Tamaño en bytes

    // Comprobaciones de validación
    if ($fichero['error'] !== UPLOAD_ERR_OK) {
        $errores['fichero'] = "Error al subir el archivo.";
    } elseif ($tipo !== 'txt') {
        $errores['fichero'] = "El archivo debe ser de tipo .txt.";
    } elseif ($tamanyo > 100) {
        $errores['fichero'] = "El archivo no puede exceder los 100 bytes.";
    } else {
        // Leer el contenido del archivo
        $contenido = file_get_contents($fichero['tmp_name']);
        $palabras = explode(',', $contenido);
        $palabras = array_map('trim', $palabras); // Eliminar espacios alrededor de las palabras

        // Verificar que haya exactamente 5 palabras
        if (count($palabras) !== 5) {
            $errores['fichero'] = "El archivo debe contener exactamente 5 palabras separadas por comas.";
        } else {
            // Verificar que el archivo no exista previamente
            $ruta_fichero = $ruta_palabras . $nombre_archivo . ".txt";
            if (file_exists($ruta_fichero)) {
                $errores['fichero'] = "El archivo '$nombre_archivo.txt' ya existe.";
            }
        }
    }

    // Si no hay errores, guardar el archivo
    if (empty($errores)) {
        if (move_uploaded_file($fichero['tmp_name'], $ruta_fichero)) {
            $mensaje = "Fichero '$nombre_archivo.txt' subido con éxito.";
            // Ordenar las palabras alfabéticamente
            sort($palabras);
        } else {
            $mensaje = "No se pudo mover el fichero '$nombre_archivo.txt'.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subida de Fichero</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        .error {
            display: block;
            font-size: small;
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <h1>Subida de Fichero de Palabras</h1>
    </header>
    <main>
        <form action="" method="post" enctype="multipart/form-data">
            <h4>Introduce el nombre del archivo y selecciona un fichero .txt</h4>
            <p>
                <label for="nombre">Nombre del archivo:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre_archivo); ?>">
                <?php if (!empty($errores['nombre'])) echo "<span class='error'>{$errores['nombre']}</span>"; ?>
            </p>
            <p>
                <label for="fichero">Selecciona un archivo .txt:</label>
                <input type="file" name="fichero" id="fichero" accept=".txt">
                <?php if (!empty($errores['fichero'])) echo "<span class='error'>{$errores['fichero']}</span>"; ?>
            </p>
            <input type="submit" name="enviar" value="Subir">
        </form>

        <?php if (!empty($mensaje)) echo "<p class='notice'>$mensaje</p>"; ?>

        <?php if (isset($palabras) && empty($errores)): ?>
            <h4>Palabras del archivo:</h4>
            <ul>
                <?php foreach ($palabras as $palabra): ?>
                    <li><?php echo htmlspecialchars($palabra); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
    <footer>
        <p>P.Lluyot-24</p>
    </footer>
</body>

</html>