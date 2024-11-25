<?php

$fichero = [];
$mensaje = "";
$errores = [];
$ruta_imagenes = "img/";
$ruta_fichero = "";

//si se ha dado a enviar imagen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
    //validamos que el archivo se ha enviado correctamente
    //fichero es un array
    $fichero = $_FILES['fichero_imagen']; //si no viene ver que trae
    //si hay error
    if ($fichero['error'] !== UPLOAD_ERR_OK)  $errores['fichero_imagen'] = "Error al obtener el fichero";
    else{ //si no hay error
        $tipo = $fichero['type']; //tipo mime
        //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $tamanyo = $fichero['size'] / (1024 * 1024); //tamaño en bytes -> Mb

        //validación -----------------------------------------------------------
        // Validar el tipo de archivo (solo imágenes jpg, jpeg, png)
        $formatos_permitidos = ['image/jpg', 'image/jpeg', 'image/png'];
        //$check = getimagesize($fichero["tmp_name"]);
        if (!in_array($tipo, $formatos_permitidos))
            $errores['fichero_imagen'] = "El fichero no es una imagen permitida\n";
        elseif ($tamanyo > 2)
            $errores['fichero_imagen'] = "El fichero no puede tener más de 2 MB\n";

        // si todo ha ido correctamente:
        if (empty($errores)) {
            //obtenemos la ruta del fichero (la última parte del fichero)
            $ruta_fichero = $ruta_imagenes . basename($fichero["name"]);
            //movemos el fichero temporal a la ruta correcta con el nombre correcto
            if (move_uploaded_file($fichero["tmp_name"], $ruta_fichero)) {
                //generamos un mensaje de éxito.
                $mensaje = "Fichero subido con éxito !!";
            } else {
                $mensaje = "No se ha subir el Fichero &quot;{$fichero['name']}&quot;";
            }
        }
    }
    // echo "<pre>" . print_r($fichero, true) . "</pre>";
}
?>
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>P.Lluyot</title>
    <link rel='stylesheet' href='https://cdn.simplecss.org/simple.min.css'>
    <style>
        .error {
            display: block;
            font-size: small;
            color: red;
        }

        .img {
            text-align: center;
            max-width: 500px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Subida de archivos</h1>
    </header>
    <main>

        <form action="e10_archivos.php" method="post" enctype="multipart/form-data">
            <h4>Selecciona una imagen de tu equipo en formato png, jpg o jpeg</h4>
            <p>
                <input type="file" name="fichero_imagen" id="fichero_imagen">
                <?php if (!empty($errores['fichero_imagen'])) echo "<span class='error'>{$errores['fichero_imagen']}</span>"; ?>
            </p>
            <input type="submit" name="enviar" value="enviar">
        </form>
        <!-- Si la imagen se ha subido correctamente, la mostramos -->
        <?php
        if (!empty($ruta_fichero) && empty($errores))  
            echo "<img src='$ruta_fichero' alt='Imagen subida'>";

        ?>
       
        <!-- mostramos un mensaje informativo -->
        <?php
        if (!empty($mensaje)) ?>
        <p class='notice'><?= $mensaje; ?></p>
    </main>
    <footer>
        <p>P.Lluyot</p>
    </footer>
</body>

</html>