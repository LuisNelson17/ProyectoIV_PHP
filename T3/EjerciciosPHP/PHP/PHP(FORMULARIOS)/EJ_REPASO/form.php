<?php
$nombre=$contrasena="";
$err=[];
$ruta="formulario.csv";
$usuarios=[];

function sanitizar($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
$nombre= sanitizar($_POST["nombre"]);
$contrasena= sanitizar($_POST["contrasena"]);
}
// validamos campos obligatorios
if(empty($nombre)) $err["nombre"]="Nombre obligatotio";
if(empty($contrasena)) $err["contrasena"]="contraseña obligatotia";
if(empty($nombre)&& empty($contrasena)) $err["all_void"]="Rellene todos los campos";

// validamos CSV

if(empty($err)){
    $archivo= fopen($ruta,"+a");
    while(($data= fgetcsv($archivo,1000,","))== FALSE){


    }
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

    <header> <h1>FORMULARIO</h1></header>
    <form action="form.php">
        <label for="usuario">Nombre</label>
        <input type="text" name="usuario">
        
    <?php if(isset($err["nombre"])) echo '<p style="color:red">{err["nombre"]}</p>';?>
        <label for="contrasena">Apellidos</label>
        <input type="text" name="contrasena">
        <?php if(isset($err["contrasena"])) echo '<p style="color:red">{err["contrasena"]}</p>';?>
        <input type="button" value="Enviar">

        <?php if(isset($err["nombre"])&& isset($err["contrasena"])) echo '<p style="color:red">{err["all_void"]}</p>';?>
    </form>
    
</body>

</html>