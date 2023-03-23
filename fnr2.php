<html>
<head>
<style>
    body{
        background-image: url("fondo.jpg");
        background-repeat: no-repeat;
        background-image: fixed;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;
        display: grid;
        place-items: center;
        text-align: center;
	color: white;
	font-size: 25px;
    }
</style>
</head>
<body>
<?php

// Validación de los datos de entrada
if (!isset($_POST["ruta_carpeta"]) || !isset($_POST["reemplazar"]) || !isset($_POST["nueva"])) {
    echo "Error: se requieren todos los campos para realizar el reemplazo.";
    exit;
}

$ruta_carpeta = $_POST["ruta_carpeta"];
$reemplazar = $_POST["reemplazar"];
$nueva = $_POST["nueva"];

// Validación de la ruta de la carpeta
if (!is_dir($ruta_carpeta)) {
    echo "Error: la carpeta no existe.";
    exit;
}

// Obtener la lista de archivos en la carpeta
$archivos = scandir($ruta_carpeta);

if ($archivos === false) {
    echo "Error: no se pudo obtener la lista de archivos en la carpeta.";
    exit;
}

// Recorrer la lista de archivos y realizar el reemplazo en cada uno
foreach ($archivos as $archivo) {
    if (is_file($ruta_carpeta . '/' . $archivo)) { // sólo procesar archivos, no subcarpetas
        $contenido = file_get_contents($ruta_carpeta . '/' . $archivo);

        if ($contenido === false) {
            echo "Error: no se pudo leer el contenido del archivo $archivo.";
            continue; // continuar con el siguiente archivo
        }

        // Realizar el reemplazo de la palabra
        $nuevo_contenido = str_replace($reemplazar, $nueva, $contenido);

        // Escribir el nuevo contenido en el archivo
        $resultado = file_put_contents($ruta_carpeta . '/' . $archivo, $nuevo_contenido);

        if ($resultado === false) {
            echo "Error: no se pudo escribir el contenido en el archivo $archivo.";
            continue; // continuar con el siguiente archivo
        }

        // Mostrar el nuevo contenido
        echo "El nuevo contenido del archivo $archivo es:<br>";
        echo nl2br(htmlspecialchars($nuevo_contenido)); // htmlspecialchars convierte los caracteres especiales en entidades HTML
        echo "<br><br>";
    }
}

?>



<img src="bien.gif">
</body>
</html>
