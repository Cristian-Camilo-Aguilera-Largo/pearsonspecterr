document.addEventListener('DOMContentLoaded', function () {
    const productTableBody = document.getElementById('productTable').querySelector('tbody');
    const abogadosMap = new Map();

    // Función para obtener los abogados de la API
    function fetchAbogados() {
        return fetch('http://localhost:8080/abogados')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Abogados:', data);
                data.forEach(abogado => {
                    abogadosMap.set(abogado.id, abogado.nombre); // Guardar el nombre del abogado con su ID
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation (abogados):', error);
            });
    }

    // Función para obtener los datos de los productos (casos)
    function fetchProducts() {
        fetch('http://localhost:8080/tipificacion1')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(product => {
                    addProductToTable(product);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    // Función para agregar un producto a la tabla
    function addProductToTable(product) {
        const row = document.createElement('tr');

        // Obtener el nombre del abogado utilizando su ID desde el mapa
        const abogadoNombre = abogadosMap.get(product.abogados.id) || 'Desconocido';

        // Obtener el nombre del cliente desde la propiedad "clientes"
        const clienteNombre = product.clientes ? product.clientes.nombre : 'Desconocido';

        console.log('ID del Abogado en el Producto:', product.abogados.id, 'Nombre del Abogado:', abogadoNombre);
        console.log('ID del Cliente en el Producto:', product.clientes.id, 'Nombre del Cliente:', clienteNombre);

        row.innerHTML = `
            <td>${product.caso}</td>
            <td>${product.fecha_ic}</td>
            <td>${product.fecha_ct || 'No disponible'}</td>
            <td>${product.estado}</td>
            <td>${abogadoNombre}</td>
            <td>${clienteNombre}</td>  <!-- Mostrar el nombre del cliente -->
            <td>${product.archivo || 'No disponible'}</td>
            <td>
                                                        <form id="form-${product.id}" enctype="multipart/form-data">
                                                            <input type="file" name="file" class="form-control" accept=".zip" />
                                                            <button type="button" class="btn btn-primary mt-2" onclick="subirArchivo(${product.id})">Subir</button>
                                                        </form>
                                                    </td>
            <td>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-${product.id}">
                                Ver más...
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop-${product.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-${product.id}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel-${product.id}">${product.caso}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Descripción:</strong> ${product.descripcion}</p>
                                            <p><strong>Cliente:</strong> ${clienteNombre}</p>
                                            <p><strong>Abogado:</strong> ${abogadoNombre}</p>
                                            <p><strong>Estado:</strong> ${product.estado}</p>
                                            <p><strong>Fecha de inicio:</strong> ${product.fecha_ic}</p>
                                            <p><strong>Fecha de cierre:</strong> ${product.fecha_ct || 'No disponible'}</p>

                                            <div id="fileName-${product.id}" class="mt-3"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
        `;

        productTableBody.appendChild(row);
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
                                alert("Hubo un problema al subir el archivo. Intenta de nuevo más tarde.");
                            });
                        }


    document.getElementById("searchBtn").addEventListener("click", function() {
                            const nombreCliente = document.getElementById("nombreCliente").value.toLowerCase();
                            const nombreCaso = document.getElementById("nombreCaso").value.toLowerCase();

                            const rows = document.querySelectorAll("#casosTable tbody tr");
                            rows.forEach(row => {
                                const caso = row.cells[0].textContent.toLowerCase();
                                const cliente = row.cells[5].textContent.toLowerCase();
                                row.style.display =
                                    (nombreCliente === "" || cliente.includes(clienteNombre)) &&
                                    (nombreCaso === "" || caso.includes(product.caso)) ? "" : "none";
                            });
                        });

    // Llamada a la función para obtener los abogados y productos al cargar la página
    fetchAbogados().then(() => {
        fetchProducts();
    });
});
