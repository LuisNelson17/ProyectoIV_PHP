<?php
$mensaje = "";
$nombre = "";
$apellidos = "";

// Verificamos si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === "GET") {

    //$nombre = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '';
    //si sanitizo antes de contar, no cuenta correcamente los caracteres por lo que sanitizo después
    //$nombre = htmlspecialchars($_GET['nombre'] ?? '');
    $nombre=$_GET['nombre']??''; 
    //$apellidos = isset($_GET['apellidos']) ? htmlspecialchars($_GET['apellidos']) : '';
    //$apellidos = htmlspecialchars($_GET['apellidos'] ?? '');
    $apellidos=$_GET['apellidos']??'';

    // Verificamos si los campos están llenos
    if (!empty($nombre) && !empty($apellidos)) {
        //ahora comprobamos si la longitud de nombre es <=25 y apellidos <=35
        if (strlen($nombre) > 25) $mensaje .= "EL nombre no debe tener una longitud de más de 25 caracteres<br>";
        elseif (strlen($apellidos) > 35) $mensaje .= "Los apellidos no debe tener una longitud de más 35 caracteres</br>";
        else
            $mensaje = "Formulario enviado correctamente. Nombre: ".htmlspecialchars($nombre) .", Apellidos: ". htmlspecialchars($apellidos);
    } else {
        $mensaje = "Por favor, rellena todos los campos.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <header>
        <h2>Formulario empleado</h2>
    </header>
    <main>
        <!--ejemplo de formulario con get -->
        <form action="" method="get">
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre2" id="nombre" placeholder="<<Nombre del empleado>>" required value="<?= htmlspecialchars($nombre); ?>">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" placeholder="<<Apellidos del empleado>>" required value="<?= htmlspecialchars($apellidos); ?>">
            </p>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        <p class="notice"><?php echo $mensaje; ?></p>
    </main>
    <footer>P.Lluyot-24</footer>
</body>

</html>