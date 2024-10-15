//Cargar nombres de clientes al cargar la pagina
fetch('http://localhost:8080/tipificacion1')
.then(response => {
    if(!response.ok) {
        throw new Error('Network response was not ok '+ response.statusText);
    }
    return response.json();
})
.then(data => {
    const nombreSelect = document.getElementById('seleccioncaso');
    data.forEach(caso => {
        const option = document.createElement('option');
        option.value = caso.id;
        option.text = caso.caso;
        nombreSelect.appendChild(option);
    });
})
.catch((error) => {
    console.error('Error:', error);
});

document.addEventListener('DOMContentLoaded', function() {

    // Función para obtener los datos de la API
    fetch('http://localhost:8080/caso')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
    })

    // Mostrar los datos en los elementos <span>
    .then(data => {
        document.getElementById('idActual').textContent = data.id;
        document.getElementById('nombreActual').textContent = data.caso;
        document.getElementById('Descripcion').textContent = data.descripcion;
        document.getElementById('fechaActual').textContent = data.fecha_ic;
        document.getElementById('estadoActual').textContent = data.estado;
        document.getElementById('fechaFinalizacionActual').textContent = data.fecha_ct;
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    })
    // Llamada a la función para obtener los productos al cargar la página

})
