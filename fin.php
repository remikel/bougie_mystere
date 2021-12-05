<?php include 'header.php'; ?>
<div class="section-rm">
    <div class="flex-container">
        <div>
            <div class="text-end">
                <h1>Et voilà votre image :</h1>
                <p>Vous pouvez la télécharger (clique-droit puis "enregistrer l'image sous") et l'imprimer ou la mettre en fond d'écran !</p>
            </div>
            <a href="<?= $_GET['src'] ?>" target="_blank"><img src="<?= $_GET['src'] ?>" alt="Votre image personnalisée" class="img-generated"></a>
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