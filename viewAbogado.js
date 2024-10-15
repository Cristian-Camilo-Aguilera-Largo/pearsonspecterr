document.addEventListener("DOMContentLoaded", function() {
    fetchCasos();

    document.getElementById("searchBtn").addEventListener("click", function() {
        const nombreCliente = document.getElementById("nombreCliente").value.toLowerCase();
        const nombreCaso = document.getElementById("nombreCaso").value.toLowerCase();


        const rows = document.querySelectorAll("#casosTable tbody tr");
        rows.forEach(row => {
            const caso = row.cells[0].textContent.toLowerCase();
            const cliente = row.cells[5].textContent.toLowerCase();
            row.style.display =
                (nombreCliente === "" || cliente.includes(nombreCliente)) &&
                (nombreCaso === "" || caso.includes(nombreCaso)) ? "" : "none";
        });
    });
});

function fetchCasos() {
    fetch('http://localhost:8080/tipificacion1')
        .then(response => response.json())
        .then(casos => {
            const tbody = document.querySelector("#casosTable tbody");
            tbody.innerHTML = "";

            casos.forEach(caso => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${caso.caso}</td>
                    <td>${caso.descripcion}</td>
                    <td>${caso.estado}</td>
                    <td>${caso.fecha_ic}</td>
                    <td>${caso.fecha_ct}</td>
                    <td>${clientes.nombre}</td>
                    <td><a href="${caso.archivo}" download>Subir</a></td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los casos:', error));
}
