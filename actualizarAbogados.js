//Cargar nombres de abogados al cargar la pagina
fetch('http://localhost:8080/abogados')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok '+ response.statusText);
        }
        return response.json();
    })
    .then(data => {
        const nombreSelect = document.getElementById('selectAbogado');
        data.forEach(abogado => {
            const option = document.createElement('option');
            option.value = abogado.id;
            option.text = abogado.nombre;
            nombreSelect.appendChild(option);
        });
    })
    .catch(error => console.error('Error:', error));


// Escuchar cambios en la selección del caso
document.getElementById('selectAbogado').addEventListener('change', function () {
    const selectedId = this.value;
    if (selectedId) {
        fetch(`http://localhost:8080/abogados/${selectedId}`)
            .then(response => {
                if(!response.ok) {
                    throw new Error('Netwrok response was not ok '+response.statusText);
                }
                return response.json();
            })
            .then(vista => {
                // Mostrar los detalles en los elementos <span>
                document.getElementById('cedula').textContent = vista.cedula;
                document.getElementById('telefono').textContent = vista.telefono;
                document.getElementById('correo').textContent = vista.correo;
                document.getElementById('especializacion').textContent = vista.especializacion;
                document.getElementById('cargo').textContent = vista.cargo;
                document.getElementById('usuario').textContent = vista.usuarios.user;
            })
            .catch(error => console.error('Error al cargar los detalles del caso:', error));
    }
    //Cargar usuarios al cargar la pagina
    fetch('http://localhost:8080/usuarios')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok '+ response.statusText);
        }
        return response.json();
    })
    .then(data => {
        const nombreSelect = document.getElementById('seleccionusuario');
        data.forEach(usuarios => {
            const option = document.createElement('option');
            option.value = usuarios.id_usuario;
            option.text = usuarios.user;
            nombreSelect.appendChild(option);
        });
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

document.getElementById('formActualizarAbogado').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario

    const selectedId = document.getElementById('selectAbogado').value; // ID del abogado seleccionado
    const usuarioId = document.getElementById('seleccionusuario').value; // ID del usuario seleccionado
    const cedula = document.getElementById('nuevaCedula').value;
    const nombre = document.getElementById('nuevoNombre').value;
    const telefono = document.getElementById('nuevoTelefono').value;
    const correo = document.getElementById('nuevoCorreo').value;
    const especializacion = document.getElementById('nuevoEspecializacion').value;
    const cargo = document.getElementById('nuevoCargo').value;

    // Crear el objeto de datos para enviar en la solicitud PUT
    const updatedData = {
        nombre: nombre,
        cedula: cedula,
        telefono: telefono,
        correo: correo,
        especializacion: especializacion,
        cargo: cargo,
        usuarios: { id_usuario: usuarioId } // Asegúrate de que el ID del cliente sea parte de la entidad Casos en Spring
    };

    // Realizar la solicitud PUT para actualizar el caso
    fetch(`http://localhost:8080/abogados/${selectedId}`, {
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
        console.log('Abogado actualizado:', data);
        alert('Los datos del abogado se han actualizado correctamente.');
        // Opcional: recargar o actualizar la información del caso mostrado
    })
    .catch(error => {
        console.error('Error al actualizar el abogado:', error);
        alert('Hubo un error al actualizar el abogado.');
    });
});