document.addEventListener("DOMContentLoaded", function() {
    fetch("../footer.html")  // Cambia la ruta para apuntar al directorio raíz
        .then(response => response.text())
        .then(data => document.getElementById("footer").innerHTML = data)
        .catch(error => console.error("Error al cargar el footer:", error));
});
