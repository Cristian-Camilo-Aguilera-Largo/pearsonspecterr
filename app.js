// app.js
document.addEventListener('DOMContentLoaded', function() {
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


    // Función para obtener los datos de la API
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

        //Obtener el nombre del abogado utilizando su ID
        const abogadoNombre = product.abogados ? product.abogados.nombre : 'Desconocido';
        console.log('ID del Abogado en el Producto:', product.id_abogados, 'Nombre del Abogado:', abogadoNombre);
        row.innerHTML = `
            <td>${product.id}</td>
            <td>${abogadoNombre}</td>
            <td>${product.caso}</td>
            <td>${product.fecha_ic}</td>
            <td>${product.estado}</td>
            <td>${product.fecha_ct}</td>
            <td>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Ver mas...
                </button>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">${product.caso}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                        </div>
                    </div>
                </div>
            </td>
            
        `;

        productTableBody.appendChild(row);
    }

    // Llamada a la función para obtener los productos al cargar la página
    fetchAbogados().then(() => {
        fetchProducts();
    });
});
