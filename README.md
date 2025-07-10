# 🕯️ Bougie Mystère

**Bougie Mystère** est un jeu d'escape game interactif qui génère des illustrations personnalisées uniques. Les utilisateurs résolvent des énigmes pour déverrouiller un questionnaire personnalisé, puis reçoivent une carte postale digitale créée automatiquement selon leurs préférences.

## ✨ Fonctionnalités

- 🧩 **Escape Game** : Résolvez 4 énigmes pour obtenir un code secret (2547)
- 🎨 **Questionnaire Personnalisé** : Portrait chinois interactif en 4 étapes
- 🖼️ **Génération d'Images** : Création automatique de cartes postales au format 2315x3307px
- 📧 **Envoi par Email** : Livraison automatique via l'API Mailjet
- 🎯 **Thème Rose** : Palette de couleurs fixée pour une esthétique cohérente
- 📱 **Design Responsive** : Interface adaptée mobile et desktop

## 🏗️ Architecture

### Technologies Utilisées
- **Backend** : PHP 7.0+ avec extension GD
- **Frontend** : HTML5, CSS3, JavaScript (jQuery)
- **Dépendances** : Composer
  - `stil/gd-text` : Rendu typographique avancé
  - `mailjet/mailjet-apiv3-php` : Service d'envoi d'emails
- **Polices** : Quicksand (interface), AmaticSC (titres originaux)

### Structure du Projet
```
bougie/
├── index.php              # Page d'accueil avec escape game
├── questionnaire.php      # Formulaire personnalisé en 4 étapes
├── generate.php           # Moteur de génération d'images
├── fin.php               # Page de résultat avec image générée
├── css/
│   └── modern-style.css   # Styles principaux responsive
├── images/
│   ├── ROSE/             # Assets thématiques roses
│   │   ├── animaux/      # Icônes animaux (chat, chien, etc.)
│   │   ├── boissons/     # Boissons (café, thé, chocolat)
│   │   ├── desserts/     # Desserts (éclair, crêpe, etc.)
│   │   ├── chiffres/     # Chiffres 0-9
│   │   ├── plantes1-3/   # Végétaux (pin, cactus, etc.)
│   │   ├── sports1-2/    # Sports (football, tennis, etc.)
│   │   └── transports/   # Véhicules (vélo, avion, etc.)
│   ├── background/       # Images de fond
│   └── generated/        # Images créées (auto-générées)
├── fonts/               # Polices personnalisées
├── includes/            # Classes PHP modulaires
└── js/                 # Scripts d'interactions
```

## 🚀 Installation

### Prérequis
- PHP 7.0+ avec extension GD activée
- Composer
- Serveur web (Apache/Nginx) ou serveur PHP intégré
- Compte Mailjet pour l'envoi d'emails

### Installation
```bash
# Cloner le projet
git clone [URL_DU_REPO]
cd bougie

# Installer les dépendances
composer install

# Configurer les permissions
chmod 755 images/generated/

# Démarrer le serveur de développement
php -S localhost:8000
```

### Configuration Email
Éditez `generate.php` et configurez vos identifiants Mailjet :
```php
// Lignes 200-201
$mj = new \Mailjet\Client('VOTRE_API_KEY', 'VOTRE_SECRET_KEY', true);
```

## 🎮 Utilisation

### Pour les Utilisateurs
1. **Résolvez l'Escape Game** : Trouvez le code secret `2547`
2. **Remplissez le Questionnaire** : 4 étapes de personnalisation
3. **Recevez votre Illustration** : Image unique générée et envoyée par email

### Étapes du Questionnaire
1. **Goûts Culturels** : Musique, livre, chanson préférés
2. **Loisirs** : Animal favori, sport, transport
3. **Plaisirs** : Dessert, film, expression favorite
4. **Finition** : Plante, boisson, chiffre porte-bonheur + email

### Code Secret de l'Escape Game
Les énigmes révèlent le code **2547** :
- 🟡 **JAUNE** = **2** (nombre de chats sur la carte)
- 🟣 **VIOLET** = **5** (branches de houx sur la bûche)
- 🔵 **BLEU** = **4** (tracé du parcours géographique)
- 🟠 **ORANGE** = **7** (code morse de la banquise : SEPT)

## 🛠️ Développement

### Commandes Utiles
```bash
# Démarrage rapide
php -S localhost:8000

# Test de génération d'image
# Accédez à questionnaire.php et remplissez le formulaire

# Vérification des logs
tail -f /var/log/apache2/error.log
```

### Structure des Images Générées
- **Format** : JPEG 2315x3307px (format carte postale)
- **Composition** : Superposition d'éléments PNG selon les réponses
- **Typographie** : Textes dynamiques avec police Quicksand
- **Couleurs** : Thème rose exclusivement

### API de Génération
Le moteur d'image (`generate.php`) fonctionne ainsi :
1. Récupération des données POST du questionnaire
2. Sélection des assets PNG correspondants dans `/images/ROSE/`
3. Composition par superposition avec la librairie GD
4. Ajout des textes utilisateur avec `stil/gd-text`
5. Sauvegarde dans `/images/generated/`
6. Envoi email via Mailjet
7. Redirection vers la page de résultat

## 🔒 Sécurité

### Mesures Implémentées
- **Validation CSRF** : Tokens pour les formulaires
- **Sanitisation** : Nettoyage des entrées utilisateur
- **Validation Email** : Format et longueur des champs
- **Limitation Upload** : Pas d'upload utilisateur direct

### Points d'Attention
- ⚠️ **Credentials hardcodés** : API Mailjet en dur dans `generate.php`
- ⚠️ **Répertoire public** : `/images/generated/` accessible directement
- ⚠️ **Pas de base de données** : Sessions fichiers uniquement

## 📝 Historique des Modifications

### Récentes Améliorations
- ✅ Police des titres changée pour Quicksand
- ✅ Suppression des bordures sur les éléments "Personnalisé/Instantané/À emporter"
- ✅ Scroll automatique vers le formulaire lors de la navigation
- ✅ Couleur fixée sur "ROSE" (suppression du choix)
- ✅ Boutons d'action compacts sur une ligne
- ✅ Message de succès en vert (au lieu de rouge)

## 🤝 Contribution

Pour contribuer au projet :
1. Fork le repository
2. Créez une branche feature (`git checkout -b feature/nouvelle-fonctionnalite`)
3. Committez vos changements (`git commit -m 'Ajout nouvelle fonctionnalité'`)
4. Push vers la branche (`git push origin feature/nouvelle-fonctionnalite`)
5. Ouvrez une Pull Request

## 📄 Licence

Ce projet est sous licence privée. Tous droits réservés.

## 👥 Crédits

- **Concept & Design** : Noémie Pulido
- **Développement** : Équipe Bougie Mystère
- **Assets Graphiques** : Collection thématique exclusive

---

📧 **Contact** : hello@noemie-pulido.fr  
📸 **Instagram** : [@noemie_pulido](https://www.instagram.com/noemie_pulido/)