<?php include 'header.php'; ?>
<div class="section-rm">
    <div class="flex-container">
        <button class="btn base" id="try2">
            J'ai trouvé le code
        </button>
        <div class="answer" id="solution2">
        <p>JAUNE : Il faut utiliser les lettres sur les panneaux jaunes de la carte du monde. Pour chacune, prendre la lettre antérieure (exemple Q = P, B = A) permet de révéler les mots POISSON / PATTES / PERCHÉ
                En réfléchissant à ces mots, on trouve leur point commun : le CHAT
                Il suffit alors de compter le nombre de chats sur la carte du monde, il y en a 2 !
            </p>
            <p>
                VIOLET : Il faut chercher les villes d’origine des 4 ingrédients de la recette de la bûche située sous la bougie. On trouve dans l’ordre HAVANA / OSAKA / UYO / XI’AN. En prenant la première lettre de chaque ville, on obtient HOUX. Il suffit alors de compter le nombre de branches de houx sur la bûche dessinée sur l’étiquette volante : il y en a 5 !
            </p>
            <p>
                BLEU : Il va falloir retrouver le parcours réalisé sur la carte du monde grâce à la carte postale. La personne qui nous envoie la carte postale part de RIO DE JANEIRO comme en témoigne le timbre, c’est donc le départ.
                Ensuite direction PARIS en France, puis HAVANA (Comme en atteste le ticket d’avion qui est derrière la carte postale). Enfin, on finit à UYO pour faire un safari, ville à l’Est où l’on retrouve girafe et alligator.
                En traçant ce chemin visuellement sur la mappemonde, on dessine le chiffre 4 !
            </p>
            <p>
                ORANGE : En faisant fondre la bougie, on découvre un papier caché dans de l’aluminium à la surface de la bougie, sous une fleur. Ce papier révèle un code morse, nécessaire pour décrypter le code caché dans le Pôle Sud. En effet, les contours de la banquise forment un code visuel avec des points et des barres, on doit lire : S-E-P-T, la réponse est donc le chiffre 7 !
            </p>
        </div>
        <button class="btn base" id="solution">
            Je veux la solution
        </button>
        <div class="try">
            <div>
                <input class="css-input" type="text" placeholder="Entre le code" id="code">
                <button class="btn" id="go">
                    Envoyer
                </button>
                <div id="error">Ce n'est pas ça ! Essaie encore !</div>
            </div>
        </div>
    </div>
</div>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
<link href="style.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script>
    $('#solution').on('click', () => {
        $('#solution2').fadeIn(500).fadeOut(5000)
    })
    $('#try2').on('click', () => {
        $('.base').fadeOut()
        $('.try').fadeIn()
    })
    $('#go').on('click', () => {
        if ($('#code').val() == '2547') {
            window.location.href = "/bougie/questionnaire.php";
        } else {
            $('#error').fadeIn(3000).fadeOut(3000)
        }
    })
</script>
<?php include 'footer.php'; ?>