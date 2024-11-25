<?php
// Inicialización de variables.Las inicializamos todas como campo vacio
$nombre = $apellidos = $nacimiento = $genero = $curso = $email = $password = $password2 = $comentarios = $terminos = "";
$preferencias = [];
$errores = [];

// Función para sanitizar la entrada
function sanitizar($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Verificación del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = sanitizar($_POST["nombre"]);
    $apellidos = sanitizar($_POST["apellidos"]);
    $nacimiento = $_POST["nacimiento"];
    $genero = isset($_POST["genero"]) ? sanitizar($_POST["genero"]) : "";
    $curso = isset($_POST["curso"]) ? sanitizar($_POST["curso"]) : "";
    $preferencias = isset($_POST["preferencias"]) ? $_POST["preferencias"] : [];
    $email = sanitizar($_POST["email"]);
    $password = $_POST["contrasena"];
    $password2 = $_POST["contrasena2"];
    $comentarios = sanitizar($_POST["comentarios"]);
    $terminos = isset($_POST["terminos"]) ? sanitizar($_POST["terminos"]) : "";

    // campos obligatorios
    if (empty($nombre)) $errores["nombre"] = "El nombre es obligatorio.";
    if (empty($apellidos)) $errores["apellidos"] = "El apellido es obligatorio.";
    if (empty($nacimiento)) $errores["nacimiento"] = "La fecha de nacimiento es obligatoria.";
    if (empty($genero)) $errores["genero"] = "El género es obligatorio.";
    if (empty($email)) $errores["email"] = "El email es obligatorio.";
    if (empty($password) || empty($password2)) $errores["contrasena"] = "La contraseña es obligatoria.";
    if (empty($terminos)) $errores["terminos"] = "Debe aceptar los términos y condiciones.";

    //  edad mínima (18 años)
    if (!empty($nacimiento)) {
        $fechaNacimiento = date_create($nacimiento);
        $hoy = date_create();
        $edad = date_diff($fechaNacimiento, $hoy)->y;
        if ($edad < 18) {
            $errores["nacimiento"] = "Debe ser mayor de 18 años.";
        }
    }

    // Validación de formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores["email"] = "Formato de email inválido.";
    }

    // Verificación de contraseña
    if (!empty($password) && !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
        $errores["contrasena"] = "La contraseña debe tener al menos 8 caracteres, incluir un número y letras en minúsculas y mayúsculas.";
    } elseif ($password !== $password2) {
        $errores["contrasena2"] = "Las contraseñas no coinciden.";
    }

    // Validación de unicidad de email en archivo CSV
    if (empty($errores)) {
        $archivo = fopen("usuarios.csv", "a+");
        while (($data = fgetcsv($archivo, 1000, ",")) !== FALSE) {
            if ($data[5] == $email) {
                $errores["email"] = "El email ya está registrado.";
                break;
            }
        }
        fclose($archivo);
    }

    // Almacenamiento de datos en CSV si no hay errores
    if (empty($errores)) {
        $archivo = fopen("usuarios.csv", "a+");
        $usuario = [
            $nombre,
            $apellidos,
            $nacimiento,
            $genero,
            implode(", ", $preferencias),
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $comentarios
        ];
        fputcsv($archivo, $usuario);
        fclose($archivo);
        echo "<p style='color:green'>Registro exitoso</p>";
        // Limpiar variables después del envío exitoso
        $nombre = $apellidos = $nacimiento = $genero = $curso = $email = $password = $password2 = $comentarios = $terminos = "";
        $preferencias = [];
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Usuario</title>
    <style>


    </style>
</head>
<body>
    <header>
        <h1>Formulario de Registro</h1>
    </header>
    <main>
        <form action="" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
            <?php if (isset($errores["nombre"])) echo "<p style='color:red'>{$errores['nombre']}</p>"; ?>
    <br>
    <br>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>">
            <?php if (isset($errores["apellidos"])) echo "<p style='color:red'>{$errores['apellidos']}</p>"; ?>
    <br>
    <br>
            <label for="nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="nacimiento" id="nacimiento" value="<?php echo $nacimiento; ?>">
            <?php if (isset($errores["nacimiento"])) echo "<p style='color:red'>{$errores['nacimiento']}</p>"; ?>
            <br>   <br>
            <label for="genero">Género</label>
            <br>
            <input type="radio" name="genero" value="Masculino" <?php if ($genero == "Masculino") echo "checked"; ?>> Masculino
            <input type="radio" name="genero" value="Femenino" <?php if ($genero == "Femenino") echo "checked"; ?>> Femenino
            <input type="radio" name="genero" value="Otro" <?php if ($genero == "Otro") echo "checked"; ?>> Otro
            <?php if (isset($errores["genero"])) echo "<p style='color:red'>{$errores['genero']}</p>"; ?>
    <br>
    <br>
            <label for="curso">Curso</label>
            <br>
            <br>
            <select name="curso" id="curso">
                <option value=""></option>
                <option value="1DAW" <?php if ($curso == "1DAW") echo "selected"; ?>>1DAW</option>
                <option value="2DAW" <?php if ($curso == "2DAW") echo "selected"; ?>>2DAW</option>
            </select>

            <br>
            <br>

            <fieldset>
                <legend>Preferencias</legend>
                <input type="checkbox" name="preferencias[]" value="Deportes" <?php if (in_array("Deportes", $preferencias)) echo "checked"; ?>> Deportes
                <input type="checkbox" name="preferencias[]" value="Musica" <?php if (in_array("Musica", $preferencias)) echo "checked"; ?>> Música
                <input type="checkbox" name="preferencias[]" value="Viajes" <?php if (in_array("Viajes", $preferencias)) echo "checked"; ?>> Viajes
            </fieldset>
            <br>   <br>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>">
            <?php if (isset($errores["email"])) echo "<p style='color:red'>{$errores['email']}</p>"; ?>
   <br>   <br>
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena">
            <?php if (isset($errores["contrasena"])) echo "<p style='color:red'>{$errores['contrasena']}</p>"; ?>

            <label for="contrasena2">Confirmar Contraseña</label>
            <input type="password" name="contrasena2" id="contrasena2">
            <?php if (isset($errores["contrasena2"])) echo "<p style='color:red'>{$errores['contrasena2']}</p>"; ?>
            <br>   <br>
            <label for="comentarios">Comentarios</label>
            <textarea name="comentarios" id="comentarios"><?php echo $comentarios; ?></textarea>
            <br>   <br>
            <input type="checkbox" name="terminos" id="terminos" <?php if ($terminos) echo "checked"; ?>> Acepto los términos y condiciones
            <?php if (isset($errores["terminos"])) echo "<p style='color:red'>{$errores['terminos']}</p>"; ?>

            <button type="submit">Enviar</button>
            <button type="reset">Restaurar</button>
        </form>
    </main>
</body>
</html>
