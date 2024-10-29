// Cargar nombres de clientes al cargar la página
fetch('http://localhost:8080/tipificacion1')
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok ' + response.statusText);
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

// Manejador de evento para el formulario
document.getElementById('casoForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario

    const selectCaso = document.getElementById('seleccioncaso');
    const casoId = selectCaso.value; // Obtener el ID del caso seleccionado

    if (!casoId) {
        alert("Por favor, seleccione un caso para borrar.");
        return;
    }

    // Realizar la solicitud para borrar el caso
    fetch(`http://localhost:8080/tipificacion1/${casoId}`, {
        method: 'DELETE'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        alert('Caso borrado exitosamente!');
        // Opcional: Eliminar el caso de la lista desplegable
        selectCaso.remove(selectCaso.selectedIndex);
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Error al borrar el caso: ' + error.message);
    });
});
