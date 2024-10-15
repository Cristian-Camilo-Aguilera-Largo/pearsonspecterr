<?php
// Inicia la sesión (si aún no está iniciada)
session_start();

// Incluye el archivo de conexión a la base de datos
include('conexion.php');

// Obtiene los valores enviados por el formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta la base de datos para validar el inicio de sesión
$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE User = '$username' AND Pass = '$password'");

if (mysqli_num_rows($validar_login) > 0) {
    // Si se encuentra un registro válido, obtiene el rol del usuario
    $usuario = mysqli_fetch_assoc($validar_login);

    // Depuración: Muestra la información del usuario
    // Puedes comentar o eliminar esta línea después de confirmar que funciona
    var_dump($usuario);

    $_SESSION['usuario'] = $username;  // Guarda el nombre de usuario en la sesión
    $_SESSION['id_rol'] = $usuario['id_rol'];  // Guarda el rol en la sesión

    // Redirige al usuario según su rol
    switch ($usuario['id_rol']) {
        case 1:
            // Redirigir a la interfaz de administradores
            header("location: ../html/InterfazAdministradores.html");
            break;
        case 2:
            // Redirigir a la interfaz de abogados
            header("location: ../html/InterfazAbogados.html");
            break;
        case 3:
            // Redirigir a la interfaz de clientes
            header("location: ../html/InterfazClientes.html");
            break;
        default:
            // Redirigir a una página de error o inicio
            header("location: ../login.php");
            break;
    }
    exit;
} else {
    // Si no se encuentra un registro válido, muestra un mensaje de error y redirige al usuario a la página de inicio de sesión
    echo '
    <script>
    alert("Usuario o contraseña incorrectos. Intente de nuevo.");
    window.location = "../login.php";
    </script>
    ';
    exit;
}
?>
