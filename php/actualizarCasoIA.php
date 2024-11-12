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

        .custom-gap {
                padding-right: 200px; /* Ajusta el valor según necesites */
            }
    </style>
</head>

<body>
    <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="../php/InterfazAbogados.php"><strong>Valbuen Abogados</strong></a>
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
    <div class="container mt-4">
        <h2>Actualizar Caso</h2>
        <!-- Contenedor para mostrar y editar datos del caso -->
        <div class="row g-5">
            <div class="col-md-6 custom-gap">
                <div id="datosActuales">
                    <div class="mb-3">
                        <label for="selectCaso" class="form-label">Seleccionar Caso</label>
                        <select class="form-select" id="seleccioncaso">
                            <option selected disabled>Seleccione un caso</option>
                            <!-- Aquí se deben cargar dinámicamente los casos desde la API o la base de datos -->

                        </select>
                    </div>


                    <h4>Datos Actuales</h4>
                    <div>
                        <!-- Aquí se mostrarán los datos actuales del caso seleccionado -->
                        <p><strong>ID del Caso:</strong> <span id="idActual"></span></p>
                        <p><strong>Titulo del caso:</strong> <span id="nombreActual"></span></p>
                        <p><strong>Descripcion:</strong> <span id="Descripcion"></span></p>
                        <p><strong>Fecha de Inicio:</strong> <span id="fechaActual"></span></p>
                        <p><strong>Estado:</strong> <span id="estadoActual"></span></p>
                        <p><strong>Fecha de Finalizacion:</strong> <span id="fechaFinalizacionActual"></span></p>
                        <!-- Agrega más campos según sea necesario -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form id="formActualizarCaso">
                    <div class="mb-3">
                        <label for="nuevoNombre" class="form-label">Nuevo Nombre del Cliente</label>
                        <select class="form-select" id="seleccionclientes">
                            <option selected disabled>Seleccione un cliente</option>
                            <!--Aquí se deben cargar dinámicamente los nombres de clientes desde la API o la base de datos-->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nuevaDescripcion" class="form-label">Nueva descripcion del caso</label>
                        <textarea class="form-control" id="nuevaDescripcion" rows="3" placeholder="Ingrese una descripcion corta del caso"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nuevaFecha" class="form-label">Nueva Fecha de Inicio</label>
                        <input type="date" class="form-control" id="nuevaFecha">
                    </div>
                    <div class="mb-3">
                    <label for="Estado" class="form-label">Estado</label>
                        <select class="form-select" id="nuevoEstado" onchange="toggleFechaTc()">
                            <option value="terminado">Terminado</option>
                            <option value="en_proceso">En Proceso</option>
                            <option value="anulado">Anulado</option>
                        </select>
                    </div>
                    <div class="mb-3" id="fechaTcContainer">
                        <label for="nuevaFechaFin" class="form-label">Nueva Fecha de Fin</label>
                        <input type="date" class="form-control" id="nuevaFechaFin">
                    </div>
                    <!-- Agrega más campos de entrada para otros datos que se puedan actualizar -->
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
<!--Footer-->
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
        document.addEventListener("DOMContentLoaded", function () {
            fetchCasosAbogado();

            // Función para cargar solo los casos del abogado
            function fetchCasosAbogado() {
                const abogadoId = <?php echo $_SESSION['id_abogado']; ?>;

                fetch(`http://localhost:8080/casos/${abogadoId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta de la red ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        const nombreSelect = document.getElementById('seleccioncaso');

                        // Añadir la opción "Seleccione un caso" como predeterminada
                        nombreSelect.innerHTML = '<option selected disabled>Seleccione un caso</option>';

                        data.forEach(caso => {
                            const option = document.createElement('option');
                            option.value = caso.id;
                            option.text = caso.caso;
                            nombreSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al cargar los casos del abogado:', error));
            }

            // Cargar los nombres de clientes al cargar la página
            fetch('http://localhost:8080/clientes')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta de la red ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    const clienteSelect = document.getElementById('seleccionclientes');

                    // Agregar la opción predeterminada
                    clienteSelect.innerHTML = '<option selected disabled>Seleccione un cliente</option>';
                    // Limpiar las opciones anteriores, asegurándose de que el select esté vacío
                    clienteSelect.innerHTML = '';
                    data.forEach(cliente => {
                        const option = document.createElement('option');
                        option.value = cliente.id;
                        option.text = cliente.nombre;
                        clienteSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar los nombres de clientes:', error));

            // Escuchar cambios en la selección del caso
            document.getElementById('seleccioncaso').addEventListener('change', function () {
                const selectedId = this.value;
                if (selectedId) {
                    fetch(`http://localhost:8080/tipificacion1/${selectedId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta de la red ' + response.statusText);
                            }
                            return response.json();
                        })
                        .then(vista => {
                            document.getElementById('idActual').textContent = vista.id;
                            document.getElementById('nombreActual').textContent = vista.caso;
                            document.getElementById('Descripcion').textContent = vista.descripcion;
                            document.getElementById('fechaActual').textContent = vista.fecha_ic || 'No disponible';
                            document.getElementById('estadoActual').textContent = vista.estado;
                            document.getElementById('fechaFinalizacionActual').textContent = vista.fecha_ct || 'No disponible';
                        })
                        .catch(error => console.error('Error al cargar los detalles del caso:', error));
                }
            });

            // Código para ocultar la fecha de finalización si el estado cambia a "en_proceso" o "anulado"
            function toggleFechaTc() {
                const estado = document.getElementById('nuevoEstado').value;
                const fechaTcContainer = document.getElementById('fechaTcContainer');
                fechaTcContainer.style.display = (estado === 'en_proceso' || estado === 'anulado') ? 'none' : 'block';
            }
            document.getElementById('nuevoEstado').addEventListener('change', toggleFechaTc);

            
        });

        // Enviar la actualización del caso
        document.getElementById('formActualizarCaso').addEventListener('submit', function(event) {
            event.preventDefault();

            const selectedId = document.getElementById('seleccioncaso').value;
            const clienteId = document.getElementById('seleccionclientes').value;
            const descripcion = document.getElementById('nuevaDescripcion').value;
            const fechaInicio = document.getElementById('nuevaFecha').value;
            const estado = document.getElementById('nuevoEstado').value;
            const fechaFin = document.getElementById('nuevaFechaFin').value;

            const updatedData = {
                descripcion: descripcion,
                fecha_ic: fechaInicio,
                estado: estado,
                fecha_ct: fechaFin,
                clientes: { id: clienteId }
            };

            fetch(`http://localhost:8080/tipificacion1/${selectedId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(updatedData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta de la red ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Caso actualizado:', data);
                alert('Los datos del caso se han actualizado correctamente.');
            })
            .catch(error => {
                console.error('Error al actualizar el caso:', error);
                alert('Hubo un error al actualizar el caso.');
            });
        });
    </script>

</body>
</html>