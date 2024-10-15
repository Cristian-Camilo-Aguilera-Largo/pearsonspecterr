// app.js
document.addEventListener('DOMContentLoaded', function() {
    const productTableBody = document.getElementById('productTable').querySelector('tbody');

    // Función para obtener los datos de la API
    function fetchProducts() {
        fetch('http://localhost:8080/clientes')
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

        row.innerHTML = `
            <td>${product.id}</td>
            <td>${product.nombre}</td>
            <td>${product.apellido}</td>
            <td>${product.email}</td>
            <td>${product.telefono}</td>
        `;

        productTableBody.appendChild(row);
    }

    // Llamada a la función para obtener los productos al cargar la página
    fetchProducts();
});
