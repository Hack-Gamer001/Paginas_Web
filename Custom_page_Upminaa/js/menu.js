document.addEventListener('DOMContentLoaded', function() {
    // Menu functionality
    const menu = {
      init: function() {
        this.openButton = document.querySelector('.nav__menu');
        this.menu = document.querySelector('.nav__link--menu');
        this.closeButton = document.querySelector('.nav__close');
        this.links = document.querySelectorAll('.nav__links');
        this.nav = document.querySelector('.nav');
        
        this.setupEvents();
        console.log('UpMinaa Menu System Initialized');
      },
      
      setupEvents: function() {
        this.openButton.addEventListener('click', this.toggleMenu.bind(this, true));
        this.closeButton.addEventListener('click', this.toggleMenu.bind(this, false));
        
        this.links.forEach(link => {
          link.addEventListener('click', this.handleLinkClick.bind(this));
        });
        
        window.addEventListener('scroll', this.handleScroll.bind(this));
      },
      
      toggleMenu: function(show) {
        this.menu.classList.toggle('nav__link--show', show);
        document.body.style.overflow = show ? 'hidden' : 'auto';
        
        // Animate menu items
        if (show) {
          const items = this.menu.querySelectorAll('.nav__items');
          items.forEach((item, index) => {
            item.style.animation = `fadeInUp 0.3s ease ${index * 0.1}s forwards`;
          });
        }
      },
      
      handleLinkClick: function(event) {
        const target = event.currentTarget.getAttribute('href');
        
        this.toggleMenu(false);
        
        if (target !== '#') {
          event.preventDefault();
          const section = document.querySelector(target);
          if (section) {
            window.scrollTo({
              top: section.offsetTop - 80,
              behavior: 'smooth'
            });
          }
        }
      },
      
      handleScroll: function() {
        if (window.scrollY > 100) {
          this.nav.style.backgroundColor = 'rgba(26, 26, 46, 0.95)';
          this.nav.style.boxShadow = '0 5px 15px rgba(0,0,0,0.3)';
          this.nav.style.padding = '15px 0';
        } else {
          this.nav.style.backgroundColor = 'transparent';
          this.nav.style.boxShadow = 'none';
          this.nav.style.padding = '20px 0';
        }
      }
    };
    
    menu.init();
    
    // Add animation for menu items
    const style = document.createElement('style');
    style.textContent = `
      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    `;
    document.head.appendChild(style);
  });