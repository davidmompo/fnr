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
if (!isset($_POST["ruta_archivo"]) || !isset($_POST["reemplazar"]) || !isset($_POST["nueva"])) {
    echo "Error: se requieren todos los campos para realizar el reemplazo.";
    exit;
}

$ruta_archivo = $_POST["ruta_archivo"];
$reemplazar = $_POST["reemplazar"];
$nueva = $_POST["nueva"];

// Validación de la ruta del archivo
if (!file_exists($ruta_archivo)) {
    echo "Error: el archivo no existe.";
    exit;
}

// Obtener el contenido del archivo
$contenido = file_get_contents($ruta_archivo);

if ($contenido === false) {
    echo "Error: no se pudo leer el contenido del archivo.";
    exit;
}

// Realizar el reemplazo de la palabra
$nuevo_contenido = str_replace($reemplazar, $nueva, $contenido);

// Escribir el nuevo contenido en el archivo
$resultado = file_put_contents($ruta_archivo, $nuevo_contenido);

if ($resultado === false) {
    echo "Error: no se pudo escribir el contenido en el archivo.";
    exit;
}

// Mostrar el nuevo contenido
echo "El nuevo contenido del archivo es:<br>";
echo nl2br(htmlspecialchars($nuevo_contenido)); // htmlspecialchars convierte los caracteres especiales en entidades HTML
?>

<img src="bien.gif">
</body>
</html>
