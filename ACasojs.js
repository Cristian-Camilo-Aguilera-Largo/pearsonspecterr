//Quitar fecha

function toggleFechaTc(){
    const estado = document.getElementById('Estado').value;
    const fechaTcContainer = document.getElementById('fechaTcContainer');
    if (estado === 'en_proceso'){
        fechaTcContainer.style.display = 'none';
    } else {
        fechaTcContainer.style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', function() {

    //Cargar nombres de abogados al cargar la pagina
    fetch('http://localhost:8080/abogados')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok '+ response.statusText);
        }
        return response.json();
    })
    .then(data => {
        const nombreSelect = document.getElementById('seleccion');
        data.forEach(abogado => {
            const option = document.createElement('option');
            option.value = abogado.id;
            option.text = abogado.nombre;
            nombreSelect.appendChild(option);
        });
    })
    .catch((error) => {
        console.error('Error:', error);
    });

    //Cargar nombres de abogados al cargar la pagina
    fetch('http://localhost:8080/clientes')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok '+ response.statusText);
        }
        return response.json();
    })
    .then(data => {
        const nombreSelect = document.getElementById('seleccionc');
        data.forEach(abogado => {
            const option = document.createElement('option');
            option.value = abogado.id;
            option.text = abogado.nombre;
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
            const abogadoNombre = seleccion.options[seleccion.selectedIndex].text;

            const caso = {
                idAbogado: seleccion.value, // Asegúrate de enviar el ID aquí
                caso: document.getElementById('Caso').value,
                descripcion: document.getElementById('Descripcion').value,
                fecha_ic: document.getElementById('Fecha_ic').value,
                estado: document.getElementById('Estado').value,
                fecha_ct: document.getElementById('Fecha_tc').value
            };
    
            fetch('http://localhost:8080/envio', {
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


