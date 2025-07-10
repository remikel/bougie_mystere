<?php 
session_start();
require_once 'includes/security.php';
require_once 'includes/validator.php';

$csrfToken = Security::generateCSRFToken();

// Handle error/success messages
$errorMessage = isset($_GET['error']) ? urldecode($_GET['error']) : '';
$successMessage = isset($_GET['success']) ? 'Image générée avec succès !' : '';

include 'header.php'; 
?>

<link href="css/modern-style.css" rel="stylesheet">

<div class="section-rm">
    <div class="flex-container">
        <div class="questionnaire-container">
            <div class="questionnaire-header">
                <div class="celebration-icon">🎉</div>
                <h1>Bravo ! Tu as résolu les énigmes</h1>
                <div class="subtitle">
                    <span class="highlight">Bougie Mystère</span> révélée !
                </div>
                <p class="intro-text">
                    Créons maintenant ton illustration personnalisée unique. 
                    Réponds à ces questions pour révéler ton univers artistique !
                </p>
            </div>

            <?php if ($errorMessage): ?>
                <div class="alert alert-error" role="alert">
                    <span class="alert-icon">⚠️</span>
                    <div>
                        <strong>Oups !</strong>
                        <p><?= htmlspecialchars($errorMessage) ?></p>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($successMessage): ?>
                <div class="alert alert-success" role="alert">
                    <span class="alert-icon">✅</span>
                    <div>
                        <strong>Parfait !</strong>
                        <p><?= htmlspecialchars($successMessage) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <form id="questionnaire-form" action="generate.php" method="POST" novalidate>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                
                <!-- Progress indicator -->
                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                    <div class="progress-text">
                        <span id="current-step">1</span> / <span id="total-steps">4</span>
                    </div>
                </div>

                <!-- Step 0: Welcome -->
                <div class="form-step active" id="step-0">
                    <div class="step-content">
                        <div class="step-icon">🎨</div>
                        <h2>Prêt pour ton portrait chinois ?</h2>
                        <p>Nous allons créer ton univers visuel en quelques questions simples et amusantes.</p>
                        <div class="features-grid">
                            <div class="feature">
                                <span class="feature-icon">🎭</span>
                                <span>Personnalisé</span>
                            </div>
                            <div class="feature">
                                <span class="feature-icon">🚀</span>
                                <span>Instantané</span>
                            </div>
                            <div class="feature">
                                <span class="feature-icon">📱</span>
                                <span>À emporter</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-next" data-step="0">
                            Commencer l'aventure ! ✨
                        </button>
                    </div>
                </div>

                <!-- Step 1: Cultural tastes -->
                <div class="form-step" id="step-1">
                    <div class="step-content">
                        <div class="step-header">
                            <div class="step-icon">🎵</div>
                            <h2>Tes goûts culturels</h2>
                            <p>Dis-nous ce qui nourrit ton âme</p>
                        </div>

                        <div class="questions-grid">
                            <div class="question-card">
                                <label for="chanson" class="question-label">
                                    <span class="question-icon">🎶</span>
                                    Quelle chanson écoutes-tu en boucle ces jours-ci ?
                                </label>
                                <input type="text" name="chanson" id="chanson" required maxlength="35" 
                                       placeholder="Ex: Bohemian Rhapsody, Imagine..." 
                                       class="form-input">
                                <div class="input-hint">La mélodie de ton moment présent</div>
                            </div>

                            <div class="question-card">
                                <label for="animaux" class="question-label">
                                    <span class="question-icon">🦄</span>
                                    Si tu étais un animal aujourd'hui, tu serais...
                                </label>
                                <select name="animaux" id="animaux" required class="form-select">
                                    <option value="">Révèle ton animal intérieur</option>
                                    <option value="ecureuil">🐿️ Écureuil - Énergique et vif</option>
                                    <option value="chat">🐱 Chat - Mystérieux et indépendant</option>
                                    <option value="cheval">🐎 Cheval - Libre et noble</option>
                                    <option value="chien">🐕 Chien - Fidèle et joyeux</option>
                                    <option value="dauphin">🐬 Dauphin - Intelligent et joueur</option>
                                    <option value="tigre">🐅 Tigre - Puissant et déterminé</option>
                                    <option value="elephant">🐘 Éléphant - Sage et protecteur</option>
                                    <option value="renard">🦊 Renard - Rusé et adaptable</option>
                                    <option value="grue">🕊️ Grue - Élégant et paisible</option>
                                    <option value="panda">🐼 Panda - Zen et adorable</option>
                                </select>
                            </div>

                            <div class="question-card">
                                <label for="livre" class="question-label">
                                    <span class="question-icon">📚</span>
                                    Tu lis quoi en ce moment ?
                                </label>
                                <input type="text" name="livre" id="livre" required maxlength="52" 
                                       placeholder="Ex: Le Petit Prince, un manga..." 
                                       class="form-input">
                                <div class="input-hint">Livre, article, BD... tout compte !</div>
                            </div>
                        </div>

                        <div class="step-navigation">
                            <button type="button" class="btn btn-secondary btn-prev" data-step="1">
                                ← Retour
                            </button>
                            <button type="button" class="btn btn-primary btn-next" data-step="1">
                                Continuer →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Lifestyle -->
                <div class="form-step" id="step-2">
                    <div class="step-content">
                        <div class="step-header">
                            <div class="step-icon">🌟</div>
                            <h2>Ton style de vie</h2>
                            <p>Comment vibres-tu au quotidien ?</p>
                        </div>

                        <div class="questions-grid">
                            <div class="question-card">
                                <label for="transports" class="question-label">
                                    <span class="question-icon">🚀</span>
                                    Ton moyen de transport idéal ?
                                </label>
                                <select name="transports" id="transports" required class="form-select">
                                    <option value="">Choisis ton véhicule d'évasion</option>
                                    <option value="skate">🛹 Skateboard - Urbain et libre</option>
                                    <option value="avion">✈️ Avion - Aventurier des cieux</option>
                                    <option value="voiture">🚗 Voiture - Confort et indépendance</option>
                                    <option value="trottinette">🛴 Trottinette - Pratique et fun</option>
                                    <option value="bateau">⛵ Bateau - Navigateur des mers</option>
                                    <option value="train">🚂 Train - Contemplatif voyageur</option>
                                    <option value="moto">🏍️ Moto - Sensation et vitesse</option>
                                    <option value="velo">🚲 Vélo - Écolo et sportif</option>
                                </select>
                            </div>

                            <div class="question-card">
                                <label for="hashtag" class="question-label">
                                    <span class="question-icon">#️⃣</span>
                                    Le hashtag de ta journée
                                </label>
                                <div class="input-with-hash">
                                    <span class="hash-symbol">#</span>
                                    <input type="text" name="hashtag" id="hashtag" required maxlength="14" 
                                           placeholder="bonheur" 
                                           class="form-input hash-input"
                                           pattern="[a-zA-Z0-9_àáâäçéèêëïíîôöùúûüÿñæœ]+">
                                </div>
                                <div class="input-hint">L'émotion du moment en un mot</div>
                            </div>

                            <div class="question-card">
                                <label for="sports" class="question-label">
                                    <span class="question-icon">⚡</span>
                                    Ton sport de cœur ?
                                </label>
                                <select name="sports" id="sports" required class="form-select">
                                    <option value="">Ta discipline préférée</option>
                                    <option value="bad">🏸 Badminton</option>
                                    <option value="volley">🏐 Volleyball</option>
                                    <option value="rugby">🏉 Rugby</option>
                                    <option value="golf">⛳ Golf</option>
                                    <option value="foot">⚽ Football</option>
                                    <option value="basket">🏀 Basketball</option>
                                    <option value="martial">🥋 Arts martiaux</option>
                                    <option value="plongee">🤿 Plongée/Natation</option>
                                    <option value="escalade">🧗 Escalade</option>
                                    <option value="tennis">🎾 Tennis</option>
                                </select>
                            </div>
                        </div>

                        <div class="step-navigation">
                            <button type="button" class="btn btn-secondary btn-prev" data-step="2">
                                ← Retour
                            </button>
                            <button type="button" class="btn btn-primary btn-next" data-step="2">
                                Continuer →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Preferences -->
                <div class="form-step" id="step-3">
                    <div class="step-content">
                        <div class="step-header">
                            <div class="step-icon">🌸</div>
                            <h2>Tes petits plaisirs</h2>
                            <p>Les détails qui font ta personnalité</p>
                        </div>

                        <div class="questions-grid">
                            <div class="question-card">
                                <label for="desserts" class="question-label">
                                    <span class="question-icon">🍰</span>
                                    Ton dessert réconfort du moment ?
                                </label>
                                <select name="desserts" id="desserts" required class="form-select">
                                    <option value="">Ton plaisir sucré</option>
                                    <option value="eclair">⚡ Éclair - Classique élégant</option>
                                    <option value="crepe">🥞 Crêpe - Douceur simple</option>
                                    <option value="gateau">🍰 Tarte - Sophistication</option>
                                    <option value="macaron">🌈 Macaron - Raffinement coloré</option>
                                    <option value="choux">🍮 Choux - Tradition gourmande</option>
                                    <option value="tiramisu">☕ Tiramisu - Italian vibes</option>
                                    <option value="cookie">🍪 Cookie - Comfort food</option>
                                    <option value="dango">🍡 Dango - Exotisme sucré</option>
                                    <option value="cupcake">🧁 Cupcake - Fun et coloré</option>
                                    <option value="cannele">🥧 Cannelé - Tradition bordelaise</option>
                                </select>
                            </div>

                            <div class="question-card">
                                <label for="film" class="question-label">
                                    <span class="question-icon">🎬</span>
                                    Le dernier film qui t'a marqué(e) ?
                                </label>
                                <input type="text" name="film" id="film" required maxlength="52" 
                                       placeholder="Ex: Inception, Spirited Away..." 
                                       class="form-input">
                                <div class="input-hint">Celui qui t'a retourné le cerveau</div>
                            </div>

                            <div class="question-card">
                                <label for="gros_mot" class="question-label">
                                    <span class="question-icon">🤭</span>
                                    Ta dernière "insulte" (polie !) ?
                                </label>
                                <input type="text" name="gros_mot" id="gros_mot" required maxlength="25" 
                                       placeholder="Ex: Zut, Flûte, Purée..." 
                                       class="form-input">
                                <div class="input-hint">Reste poli(e), on est en famille !</div>
                            </div>
                        </div>

                        <div class="step-navigation">
                            <button type="button" class="btn btn-secondary btn-prev" data-step="3">
                                ← Retour
                            </button>
                            <button type="button" class="btn btn-primary btn-next" data-step="3">
                                Continuer →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Final touches -->
                <div class="form-step" id="step-4">
                    <div class="step-content">
                        <div class="step-header">
                            <div class="step-icon">🎨</div>
                            <h2>Touche finale</h2>
                            <p>Choisissons ton univers coloré</p>
                        </div>

                        <div class="questions-grid">
                            <div class="question-card full-width">
                                <label class="question-label">
                                    <span class="question-icon">🌈</span>
                                    Quelle ambiance colorée te correspond ?
                                </label>
                                <div class="color-palette">
                                    <label class="color-choice" for="color-bleu">
                                        <input type="radio" name="color" value="BLEU" id="color-bleu" required>
                                        <div class="color-preview bleu">
                                            <div class="color-circle"></div>
                                            <div class="color-info">
                                                <strong>Bleu Océan</strong>
                                                <span>Profondeur et sérénité</span>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="color-choice" for="color-vert">
                                        <input type="radio" name="color" value="VERT" id="color-vert" required>
                                        <div class="color-preview vert">
                                            <div class="color-circle"></div>
                                            <div class="color-info">
                                                <strong>Vert Nature</strong>
                                                <span>Fraîcheur et harmonie</span>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="color-choice" for="color-rose">
                                        <input type="radio" name="color" value="ROSE" id="color-rose" required>
                                        <div class="color-preview rose">
                                            <div class="color-circle"></div>
                                            <div class="color-info">
                                                <strong>Rouge Passion</strong>
                                                <span>Énergie et chaleur</span>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="color-choice" for="color-violet">
                                        <input type="radio" name="color" value="VIOLET" id="color-violet" required>
                                        <div class="color-preview violet">
                                            <div class="color-circle"></div>
                                            <div class="color-info">
                                                <strong>Violet Mystique</strong>
                                                <span>Créativité et magie</span>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="color-choice" for="color-jaune">
                                        <input type="radio" name="color" value="JAUNE" id="color-jaune" required>
                                        <div class="color-preview jaune">
                                            <div class="color-circle"></div>
                                            <div class="color-info">
                                                <strong>Jaune Solaire</strong>
                                                <span>Joie et optimisme</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="question-card full-width">
                                <label class="question-label">
                                    <span class="question-icon">🌱</span>
                                    Une plante qui te ressemble ?
                                </label>
                                <select name="plantes" id="plantes" required class="form-select">
                                    <option value="">Ton alter ego végétal</option>
                                    <option value="pin">🌲 Pin - Robuste et durable</option>
                                    <option value="tropical">🌿 Monstera - Exotique et moderne</option>
                                    <option value="cactus">🌵 Cactus - Résistant et unique</option>
                                    <option value="chene">🌳 Chêne - Majestueux et sage</option>
                                    <option value="chanvre">🍀 Chanvre - Naturel et authentique</option>
                                    <option value="erable">🍁 Érable - Coloré et changeant</option>
                                    <option value="ginkgo">🌾 Ginkgo - Ancien et mystérieux</option>
                                </select>
                            </div>

                            <div class="question-card">
                                <label for="boissons" class="question-label">
                                    <span class="question-icon">☕</span>
                                    Ta boisson du cœur ?
                                </label>
                                <select name="boissons" id="boissons" required class="form-select">
                                    <option value="">Ton breuvage de réconfort</option>
                                    <option value="cafe">☕ Café - Énergie pure</option>
                                    <option value="choco">🍫 Chocolat chaud - Douceur réconfortante</option>
                                    <option value="the">🍵 Thé - Zen et raffinement</option>
                                </select>
                            </div>

                            <div class="question-card">
                                <label for="chiffres" class="question-label">
                                    <span class="question-icon">🔢</span>
                                    Ton chiffre porte-bonheur ?
                                </label>
                                <select name="chiffres" id="chiffres" required class="form-select">
                                    <option value="">Ton nombre magique</option>
                                    <option value="0">0️⃣ Zéro - Nouveau départ</option>
                                    <option value="1">1️⃣ Un - Singularité</option>
                                    <option value="2">2️⃣ Deux - Équilibre parfait</option>
                                    <option value="3">3️⃣ Trois - Créativité pure</option>
                                    <option value="4">4️⃣ Quatre - Stabilité</option>
                                    <option value="5">5️⃣ Cinq - Aventure</option>
                                    <option value="6">6️⃣ Six - Harmonie</option>
                                    <option value="7">7️⃣ Sept - Chance légendaire</option>
                                    <option value="8">8️⃣ Huit - Infini</option>
                                    <option value="9">9️⃣ Neuf - Accomplissement</option>
                                </select>
                            </div>

                            <div class="question-card full-width">
                                <label for="email" class="question-label">
                                    <span class="question-icon">📧</span>
                                    Ton email pour recevoir ta création ?
                                </label>
                                <input type="email" name="email" id="email" required 
                                       placeholder="ton@email.com" 
                                       class="form-input">
                                <div class="input-hint">
                                    <span class="privacy-icon">🔒</span>
                                    Promis, on garde ça secret ! Juste pour t'envoyer ton chef-d'œuvre.
                                </div>
                            </div>
                        </div>

                        <div class="step-navigation final">
                            <button type="button" class="btn btn-secondary btn-prev" data-step="4">
                                ← Retour
                            </button>
                            <button type="submit" class="btn btn-magic" id="submit-btn">
                                <span class="btn-text">Créer ma magie</span>
                                <span class="btn-icon">✨</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Questionnaire Styles */
.questionnaire-container {
    max-width: 900px;
    width: 100%;
    margin: 0 auto;
}

.questionnaire-header {
    text-align: center;
    margin-bottom: var(--spacing-xxl);
    background: rgba(255, 255, 255, 0.95);
    padding: var(--spacing-xxl);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
}

.celebration-icon {
    font-size: 4rem;
    margin-bottom: var(--spacing-md);
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

.questionnaire-header h1 {
    margin-bottom: var(--spacing-sm);
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.subtitle {
    font-size: 1.3rem;
    margin-bottom: var(--spacing-md);
    color: var(--primary-color);
}

.highlight {
    background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: bold;
}

.intro-text {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #666;
    margin: 0;
}

/* Alert Messages */
.alert {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-md);
    padding: var(--spacing-lg);
    border-radius: var(--border-radius);
    margin-bottom: var(--spacing-lg);
    backdrop-filter: blur(10px);
}

.alert-error {
    background: rgba(231, 76, 60, 0.1);
    border: 1px solid rgba(231, 76, 60, 0.3);
    color: #c0392b;
}

.alert-success {
    background: rgba(46, 204, 113, 0.1);
    border: 1px solid rgba(46, 204, 113, 0.3);
    color: #27ae60;
}

.alert-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
}

/* Progress */
.progress-container {
    background: rgba(255, 255, 255, 0.9);
    padding: var(--spacing-lg);
    border-radius: var(--border-radius);
    margin-bottom: var(--spacing-lg);
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    box-shadow: var(--shadow);
}

.progress-bar {
    flex: 1;
    height: 8px;
    background: #e1e5e9;
    border-radius: 4px;
    overflow: hidden;
    position: relative;
}

.progress-bar::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 25%;
    background: linear-gradient(90deg, var(--accent-color), var(--secondary-color));
    border-radius: 4px;
    transition: width 0.3s ease;
}

.progress-text {
    font-weight: 600;
    color: var(--primary-color);
}

/* Form Steps */
.form-step {
    display: none;
    background: rgba(255, 255, 255, 0.95);
    border-radius: var(--border-radius);
    padding: var(--spacing-xxl);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
}

.form-step.active {
    display: block;
    animation: slideIn 0.5s ease-out;
}

.step-content {
    max-width: 100%;
}

.step-header {
    text-align: center;
    margin-bottom: var(--spacing-xxl);
}

.step-icon {
    font-size: 3rem;
    margin-bottom: var(--spacing-md);
    display: block;
}

.step-header h2 {
    margin-bottom: var(--spacing-sm);
    color: var(--primary-color);
}

.step-header p {
    color: #666;
    font-size: 1.1rem;
}

/* Features Grid (Step 0) */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: var(--spacing-md);
    margin: var(--spacing-xxl) 0;
}

.feature {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-lg);
    background: rgba(255, 255, 255, 0.8);
    border-radius: var(--border-radius);
    border: 2px solid rgba(190, 18, 115, 0.1);
}

.feature-icon {
    font-size: 2rem;
}

/* Questions Grid */
.questions-grid {
    display: grid;
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-xxl);
}

.question-card {
    background: rgba(255, 255, 255, 0.8);
    border-radius: var(--border-radius);
    padding: var(--spacing-lg);
    border: 2px solid rgba(255, 255, 255, 0.5);
    transition: var(--transition);
}

.question-card:hover {
    border-color: rgba(190, 18, 115, 0.3);
    box-shadow: 0 4px 20px rgba(190, 18, 115, 0.1);
}

.question-card.full-width {
    grid-column: 1 / -1;
}

.question-label {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: var(--spacing-md);
    font-size: 1.1rem;
}

.question-icon {
    font-size: 1.3rem;
}

.form-input, .form-select {
    width: 100%;
    padding: var(--spacing-md);
    border: 2px solid rgba(190, 18, 115, 0.2);
    border-radius: 8px;
    font-size: 1rem;
    font-family: var(--font-primary);
    transition: var(--transition);
    background: rgba(255, 255, 255, 0.9);
}

.form-input:focus, .form-select:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(190, 18, 115, 0.1);
    background: var(--white);
}

.input-hint {
    margin-top: var(--spacing-sm);
    font-size: 0.9rem;
    color: #666;
    font-style: italic;
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.privacy-icon {
    color: var(--accent-color);
}

/* Hash Input */
.input-with-hash {
    display: flex;
    border: 2px solid rgba(190, 18, 115, 0.2);
    border-radius: 8px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.9);
    transition: var(--transition);
}

.input-with-hash:focus-within {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(190, 18, 115, 0.1);
}

.hash-symbol {
    padding: var(--spacing-md);
    background: rgba(190, 18, 115, 0.1);
    color: var(--accent-color);
    font-weight: bold;
    border-right: 1px solid rgba(190, 18, 115, 0.2);
}

.hash-input {
    border: none;
    margin: 0;
    background: transparent;
}

/* Color Palette */
.color-palette {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-md);
    margin-top: var(--spacing-md);
}

.color-choice {
    cursor: pointer;
}

.color-choice input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.color-preview {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    padding: var(--spacing-lg);
    border-radius: var(--border-radius);
    border: 2px solid transparent;
    transition: var(--transition);
    background: rgba(255, 255, 255, 0.9);
}

.color-choice input:checked + .color-preview {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(190, 18, 115, 0.1);
    transform: scale(1.02);
}

.color-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.color-preview.bleu .color-circle { background: linear-gradient(135deg, #00435a, #00dceb); }
.color-preview.vert .color-circle { background: linear-gradient(135deg, #00b96b, #e5f5dd); }
.color-preview.rose .color-circle { background: linear-gradient(135deg, #e84121, #f9d8d6); }
.color-preview.violet .color-circle { background: linear-gradient(135deg, #a148b5, #e8cefd); }
.color-preview.jaune .color-circle { background: linear-gradient(135deg, #ff6100, #ffb500); }

.color-info strong {
    display: block;
    color: var(--primary-color);
    margin-bottom: var(--spacing-xs);
}

.color-info span {
    color: #666;
    font-size: 0.9rem;
}

/* Navigation */
.step-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: var(--spacing-md);
}

.step-navigation.final {
    justify-content: center;
    gap: var(--spacing-lg);
}

.btn-magic {
    background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
    color: var(--white);
    border: none;
    padding: var(--spacing-lg) var(--spacing-xxl);
    border-radius: 50px;
    font-size: 1.2rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    position: relative;
    overflow: hidden;
}

.btn-magic:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-hover);
}

.btn-magic::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s;
}

.btn-magic:hover::before {
    left: 100%;
}

/* Responsive */
@media (max-width: 768px) {
    .questionnaire-container {
        padding: var(--spacing-md);
    }
    
    .questionnaire-header,
    .form-step {
        padding: var(--spacing-lg);
    }
    
    .questions-grid {
        grid-template-columns: 1fr;
    }
    
    .color-palette {
        grid-template-columns: 1fr;
    }
    
    .step-navigation {
        flex-direction: column;
    }
    
    .step-navigation.final {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('questionnaire-form');
    const steps = document.querySelectorAll('.form-step');
    const progressBar = document.querySelector('.progress-bar::after') || document.querySelector('.progress-bar');
    const currentStepSpan = document.getElementById('current-step');
    const totalStepsSpan = document.getElementById('total-steps');
    
    let currentStep = 0;
    const totalSteps = steps.length - 1; // Excluding step 0
    
    totalStepsSpan.textContent = totalSteps;
    
    function updateProgress() {
        const progress = (currentStep / totalSteps) * 100;
        if (progressBar) {
            progressBar.style.setProperty('--progress', `${progress}%`);
        }
        currentStepSpan.textContent = Math.max(1, currentStep);
    }
    
    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
        });
        updateProgress();
    }
    
    // Next buttons
    document.querySelectorAll('.btn-next').forEach(btn => {
        btn.addEventListener('click', function() {
            const step = parseInt(this.dataset.step);
            if (validateStep(step)) {
                currentStep = step + 1;
                showStep(currentStep);
            }
        });
    });
    
    // Previous buttons
    document.querySelectorAll('.btn-prev').forEach(btn => {
        btn.addEventListener('click', function() {
            const step = parseInt(this.dataset.step);
            currentStep = step - 1;
            showStep(currentStep);
        });
    });
    
    function validateStep(stepIndex) {
        const step = steps[stepIndex];
        const requiredFields = step.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = '#e74c3c';
                isValid = false;
                
                setTimeout(() => {
                    field.style.borderColor = '';
                }, 3000);
            }
        });
        
        return isValid;
    }
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateStep(currentStep)) {
            return;
        }
        
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.innerHTML = '<span class="btn-text">Création en cours...</span><span class="btn-icon">⏳</span>';
        submitBtn.disabled = true;
        
        // Simulate processing time then submit
        setTimeout(() => {
            form.submit();
        }, 1000);
    });
    
    // Initialize
    showStep(0);
    
    // Add dynamic progress bar style
    const style = document.createElement('style');
    style.textContent = `
        .progress-bar::after { width: var(--progress, 0%); }
    `;
    document.head.appendChild(style);
});
</script>

<?php include 'footer.php'; ?>