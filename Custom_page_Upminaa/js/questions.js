document.addEventListener('DOMContentLoaded', function() {
    class FAQSystem {
      constructor() {
        this.questions = [...document.querySelectorAll('.questions__title')];
        this.activeIndex = 0;
        
        this.init();
      }
      
      init() {
        console.log('UpMinaa FAQ System Initialized');
        
        if (this.questions.length === 0) return;
        
        // Open first question by default
        this.toggleQuestion(this.questions[0]);
        
        // Set up event listeners
        this.questions.forEach(question => {
          question.addEventListener('click', () => {
            this.toggleQuestion(question);
            
            // Analytics tracking (example)
            console.log(`FAQ question clicked: ${question.textContent.trim()}`);
          });
        });
      }
      
      toggleQuestion(question) {
        const answer = question.nextElementSibling;
        const container = question.parentElement.parentElement;
        const arrow = question.querySelector('.questions__arrow');
        
        // Close all other questions
        if (question.dataset.faqOpen !== 'true') {
          this.questions.forEach(q => {
            if (q !== question) {
              q.nextElementSibling.style.height = '0';
              q.parentElement.parentElement.classList.remove('questions__padding--add');
              q.querySelector('.questions__arrow').classList.remove('questions__arrow--rotate');
              q.dataset.faqOpen = 'false';
            }
          });
        }
        
        // Toggle current question
        if (question.dataset.faqOpen === 'true') {
          // Close
          answer.style.height = '0';
          container.classList.remove('questions__padding--add');
          arrow.classList.remove('questions__arrow--rotate');
          question.dataset.faqOpen = 'false';
        } else {
          // Open
          answer.style.height = `${answer.scrollHeight}px`;
          container.classList.add('questions__padding--add');
          arrow.classList.add('questions__arrow--rotate');
          question.dataset.faqOpen = 'true';
          
          // Scroll to question if it's not fully visible
          const questionRect = question.getBoundingClientRect();
          if (questionRect.top < 100 || questionRect.bottom > window.innerHeight) {
            window.scrollTo({
              top: window.scrollY + questionRect.top - 100,
              behavior: 'smooth'
            });
          }
        }
      }
    }
    
    // Initialize FAQ system
    new FAQSystem();
    
    // Add animation for smoother transitions
    const style = document.createElement('style');
    style.textContent = `
      .questions__answer {
        transition: height 0.4s ease, padding 0.4s ease;
        will-change: height;
      }
      
      .questions__arrow {
        transition: transform 0.4s ease;
      }
      
      .questions__padding {
        transition: padding 0.4s ease;
      }
    `;
    document.head.appendChild(style);
  });