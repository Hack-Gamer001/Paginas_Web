document.addEventListener("DOMContentLoaded", function() {
    fetch('../header.html')  // El ../ sube un nivel desde Pages/
        .then(response => response.text())
        .then(data => {
            document.getElementById('header').innerHTML = data;
            // Inicializar el menú móvil después de cargar el header
            initMobileMenu();
        })
        .catch(error => console.error('Error cargando el header:', error));

    function initMobileMenu() {
        // Tu código existente para el menú móvil
        const menuBtn = document.querySelector('.nav__menu');
        const navList = document.querySelector('.nav__link--menu');
        const closeBtn = document.querySelector('.nav__close');

        if(menuBtn && navList && closeBtn) {
            menuBtn.addEventListener('click', function() {
                navList.classList.add('nav__link--show');
            });

            closeBtn.addEventListener('click', function() {
                navList.classList.remove('nav__link--show');
            });
        }
    }
});