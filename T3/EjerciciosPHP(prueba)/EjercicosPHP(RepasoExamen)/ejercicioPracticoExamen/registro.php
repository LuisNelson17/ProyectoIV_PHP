<?php
// Inicializar variables para almacenar mensajes y valores
$error = "";
$mensaje = "";
$nombre = $edad = $correo = $password = "";

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar y limpiar los datos del formulario
    $nombre = trim($_POST["nombre"]);
    $edad = trim($_POST["edad"]);
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    // Validar que todos los campos estén completos
    if (empty($nombre) || empty($edad) || empty($correo) || empty($password)) {
        $error = "Por favor, completa todos los campos.";
    }
    // Validar que la edad esté en el rango permitido
    elseif (!is_numeric($edad) || $edad < 18 || $edad > 100) {
        $error = "La edad debe ser un número entre 18 y 100.";
    }
    // Validar el formato de correo electrónico
    elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electrónico no es válido.";
    }
    // Validar que la contraseña tenga al menos 6 caracteres
    elseif (strlen($password) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        // Si todos los datos son válidos
        $mensaje = "Bienvenido, $nombre. Tu registro ha sido exitoso.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Formulario de Registro</h2>

    <!-- Mostrar mensaje de error o confirmación -->
    <?php if (!empty($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } elseif (!empty($mensaje)) { ?>
        <p style="color: green;"><?php echo $mensaje; ?></p>
    <?php } ?>

    <!-- Formulario de Registro -->
    <form method="POST" action="registro.php">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>"><br><br>

        <label for="edad">Edad:</label><br>
        <input type="number" id="edad" name="edad" value="<?php echo htmlspecialchars($edad); ?>"><br><br>

        <label for="correo">Correo Electrónico:</label><br>
        <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>"><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Registrarse">
    </form>
</body>
</html>