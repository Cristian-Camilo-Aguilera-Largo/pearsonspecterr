<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
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
                        <a class="nav-link active" aria-current="page" href="../php/InterfazAbogados.php">Lista de Casos</a>
                    </div>
                    <div class="Persona ms-auto d-flex align-items-center">
                        <img src="../Img/Personas.png" alt="Icono Persona" class="me-2" />
                        <span class="text-white" style="font-weight:bold;">Bienvenido, <?php echo $_SESSION['usuario']; ?></span>
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
                    <th>Archivo Subido</th>
                    <th>Subir Nuevo Archivo</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se llenarán los casos -->
            </tbody>
        </table>
    </main>
    <footer class="bg-dark text-white pt-4">
        <div class="container">
            <div class="row">
                <!-- Información de pie de página omitida por brevedad -->
            </div>
            <hr class="bg-white">
            <div class="text-center py-3">
                © 2024 Pearson Specter
            </div>
        </div>
    </footer>

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
            const abogadoId = <?php echo $_SESSION['id_abogado']; ?>;

            fetch(`http://localhost:8080/casos/${abogadoId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al cargar los casos');
                    }
                    return response.json();
                })
                .then(casos => {
                    const tbody = document.querySelector("#casosTable tbody");
                    tbody.innerHTML = "";

                    casos.forEach(caso => {
                        const archivoSubido = caso.archivo ?
                            `<a href="http://localhost:8080/files/${caso.archivo}" download="${caso.archivo}">${caso.archivo}</a>` :
                                'No disponible';

                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${caso.caso}</td>
                            <td>${caso.descripcion}</td>
                            <td>${caso.estado}</td>
                            <td>${caso.fecha_ic}</td>
                            <td>${caso.fecha_ct || 'No disponible'}</td>
                            <td>${caso.clientes.nombre}</td>
                            <td>${archivoSubido}</td>
                            <td>
                                <form id="form-${caso.id}" enctype="multipart/form-data">
                                    <input type="file" name="file" class="form-control" accept=".zip" />
                                    <button type="button" class="btn btn-primary mt-2" onclick="subirArchivo(${caso.id})">Subir</button>
                                </form>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar los casos:', error);
                    alert("Hubo un problema al cargar los casos. Intenta de nuevo más tarde.");
                });
        }
        function descargarArchivo(filename) {
            const link = document.createElement('a');
            link.href = `http://localhost:8080/files/${filename}`;
            link.download = filename; // Esto indica que se debe descargar
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function subirArchivo(casoId) {
            const form = document.getElementById(`form-${casoId}`);
            const formData = new FormData(form);

            fetch(`http://localhost:8080/casos/${casoId}/subir-archivo`, {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al subir el archivo');
                }
                alert("Archivo subido correctamente");
                fetchCasos(); // Recargar la tabla para mostrar el archivo subido
            })
            .catch(error => {
                console.error("Error al subir el archivo:", error);
                alert("Hubo un problema al subir el archivo. Intenta de nuevo más tarde.");
            });
        }
    </script>
</body>
</html>
