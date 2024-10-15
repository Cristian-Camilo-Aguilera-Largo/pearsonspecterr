document.addEventListener('DOMContentLoaded', function() {

    //Cargar nombres de abogados al cargar la pagina
    fetch('http://localhost:8080/roles')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok '+ response.statusText);
        }
        return response.json();
    })
    .then(data => {
        const nombreSelect = document.getElementById('seleccion');
        data.forEach(roles => {
            const option = document.createElement('option');
            option.value = roles.id_rol;
            option.text = roles.rol;
            nombreSelect.appendChild(option);
        });
    })
    .catch((error) => {
        console.error('Error:', error);
    });

    //Subir a la base de datos
    const casoForm = document.getElementById('casoForm');
    if(casoForm) {
        casoForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const seleccion = document.getElementById('seleccion');
            const caso = {
                User: document.getElementById('User').value,
                Pass: document.getElementById('Pass').value,
                idRol: seleccion.value
            };
            console.log('ID del cliente a enviar:', caso.idRol);
            fetch('http://localhost:8080/enviousuarios', {
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


