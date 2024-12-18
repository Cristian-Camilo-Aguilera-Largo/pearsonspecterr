<?php
// Verificar si el usuario está autenticado
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
$id_usuario = $_SESSION['usuario']; // Asumiendo que almacenas el ID del cliente en la sesión
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Casos</title>

    <!-- Conexiones -->
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="../php/InterfazClientes.php"><strong>Valbuen Abogados</strong></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" aria-current="page" href="../php/InterfazClientes.php">Lista de Casos</a>
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
        <h2>Lista de Casos</h2>
        <div class="container">
            <input type="hidden" id="clienteId" value="<?php echo $id_usuario; ?>"> <!-- Aquí va el ID del cliente -->
            <table id="productTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre del Caso</th>
                        <th>Abogado</th>
                        <th>Estado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Final</th>
                        <th>Archivo Subido</th>
                        <th>Subir Nuevo Archivo</th>
                        <th>Ver más..</th>
                    </tr>
                </thead>
                <tbody id="casosContainer">
                    <!-- Los casos se cargarán aquí -->
                </tbody>
            </table>
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

    <script>
        fetchCasos()
        function fetchCasos() {
            const idUsuario = <?php echo $_SESSION['id_cliente']; ?>; // ID del cliente logueado

            // Llamar al endpoint para obtener los casos del cliente
            fetch(`http://localhost:8080/cliente/${idUsuario}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
            console.log(data); // Aquí puedes manejar los casos que se reciben
            const casosContainer = document.getElementById("casosContainer");
            casosContainer.innerHTML = "";
            if (data.length === 0) {
                casosContainer.innerHTML = `<tr><td colspan="8" class="text-center">No se encontraron casos.</td></tr>`;
            } else {
                data.forEach(caso => {
                    const archivoSubido = caso.archivo ?
                                `<a href="http://localhost:8080/files/${caso.archivo}" download="${caso.archivo}">${caso.archivo}</a>` :
                                    'No disponible';
                    casosContainer.innerHTML += `
                        <tr>
                            <td>${caso.caso}</td>
                            <td>${caso.abogados.nombre}</td>
                            <td>${caso.estado}</td>
                            <td>${caso.fecha_ic}</td>
                            <td>${caso.fecha_ct || 'No disponible'}</td>
                            <td>${archivoSubido || 'No disponible'}</td>
                            <td>
                                <form id="form-${caso.id}" enctype="multipart/form-data">
                                    <input type="file" name="file" class="form-control" accept=".zip" />
                                    <button type="button" class="btn btn-primary mt-2" onclick="subirArchivo(${caso.id})">Subir</button>
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-${caso.id}">
                                    Ver más...
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop-${caso.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-${caso.id}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel-${caso.id}">${caso.caso}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Descripción:</strong> ${caso.descripcion}</p>
                                                <p><strong>Cliente:</strong> ${caso.clientes.nombre}</p>
                                                <p><strong>Abogado:</strong> ${caso.abogados.id}</p>
                                                <p><strong>Estado:</strong> ${caso.estado}</p>
                                                <p><strong>Fecha de inicio:</strong> ${caso.fecha_ic}</p>
                                                <p><strong>Fecha de cierre:</strong> ${caso.fecha_ct || 'No disponible'}</p>

                                                <div id="fileName-${caso.id}" class="mt-3"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                    
                });
            }
            })
            .catch(error => {
                console.error('Error:', error);
                const casosContainer = document.getElementById("casosContainer");
                casosContainer.innerHTML = `<tr><td colspan="8" class="text-center">Error al cargar los casos.</td></tr>`;
            });
        }
        function descargarArchivo(filename) {
            const link = document.createElement('a');
            link.href = `http://localhost:8080/files/${filename}`;
            link.download = filename;
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
                fetchCasos();
            })
            .catch(error => {
                console.error("Error al subir el archivo:", error);
                
            });
        }
    </script>

</body>

</html>