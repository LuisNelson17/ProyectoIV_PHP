<?php
// Arrays de texto por estilo literario
$estilos_literarios = [
    'Narrativo' => [
        'Había una vez en un reino muy lejano...',
        'El héroe se lanzó a la batalla sin dudarlo...',
        'Aquella noche, el viento silbaba entre los árboles...',
        'Aquella noche, el viento silbaba entre los árboles...'
    ],
    'Poético' => [
        'El viento susurra, la luna brilla...',
        'Entre el mar y la arena, danzan las estrellas...',
        'La vida es un suspiro, un breve instante...'
    ],
    'Ensayo' => [
        'El arte es una manifestación de la cultura humana...',
        'La historia nos enseña que la repetición de errores es común...',
        'La tecnología ha transformado nuestra sociedad en múltiples formas...'
    ]
];

// Variables iniciales
$color_fondo = '';
$fuente = '';
$estilo_literario='';
$texto = '';

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $color_fondo = htmlspecialchars($_POST['color_fondo']) ?? '';
    $fuente = htmlspecialchars($_POST['fuente']) ?? '';
    $estilo_literario = htmlspecialchars($_POST['estilo_literario']) ?? '';

    // Obtener un texto aleatorio del estilo literario seleccionado
    if (isset($estilos_literarios[$estilo_literario])) {

        $indice = array_rand($estilos_literarios[$estilo_literario]);
        $texto =  $estilos_literarios[$estilo_literario][$indice];

        // otra forma de hacerlo
        // $textos = $estilos_literarios[$estilo_literario];
        // $texto = $textos[array_rand($textos)];

    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalización de Estilo</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">

    <style>
        /* Definimos las fuentes que se podrán elegir */
        @import url('https://fonts.googleapis.com/css2?family=Arial&family=Courier+New&family=Verdana&display=swap');
    </style>
</head>

<body>
    <header>
        <h2>Generación de textos</h2>
    </header>
    <main>
        <!-- Formulario -->
        <form method="POST" action="">
            <p>
            <label for="color_fondo">Elige el color de fondo:</label>
            <select name="color_fondo" id="color_fondo">
                <?php
                  /*
                  <option value="red" <?= $color_fondo === 'red' ? 'selected' : '' ?>>Rojo</option>
                <option value="blue" <?= $color_fondo === 'blue' ? 'selected' : '' ?>>Azul</option>
                <option value="green" <?= $color_fondo === 'green' ? 'selected' : '' ?>>Verde</option>
                
                  */   
                ?>
                <option value="#e69691" <?php echo ($color_fondo === '#e69691' ? 'selected' : ''); ?>>Rojo</option>
                <option value="#98a9ed" <?= $color_fondo === '#98a9ed' ? 'selected' : ''; ?>>Azul</option>
                <option value="#9df5b4" <?php if($color_fondo === '#9df5b4') echo 'selected'; ?>>Verde</option>
            </select>
            
            <label for="fuente">Elige la fuente:</label>
            <select name="fuente" id="fuente">
                <option value="Arial" <?= $fuente === 'Arial' ? 'selected' : '' ?>>Arial</option>
                <option value="Verdana" <?= $fuente === 'Verdana' ? 'selected' : '' ?>>Verdana</option>
                <option value="Courier" <?= $fuente === 'Courier' ? 'selected' : '' ?>>Courier New</option>
            </select>
            

            <label for="estilo_literario">Elige el estilo literario:</label>
            <select name="estilo_literario" id="estilo_literario">
                <option value="Narrativo" <?= $estilo_literario === 'Narrativo' ? 'selected' : '' ?>>Narrativo</option>
                <option value="Poético" <?= $estilo_literario === 'Poético' ? 'selected' : '' ?>>Poético</option>
                <option value="Ensayo" <?= $estilo_literario === 'Ensayo' ? 'selected' : '' ?>>Ensayo</option>
            </select>
            </p>

            <button type="submit">Enviar</button>
        </form>
        
        <?php if ($texto){ ?>
            <!-- Div con el estilo personalizado -->
            <p class="notice" style="background-color:<?= htmlspecialchars($color_fondo) ?>; font-family:<?= htmlspecialchars($fuente) ?>;"><?= htmlspecialchars($texto) ?>
            </p>
        <?php } ?>

    </main>
    <footer>
        <p>P.Lluyot</p>
    </footer>

</html>