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
    <title>Añadir Caso</title>

    <!--Conexiones-->
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--Estilos locales-->
    <style>
        .boton {
            margin-top: 10px;
        }

        /* CSS para que el dropdown se abra al pasar el mouse */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
            /* Opcional: para que se alinee con el navbar */
        }
    </style>
</head>

<body>
    <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="../php/InterfazAdministradores.php"><strong>Valbuen Abogados</strong></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" aria-current="page" href="../php/InterfazAdministradores.php">Lista de Casos</a>
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
                            <a class="nav-link" href="../php/añadirUsuario.php">Crear Usuario</a>
                            <a class="nav-link" href="../php/CrearAdmin.php">Crear Admin</a>
                        </div>

                        <!-- Div Persona ubicado fuera de navbar-nav y con ms-auto para alinearse a la derecha -->
                        <div class="Persona ms-auto d-flex align-items-center">
                            <img src="../Img/Personas.png" alt="Icono Persona" class="me-2" />
                            <span class="text-black" style="font-weight:bold;">Bienvenido, <?php echo $_SESSION['usuario']; ?></span>
                            <a href="../php/cerrar_sesion.php" class="btn btn-danger ms-3">Cerrar sesión</a>
                        </div>
                    </div>

                </div>
            </nav>
        </header>
    <div class="container mt-4">
        <h2>Añadir Abogado</h2>
        <div class="container">
            <form class="casoForm" id="casoForm">
                <div class="mb-3">
                    <label for="Cedula" class="form-label">Numero de Identificacion del Abogado</label>
                    <input type="number" class="form-control" id="Cedula">
                </div>
                <div class="mb-3">
                    <label for="Nombre" class="form-label">Nombre del Abogado</label>
                    <input type="text" class="form-control" id="Nombre">
                </div>
                <div class="mb-3">
                    <label for="Telefono" class="form-label">Telefono del Abogado</label>
                    <input type="number" class="form-control" id="Telefono">
                </div>
                <div class="mb-3">
                    <label for="Correo" class="form-label">Correo del Abogado</label>
                    <input type="email" class="form-control" id="Correo">
                </div>
                <div class="mb-3">
                    <label for="Cargo" class="form-label">Especializacion del abogado</label>
                    <input type="text" class="form-control" id="Especializacion">
                </div>
                <div class="mb-3">
                    <label for="Cargo" class="form-label">Cargo del Abogado</label>
                    <input type="text" class="form-control" id="Cargo">
                </div>
                <button type="submit" class="btn btn-secondary btn-lg boton">Añadir Abogado</button>
            </form>
        </div>
    </div>
    <div class="foot">
               <footer class="bg-dark text-white pt-4">
                   <div class="container">
                       <div class="row">
                           <div class="col-md-3">
                               <h5 class="empresa_f">ValbuenAbogados</h5>
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
                                   <li><button type="button" class="btn btn-dark">lineaetica@ValbuenAbogados.com</button></li>
                               </ul>
                           </div>
                           <div class="col-md-3">
                               <h5>Se parte de ValbuenAbogados</h5>
                               <ul class="list-unstyled">
                                   <li><button type="button" class="btn btn-dark">Trabaja con nosotros</button></li>
                                   <li><button type="button" class="btn btn-dark">trabajo@ValbuenAbogados.com</button></li>
                               </ul>
                           </div>
                           <div class="col-md-3">
                               <h5>Contacto</h5>
                               <ul class="list-unstyled">
                                   <li><a href="#" class="text-white">321 3214321</a></li>
                                   <li><a href="#" class="text-white">atencionalcliente@ValbuenAbogados.com</a></li>
                               </ul>
                           </div>
                       </div>
                       </div>
                       <div class="copyright">
                           © 2024 ValbuenAbogados
                       </div>
               </footer>
           </div>
    <script src="../anadirAbogadosjs.js"></script>
</body>

</html>