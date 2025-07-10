<?php 
session_start();
require_once 'includes/security.php';

// Validate image parameter
$imageSrc = isset($_GET['src']) ? Security::sanitizeInput($_GET['src']) : '';

// Validate that the image exists and is from the correct directory
if (empty($imageSrc) || !preg_match('/^images\/generated\/[a-zA-Z0-9@._-]+\.(jpeg|jpg|png)$/i', $imageSrc)) {
    header('Location: index.php?error=' . urlencode('Image non trouvée'));
    exit;
}

// Check if file actually exists
if (!file_exists($imageSrc)) {
    header('Location: index.php?error=' . urlencode('Fichier image introuvable'));
    exit;
}

include 'header.php'; 
?>

<link href="css/modern-style.css" rel="stylesheet">

<div class="section-rm">
    <div class="flex-container">
        <div class="result-container">
            <div class="result-header">
                <div class="celebration-animation">
                    <div class="confetti"></div>
                    <div class="celebration-icon">🎉</div>
                </div>
                <h1>Félicitations !</h1>
                <h2>Voici ton illustration personnalisée</h2>
                <p class="result-intro">
                    Ton univers unique a été créé ! Cette illustration reflète tes goûts, 
                    ta personnalité et ton instant présent. Elle est entièrement unique, 
                    comme toi !
                </p>
            </div>

            <div class="image-showcase">
                <div class="image-frame">
                    <img src="<?= htmlspecialchars($imageSrc) ?>" 
                         alt="Ton illustration personnalisée Bougie Mystère" 
                         class="generated-image" 
                         loading="lazy">
                </div>
                
                <div class="image-info">
                    <div class="info-card">
                        <div class="info-icon">📱</div>
                        <h3>Sur mobile</h3>
                        <p>Appui long sur l'image puis "Enregistrer"</p>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">💻</div>
                        <h3>Sur ordinateur</h3>
                        <p>Clic droit puis "Enregistrer l'image sous"</p>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">🖨️</div>
                        <h3>À imprimer</h3>
                        <p>Format carte postale idéal pour l'impression</p>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="<?= htmlspecialchars($imageSrc) ?>" 
                   class="btn btn-primary" 
                   download="mon-illustration-bougie-mystere.jpg"
                   target="_blank">
                    💾 Télécharger mon illustration
                </a>
                <button class="btn btn-secondary" onclick="shareImage()">
                    📤 Partager
                </button>
                <a href="questionnaire.php" class="btn btn-outline">
                    🎨 Créer une nouvelle illustration
                </a>
            </div>

            <div class="sharing-section">
                <h3>Partage ton expérience !</h3>
                <p>Tu as aimé l'aventure Bougie Mystère ? Partage ton expérience et découvre le travail de Noémie !</p>
                <div class="social-links">
                    <a href="https://www.instagram.com/noemie_pulido/" 
                       target="_blank" 
                       rel="noopener" 
                       class="social-btn instagram">
                        <span class="social-icon">📸</span>
                        <span>Suivre @noemie_pulido</span>
                    </a>
                    <a href="mailto:hello@noemie-pulido.fr" 
                       class="social-btn email">
                        <span class="social-icon">📧</span>
                        <span>Contact</span>
                    </a>
                </div>
            </div>

            <div class="experience-feedback">
                <div class="feedback-card">
                    <h3>🚀 L'aventure continue</h3>
                    <p>
                        Cette illustration capture ton instant présent, mais demain sera différent ! 
                        Reviens quand tu veux pour créer une nouvelle illustration qui reflétera 
                        ton évolution et tes nouveaux goûts.
                    </p>
                    <small>Chaque illustration est unique et éphémère, tout comme les moments de la vie.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.result-container {
    max-width: 900px;
    margin: 0 auto;
    padding: var(--spacing-lg);
}

.result-header {
    text-align: center;
    margin-bottom: var(--spacing-xxl);
    position: relative;
}

.celebration-animation {
    position: relative;
    margin-bottom: var(--spacing-lg);
}

.celebration-icon {
    font-size: 4rem;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-20px); }
    60% { transform: translateY(-10px); }
}

.confetti {
    position: absolute;
    width: 10px;
    height: 10px;
    background: var(--secondary-color);
    animation: confetti-fall 3s infinite;
}

@keyframes confetti-fall {
    0% { transform: translateY(-100px) rotate(0deg); opacity: 1; }
    100% { transform: translateY(200px) rotate(360deg); opacity: 0; }
}

.result-header h1 {
    color: var(--primary-color);
    font-size: 2.5rem;
    margin-bottom: var(--spacing-sm);
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.result-header h2 {
    color: var(--secondary-color);
    font-size: 1.5rem;
    margin-bottom: var(--spacing-lg);
    font-weight: 600;
}

.result-intro {
    font-size: 1.1rem;
    line-height: 1.6;
    color: rgba(68, 38, 103, 0.8);
    max-width: 600px;
    margin: 0 auto;
}

.image-showcase {
    margin-bottom: var(--spacing-xxl);
}

.image-frame {
    position: relative;
    max-width: 600px;
    margin: 0 auto var(--spacing-lg);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(68, 38, 103, 0.3);
    transition: var(--transition);
    cursor: pointer;
}

.image-frame:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(68, 38, 103, 0.4);
}

.generated-image {
    width: 100%;
    height: auto;
    display: block;
    transition: var(--transition);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.image-frame:hover .image-overlay {
    opacity: 1;
}

.zoom-hint {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}

.image-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
}

.info-card {
    background: rgba(255, 255, 255, 0.9);
    padding: var(--spacing-lg);
    border-radius: var(--border-radius);
    text-align: center;
    box-shadow: 0 4px 15px rgba(68, 38, 103, 0.1);
    backdrop-filter: blur(10px);
    transition: var(--transition);
}

.info-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(68, 38, 103, 0.2);
}

.info-icon {
    font-size: 2rem;
    margin-bottom: var(--spacing-sm);
    display: block;
}

.info-card h3 {
    color: var(--primary-color);
    font-size: 1.1rem;
    margin-bottom: var(--spacing-xs);
}

.info-card p {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
}

.action-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-md);
    justify-content: center;
    margin-bottom: var(--spacing-xxl);
}

.sharing-section {
    text-align: center;
    background: linear-gradient(135deg, rgba(68, 38, 103, 0.05), rgba(245, 183, 19, 0.05));
    padding: var(--spacing-xxl);
    border-radius: var(--border-radius-lg);
    margin-bottom: var(--spacing-xl);
    backdrop-filter: blur(10px);
}

.sharing-section h3 {
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-bottom: var(--spacing-md);
}

.sharing-section p {
    color: rgba(68, 38, 103, 0.8);
    font-size: 1.1rem;
    margin-bottom: var(--spacing-lg);
    line-height: 1.6;
}

.social-links {
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-md);
    justify-content: center;
}

.social-btn {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-md) var(--spacing-lg);
    background: var(--white);
    border: 2px solid transparent;
    border-radius: 50px;
    text-decoration: none;
    color: var(--primary-color);
    font-weight: 600;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(68, 38, 103, 0.1);
}

.social-btn:hover {
    border-color: var(--accent-color);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(68, 38, 103, 0.2);
    color: var(--accent-color);
}

.social-icon {
    font-size: 1.2rem;
}

.experience-feedback {
    text-align: center;
}

.feedback-card {
    background: rgba(255, 255, 255, 0.9);
    padding: var(--spacing-xxl);
    border-radius: var(--border-radius-lg);
    border: 2px solid rgba(245, 183, 19, 0.3);
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 30px rgba(68, 38, 103, 0.1);
}

.feedback-card h3 {
    color: var(--primary-color);
    font-size: 1.4rem;
    margin-bottom: var(--spacing-md);
}

.feedback-card p {
    color: rgba(68, 38, 103, 0.8);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: var(--spacing-md);
}

.feedback-card small {
    color: #888;
    font-style: italic;
    font-size: 0.9rem;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-content {
    position: relative;
    margin: auto;
    padding: 20px;
    width: 90%;
    max-width: 800px;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
}

.close {
    position: absolute;
    top: 10px;
    right: 25px;
    color: white;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
    z-index: 1001;
}

.close:hover {
    color: var(--secondary-color);
}

.modal-content img {
    max-width: 100%;
    max-height: 80vh;
    border-radius: var(--border-radius);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
}

.modal-actions {
    margin-top: var(--spacing-lg);
}

/* Responsive Design */
@media (max-width: 768px) {
    .result-header h1 {
        font-size: 2rem;
    }
    
    .result-header h2 {
        font-size: 1.3rem;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .action-buttons .btn {
        width: 100%;
        max-width: 300px;
    }
    
    .social-links {
        flex-direction: column;
        align-items: center;
    }
    
    .social-btn {
        width: 100%;
        max-width: 280px;
        justify-content: center;
    }
    
    .image-info {
        grid-template-columns: 1fr;
    }
    
    .sharing-section {
        padding: var(--spacing-lg);
    }
}

@media (max-width: 480px) {
    .result-container {
        padding: var(--spacing-md);
    }
    
    .celebration-icon {
        font-size: 3rem;
    }
    
    .result-header h1 {
        font-size: 1.8rem;
    }
    
    .feedback-card {
        padding: var(--spacing-lg);
    }
}
</style>

<script>
function openImageModal() {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const img = document.querySelector('.generated-image');
    
    if (modal && modalImg && img) {
        modal.style.display = 'block';
        modalImg.src = img.src;
        document.body.style.overflow = 'hidden';
    }
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function shareImage() {
    if (navigator.share) {
        navigator.share({
            title: 'Mon illustration Bougie Mystère',
            text: 'Découvre mon illustration personnalisée créée avec Bougie Mystère !',
            url: window.location.href
        }).catch(console.error);
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Lien copié dans le presse-papier !');
        }).catch(() => {
            alert('Impossible de partager automatiquement. Copiez ce lien: ' + window.location.href);
        });
    }
}

// Generate confetti particles
document.addEventListener('DOMContentLoaded', () => {
    const celebration = document.querySelector('.celebration-animation');
    
    if (celebration) {
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.backgroundColor = ['#442667', '#F5B713', '#BE1273'][Math.floor(Math.random() * 3)];
            confetti.style.animationDelay = Math.random() * 3 + 's';
            confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
            celebration.appendChild(confetti);
        }
        
        // Remove confetti after animations
        setTimeout(() => {
            document.querySelectorAll('.confetti').forEach(el => el.remove());
        }, 6000);
    }
    
    // Add modal click handler with delay to override enhanced-interactions.js
    setTimeout(() => {
        const generatedImage = document.querySelector('.generated-image');
        if (generatedImage) {
            // Remove the onclick attribute if it exists
            generatedImage.removeAttribute('onclick');
            
            // Add our modal click handler
            generatedImage.addEventListener('click', function(e) {
                e.stopPropagation();
                e.preventDefault();
                openImageModal();
            });
            generatedImage.style.cursor = 'pointer';
            generatedImage.title = 'Cliquez pour agrandir';
        }
    }, 100);
});

// Close modal on Escape key (with higher priority than enhanced-interactions.js)
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const modal = document.getElementById('imageModal');
        if (modal && modal.style.display === 'block') {
            e.stopPropagation();
            closeImageModal();
        }
    }
}, true); // Use capture phase for higher priority
</script>

<?php include 'footer.php'; ?>