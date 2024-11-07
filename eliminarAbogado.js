function cargarAbogados() {
    fetch('http://localhost:8080/abogados')
    .then(response => response.json())
    .then(data => {
        const nombreSelect = document.getElementById('seleccion');
        nombreSelect.innerHTML = '<option selected disabled>Seleccione un abogado</option>';
        data.forEach(abogado => {
            const option = document.createElement('option');
            option.value = abogado.id;
            option.text = abogado.nombre;
            nombreSelect.appendChild(option);
        });
    })
    .catch((error) => {
        console.error('Error al cargar abogados:', error);
    });
}

document.getElementById('casoForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const nombreSelect = document.getElementById('seleccion');
    const abogadoId = nombreSelect.value;

    if (!abogadoId) {
        alert('Por favor, seleccione un abogado para eliminar.');
        return;
    }

    fetch(`http://localhost:8080/envioabogados/eliminar/${abogadoId}`, {
        method: 'DELETE',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('No se pudo eliminar el abogado: ' + response.statusText);
        }
        alert('Abogado eliminado exitosamente');
        cargarAbogados(); // Recarga la lista de abogados después de eliminar
    })
    .catch(error => {
        console.error('Error al eliminar el abogado:', error);
        alert('Hubo un error al intentar eliminar el abogado.');
    });
});

// Llama a cargarAbogados() cuando la página carga
window.onload = cargarAbogados;
