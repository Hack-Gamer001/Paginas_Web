document.addEventListener('DOMContentLoaded', function() {
    class TestimonialSlider {
      constructor() {
        this.sliders = [...document.querySelectorAll('.testimony__body')];
        this.nextButton = document.querySelector('#next');
        this.prevButton = document.querySelector('#before');
        this.container = document.querySelector('.testimony__container');
        this.currentIndex = 0;
        this.autoSlideInterval = null;
        this.autoSlideDelay = 5000;
        
        this.init();
      }
      
      init() {
        if (this.sliders.length === 0) return;
        
        console.log('UpMinaa Testimonials Slider Initialized');
        
        // Set first slide as active
        this.sliders[0].classList.add('testimony__body--show');
        
        // Event listeners
        this.nextButton.addEventListener('click', () => this.changeSlide(1));
        this.prevButton.addEventListener('click', () => this.changeSlide(-1));
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
          if (e.key === 'ArrowRight') this.changeSlide(1);
          if (e.key === 'ArrowLeft') this.changeSlide(-1);
        });
        
        // Touch events for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        
        this.container.addEventListener('touchstart', (e) => {
          touchStartX = e.changedTouches[0].screenX;
        }, {passive: true});
        
        this.container.addEventListener('touchend', (e) => {
          touchEndX = e.changedTouches[0].screenX;
          this.handleSwipe();
        }, {passive: true});
        
        // Auto-slide
        this.startAutoSlide();
        
        // Pause on hover
        this.container.addEventListener('mouseenter', () => this.pauseAutoSlide());
        this.container.addEventListener('mouseleave', () => this.startAutoSlide());
      }
      
      changeSlide(direction) {
        this.sliders[this.currentIndex].classList.remove('testimony__body--show');
        
        this.currentIndex += direction;
        
        // Circular navigation
        if (this.currentIndex >= this.sliders.length) {
          this.currentIndex = 0;
        } else if (this.currentIndex < 0) {
          this.currentIndex = this.sliders.length - 1;
        }
        
        this.sliders[this.currentIndex].classList.add('testimony__body--show');
        this.resetAutoSlide();
      }
      
      startAutoSlide() {
        this.autoSlideInterval = setInterval(() => {
          this.changeSlide(1);
        }, this.autoSlideDelay);
      }
      
      pauseAutoSlide() {
        clearInterval(this.autoSlideInterval);
      }
      
      resetAutoSlide() {
        this.pauseAutoSlide();
        this.startAutoSlide();
      }
      
      handleSwipe() {
        const threshold = 50;
        const difference = touchStartX - touchEndX;
        
        if (difference > threshold) {
          this.changeSlide(1); // Swipe left
        } else if (difference < -threshold) {
          this.changeSlide(-1); // Swipe right
        }
      }
    }
    
    // Initialize slider
    new TestimonialSlider();
  });