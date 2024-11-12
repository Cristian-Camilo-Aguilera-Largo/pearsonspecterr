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
          <h5>Ingrese los siguientes datos:</h5>
          <br>
          <div class="login-input">
            <input type="text" name="username" id="username" placeholder="Nombre" required />
          </div>

          <div class="login-input">
            <input type="text" name="apellido" id="apellido" placeholder="Apellidos" required />
          </div>

          <div class="login-input">
            <input type="number" name="telefono" id="telefono" placeholder="Teléfono" required>
          </div>

          <!-- Botón de envío del formulario -->
          <button type="submit" class="login-button">Siguiente</button>
        </form>

        <!-- Enlace para volver al inicio de sesión -->
        <a href="/pearsonspecterr/php/Login.php">
          <button type="button" class="register-button">Volver al inicio de sesión</button>
        </a>
      </div>
    </div>
  </div>

  <script>
    async function registrarUsuario() {

      // Obtener valores de contraseña y confirmación
      const contrasena = document.getElementById("contrasena").value;
      const confirmarContrasena = document.getElementById("confirmarContrasena").value;

      // Verificar que las contraseñas coincidan
      if (contrasena !== confirmarContrasena) {
        alert("Las contraseñas no coinciden. Inténtalo de nuevo.");
        return;
      }

      // Obtener los datos del formulario
      const usuarioData = {
        nombre: document.getElementById("username").value,  // Corregido a "username"
        apellido: document.getElementById("apellido").value,
        telefono: document.getElementById("telefono").value,
        email: document.getElementById("correo").value,
        password: contrasena  // Corregido a "password"
      };

      try {
        // Enviar los datos a la API
        const response = await fetch("http://localhost:8080/registro", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(usuarioData)
        });

        // Verificar la respuesta del servidor
        if (response.ok) {
          alert("Usuario registrado con éxito");
          document.getElementById("registroForm").reset(); // Vaciar los campos del formulario
        } else {
          alert("Error al registrar el usuario");
        }
      } catch (error) {
        console.error("Error en la solicitud:", error);
        alert("Error al conectar con el servidor");
      }
    }
    header("Location: /pearsonspecterr/php/registroUsuario.php");
    exit();
  </script>

</body>

</html>



