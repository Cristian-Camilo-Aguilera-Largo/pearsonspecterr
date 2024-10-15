<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Si no está autenticado, redirigir a la página de inicio de sesión
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Casos</title>
    <link rel="stylesheet" href="../estilos/viewAbogado.css">
</head>
<body>
    <header>
        <h1>Mis Casos</h1>
    </header>
    <main>
        <div class="search">
            <input type="text" id="nombreCliente" placeholder="Nombre Cliente" />
            <input type="text" id="nombreCaso" placeholder="Nombre Caso" />
            <button id="searchBtn">Buscar</button>
        </div>
        <table id="casosTable">
            <thead>
                <tr>
                    <th>Nombre del Caso</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Nombre del Cliente</th>
                    <th>Archivo</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </main>
    <script src="../viewAbogado.js"></script>
</body>
</html>
