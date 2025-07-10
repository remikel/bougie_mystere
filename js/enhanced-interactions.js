// Enhanced JavaScript for improved user experience
class BougieApp {
    constructor() {
        this.currentStep = 0;
        this.totalSteps = 4;
        this.formData = {};
        this.init();
    }

    init() {
        this.bindEvents();
        this.initializeForm();
        this.setupProgressBar();
        this.setupValidation();
    }

    bindEvents() {
        // Game code submission
        const goButton = document.getElementById('go');
        const codeInput = document.getElementById('code');
        
        if (goButton && codeInput) {
            goButton.addEventListener('click', this.handleCodeSubmission.bind(this));
            codeInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    this.handleCodeSubmission();
                }
            });
            
            // Real-time code validation
            codeInput.addEventListener('input', this.validateCodeInput.bind(this));
        }

        // Form navigation
        document.querySelectorAll('.etape_suivante').forEach(btn => {
            btn.addEventListener('click', this.handleNextStep.bind(this));
        });
        
        document.querySelectorAll('.etape_precedente').forEach(btn => {
            btn.addEventListener('click', this.handlePrevStep.bind(this));
        });

        // Solution buttons
        const solutionBtn = document.getElementById('solution');
        const tryBtn = document.getElementById('try2');
        
        if (solutionBtn) {
            solutionBtn.addEventListener('click', this.showSolution.bind(this));
        }
        
        if (tryBtn) {
            tryBtn.addEventListener('click', this.showTryInterface.bind(this));
        }

        // Form submission
        const form = document.getElementById('myform');
        if (form) {
            form.addEventListener('submit', this.handleFormSubmission.bind(this));
        }

        // Real-time form validation
        document.querySelectorAll('.champtxt').forEach(input => {
            input.addEventListener('blur', this.validateField.bind(this));
            input.addEventListener('input', this.clearFieldError.bind(this));
        });
    }

    handleCodeSubmission() {
        const codeInput = document.getElementById('code');
        const errorDiv = document.getElementById('error');
        const code = codeInput.value.trim();

        if (!code) {
            this.showError('Veuillez entrer un code.', errorDiv);
            return;
        }

        if (code === '2547') {
            this.showSuccess('Code correct ! Redirection...', errorDiv);
            setTimeout(() => {
                window.location.href = 'questionnaire.php';
            }, 1500);
        } else {
            this.showError('Ce n\'est pas ça ! Essaie encore !', errorDiv);
            codeInput.value = '';
            codeInput.focus();
        }
    }

    validateCodeInput(e) {
        const input = e.target;
        const value = input.value;
        
        // Only allow numbers
        input.value = value.replace(/[^0-9]/g, '');
        
        // Limit to 4 characters
        if (input.value.length > 4) {
            input.value = input.value.substring(0, 4);
        }
    }

    showSolution() {
        const solutionDiv = document.getElementById('solution2');
        if (solutionDiv) {
            solutionDiv.style.display = 'block';
            solutionDiv.scrollIntoView({ behavior: 'smooth' });
            
            // Auto-hide after 15 seconds
            setTimeout(() => {
                this.hideElement(solutionDiv);
            }, 15000);
        }
    }

    showTryInterface() {
        const baseButtons = document.querySelectorAll('.base');
        const tryDiv = document.querySelector('.try');
        
        baseButtons.forEach(btn => this.hideElement(btn));
        if (tryDiv) {
            tryDiv.style.display = 'block';
            tryDiv.querySelector('.css-input')?.focus();
        }
    }

    initializeForm() {
        // Set up form steps
        for (let i = 1; i <= this.totalSteps; i++) {
            const step = document.getElementById(`etape${i}_recherche`);
            if (step && i > 0) {
                step.style.display = 'none';
            }
        }
        
        this.updateProgressBar();
    }

    setupProgressBar() {
        const container = document.getElementById('bloc_recherche_couleur');
        if (container && !container.querySelector('.progress-container')) {
            const progressHTML = `
                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>
            `;
            container.insertAdjacentHTML('afterbegin', progressHTML);
        }
    }

    updateProgressBar() {
        const progressBar = document.getElementById('progress-bar');
        if (progressBar) {
            const percentage = (this.currentStep / this.totalSteps) * 100;
            progressBar.style.width = `${percentage}%`;
        }
    }

    handleNextStep(e) {
        e.preventDefault();
        const currentStepNum = parseInt(e.target.getAttribute('etape'));
        
        if (this.validateCurrentStep(currentStepNum)) {
            this.animateStepTransition(currentStepNum, currentStepNum + 1);
            this.currentStep = currentStepNum + 1;
            this.updateProgressBar();
        }
    }

    handlePrevStep(e) {
        e.preventDefault();
        const currentStepNum = parseInt(e.target.getAttribute('etape'));
        
        this.animateStepTransition(currentStepNum, currentStepNum - 1);
        this.currentStep = currentStepNum - 1;
        this.updateProgressBar();
    }

    validateCurrentStep(stepNum) {
        const currentStep = document.getElementById(`etape${stepNum}_recherche`);
        if (!currentStep) return true;

        const requiredFields = currentStep.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!this.validateField({ target: field })) {
                isValid = false;
            }
        });

        return isValid;
    }

    animateStepTransition(fromStep, toStep) {
        const fromElement = document.getElementById(`etape${fromStep}_recherche`);
        const toElement = document.getElementById(`etape${toStep}_recherche`);
        
        if (fromElement && toElement) {
            fromElement.style.opacity = '0';
            fromElement.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                fromElement.style.display = 'none';
                toElement.style.display = 'block';
                toElement.style.opacity = '0';
                toElement.style.transform = 'translateX(20px)';
                
                // Force reflow
                toElement.offsetHeight;
                
                toElement.style.opacity = '1';
                toElement.style.transform = 'translateX(0)';
                
                // Focus first input in new step
                const firstInput = toElement.querySelector('.champtxt');
                if (firstInput) {
                    setTimeout(() => firstInput.focus(), 300);
                }
            }, 200);
        }
    }

    setupValidation() {
        // Add validation patterns
        const patterns = {
            hashtag: /^[a-zA-Z0-9_àáâäçéèêëïíîôöùúûüÿñæœ]+$/,
            email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        };

        Object.keys(patterns).forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field) {
                field.pattern = patterns[fieldName].source;
            }
        });
    }

    validateField(e) {
        const field = e.target;
        const value = field.value.trim();
        const fieldName = field.name;
        let isValid = true;
        let errorMessage = '';

        // Remove existing error styling
        this.clearFieldError(e);

        // Required field validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'Ce champ est requis.';
        }
        
        // Length validation
        else if (value) {
            const maxLength = parseInt(field.getAttribute('maxlength'));
            if (maxLength && value.length > maxLength) {
                isValid = false;
                errorMessage = `Maximum ${maxLength} caractères.`;
            }

            // Field-specific validation
            switch (fieldName) {
                case 'email':
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                        isValid = false;
                        errorMessage = 'Adresse email invalide.';
                    }
                    break;
                    
                case 'hashtag':
                    if (!/^[a-zA-Z0-9_àáâäçéèêëïíîôöùúûüÿñæœ]+$/.test(value)) {
                        isValid = false;
                        errorMessage = 'Caractères autorisés: lettres, chiffres et underscore.';
                    }
                    break;
            }
        }

        if (!isValid) {
            this.showFieldError(field, errorMessage);
        }

        return isValid;
    }

    showFieldError(field, message) {
        const formGroup = field.closest('.form-group') || this.createFormGroup(field);
        formGroup.classList.add('has-error');
        
        let errorDiv = formGroup.querySelector('.error-message');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            formGroup.appendChild(errorDiv);
        }
        
        errorDiv.textContent = message;
        field.setAttribute('aria-describedby', 'error-' + field.name);
        errorDiv.id = 'error-' + field.name;
    }

    clearFieldError(e) {
        const field = e.target;
        const formGroup = field.closest('.form-group');
        if (formGroup) {
            formGroup.classList.remove('has-error');
            const errorDiv = formGroup.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.style.display = 'none';
            }
        }
    }

    createFormGroup(field) {
        const wrapper = document.createElement('div');
        wrapper.className = 'form-group';
        field.parentNode.insertBefore(wrapper, field);
        wrapper.appendChild(field);
        return wrapper;
    }

    handleFormSubmission(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        let isValid = true;

        // Validate all fields
        form.querySelectorAll('.champtxt').forEach(field => {
            if (!this.validateField({ target: field })) {
                isValid = false;
            }
        });

        if (!isValid) {
            this.showError('Veuillez corriger les erreurs avant de continuer.');
            return;
        }

        // Show loading state
        const submitButton = form.querySelector('[type="submit"]');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.classList.add('loading');
            submitButton.textContent = 'Génération en cours...';
        }

        // Submit form
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                return response.text();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            this.showError('Une erreur est survenue. Veuillez réessayer.');
        })
        .finally(() => {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.classList.remove('loading');
                submitButton.textContent = 'Générer l\'image';
            }
        });
    }

    showError(message, element = null) {
        if (!element) {
            element = document.getElementById('error') || this.createErrorElement();
        }
        
        element.textContent = message;
        element.style.display = 'block';
        element.className = 'error-message';
        
        setTimeout(() => {
            this.hideElement(element);
        }, 5000);
    }

    showSuccess(message, element = null) {
        if (!element) {
            element = document.getElementById('error') || this.createErrorElement();
        }
        
        element.textContent = message;
        element.style.display = 'block';
        element.className = 'success-message';
    }

    createErrorElement() {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'error';
        errorDiv.className = 'error-message';
        document.body.appendChild(errorDiv);
        return errorDiv;
    }

    hideElement(element) {
        if (element) {
            element.style.opacity = '0';
            setTimeout(() => {
                element.style.display = 'none';
                element.style.opacity = '1';
            }, 300);
        }
    }
}

// Initialize app when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new BougieApp();
});

// Handle URL parameters for error/success messages
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    const success = urlParams.get('success');
    
    if (error) {
        const app = new BougieApp();
        app.showError(decodeURIComponent(error));
    }
    
    if (success) {
        const app = new BougieApp();
        app.showSuccess('Image générée avec succès !');
    }
});

// Accessibility improvements
document.addEventListener('keydown', (e) => {
    // Escape key to close modals/overlays
    if (e.key === 'Escape') {
        const visibleOverlays = document.querySelectorAll('.answer[style*="display: block"]');
        visibleOverlays.forEach(overlay => {
            overlay.style.display = 'none';
        });
    }
});

// Enhanced image viewing
document.addEventListener('DOMContentLoaded', () => {
    const generatedImage = document.querySelector('.img-generated');
    if (generatedImage) {
        generatedImage.addEventListener('click', () => {
            // Open in new tab for better viewing
            window.open(generatedImage.src, '_blank');
        });
        
        generatedImage.style.cursor = 'pointer';
        generatedImage.title = 'Cliquez pour voir en grand';
    }
});