<?php
/**
* Ejercicio realizado por P.Lluyot. 2DAW
*/
    $numero="";
    //código php
    require_once("misfunciones.php");

    if ($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['generar'])){
        $numero = intval($_POST['numero']??'');
        if ($numero<=0 || $numero>10) $mensaje ="El número debe estar comprendido entre 0 y 10 "; //die("error fatal");
        else {//si existe el número llamamos a una tabla para que me genere la tabkla de multiplicar
        //generamos un array bidimensional
        $arrayNum=[];
        for ($i=1;$i<=10;$i++){
            $arrayNum[]=['operacion'=> "$i x $numero", 'resultado'=> ($i * $numero)];    
        }
        
        $mensaje = "<h3>Tabla del $numero</h3>".tablaArrayHTML($arrayNum);
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
    <header><h3>Tabla de multiplicar</h3></header>
    <main>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <p>
                <label for="numero">Número</label>
                <input type="number" step="1" name="numero" id="numero" min="1" max="10" value="<?=$numero?>">
            </p>
            <input type="submit" name="generar" value="Generar">
        </form>
        <?php if (!empty($mensaje)){
            echo $mensaje;
        }?>
    </main>
    <footer><p>P.Lluyot</p></footer>
</body>
</html>