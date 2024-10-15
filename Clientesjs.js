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
     // Función para obtener los clientes de la API
        function fetchAbogados() {
            return fetch('http://localhost:8080/clientes')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('clientes:', data);
                    data.forEach(clientes => {
                        clientesMap.set(clientes.id, clientes.nombre); // Guardar el nombre del clientes con su ID
                    });
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation (clientes):', error);
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
        const clienteNombre = product.clientes ? product.clientes.nombre : 'Desconocido';
        console.log('ID del Abogado en el Producto:', product.id_clientes, 'Nombre del Abogado:', clienteNombre);
        row.innerHTML = `
            <td>${product.id}</td>
            <td>${abogadoNombre}</td>
            <td>${clienteNombre}</td>
            <td>${product.caso}</td>
            <td>${product.fecha_ic}</td>
            <td>${product.estado}</td>
            <td>${product.fecha_ct}</td>
            <td>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Ver mas...
                </button>
            </td>

        `;

        productTableBody.appendChild(row);
    }

    // Llamada a la función para obtener los productos al cargar la página
    fetchAbogados().then(() => {
        fetchProducts();
    });
});
