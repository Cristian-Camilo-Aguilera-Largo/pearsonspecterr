//Quitar fecha

function toggleFechaTc(){
    const estado = document.getElementById('nuevoEstado').value;
    const fechaTcContainer = document.getElementById('fechaTcContainer');
    if (estado === 'en_proceso' || estado === 'anulado'){
        fechaTcContainer.style.display = 'none';
    } else {
        fechaTcContainer.style.display = 'block';
    }
}

//Cargar nombres de casos al cargar la pagina
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
    .catch(error => console.error('Error:', error));


// Escuchar cambios en la selección del caso
document.getElementById('seleccioncaso').addEventListener('change', function () {
    const selectedId = this.value;
    if (selectedId) {
        fetch(`http://localhost:8080/tipificacion1/${selectedId}`)
            .then(response => {
                if(!response.ok) {
                    throw new Error('Netwrok response was not ok '+response.statusText);
                }
                return response.json();
            })
            .then(vista => {
                // Mostrar los detalles en los elementos <span>
                document.getElementById('idActual').textContent = vista.id;
                document.getElementById('nombreActual').textContent = vista.caso;
                document.getElementById('Descripcion').textContent = vista.descripcion;
                document.getElementById('fechaActual').textContent = vista.fecha_ic || 'No disponible';
                document.getElementById('estadoActual').textContent = vista.estado;
                document.getElementById('fechaFinalizacionActual').textContent = vista.fecha_ct || 'No disponible';
            })
            .catch(error => console.error('Error al cargar los detalles del caso:', error));
    }

    //Cargar nombres de clientes al cargar la pagina
    fetch('http://localhost:8080/clientes')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok '+ response.statusText);
        }
        return response.json();
    })
    .then(data => {
        const nombreSelect = document.getElementById('seleccionclientes');
        data.forEach(clientes => {
            const option = document.createElement('option');
            option.value = clientes.id;
            option.text = clientes.nombre;
            nombreSelect.appendChild(option);
        });
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

document.getElementById('formActualizarCaso').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    const selectedId = document.getElementById('seleccioncaso').value; // ID del caso seleccionado
    const clienteId = document.getElementById('seleccionclientes').value; // ID del cliente seleccionado
    const descripcion = document.getElementById('nuevaDescripcion').value;
    const fechaInicio = document.getElementById('nuevaFecha').value;
    const estado = document.getElementById('nuevoEstado').value;
    const fechaFin = document.getElementById('nuevaFechaFin').value;

    // Crear el objeto de datos para enviar en la solicitud PUT
    const updatedData = {
        descripcion: descripcion,
        fecha_ic: fechaInicio,
        estado: estado,
        fecha_ct: fechaFin,
        clientes: { id: clienteId } // Asegúrate de que el ID del cliente sea parte de la entidad Casos en Spring
    };

    // Realizar la solicitud PUT para actualizar el caso
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
        // Opcional: recargar o actualizar la información del caso mostrado
    })
    .catch(error => {
        console.error('Error al actualizar el caso:', error);
        alert('Hubo un error al actualizar el caso.');
    });
});

