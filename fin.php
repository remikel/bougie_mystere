<?php include 'header.php'; ?>
<div class="section-rm">
    <div class="flex-container">
        <button class="btn base" id="try2">
            J'ai trouvé le code
        </button>
        <div class="answer" id="solution2">
            2547
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
<?php include 'footer.php'; ?>