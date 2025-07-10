<?php 
session_start();
require_once 'includes/security.php';
require_once 'includes/validator.php';

$csrfToken = Security::generateCSRFToken();

// Handle error/success messages
$errorMessage = isset($_GET['error']) ? urldecode($_GET['error']) : '';
$successMessage = isset($_GET['success']) ? 'Image générée avec succès !' : '';

include 'header_improved.php'; 
?>

<div class="section-rm">
    <div class="flex-container">
        <div class="felicitation">
            <h1>Félicitations ! 🎉</h1>
            <h2>Tu as trouvé la solution des énigmes de la <strong>Bougie Mystère</strong></h2>
            
            <p>
                La <strong>Bougie Mystère</strong> est née de l'imagination de Noémie et de Rémi, nous espérons que l'expérience t'aura plu !
                Noémie est illustratrice, Rémi est développeur web, et en mixant leurs compétences on obtient...un champ des possibles immense pour te créer une
                illustration de manière automatisée et en même temps complètement sur-mesure. Impossible tu dis ?
            </p>
            
            <p>
                On te laisse remplir le formulaire ci-dessous, à la manière d'un portrait chinois. Il s'agit de faire un « Arrêt sur Image » de ta vie à ce moment précis
                avant de générer ton illustration personnalisée en format carte postale. Tu pourras d'ailleurs réitérer l'expérience quand tu le souhaites, pour toi ou
                même pour faire plaisir à quelqu'un d'autre !
            </p>
            
            <?php if ($errorMessage): ?>
                <div class="error-message" role="alert">
                    <strong>Erreur :</strong> <?= htmlspecialchars($errorMessage) ?>
                </div>
            <?php endif; ?>
            
            <?php if ($successMessage): ?>
                <div class="success-message" role="alert">
                    <?= htmlspecialchars($successMessage) ?>
                </div>
            <?php endif; ?>
        </div>

        <form id="myform" action="generate_improved.php" method="POST" novalidate aria-label="Questionnaire de personnalisation">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
            
            <div id="bloc_recherche_couleur">
                <!-- Progress bar will be added by JavaScript -->
                
                <div id="etape0_recherche" class="form-step">
                    <h2>🎨 Créons ton univers personnalisé</h2>
                    <p>Réponds à quelques questions pour créer ton illustration unique !</p>
                    <button type="button" class="btn etape_suivante" data-etape="0">C'est parti !</button>
                </div>

                <div id="etape1_recherche" class="form-step" style="display:none;">
                    <h3>🎵 Tes goûts culturels</h3>
                    
                    <div class="form-group">
                        <label for="chanson" class="form-question">Quelle chanson écoutes-tu le plus ces jours-ci ?</label>
                        <input required type="text" name="chanson" id="chanson" value="" maxlength="35" 
                               placeholder="Ex: Bohemian Rhapsody" class="champtxt" 
                               aria-describedby="chanson-hint" />
                        <small id="chanson-hint">Maximum 35 caractères</small>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="animaux" class="form-question">Tu te sens comme quel animal aujourd'hui ?</label>
                        <select required name="animaux" id="animaux" class="champtxt" aria-describedby="animaux-hint">
                            <option value="">Choisis ton animal du jour</option>
                            <option value="ecureuil">🐿️ Écureuil - Énergique et vif</option>
                            <option value="chat">🐱 Chat - Indépendant et mystérieux</option>
                            <option value="cheval">🐎 Cheval - Noble et libre</option>
                            <option value="chien">🐕 Chien - Fidèle et joyeux</option>
                            <option value="dauphin">🐬 Dauphin - Intelligent et joueur</option>
                            <option value="tigre">🐅 Tigre - Fort et déterminé</option>
                            <option value="elephant">🐘 Éléphant - Sage et paisible</option>
                            <option value="renard">🦊 Renard - Rusé et malin</option>
                            <option value="grue">🕊️ Grue - Élégant et gracieux</option>
                            <option value="panda">🐼 Panda - Zen et adorable</option>
                        </select>
                        <small id="animaux-hint">Choisis l'animal qui reflète ton humeur</small>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="transports" class="form-question">Pour te déplacer aujourd'hui tu préfères :</label>
                        <select required name="transports" id="transports" class="champtxt">
                            <option value="">Ton moyen de transport idéal</option>
                            <option value="skate">🛹 Le skateboard - Style urbain</option>
                            <option value="avion">✈️ L'avion - Aventure lointaine</option>
                            <option value="voiture">🚗 La voiture - Confort et liberté</option>
                            <option value="trottinette">🛴 La trottinette - Pratique et fun</option>
                            <option value="bateau">⛵ Le bateau - Évasion marine</option>
                            <option value="train">🚂 Le train - Voyage contemplatif</option>
                            <option value="moto">🏍️ La moto - Sensation forte</option>
                            <option value="velo">🚲 Le vélo - Écolo et sportif</option>
                        </select>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="livre" class="form-question">Tu lis quoi en ce moment ?</label>
                        <input required type="text" name="livre" id="livre" maxlength="52" value="" 
                               placeholder="Ex: Le Petit Prince" class="champtxt" 
                               aria-describedby="livre-hint" />
                        <small id="livre-hint">Livre, magazine, article... Maximum 52 caractères</small>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn btn-secondary etape_precedente" data-etape="1">Précédent</button>
                        <button type="button" class="btn etape_suivante" data-etape="1">Suivant</button>
                    </div>
                </div>

                <div id="etape2_recherche" class="form-step" style="display:none;">
                    <h3>🏃‍♀️ Tes passions</h3>
                    
                    <div class="form-group">
                        <label for="hashtag" class="form-question">Hashtag de ta journée :</label>
                        <div class="input-with-prefix">
                            <span class="input-prefix">#</span>
                            <input required type="text" name="hashtag" id="hashtag" value="" maxlength="14" 
                                   placeholder="bonheur" class="champtxt" 
                                   pattern="[a-zA-Z0-9_àáâäçéèêëïíîôöùúûüÿñæœ]+" 
                                   aria-describedby="hashtag-hint" />
                        </div>
                        <small id="hashtag-hint">Lettres, chiffres et underscore uniquement</small>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="sports" class="form-question">Ton sport préféré, ce serait :</label>
                        <select required name="sports" id="sports" class="champtxt">
                            <option value="">Choisis ton sport</option>
                            <option value="bad">🏸 Le badminton</option>
                            <option value="volley">🏐 Le volleyball</option>
                            <option value="rugby">🏉 Le rugby</option>
                            <option value="golf">⛳ Le golf</option>
                            <option value="foot">⚽ Le football</option>
                            <option value="basket">🏀 Le basketball</option>
                            <option value="martial">🥋 Les arts martiaux</option>
                            <option value="plongee">🤿 La plongée/natation</option>
                            <option value="escalade">🧗 L'escalade</option>
                            <option value="tennis">🎾 Le tennis</option>
                        </select>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="desserts" class="form-question">Là tout de suite si tu devais te faire plaisir avec un dessert tu choisirais :</label>
                        <select required name="desserts" id="desserts" class="champtxt">
                            <option value="">Ton dessert plaisir</option>
                            <option value="eclair">⚡ Un éclair</option>
                            <option value="crepe">🥞 Une bonne crêpe</option>
                            <option value="gateau">🍰 Une tarte au citron</option>
                            <option value="macaron">🍪 Des macarons</option>
                            <option value="choux">🍮 Des choux à la crème/profiteroles</option>
                            <option value="tiramisu">🍨 Un tiramisu</option>
                            <option value="cookie">🍪 Un cookie aux pépites choco</option>
                            <option value="dango">🍡 Un dango</option>
                            <option value="cupcake">🧁 Un cupcake</option>
                            <option value="cannele">🥧 Des cannelés</option>
                        </select>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="film" class="form-question">Le dernier film qui t'a retourné(e) :</label>
                        <input required type="text" name="film" id="film" maxlength="52" value="" 
                               placeholder="Ex: Inception" class="champtxt" 
                               aria-describedby="film-hint" />
                        <small id="film-hint">Maximum 52 caractères</small>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn btn-secondary etape_precedente" data-etape="2">Précédent</button>
                        <button type="button" class="btn etape_suivante" data-etape="2">Suivant</button>
                    </div>
                </div>

                <div id="etape3_recherche" class="form-step" style="display:none;">
                    <h3>🌱 Tes préférences</h3>
                    
                    <div class="form-group">
                        <label for="gros_mot" class="form-question">La dernière "insulte" que tu as prononcée :</label>
                        <input required type="text" name="gros_mot" id="gros_mot" value="" 
                               placeholder="Ex: Zut, Mince, Flûte..." maxlength="25" class="champtxt" 
                               aria-describedby="gros-mot-hint" />
                        <small id="gros-mot-hint">Reste poli(e) ! Maximum 25 caractères</small>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="plantes" class="form-question">Une plante qui te correspond bien :</label>
                        <select required name="plantes" id="plantes" class="champtxt">
                            <option value="">Choisis ta plante</option>
                            <option value="pin">🌲 Le pin - Robuste et durable</option>
                            <option value="tropical">🌿 Le monstera - Exotique et moderne</option>
                            <option value="cactus">🌵 Le cactus - Résistant et unique</option>
                            <option value="chene">🌳 Le chêne - Fort et majestueux</option>
                            <option value="chanvre">🍀 Le chanvre - Naturel et polyvalent</option>
                            <option value="erable">🍁 L'érable - Coloré et changeant</option>
                            <option value="ginkgo">🌾 Le ginkgo - Ancien et sage</option>
                        </select>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="boissons" class="form-question">Ta boisson fétiche du moment :</label>
                        <select required name="boissons" id="boissons" class="champtxt">
                            <option value="">Ta boisson réconfort</option>
                            <option value="cafe">☕ Le café - Parce que tu es un adulte, un vrai</option>
                            <option value="choco">🍫 Le chocolat chaud - Toujours réconfortant</option>
                            <option value="the">🍵 Le thé - Parce que oui, tu es raffiné(e)</option>
                        </select>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="chiffres" class="form-question">Ton chiffre porte-bonheur :</label>
                        <select required name="chiffres" id="chiffres" class="champtxt">
                            <option value="">Choisis ton chiffre</option>
                            <option value="0">0️⃣ Zéro - Le recommencement</option>
                            <option value="1">1️⃣ Un - L'unicité</option>
                            <option value="2">2️⃣ Deux - L'équilibre</option>
                            <option value="3">3️⃣ Trois - La créativité</option>
                            <option value="4">4️⃣ Quatre - La stabilité</option>
                            <option value="5">5️⃣ Cinq - L'aventure</option>
                            <option value="6">6️⃣ Six - L'harmonie</option>
                            <option value="7">7️⃣ Sept - La chance</option>
                            <option value="8">8️⃣ Huit - L'infini</option>
                            <option value="9">9️⃣ Neuf - L'accomplissement</option>
                        </select>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn btn-secondary etape_precedente" data-etape="3">Précédent</button>
                        <button type="button" class="btn etape_suivante" data-etape="3">Suivant</button>
                    </div>
                </div>

                <div id="etape4_recherche" class="form-step" style="display:none;">
                    <h3>🎨 Finalisation</h3>
                    
                    <div class="form-group">
                        <label for="color" class="form-question">Quelle ambiance colorée te plaît ?</label>
                        <div class="color-grid">
                            <label class="color-option" for="color_bleu">
                                <input type="radio" name="color" value="BLEU" id="color_bleu" required>
                                <div class="color-preview" style="background: linear-gradient(135deg, #00435a, #00dceb)"></div>
                                <span>Bleu Océan</span>
                            </label>
                            <label class="color-option" for="color_rose">
                                <input type="radio" name="color" value="ROSE" id="color_rose" required>
                                <div class="color-preview" style="background: linear-gradient(135deg, #e84121, #f9d8d6)"></div>
                                <span>Rouge Passion</span>
                            </label>
                            <label class="color-option" for="color_vert">
                                <input type="radio" name="color" value="VERT" id="color_vert" required>
                                <div class="color-preview" style="background: linear-gradient(135deg, #00b96b, #e5f5dd)"></div>
                                <span>Vert Nature</span>
                            </label>
                            <label class="color-option" for="color_violet">
                                <input type="radio" name="color" value="VIOLET" id="color_violet" required>
                                <div class="color-preview" style="background: linear-gradient(135deg, #a148b5, #e8cefd)"></div>
                                <span>Violet Mystique</span>
                            </label>
                            <label class="color-option" for="color_jaune">
                                <input type="radio" name="color" value="JAUNE" id="color_jaune" required>
                                <div class="color-preview" style="background: linear-gradient(135deg, #ff6100, #ffb500)"></div>
                                <span>Jaune Solaire</span>
                            </label>
                        </div>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-question">Ton email pour recevoir ton illustration :</label>
                        <input required type="email" name="email" id="email" value="" 
                               placeholder="votre@email.com" class="champtxt" 
                               aria-describedby="email-hint" />
                        <small id="email-hint">Nous respectons ta vie privée. Ton email ne sera pas partagé.</small>
                        <div class="error-message" role="alert"></div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn btn-secondary etape_precedente" data-etape="4">Précédent</button>
                        <button type="submit" class="btn btn-submit" id="submit-btn">
                            ✨ Générer mon illustration ✨
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
/* Additional styles for improved questionnaire */
.color-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: var(--spacing-md);
    margin: var(--spacing-md) 0;
}

.color-option {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: var(--spacing-md);
    border: 2px solid transparent;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    background: rgba(255, 255, 255, 0.05);
}

.color-option:hover {
    border-color: var(--accent-color);
    background: rgba(255, 255, 255, 0.1);
}

.color-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.color-option input[type="radio"]:checked + .color-preview {
    box-shadow: 0 0 0 3px var(--accent-color);
    transform: scale(1.1);
}

.color-preview {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin-bottom: var(--spacing-sm);
    transition: var(--transition);
    border: 3px solid white;
}

.color-option span {
    font-weight: 600;
    color: var(--primary-color);
    text-align: center;
}

.input-with-prefix {
    display: flex;
    align-items: center;
    background: var(--white);
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    overflow: hidden;
    transition: var(--transition);
}

.input-with-prefix:focus-within {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(190, 18, 115, 0.1);
}

.input-prefix {
    padding: var(--spacing-md);
    background: var(--light-bg);
    color: var(--primary-color);
    font-weight: bold;
    border-right: 1px solid #e1e5e9;
}

.input-with-prefix .champtxt {
    border: none;
    margin: 0;
    flex: 1;
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    margin-top: var(--spacing-xl);
    gap: var(--spacing-md);
}

.btn-submit {
    background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
    font-size: 1.2rem;
    padding: var(--spacing-md) var(--spacing-xxl);
    position: relative;
    overflow: hidden;
}

.btn-submit::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s;
}

.btn-submit:hover::before {
    left: 100%;
}

@media (max-width: 768px) {
    .form-navigation {
        flex-direction: column;
    }
    
    .color-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<script src="js/enhanced-interactions.js"></script>

<?php include 'footer_improved.php'; ?>