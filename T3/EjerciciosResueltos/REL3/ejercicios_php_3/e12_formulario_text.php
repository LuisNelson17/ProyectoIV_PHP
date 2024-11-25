<?php
const DIR_TEMPORAL = 'tmp/';
$id_unico = "";
$mensaje = "";
$preguntas_seleccionadas = [];
$fin = false;

//si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['enviar']) && $_POST['enviar']=="Enviar") {

    // Obtener el ID único
    $id_unico = $_POST['id_unico'];
    $archivo_respuestas = DIR_TEMPORAL . "respuestas_$id_unico.txt";

    // Leer las respuestas correctas desde el archivo temporal
    $respuestas_correctas = unserialize(file_get_contents($archivo_respuestas));

    //si no ha habido error al recuperar los datos del fichero.
    if ($respuestas_correctas == false) {
        $mensaje = "Error al recuperar las soluciones al test.";
    } else { //si hemos recuperado las soluciones del test
        // Guardar las respuestas del usuario
        for ($i = 0; $i < count($respuestas_correctas); $i++) {
            if (isset($_POST["respuesta_$i"])) {
                $respuestas_usuario[$i] = $_POST["respuesta_$i"]; // Almacena la respuesta seleccionada
            } else {
                $respuestas_usuario[$i] = ''; // En caso de que no haya respuesta, se asigna una cadena vacía
            }
        }
        // Contar aciertos
        $aciertos = 0;
        foreach ($respuestas_correctas as $i => $respuesta_correcta) {
            if (isset($respuestas_usuario[$i]) && $_POST["respuesta_$i"] == $respuesta_correcta) {
                $aciertos++; //acumulamos los aciertos
            }
        }
        // Mostrar el resultado
        $mensaje =  "Has acertado $aciertos de " . count($respuestas_correctas) . " preguntas.";
        //si ya tenemos las respuestas eliminamos el id_unico almacenado.
        $id_unico = "";
        // Eliminar el archivo temporal
        unlink($archivo_respuestas);
    }
    //ponemos el flag a true para saber que ha finalizado el test.
    $fin = true;
}
// se debe generar la página con los test
//cargamos esta parte la primera vez que se inicia la página.
else {


    // Cargar preguntas desde archivo JSON
    $contenido = file_get_contents('e12_preguntas.json');
    //transformamos el JSON a un array asociativo
    $preguntas = json_decode($contenido, true);

    // Seleccionar 3 preguntas aleatorias del array anterior
    $preguntas_seleccionadas = array_rand($preguntas, 3);

    // Generar un ID único para almacenar las respuestas correctas
    $id_unico = uniqid(); //este id lo almacenaremos en el formulario en un campo hidden.
    $archivo_respuestas = "tmp/respuestas_$id_unico.txt"; //nombre que recibirá el archivo

    // Extraer las respuestas correctas
    $respuestas_correctas = [];
    foreach ($preguntas_seleccionadas as $indice) {
        $respuestas_correctas[] = $preguntas[$indice]['respuesta_correcta'];
    }

    // Guardar las respuestas correctas en un archivo temporal (serializamos las respuestas en un string)
    file_put_contents($archivo_respuestas, serialize($respuestas_correctas));
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
        :root {
            --accent: green;
            --accent-hover: rgba(0, 255, 0, 200);
        }
    </style>
</head>
<body>
    <header>
        <h2>Test</h2>
    </header>
    <main>
        <form method='post' action='e12_formulario_text.php'>
            <?php
            if (!empty($preguntas_seleccionadas)) {
                foreach ($preguntas_seleccionadas as $i => $indice) {
                    echo "<label for='respuesta_$i'>{$preguntas[$indice]['pregunta']}</label><br>";
                    foreach ($preguntas[$indice]['opciones'] as $opcion) {
                        // Verifica si la opción fue seleccionada por el usuario
                        $checked = isset($respuestas_usuario[$i]) && $respuestas_usuario[$i] === $opcion ? 'checked' : '';
                        echo "<input type='radio' name='respuesta_$i' value='$opcion' required $checked> $opcion<br>";
                    }
                }
            }
            // Generar el formulario con las preguntas
            ?>
            <!-- id único oculto -->
            <input type='hidden' name='id_unico' value='<?= $id_unico; ?>'>
            <input type='submit' name="enviar" value='<?=($fin==1?'Iniciar':'Enviar');?>'>
        </form>
        <?php
        echo (!empty($mensaje)?  "<p class='notice'>$mensaje</p>" : "");
        ?>

    </main>
    <footer>
        <p>P.Lluyot</p>
    </footer>
</body>

</html>