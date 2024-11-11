<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="INICIAR SESION" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <link rel="shortcut icon" href="Img/Logo.jpg" />
  <link rel="stylesheet" href="../estilos/login.css" />
  <title>INICIAR SESION</title>
</head>

<body>
  <div id="filtro-container">
    <div id="body-container">

      <!-- Contenedor principal de la interfaz de inicio de sesión -->
      <div class="login-container">

        <!-- Formulario de inicio de sesión -->
        <form class="login-form" action="/pearsonspecterr/php/validacion.php" method="POST">

          <!-- Logo de la Empresa -->
          <img style="margin-bottom: 10px" src="/pearsonspecterr/Img/Logo.png" alt="Logo de la empresa" width="312" height="224" /><br>

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
          <!-- Botón de registro con estilos personalizados -->
        </form>

          <!-- Botón de registro con estilos personalizados -->
          <a href="/pearsonspecterr/php/registro.php">
            <button type="button" class="register-button">Registrarse</button>
          </a>
        <!-- Enlaces de registro y recuperación de contraseña -->
        <div class="login-links">

          <input type="checkbox" name="recuerdame" id="recuerdame" style="display: inline-flexbox;">
          <label for="recuerdame" style="display: inline-block;">Recuérdame</label>
          <a href="#" class="login-link" id="olvidaste-contrasena">¿Olvidaste tu contraseña?</a>

        </div>
      </div>
    </div>
  </div>
</body>

</html>