<?php
$mensaje = "";
$numero1 = "";
$numero2 = "";
//comprobamos el método del formulario
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //
    if (isset($_POST['numero1']) && isset($_POST['numero2']))
    //!empty($_POST['numero1']) && !empty($_POST['numero2']))
    {

        //recogemos los valores
        $numero1 = floatval($_POST['numero1']); //(no es necesario usar htmlspecialchars)
        $numero2 = floatval($_POST['numero2']);
        $operacion = htmlspecialchars($_POST['operacion'])??''; 

        //controlamos que la división no sea entre un número 0
        if ($operacion == "/" && $numero2 == 0)
            $mensaje = "Err: división entre número 0";
        //realizamos la operación
        else {
            // Realizamos la operación según el operador seleccionado
            switch ($operacion) {
                case '+':
                    $resultado = $numero1 + $numero2;
                    break;
                case '-':
                    $resultado = $numero1 - $numero2;
                    break;
                case '*':
                    $resultado = $numero1 * $numero2;
                    break;
                case '/':
                    $resultado = $numero1 / $numero2;
                    break;
            }
            // Formamos el mensaje con la operación y el resultado
            $mensaje = "$numero1 $operacion $numero2 = $resultado";
        }
    } else {
        $mensaje = "Error en el envío de parámetros";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>

    <header>
        <h3>Calculadora</h3>
    </header>
    <main>
        <form name="frmcalc" action="e2_calc.php" method="post">
            <p>
                <label for="numero1">Número 1:</label>
                <input type="number" step="any" name="numero1" placeholder="introduce el primer número" value="<?=$numero1;?>">
                <label for="numero2">Número 2:</label>
                <input type="number" name="numero2" placeholder="introduce el segundo número" value="<?=$numero2;?>" >

            </p>
            <input type="submit" name="operacion" value="+">
            <input type="submit" name="operacion" value="-">
            <input type="submit" name="operacion" value="*">
            <input type="submit" name="operacion" value="/">
        </form>
        <?php
        if (!empty($mensaje))
            echo "<p class='notice'>$mensaje</p>";

        ?>
    </main>

</body>

</html>