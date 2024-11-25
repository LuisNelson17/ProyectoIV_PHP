<?php

$resultado=null;
   $ruta;

        if (isset($_POST['formulario'])) {
            $nombre = $_FILES['fichero']['name'];
            $tmp_name = $_FILES['fichero']['tmp_name'];
            $tipo = $_FILES['fichero']['type'];
            $tamano = $_FILES['fichero']['size'];
            $error = $_FILES['fichero']['error'];
            $tamanoMaximo = 2 * 1024 * 1024; 
            if($error){
                $resultado= "Ha ocurrido un error";
            }else if($tamano>$tamanoMaximo){
                $resultado= "El tamaño supera el maximo permitido. 2MB";
            }else if($tipo!= "image/jpg"&&$tipo!="image/png"&&$tipo !="image/jpeg"){
                $resultado= "Tipos de archivos invalidos.Debe ser jpg,jpeg o png.";
            }else{
                $ruta='files/'.$nombre;
                move_uploaded_file($tmp_name,$ruta);
                $resultado="La imagen $name ha sido guardada con exito";
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
<header>

<h1>Formulario</h1>
</header>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
<input type="file" name="fichero">
<input type="hidden" name="formulario">
<input type="submit" value="Subir">

<h1><?php echo $resultado?></h1>
</form>




</body>
</html>