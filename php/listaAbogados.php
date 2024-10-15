<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Si no está autenticado, redirigir a la página de inicio de sesión
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Abogados</title>

    <!--Conexiones-->
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--Estilos locales-->
    <style>
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 15px;
            overflow: hidden;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html"><strong>Pearson Specter</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="../php/InterfazAdministradores.php">Lista de Casos</a>
                        <a class="nav-link" href="../php/listaClientes.php">Lista Clientes</a>
                        <a class="nav-link" href="../php/listaAbogados.php">Lista Abogados</a>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Casos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../php/añadirCaso.php">Añadir Caso</a></li>
                                <li><a class="dropdown-item" href="../php/actualizarCaso.php">Actualizar Caso</a></li>
                                <li><a class="dropdown-item" href="../php/eliminarCaso.php">Borrar Caso</a></li>
                            </ul>
                        </div>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Abogados
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../php/añadirAbogado.php">Añadir Abogado</a></li>
                                <li><a class="dropdown-item" href="../php/ActualizarAbogado.php">Actualizar Abogado</a></li>
                                <li><a class="dropdown-item" href="../php/eliminarAbogado.php">Borrar Abogado</a></li>
                            </ul>
                        </div>
                        <a class="nav-link" href="../php/CrearAdmin.php">Crear Admin</a>
                        <!-- Menú de usuario -->
                        <div class="Persona">
                            <img src="../Img/Personas.png" alt="Icono Persona" />
                            <div class="menu-desplegable">
                                <span style="font-weight:bold ;"> Bienvenido,<?php echo $_SESSION['usuario']; ?></span>
                                <a href="../php/cerrar_sesion.php">Cerrar sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="container mt-4">
        <h2>Abogados</h2>
        <div class="container">
            <table id="productTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Especializacion</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se agregarán los productos -->
                </tbody>
            </table>
        </div>
    </div>
    <footer class="bg-dark text-white pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="empresa_f">Pearson Specter</h5>
                    <ul class="list-unstyled">
                        <li>Síguenos</li>
                        <li class="iconos">
                            <a href="#" class="text-white"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-envelope"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Sobre nosotros</h5>
                    <ul class="list-unstyled">
                        <li><button type="button" class="btn btn-dark">Politica de tratamiento</button></li>
                        <li><button type="button" class="btn btn-dark">lineaetica@pearsonspecter.com</button></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Se parte de Pearson Specter</h5>
                    <ul class="list-unstyled">
                        <li><button type="button" class="btn btn-dark">Trabaja con nosotros</button></li>
                        <li><button type="button" class="btn btn-dark">trabajo@pearsonspecter.com</button></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">321 3214321</a></li>
                        <li><a href="#" class="text-white">atencionalcliente@pearsonspecter.com</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center py-3">
                © 2024 Pearson Specter
            </div>
        </div>
    </footer>
    <script src="../abogadosjs.js"></script>
</body>

</html>