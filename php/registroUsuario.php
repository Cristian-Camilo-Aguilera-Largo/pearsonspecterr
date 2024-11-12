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
    <div id="body-register-container">
      <div class="register-container">

        <!-- Encabezado de registro -->
        <h2>Formulario de Registro</h2>

        <!-- Formulario de registro -->
        <form id="registroForm" class="login-form" onsubmit="event.preventDefault(); registrarUsuario();">
          <br>
          <h5>Los datos que ingrese serán sus datos para iniciar sesión</h5>
          <br>
          <!-- Campo de entrada para el correo -->
          <div class="login-input">
            <input type="email" name="correo" id="correo" placeholder="Correo electrónico" required>
          </div>

          <!-- Campo de entrada para la contraseña -->
          <div class="login-input">
            <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
          </div>

          <!-- Campo de entrada para confirmar la contraseña -->
          <div class="login-input">
            <input type="password" name="confirmarContrasena" id="confirmarContrasena" placeholder="Confirmar Contraseña" required>
          </div>

          <!-- Botón de envío del formulario -->
          <button type="submit" class="login-button">Registrar</button>
        </form>

        <!-- Enlace para volver al inicio de sesión -->
        <a href="/pearsonspecterr/php/Login.php">
          <button type="button" class="register-button">Volver al inicio de sesión</button>
        </a>

          <a href="/pearsonspecterr/php/registro.php">
                      <button type="button" class="register-button">Atrás</button>
          </a>
      </div>
    </div>
  </div>

  <script>
    function registrarUsuario() {
      const usuario = {
        correo: document.getElementById('correo').value,
        contrasena: document.getElementById('contrasena').value,
        confirmarContrasena: document.getElementById('confirmarContrasena').value,  // Agregado: Confirmar contraseña
      };

      // Verifica si las contraseñas coinciden
      if (usuario.contrasena !== usuario.confirmarContrasena) {
        alert('Las contraseñas no coinciden.');
        return;
      }

      // Enviar los datos del usuario al backend
      fetch('http://localhost:8080/registro/usuario', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuario)
      })
      .then(response => response.text()) // Leemos la respuesta como texto (no como JSON)
      .then(data => {
        if (data.includes("Usuario registrado exitosamente")) {  // Verifica si el mensaje contiene el texto de éxito
          alert('Usuario registrado exitosamente');
          // Redirigir al login
          window.location.href = "/pearsonspecterr/php/Login.php";
        } else {
          alert('Error al registrar el usuario.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al registrar el usuario.');
      });
    }
  </script>
</body>

</html>
