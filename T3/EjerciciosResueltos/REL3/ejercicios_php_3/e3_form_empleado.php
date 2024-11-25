<?php
$mensaje = "";
$nombre = "";
$apellidos = "";

// Verificamos si el formulario ha sido enviado
if (isset($_GET['enviar'])) {

    $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
    $apellidos = isset($_GET['apellidos']) ? $_GET['apellidos'] : '';
    // $nombre = $_GET['nombre']??'';
    // $apellidos = $_GET['apellidos']??'';

    //OJO: nombre y apellidos no están satinizados!!!

    // Verificamos si los campos están llenos
    if (!empty($nombre) && !empty($apellidos)) {
        //ahora comprobamos si la longitud de nombre es <=25 y apellidos <=35
        if (strlen($nombre) > 25) $mensaje .= "EL nombre no debe tener una longitud de más de 25 caracteres<br>";
        elseif (strlen($apellidos) > 35) $mensaje .= "Los apellidos no debe tener una longitud de más 35 caracteres</br>";
        else
            $mensaje = "Formulario enviado correctamente.<br>--> Nombre: $nombre<br>--> Apellidos: $apellidos";
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
    <!-- <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css"> -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">


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
                <input type="text" name="nombre" id="nombre" size="20"  placeholder="<<Nombre del empleado>>" required value="<?= $nombre; ?>">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" size="40" placeholder="<<Apellidos del empleado>>" required value="<?= $apellidos; ?>">
            </p>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        <?php
            echo !empty($mensaje)?"<p class='notice'>".$mensaje."</p>":"";
        ?>
        </main>
    <footer>P.Lluyot-24</footer>
</body>

</html>