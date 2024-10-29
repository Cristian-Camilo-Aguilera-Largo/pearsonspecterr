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