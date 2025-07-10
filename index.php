<?php 
session_start();
require_once 'includes/security.php';
$csrfToken = Security::generateCSRFToken();
include 'header.php'; 
?>

<link href="css/modern-style.css" rel="stylesheet">

<div class="section-rm">
    <div class="flex-container">
        <div class="game-container">
            <button class="btn base" id="try2">
                J'ai trouvé le code
            </button>
            
            <div class="answer" id="solution2">
                <h2>Solutions des énigmes</h2>
                <div class="solution-grid">
                    <div class="solution-item">
                        <h3>🟡 JAUNE</h3>
                        <p>Il faut utiliser les lettres sur les panneaux jaunes de la carte du monde. Pour chacune, prendre la lettre antérieure (exemple Q = P, B = A) permet de révéler les mots POISSON / PATTES / PERCHÉ</p>
                        <p>En réfléchissant à ces mots, on trouve leur point commun : le <strong>CHAT</strong></p>
                        <p>Il suffit alors de compter le nombre de chats sur la carte du monde, il y en a <strong>2</strong> !</p>
                    </div>
                    
                    <div class="solution-item">
                        <h3>🟣 VIOLET</h3>
                        <p>Il faut chercher les villes d'origine des 4 ingrédients de la recette de la bûche située sous la bougie. On trouve dans l'ordre HAVANA / OSAKA / UYO / XI'AN.</p>
                        <p>En prenant la première lettre de chaque ville, on obtient <strong>HOUX</strong>.</p>
                        <p>Il suffit alors de compter le nombre de branches de houx sur la bûche dessinée sur l'étiquette volante : il y en a <strong>5</strong> !</p>
                    </div>
                    
                    <div class="solution-item">
                        <h3>🔵 BLEU</h3>
                        <p>Il va falloir retrouver le parcours réalisé sur la carte du monde grâce à la carte postale. La personne qui nous envoie la carte postale part de RIO DE JANEIRO comme en témoigne le timbre, c'est donc le départ.</p>
                        <p>Ensuite direction PARIS en France, puis HAVANA (Comme en atteste le ticket d'avion qui est derrière la carte postale). Enfin, on finit à UYO pour faire un safari, ville à l'Est où l'on retrouve girafe et alligator.</p>
                        <p>En traçant ce chemin visuellement sur la mappemonde, on dessine le chiffre <strong>4</strong> !</p>
                    </div>
                    
                    <div class="solution-item">
                        <h3>🟠 ORANGE</h3>
                        <p>En faisant fondre la bougie, on découvre un papier caché dans de l'aluminium à la surface de la bougie, sous une fleur. Ce papier révèle un code morse, nécessaire pour décrypter le code caché dans le Pôle Sud.</p>
                        <p>En effet, les contours de la banquise forment un code visuel avec des points et des barres, on doit lire : S-E-P-T, la réponse est donc le chiffre <strong>7</strong> !</p>
                    </div>
                </div>
            </div>
            
            <button class="btn base" id="solution" style="margin-top: 2rem;">
                Je veux la solution
            </button>
            
            <div class="try">
                <div class="code-input-container">
                    <label for="code" class="form-question">Entrez le code secret :</label>
                    <input class="css-input" type="text" placeholder="Code à 4 chiffres" id="code" maxlength="4" autocomplete="off" aria-describedby="code-hint">
                    <input type="hidden" id="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                    <small id="code-hint">Utilisez les chiffres trouvés dans les énigmes</small>
                    <button class="btn" id="go">
                        Valider le code
                    </button>
                    <div id="error" class="error-message" role="alert"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Additional styles for solution display */
.solution-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
    margin-top: var(--spacing-lg);
}

.solution-item {
    background: rgba(255, 255, 255, 0.1);
    padding: var(--spacing-lg);
    border-radius: var(--border-radius);
    border-left: 4px solid var(--accent-color);
    backdrop-filter: blur(5px);
}

.solution-item h3 {
    color: #ffffff;
    margin-bottom: var(--spacing-md);
    font-size: 1.3rem;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
}

.solution-item p {
    margin-bottom: var(--spacing-sm);
    line-height: 1.6;
    color: #ffffff;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
}

.form-question {
    display: block;
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: var(--spacing-md);
    text-align: center;
}

#code-hint {
    color: rgba(68, 38, 103, 0.7);
    font-style: italic;
    text-align: center;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const solutionBtn = document.getElementById('solution');
    const tryBtn = document.getElementById('try2');
    const goBtn = document.getElementById('go');
    const codeInput = document.getElementById('code');
    const errorDiv = document.getElementById('error');
    const solutionDiv = document.getElementById('solution2');
    const tryDiv = document.querySelector('.try');
    const baseButtons = document.querySelectorAll('.base');

    // Show solution
    solutionBtn?.addEventListener('click', () => {
        solutionDiv.style.display = 'block';
        solutionDiv.scrollIntoView({ behavior: 'smooth' });
        
        // Auto-hide after 20 seconds
        setTimeout(() => {
            if (solutionDiv.style.display === 'block') {
                solutionDiv.style.opacity = '0';
                setTimeout(() => {
                    solutionDiv.style.display = 'none';
                    solutionDiv.style.opacity = '1';
                }, 300);
            }
        }, 20000);
    });

    // Show try interface
    tryBtn?.addEventListener('click', () => {
        baseButtons.forEach(btn => {
            btn.style.opacity = '0';
            setTimeout(() => btn.style.display = 'none', 200);
        });
        
        setTimeout(() => {
            tryDiv.style.display = 'block';
            codeInput?.focus();
        }, 300);
    });

    // Handle code submission
    const handleCodeSubmission = () => {
        const code = codeInput.value.trim();
        
        if (!code) {
            showError('Veuillez entrer un code.');
            return;
        }
        
        if (code === '2547') {
            showSuccess('Code correct ! Redirection en cours...');
            setTimeout(() => {
                window.location.href = 'questionnaire.php';
            }, 1500);
        } else {
            showError('Code incorrect ! Indice : utilisez les chiffres des énigmes dans l\'ordre JAUNE, VIOLET, BLEU, ORANGE.');
            codeInput.value = '';
            codeInput.focus();
        }
    };

    // Code input validation
    codeInput?.addEventListener('input', (e) => {
        // Only allow numbers
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
        
        // Clear errors when typing
        errorDiv.style.display = 'none';
    });

    // Submit on Enter key
    codeInput?.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            handleCodeSubmission();
        }
    });

    // Submit on button click
    goBtn?.addEventListener('click', handleCodeSubmission);

    // Helper functions
    function showError(message) {
        errorDiv.textContent = message;
        errorDiv.className = 'error-message';
        errorDiv.style.display = 'block';
        
        setTimeout(() => {
            errorDiv.style.opacity = '0';
            setTimeout(() => {
                errorDiv.style.display = 'none';
                errorDiv.style.opacity = '1';
            }, 300);
        }, 5000);
    }

    function showSuccess(message) {
        errorDiv.textContent = message;
        errorDiv.className = 'success-message';
        errorDiv.style.display = 'block';
    }
});
</script>

<?php include 'footer.php'; ?>