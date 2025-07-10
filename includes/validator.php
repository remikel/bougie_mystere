<?php

class Validator {
    
    private static $allowedValues = [
        'color' => ['BLEU', 'VERT', 'ROSE', 'JAUNE', 'VIOLET'],
        'animaux' => ['ecureuil', 'chat', 'cheval', 'chien', 'dauphin', 'tigre', 'elephant', 'renard', 'grue', 'panda'],
        'transports' => ['skate', 'avion', 'voiture', 'trottinette', 'bateau', 'train', 'moto', 'velo'],
        'sports' => ['bad', 'volley', 'rugby', 'golf', 'foot', 'basket', 'martial', 'plongee', 'escalade', 'tennis'],
        'desserts' => ['eclair', 'crepe', 'gateau', 'macaron', 'choux', 'tiramisu', 'cookie', 'dango', 'cupcake', 'cannele'],
        'plantes' => ['pin', 'tropical', 'cactus', 'chene', 'chanvre', 'erable', 'ginkgo'],
        'boissons' => ['cafe', 'choco', 'the'],
        'chiffres' => ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']
    ];
    
    /**
     * Validate questionnaire form data
     */
    public static function validateQuestionnaireData($data) {
        $errors = [];
        
        // Required fields validation
        $requiredFields = [
            'chanson' => 'Chanson',
            'animaux' => 'Animal',
            'transports' => 'Transport',
            'livre' => 'Livre',
            'hashtag' => 'Hashtag',
            'sports' => 'Sport',
            'desserts' => 'Dessert',
            'film' => 'Film',
            'gros_mot' => 'Gros mot',
            'plantes' => 'Plante',
            'boissons' => 'Boisson',
            'chiffres' => 'Chiffre',
            'color' => 'Couleur',
            'email' => 'Email'
        ];
        
        foreach ($requiredFields as $field => $label) {
            if (!isset($data[$field]) || empty(trim($data[$field]))) {
                $errors[] = "Le champ '$label' est requis.";
            }
        }
        
        if (!empty($errors)) {
            return $errors;
        }
        
        // Text length validation
        $textLimits = [
            'chanson' => 35,
            'livre' => 52,
            'hashtag' => 14,
            'film' => 52,
            'gros_mot' => 25
        ];
        
        foreach ($textLimits as $field => $maxLength) {
            if (isset($data[$field]) && strlen(trim($data[$field])) > $maxLength) {
                $errors[] = "Le champ '$requiredFields[$field]' ne doit pas dépasser $maxLength caractères.";
            }
        }
        
        // Whitelist validation for dropdown values
        $dropdownFields = ['color', 'animaux', 'transports', 'sports', 'desserts', 'plantes', 'boissons', 'chiffres'];
        
        foreach ($dropdownFields as $field) {
            if (isset($data[$field]) && !Security::validateFromWhitelist($data[$field], self::$allowedValues[$field])) {
                $errors[] = "Valeur invalide pour le champ '$requiredFields[$field]'.";
            }
        }
        
        // Email validation
        if (isset($data['email']) && !Security::validateEmail($data['email'])) {
            $errors[] = "L'adresse email n'est pas valide.";
        }
        
        // Hashtag validation (no special chars except letters, numbers, underscore)
        if (isset($data['hashtag']) && !preg_match('/^[a-zA-Z0-9_àáâäçéèêëïíîôöùúûüÿñæœ]+$/u', $data['hashtag'])) {
            $errors[] = "Le hashtag ne peut contenir que des lettres, chiffres et underscores.";
        }
        
        return $errors;
    }
    
    /**
     * Get allowed values for a field
     */
    public static function getAllowedValues($field) {
        return isset(self::$allowedValues[$field]) ? self::$allowedValues[$field] : [];
    }
}