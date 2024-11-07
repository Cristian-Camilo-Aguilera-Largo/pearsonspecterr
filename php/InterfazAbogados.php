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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Casos</title>
    <link rel="stylesheet" href="../estilos/viewAbogado.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <!-- Estilos locales -->
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
<<<<<<< HEAD
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html"><strong>Pearson Specter</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="../php/InterfazAbogados.php">Lista de Casos</a>
                        <a class="nav-link" href="../php/listaClientesIA.php">Lista Clientes</a>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Casos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../php/actualizarCasoIA.php">Actualizar Caso</a></li>
                            </ul>
=======
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.html"><strong>Valbuen Abogados</strong></a>
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
>>>>>>> e0f83298edc6db4cc4e5493ff9bf6965dd62b1e0
                        </div>
                    </div>

                    <!-- Div Persona con ms-auto para alinearse a la derecha -->
                    <div class="Persona ms-auto d-flex align-items-center">
                        <img src="../Img/Personas.png" alt="Icono Persona" class="me-2" />
                        <span class="text-black" style="font-weight:bold;">Bienvenido, <?php echo $_SESSION['usuario']; ?></span>
                        <a href="../php/cerrar_sesion.php" class="btn btn-danger ms-3">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-4">
        <div class="search mb-3">
            <input type="text" id="nombreCliente" class="form-control" placeholder="Nombre Cliente" />
            <input type="text" id="nombreCaso" class="form-control my-2" placeholder="Nombre Caso" />
            <button id="searchBtn" class="btn btn-primary">Buscar</button>
        </div>
        <table id="casosTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nombre del Caso</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Nombre del Cliente</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se llenarán los casos -->
            </tbody>
        </table>
    </main>
    <div class="foot">
               <footer class="bg-dark text-white pt-4">
                   <div class="container">
                       <div class="row">
                           <div class="col-md-3">
                               <h5 class="empresa_f">Valbuen Abogados</h5>
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
                               <h5>Se parte de Valbuen Abogados</h5>
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
                           © 2024 Valbuen Abogados
                       </div>
               </footer>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchCasos();

            document.getElementById("searchBtn").addEventListener("click", function() {
                const nombreCliente = document.getElementById("nombreCliente").value.toLowerCase();
                const nombreCaso = document.getElementById("nombreCaso").value.toLowerCase();

                const rows = document.querySelectorAll("#casosTable tbody tr");
                rows.forEach(row => {
                    const caso = row.cells[0].textContent.toLowerCase();
                    const cliente = row.cells[5].textContent.toLowerCase();
                    row.style.display =
                        (nombreCliente === "" || cliente.includes(nombreCliente)) &&
                        (nombreCaso === "" || caso.includes(nombreCaso)) ? "" : "none";
                });
            });
        });

        function fetchCasos() {
            // Obtener el ID del abogado desde la sesión PHP
            const abogadoId = <?php echo $_SESSION['id_abogado']; ?>;

            console.log("Abogado ID:", abogadoId); // Verificación del ID del abogado

            fetch(`http://localhost:8080/casos/${abogadoId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(casos => {
                    console.log("Casos obtenidos:", casos);

                    if (!casos || casos.length === 0) {
                        console.error("No hay casos disponibles o la respuesta es incorrecta.");
                        return;
                    }

                    const tbody = document.querySelector("#casosTable tbody");
                    tbody.innerHTML = "";

                    casos.forEach(caso => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${caso.caso}</td>
                            <td>${caso.descripcion}</td>
                            <td>${caso.estado}</td>
                            <td>${caso.fecha_ic}</td>
                            <td>${caso.fecha_ct || 'No disponible'}</td>
                            <td>${caso.clientes.nombre}</td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar los casos:', error);
                });
        }

    </script>
</body>
</html>
