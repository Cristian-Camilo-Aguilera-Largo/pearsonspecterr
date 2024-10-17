<?php
// Inicia la sesión (si aún no está iniciada)
session_start();

// Incluye el archivo de conexión a la base de datos
include('conexion.php');

// Obtiene los valores enviados por el formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta la base de datos para validar el inicio de sesión
$validar_login = mysqli_query($conexion, "
    SELECT
        usuarios.id_usuario AS id_usuario,
        clientes.id AS id_cliente,
        abogados.id AS id_abogado,
        usuarios.User,
        usuarios.Pass,
        usuarios.id_rol
    FROM
        usuarios
    LEFT JOIN
        abogados ON usuarios.id_usuario = abogados.id_usuario
    LEFT JOIN
        clientes ON usuarios.id_usuario = clientes.id_usuario
    WHERE
        usuarios.User = '$username' AND usuarios.Pass = '$password'
");

if (mysqli_num_rows($validar_login) > 0) {
    // Si se encuentra un registro válido, obtiene el rol del usuario
    $usuario = mysqli_fetch_assoc($validar_login);

    // Depuración: Muestra la información del usuario
    var_dump($usuario);

    $_SESSION['usuario'] = $usuario['User'];  // Guarda el nombre de usuario en la sesión
    $_SESSION['id_rol'] = $usuario['id_rol'];  // Guarda el rol en la sesión

    // Guarda el ID del abogado o del cliente, según corresponda
    if ($usuario['id_abogado']) {
        $_SESSION['id_abogado'] = $usuario['id_abogado'];  // Guarda el ID del abogado en la sesión
    }
    if ($usuario['id_cliente']) {
        $_SESSION['id_cliente'] = $usuario['id_cliente'];  // Guarda el ID del cliente en la sesión
    }

    // Redirige al usuario según su rol
    switch ($usuario['id_rol']) {
        case 1:
            header("location: ../php/InterfazAdministradores.php");
            break;
        case 2:
            header("location: ../php/InterfazAbogados.php");
            break;
        case 3:
            header("location: ../php/InterfazClientes.php");
            break;
        default:
            header("location: ../login.php");
            break;
    }
    exit;
} else {
    echo '
    <script>
    alert("Usuario o contraseña incorrectos. Intente de nuevo.");
    window.location = "../login.php";
    </script>
    ';
    exit;
}
?>
