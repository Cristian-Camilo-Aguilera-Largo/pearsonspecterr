<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="../estilos/login.css">
</head>

<body>
  <div id="filtro-container">
    <div id="body-container">
      <div class="login-container">

        <!-- Encabezado de registro -->
        <h2>Formulario de Registro</h2>

        <!-- Formulario de registro -->
        <form action="procesar_registro.php" method="POST" class="login-form">
          <br>
          <div class="login-input">
            <input type="text" name="username" placeholder="Nombre" required />
          </div>

          <!-- Campo de entrada para la contraseña -->
          <div class="login-input">
            <input type="text" name="password" placeholder="Apellidos" required />
          </div>

          <!-- Campo de entrada para el teléfono -->
          <div class="login-input">
            <input type="number" name="telefono" id="telefono" placeholder="Teléfono" required>
          </div>

          <!-- Campo de entrada para el correo -->
          <div class="login-input">
            <input type="email" name="correo" id="correo" placeholder="Correo electrónico" required>
          </div>

          <!-- Campo de entrada para la contraseña -->
          <div class="login-input">
            <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
          </div>

          <!-- Campo de entrada para la contraseña -->
          <div class="login-input">
            <input type="password" name="contrasena" id="contrasena" placeholder="Confirmar Contraseña" required>
          </div>


          <!-- Botón de envío del formulario -->
          <button type="submit" class="login-button">Registrar</button>
        </form>

        <!-- Enlace para volver al inicio de sesión -->
          <a href="/pearsonspecterr/php/Login.php">
                      <button type="button" class="register-button">Volver al inicio de seion</button>
          </a>
      </div>
    </div>
  </div>
</body>

</html>