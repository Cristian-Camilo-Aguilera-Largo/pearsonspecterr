<?php
    // Inicia la sesión (si aún no está iniciada)
    session_start();

    // Incluye el archivo de conexión a la base de datos
    include('conexion.php');

    // Obtiene los valores enviados por el formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta la base de datos para validar el inicio de sesión
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE User = '$username' AND Pass = '$password' AND Rol ='1'");
    $validar_login_a = mysqli_query($conexion, "SELECT * FROM usuarios WHERE User = '$username' AND Pass = '$password' AND Rol = '2'");
    $validar_login_c = mysqli_query($conexion, "SELECT * FROM usuarios WHERE User = '$username' AND Pass = '$password' AND Rol ='3'");

    if (mysqli_num_rows($validar_login) > 0) {
        // Si se encuentra un registro válido, inicia la sesión y redirige al usuario a la página de bienvenida
        $_SESSION['usuario'] = $username;
        header("location: ../html/InterfazAdministradores.html");
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

    if (mysqli_num_rows($validar_login_a) > 0) {
            // Si se encuentra un registro válido, inicia la sesión y redirige al usuario a la página de bienvenida
            $_SESSION['usuario'] = $username;
            header("location: ../html/InterfazAbogados.html");
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

        if (mysqli_num_rows($validar_login_c) > 0) {
                // Si se encuentra un registro válido, inicia la sesión y redirige al usuario a la página de bienvenida
                $_SESSION['usuario'] = $username;
                header("location: ../html/InterfazClientes.html");
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