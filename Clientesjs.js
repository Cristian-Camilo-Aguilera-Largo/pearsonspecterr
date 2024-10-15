document.addEventListener('DOMContentLoaded', function() {
    const productTableBody = document.getElementById('productTable').querySelector('tbody');
    const abogadosMap = new Map();
    const clientesMap = new Map();
    
    // Asegúrate de que la variable idUsuario existe antes de utilizarla
    if (typeof idUsuario === 'undefined') {
        console.error('idUsuario no está definido.');
        return; // Detener la ejecución si idUsuario no está definido
    }

    const idClienteEspecifico = idUsuario;  // Utiliza el id_usuario del cliente logueado

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
                console.log('Abogados recibidos:', data); // Verificar datos
                data.forEach(abogado => {
                    abogadosMap.set(abogado.id, abogado.nombre); // Guardar el nombre del abogado con su ID
                });
            })
            .catch(error => {
                console.error('Error al obtener los abogados:', error);
            });
    }

    // Función para obtener los clientes de la API
    function fetchClientes() {
        return fetch('http://localhost:8080/clientes')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Clientes recibidos:', data); // Verificar datos
                data.forEach(cliente => {
                    clientesMap.set(cliente.id, cliente.nombre); // Guardar el nombre del cliente con su ID
                });
            })
            .catch(error => {
                console.error('Error al obtener los clientes:', error);
            });
    }

    // Función para obtener los casos de la API
    function fetchProducts() {
        fetch('http://localhost:8080/tipificacion1')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Casos recibidos:', data); // Verificar toda la estructura de datos

                // Filtrar los casos para que solo se muestren los relacionados con el cliente logueado
                const filteredData = data.filter(product => {
                    console.log('Producto recibido:', product); // Ver todos los campos del producto

                    // Verificar si el objeto clientes existe y tiene el id_usuario
                    if (product.clientes && product.clientes.usuarios && product.clientes.usuarios.id === idClienteEspecifico) {
                        console.log('ID del cliente en producto:', product.clientes.usuarios.id, 'Esperado:', idClienteEspecifico);
                        return true;
                    } else {
                        console.warn('Producto sin cliente asignado o diferente al cliente logueado:', product);
                        return false; // Excluir productos sin cliente o cliente incorrecto
                    }
                });

                if (filteredData.length === 0) {
                    console.warn('No se encontraron casos relacionados con el cliente especificado.');
                }

                filteredData.forEach(product => {
                    addProductToTable(product);
                });
            })
            .catch(error => {
                console.error('Error al obtener los casos:', error);
            });
    }

    // Función para agregar un caso a la tabla
    function addProductToTable(product) {
        const row = document.createElement('tr');

        // Obtener el nombre del abogado y cliente utilizando sus IDs
        const abogadoNombre = abogadosMap.get(product.abogados.id) || 'Desconocido';
        const clienteNombre = clientesMap.get(product.clientes.id) || 'Desconocido';

        console.log('ID del Abogado en el Producto:', product.abogados.id, 'Nombre del Abogado:', abogadoNombre);
        console.log('ID del Cliente en el Producto:', product.clientes.id, 'Nombre del Cliente:', clienteNombre);

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
                    Ver más...
                </button>
            </td>
        `;

        productTableBody.appendChild(row);
    }

    // Llamada a la función para obtener los abogados, clientes y luego los productos al cargar la página
    Promise.all([fetchAbogados(), fetchClientes()])
        .then(() => {
            fetchProducts();
        })
        .catch(error => {
            console.error('Error al cargar los datos iniciales:', error);
        });
});
