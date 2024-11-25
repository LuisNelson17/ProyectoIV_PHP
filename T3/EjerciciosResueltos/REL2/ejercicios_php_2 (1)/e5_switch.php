<?php
    /**
    * Ejercicio realizado por P.Lluyot. 2DAW
    */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body><?php
        $fruta = "Platano";
        switch ($fruta) {
            case "manzana":
                echo "El color es rojo";
                break;
            case ("plátano" || "Platano"):
                echo "El color es amarillo";
                break;
            case "naranja":
                echo "El color es naranja";
                break;
            default:
                echo "Color no disponible";
        }
        ?>
</body>

</html>