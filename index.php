<?php include 'header.php'; ?>
<div style="margin-left:auto;margin-right:auto;text-align:center">
    <h1>
        Félicitations tu as trouvé le code des énigmes !
    </h1>
    <p>
        J'aimerais en savoir tellement plus sur toi car le vrai trésor se trouve en soi ! Mais t'inquiètes pas j'ai bien quelque chose pour toi !
    </p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {

            $("#btn_recherche").click(function() {
                var statut = $(this).attr("statut");
                $("#bloc_recherche_couleur").slideToggle("slow");
                if (statut == "ferme") {
                    $(this).attr('statut', "ouvert");
                    $(this).html('Fermer le questionnaire');
                } else {
                    $(this).attr('statut', "ferme");
                    $(this).html('On commence ?');
                }
            });


            $(".etape_suivante").click(function() {
                var etape_actuelle = $(this).attr('etape');
                var etape_suivante = parseInt(etape_actuelle) + 1;
                var curHeight = $("#etape" + etape_actuelle + "_recherche").height();
                var autoHeight = $("#etape" + etape_suivante + "_recherche").height();
                $("#etape" + etape_actuelle + "_recherche").hide("slide", {
                    direction: "up"
                }, 300, function() {
                    $('#bloc_recherche_couleur').height(curHeight + 40).animate({
                        height: autoHeight + 40
                    }, 300, function() {

                        $("#etape" + etape_suivante + "_recherche").show("slide", {
                            direction: "down"
                        }, 300);
                    });
                });
            });

            $(".etape_precedente").click(function() {
                var etape_actuelle = $(this).attr('etape');
                var etape_precedent = parseInt(etape_actuelle) - 1;
                var curHeight = $("#etape" + etape_actuelle + "_recherche").height();
                var autoHeight = $("#etape" + etape_precedent + "_recherche").height();
                $("#etape" + etape_actuelle + "_recherche").hide("slide", {
                    direction: "down"
                }, 300, function() {
                    $('#bloc_recherche_couleur').height(curHeight + 40).animate({
                        height: autoHeight + 40
                    }, 300, function() {

                        $("#etape" + etape_precedent + "_recherche").show("slide", {
                            direction: "up"
                        }, 300);
                    });

                });
            });


            $("#terminer").click(function() {

                //HERE SUBMIT THE FORM WITH AN AJAX REQUEST (serialize #myform's inputs, etc...)...

                $("#bloc_recherche_couleur").slideToggle("slow");
                $("#btn_recherche").html('OPEN THE QUIZ');
                $(".div_cache").hide();
                $(".champtxt").val('');
                $("#etape0_recherche").show(1500);
            });
        });
    </script>
    <style>

        .titre {
            color: #ffffff;
            font-size: 24px;
        }

        .btn_noir {
            font-size: 14px;
            cursor: pointer;
            padding: 8px;
            border-radius: 2px;
            background-color: #333333;
            color: #ffffff;
            display: inline-block;
            margin: 8px;
            font-weight: 500;
            width: 100px;
        }

        .btn_noir:hover {
            background-color: #000000;
        }

        /* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! RECHERCHE !!!!!!!!!!!!!!!!!!!!!!!!!! */

        #bloc_recherche_couleur {
            background-color: #ffbe40;
            width: 100%;
            height: 200px;
            display: none;
        }


        #btn_recherche {
            background-color: #ffbe40;
            width: 400px;
            margin-bottom: 20px;
            color: #ffffff;
            font-weight: 500;
            text-align: center;
            padding: 10px;
            border-radius: 0px 0px 3px 3px;
            cursor: pointer;
        }
    </style>
    <div align="center">
        <form id="myform">
            <div id="bloc_recherche_couleur">

                <div id="etape0_recherche" style="color:#ffffff;"><br />
                    <div class="titre">Prêt pour ton portrait instantanné</div>
                    <p>Réponds à ces questions sur toi au moment présent, il n'est pas question de faire une moyenne de ta vie.</p>
                    <p>On change tous chaque jour alors réponds comme ça te vient là, tout de suite.</p>
                    <div class="btn_noir etape_suivante" etape="0">C'est parti !</div><br /><br />
                </div>

                <div id="etape1_recherche" class="div_cache" style="display:none; text-align:center;"><br />
                    <div class="titre">C'est quelle chanson que t'écoutes le plus ces jours-ci ?</div><br />
                    <input required type="text" name="chason" value="" placeholder="" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" /><br /><br />

                    <div class="titre">Tu te sens comme quel animal aujourd'hui ?</div><br />
                    <select name="animaux" id="pet-select"  style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" required>
                        <option value="">Choisis</option>
                        <option value="ecureuil">Ecureuil</option>
                        <option value="chat">Chat</option>
                        <option value="cheval">Cheval</option>
                        <option value="chien">Chien</option>
                        <option value="dauphin">Dauphin</option>
                        <option value="tigre">Tigre</option>
                        <option value="elephant">Eléphant</option>
                        <option value="renard">Renard</option>
                        <option value="grue">Grue</option>
                        <option value="Panda">Panda</option>
                    </select>
                    <br><br>

                    <div class="titre">Tu te déplace comment ces temps-ci ?</div><br />
                    <select name="transports" id="pet-select"  style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" required>
                        <option value="">Choisis</option>
                        <option value="ecureuil">Ecureuil</option>
                        <option value="chat">Chat</option>
                        <option value="cheval">Cheval</option>
                        <option value="chien">Chien</option>
                        <option value="dauphin">Dauphin</option>
                        <option value="tigre">Tigre</option>
                        <option value="elephant">Eléphant</option>
                        <option value="renard">Renard</option>
                        <option value="grue">Grue</option>
                        <option value="Panda">Panda</option>
                    </select>
                    <br><br>
                    <div class="btn_noir etape_precedente" etape="1">Précédente</div>
                    <div class="btn_noir etape_suivante" etape="1">Suivante</div>
                </div>

                <div id="etape2_recherche" class="div_cache" style="display:none; text-align:center;"><br />
                    <div class="titre">Tu te sens comme quel animal aujourd'hui ?</div><br />
                    <input type="text" name="" id="" value="" placeholder="British accent ?" style="width:300px; font-size:16px; padding:5px;  margin:0px;" class="champtxt" /><br /><br />
                    <div class="titre">And why ?</div><br />
                    <input type="text" name="" id="" value="" placeholder="Why ???" style="width:300px; font-size:16px; padding:5px;  margin:0px;" class="champtxt" /><br /><br />
                    <div class="btn_noir etape_precedente" etape="2">Précédente</div>
                    <div class="btn_noir etape_suivante" etape="2">Suivante</div>
                </div>

                <div id="etape3_recherche" class="div_cache" style="display:none; text-align:center;"><br />
                    <div class="titre">Do you like barbecues ?</div><br />
                    <input type="text" name="" id="" value="" placeholder="Bbq ?" style="width:300px; font-size:16px; padding:5px;  margin:0px;" class="champtxt" /><br /><br />
                    <div class="btn_noir etape_precedente" etape="3">Précédente</div>
                    <div class="btn_noir etape_suivante" etape="3">Suivante</div>
                </div>

                <div id="etape4_recherche" class="div_cache" style="display:none; color:#ffffff;"><br />
                    <div class="titre">Thanks ! </div><br />
                    Now I know you...<br /> <br />
                    <div class="btn_noir etape_precedente" etape="4">Précédente</div>
                    <div class="btn_noir" id="terminer">SAVE &amp; Suivante</div>
                </div>


            </div>
            <div id="btn_recherche" statut="ferme">On commence ?</div>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>