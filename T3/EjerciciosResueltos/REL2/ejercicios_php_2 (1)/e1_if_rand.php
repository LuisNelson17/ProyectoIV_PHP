<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body><?php
        $temperatura = rand(-5,45);
        if ($temperatura >= 30) {
            echo "$temperatura: Hace calor";
        } elseif ($temperatura < 15) {
            echo "$temperatura: Hace frío";
        } else {
            echo "$temperatura: El clima es templado";
        }
        ?>
</body>

</html>