// Interactividad general del sitio
document.addEventListener('DOMContentLoaded', () => {
    // Añadir animaciones de entrada
    const sections = document.querySelectorAll('main > section');
    sections.forEach(section => {
        section.classList.add('fade-in');
    });

    // Interacciones para la galería de cosplays
    const cosplayCards = document.querySelectorAll('.cosplay-card');
    cosplayCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.classList.add('hover-effect');
        });
        card.addEventListener('mouseleave', () => {
            card.classList.remove('hover-effect');
        });
    });

    // Formulario de contacto (ejemplo básico)
    const contactForm = document.querySelector('.contact-form form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Mensaje enviado. ¡Gracias por contactarme!');
            contactForm.reset();
        });
    }
});