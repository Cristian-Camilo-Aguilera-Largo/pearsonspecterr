document.addEventListener('DOMContentLoaded', function () {
    const productTableBody = document.getElementById('productTable').querySelector('tbody');
    const abogadosMap = new Map();

    fetchAbogados().then(() => {
        window.fetchProducts();
    });
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
    window.fetchProducts = function () {
        return fetch('http://localhost:8080/tipificacion1')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(caso => {
                    addProductToTable(caso);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    // Función para agregar un producto a la tabla
    function addProductToTable(caso) {
        const row = document.createElement('tr');

        // Obtener el nombre del abogado utilizando su ID desde el mapa
        const abogadoNombre = abogadosMap.get(caso.abogados.id) || 'Desconocido';

        // Obtener el nombre del cliente desde la propiedad "clientes"
        const clienteNombre = caso.clientes ? caso.clientes.nombre : 'Desconocido';
        const archivoSubido = caso.archivo ?
            `<a href="http://localhost:8080/files/${caso.archivo}" download="${caso.archivo}">${caso.archivo}</a>` :
                'No disponible';

        console.log('ID del Abogado en el Producto:', caso.abogados.id, 'Nombre del Abogado:', abogadoNombre);
        console.log('ID del Cliente en el Producto:', caso.clientes.id, 'Nombre del Cliente:', clienteNombre);

        row.innerHTML = `
            <td>${caso.caso}</td>
            <td>${caso.estado}</td>
            <td>${caso.fecha_ic}</td>
            <td>${caso.fecha_ct || 'No disponible'}</td>
            <td>${abogadoNombre}</td>
            <td>${clienteNombre}</td>  <!-- Mostrar el nombre del cliente -->
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
                                <p><strong>Cliente:</strong> ${clienteNombre}</p>
                                <p><strong>Abogado:</strong> ${abogadoNombre}</p>
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
        `;

        productTableBody.appendChild(row);
    }
    // Llamada a la función para obtener los abogados y productos al cargar la página

});
function descargarArchivo(filename) {
    const link = document.createElement('a');
    link.href = `http://localhost:8080/files/${filename}`;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
const productTableBody = document.getElementById('productTable').querySelector('tbody');
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
        productTableBody.innerHTML = '';
        window.fetchProducts();
    })
    .catch(error => {
        console.error("Error al subir el archivo:", error);
        alert("Hubo un problema al subir el archivo. Intenta de nuevo más tarde.");
    });
}

    

