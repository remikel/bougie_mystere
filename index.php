<?php include 'header.php'; ?>
<div style="margin-left:auto;margin-right:auto;text-align:center">
    <a href="#" id="valid" class="elementor-button-link elementor-button elementor-size-sm" role="button">
        <span class="elementor-button-content-wrapper">
                <span class="elementor-button-text">J'ai trouvé le code</span>
        </span>
    </a>
    <a href="#" id="valid" class="elementor-button-link elementor-button elementor-size-sm" role="button">
        <span class="elementor-button-content-wrapper">
                <span class="elementor-button-text">Je veux la solution</span>
        </span>
    </a>

    <div class="elementor-button-wrapper">
        <input type="text" id="code" pattern="2547">
        <a href="#" id="valid" class="elementor-button-link elementor-button elementor-size-sm" role="button">
            <span class="elementor-button-content-wrapper">
                <span class="elementor-button-text">Valider</span>
            </span>
        </a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script>
    $('code').on('change', ()=>{
        console.log($(this).val())
    })
</script>
<?php include 'footer.php'; ?>