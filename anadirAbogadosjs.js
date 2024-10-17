document.addEventListener('DOMContentLoaded', function() {    
    const casoForm = document.getElementById('casoForm');
    if(casoForm) {
        casoForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const caso = {
                nombre: document.getElementById('Nombre').value,
                cedula: document.getElementById('Cedula').value,
                telefono: document.getElementById('Telefono').value,
                correo: document.getElementById('Correo').value,
                especializacion: document.getElementById('Especializacion').value,
                cargo: document.getElementById('Cargo').value
            };
            console.log('ID del cliente a enviar:', caso.idClientes);
            fetch('http://localhost:8080/envioabogados', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(caso)
            })
            .then(response => {
                if(!response.ok) {
                    throw new Error('Network response was not ok '+response.statusText);
                }
                return response.text();
            })
            .then(text => {
                if(text) {
                    const data = JSON.parse(text);
                    console.log('Succsess:',data);
                    const confirmationMessage = document.createElement('div');
                    confirmationMessage.textContent = 'Datos enviados correctamente.';
                    confirmationMessage.style.color = 'green';
                    casoForm.appendChild(confirmationMessage);
                } else {
                    console.log('No content in response');
                    const confirmationMessage = document.createElement('div');
                    confirmationMessage.textContent = 'Datos enviados correctamente';
                    confirmationMessage.style.color = 'green';
                    casoForm.appendChild(confirmationMessage);
                }
                casoForm.reset();
            })
            .catch(error => {
                console.error('Error:',error);
                // Mostrar mensaje de confirmacion
                const errorMessage = document.createElement('div');
                errorMessage.textContent = 'Error al enviar los datos.';
                errorMessage.style.color = 'red';
                casoForm.appendChild(errorMessage);
            });
        });
    } else {
        console.error('Element with ID "casoForm" not found');
    }
});