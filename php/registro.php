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
             <form id="registroForm" class="login-form" onsubmit="event.preventDefault(); registrarCliente();">
               <br>
               <h5>Ingrese los siguientes datos:</h5>
               <br>
               <div class="login-input">
                 <input type="text" name="username" id="nombre" placeholder="Nombre" required />
               </div>

               <div class="login-input">
                 <input type="text" name="apellido" id="apellido" placeholder="Apellidos" required />
               </div>

               <div class="login-input">
                 <input type="number" name="telefono" id="telefono" placeholder="Teléfono" required>
               </div>

               <!-- Botón de envío del formulario -->
               <button type="submit" class="login-button">Registrar</button>
             </form>

             <!-- Enlace para volver al inicio de sesión -->
             <a href="/pearsonspecterr/php/Login.php">
               <button type="button" class="register-button">Volver al inicio de sesión</button>
             </a>
      </div>
    </div>
  </div>

  <script>
    function registrarCliente() {
      const cliente = {
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        telefono: document.getElementById('telefono').value
      };

      // Enviar los datos del cliente al backend
      fetch('http://localhost:8080/registro/cliente', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(cliente)
      })
      .then(response => {
        if (response.ok) {
          return response.text(); // Leer la respuesta si es exitosa
        } else {
          throw new Error('Hubo un problema con la solicitud');
        }
      })
      .then(data => {
        alert(data); // Mostrar mensaje de éxito
        window.location.href = "/pearsonspecterr/php/registroUsuario.php"; // Redirigir al formulario de registro de usuario
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al registrar el cliente.');
      });
    }
  </script>

</body>

</html>



