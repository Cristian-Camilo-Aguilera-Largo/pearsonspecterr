<?php
    // Inicia la sesión (si aún no está iniciada)
    session_start();

    // Incluye el archivo de conexión a la base de datos
    include('conexion.php');

    // Obtiene los valores enviados por el formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta la base de datos para validar el inicio de sesión
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE User = '$username' AND Pass = '$password' AND Rol = '$rol');

    if (mysqli_num_rows($validar_login) > 0) {
        // Si se encuentra un registro válido, inicia la sesión y redirige al usuario a la página de bienvenida
        $_SESSION['usuario'] = $username;
        header("location: ../html/InterfazAbogados.html");
        exit;
    } else {
        // Si no se encuentra un registro válido, muestra un mensaje de error y redirige al usuario a la página de inicio de sesión
        echo '
        <script>
        alert("Usuario o contraseña incorrectos. Intente de nuevo.");
        window.location = "../index.php";
        </script>
        ';
        exit;
    }
?>