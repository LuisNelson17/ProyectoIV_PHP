
<?php
    $textoIngresado;
    $MAX_TEXTO=500;

    if(isset($_SERVER['REQUEST_METHOD'])=='POST'&& isset($_POST['campoTexto'])){
        $textoIngresado= $_POST['campoTexto'];
        $textoIngresado=validarTexto($textoIngresado);
        echo " <p>Tu texto es: $textoIngresado</p>";
    }else{
        echo "<p>el texto está vacio</p>";
    }
    
    echo '<p>la longitud del texto es: '.longuitudTexto($textoIngresado).'</p>';
    
    echo '<p>numero de palabras: '.contarPalabras($textoIngresado).'</p>';

    echo '<p>numero de lineas: '.contarNumeroLineas($textoIngresado).'</p>';

    function longuitudTexto($texto){
        global $MAX_TEXTO;
        if(strlen($texto)>$MAX_TEXTO){
            return  'El texto sobrepasa las '.$MAX_TEXTO.' palabras';
        }
       $textoLongitud= strlen($texto);
       
       return $textoLongitud;
       
    }


    function validarTexto($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    function contarPalabras($texto){
        $contadorPalabras=null;
        $contadorPalabras=str_word_count($texto);
        return $contadorPalabras;
    }

    function contarNumeroLineas($texto){
        $numeroLineas=$texto;
        $numeroLineas= substr_count($texto, "\n");
        return $numeroLineas;
    }
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='https://cdn.simplecss.org/simple.min.css'>
    <title>Luis Nelson</title>
</head>
<body>

</body>
</html>