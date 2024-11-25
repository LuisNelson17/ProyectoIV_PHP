<?php
//código php
$caracteres = "";
$password = "";
$longitud = "";
$numeros = false;
$minusculas = false;
$mayusculas = false;
$especiales = false;

$mensaje = "";

//funcion que se le pasa una cadena y devuelve un caracter al azar
function char_aleatorio($cadena)
{
    $arr_cadena = str_split($cadena);
    $long = count($arr_cadena);
    $caracter = $arr_cadena[rand(0, $long - 1)];
    return $caracter;
}

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['generar'])) {
    $longitud = intval($_GET['longitud'] ?? "");
    $numeros = isset($_GET['numeros']) ? true : false;
    $minusculas = isset($_GET['minusculas']) ? true : false; //no hace falta poner el operador ternario
    $mayusculas = isset($_GET['mayusculas']);
    $especiales = isset($_GET['especiales']);


    if ($longitud < 8 || $longitud > 16) {
        $mensaje = "La longitud de la contraseña debe estar comprendida entre 8 y 16 caracteres";
    } elseif (!($numeros || $minusculas || $mayusculas || $especiales)) {
        $mensaje = "debes marcar uno de los checkbox para generar la contraseña";
    } else {
        if ($numeros) {
            $caracteres .= "0123456789";
            $password .= char_aleatorio("0123456789");
        }
        if ($minusculas) {
            $caracteres .= "abcdefghijklmnopqrstuvwxyz";
            $password .= char_aleatorio("abcdefghijklmnopqrstuvwxyz");
        }
        if ($mayusculas) {
            $caracteres .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $password .= char_aleatorio("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        }
        if ($especiales) {
            $caracteres .= "!\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~";
            $password .= char_aleatorio("!\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~");
        }
        //$arr_caracteres = str_split($caracteres);
        //$num_caracteres = count($arr_caracteres);
        //shuffle($arr_caracteres);
        for ($i = strlen($password); $i < $longitud; $i++) {
            $password .= char_aleatorio($caracteres);
        }
        //reordenamos aleatoriamente la cadena ya que siempre en primer lugar poníamos
        //un tipo de cada uno.
        $password=str_shuffle($password);
        $mensaje = "La contraseña elegida es:  <b>$password</b>";//<br> Caracteres elegidos ($caracteres)";
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
        <h2>Generador de Contraseñas</h2>
    </header>
    <main>
        <!-- código php -->

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
            <p>
                <label for="longitud">Longitud</label>
                <input type="number" name="longitud" id="longitud" min="8" max="16" value="<?= $longitud ?>">
                </p>
<p>
                <input type="checkbox" name="minusculas" id="minusculas" <?php echo ($minusculas ? 'checked' : ''); ?>>
            <label for="minusculas">Minúsculas</label>
</p><p> 
            <input type="checkbox" name="mayusculas" id="mayusculas" <?php echo ($mayusculas ? 'checked' : ''); ?>>
            <label for="mayusculas">Mayúsculas</label>
</p><p>
            <input type="checkbox" name="numeros" id="numeros" <?php echo ($numeros ? 'checked' : ''); ?>>
            <label for="numeros">Números</label>
       </p><p>     
            <input type="checkbox" name="especiales" id="especiales" <?php echo ($especiales ? 'checked' : ''); ?>>
            <label for="especiales">Caracteres Especiales</label>
</p>
            <input type="submit" value="generar" name="generar">
        </form>

        <p class='notice'><?php echo $mensaje; ?></p>
       
    </main>
    <footer>
        <p>P.Lluyot</p>
    </footer>
</body>

</html>