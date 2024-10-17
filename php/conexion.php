<?php

// Configuración de la conexión a la base de datos
$server = "localhost"; // Nombre del servidor de la base de datos
$user = "root"; // Usuario de la base de datos
$pass = ""; // Contraseña de la base de datos
$db = "pearsonspecter"; // Nombre de la base de datos

// Intenta establecer la conexión
$conexion = mysqli_connect($server, $user, $pass, $db);

// Verifica si la conexión fue exitosa
if ($conexion->connect_errno) {
    // Si hay un error en la conexión, muestra un mensaje y finaliza el script
    die("Conexión fallida: " . $conexion->connect_errno);

} else {
    // Si la conexión es exitosa, no se realiza ninguna acción adicional aquí
}

?>