<?php
// Inicia la sesión (si aún no está iniciada)
session_start();

// Verifica si la variable de sesión 'usuario' está definida
if (isset($_SESSION['usuario'])) {
  // Redirige al usuario a la página "index.php"
  header("location: /pearsonspecterr/html/InterfazAbogados.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="INVENTARIO" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <link rel="shortcut icon" href="Img/Logo.jpg" />
  <link rel="stylesheet" href="../estilos/login.css" />
  <title>INVENTARIO</title>
</head>

<body>
  <div id="filtro-container">
    <div id="body-container">

      <!-- Contenedor principal de la interfaz de inicio de sesión -->
      <div class="login-container">

        <!-- Formulario de inicio de sesión -->
        <form class="login-form" action="/pearsonspecterr/html/InterfazAbogados.html" method="POST">

          <!-- Logo de la Empresa -->
          <img style="margin-bottom: 10px" src="Img/Interaseo.png" alt="Logo de la empresa" width="312" height="224" /><br>

          <!-- Campo de entrada para el nombre de usuario o correo electrónico -->
          <div class="login-input">
            <input type="text" name="username" placeholder="Nombre de usuario o correo electrónico" required />
          </div>

          <!-- Campo de entrada para la contraseña -->
          <div class="login-input">
            <input type="password" name="password" placeholder="Contraseña" required />
          </div>

          <!-- Botón de envío del formulario -->
          <button type="submit" class="login-button">Iniciar sesión</button>
        </form>

        <!-- Enlaces de registro y recuperación de contraseña -->
        <div class="login-links">

          <input type="checkbox" name="recuerdame" id="recuerdame" style="display: inline-flexbox;">
          <label for="recuerdame" style="display: inline-block;">Recuérdame</label>
          <a href="#" class="login-link" id="olvidaste-contrasena">¿Olvidaste tu contraseña?</a>

          <script>
            // Manejador de clic para el enlace "¿Olvidaste tu contraseña?"
            document.getElementById('olvidaste-contrasena').addEventListener('click', function(event) {
              event.preventDefault(); // Evita la redirección por defecto del enlace

              alert("Por favor ingresa con el usuario administrador o pide a un administrador que inicie sesión para cambiar tu contraseña.");
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</body>

</html>