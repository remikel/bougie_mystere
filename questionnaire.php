<?php include 'header.php'; ?>
<?php if ($_GET['code'] != '2547') {
    header('Location: index.php?code=2547');
}
?>
<div style="margin-left:auto;margin-right:auto;text-align:center">
    <h1>
        Tu as trouvé la solution des énigmes de la Bougie Mystère, tu vas maintenant découvrir ta surprise...
    </h1>
    <p>
        La Bougie Mystère est née de l’imagination de Noémie et de Rémi, nous espérons que l’expérience t’aura plu !
        Noémie est illustratrice, Rémi est développeur web, et en mixant leurs compétences on obtient...un champ des possibles immense pour te créer une
        illustration de manière automatisée et en même temps complètement sur-mesure. Impossible tu dis ?
    </p>
    <p>
        On te laisse remplir le formulaire ci-dessous, à la manière d’un portrait chinois, il s’agit de faire un « Arrêt sur Image » de ta vie à ce moment précis
        avant de générer ton illustration personnalisée en format carte postale. Tu pourras d’ailleurs réitérer l’expérience quand tu le souhaites, pour toi ou

        même pour faire plaisir à quelqu’un d’autre !
    </p>
    <div align="center">
        <form id="myform" action="generate.php" method="POST">
            <div id="bloc_recherche_couleur">

                <div id="etape0_recherche" style="color:#ffffff;"><br />
                    <div class="titre">Prêt pour ton portrait instantanné</div>
                    <p>Réponds à ces questions sur toi au moment présent, il n'est pas question de faire une moyenne de ta vie.</p>
                    <p>On change tous chaque jour alors réponds comme ça te vient là, tout de suite.</p>
                    <div class="btn_noir etape_suivante" etape="0">C'est parti !</div><br /><br />
                </div>

                <div id="etape1_recherche" class="div_cache" style="display:none; text-align:center;"><br />
                    <div class="titre">C'est quelle chanson que t'écoutes le plus ces jours-ci ?</div><br />
                    <input required type="text" name="chanson" value="" maxlength="35" placeholder="" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" /><br /><br />

                    <div class="titre">Tu te sens comme quel animal aujourd'hui ?</div><br />
                    <select required name="animaux" id="pet-select" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" required>
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

                    <div class="titre">Pour te déplacer aujourd’hui tu préfères :</div><br />
                    <select required name="transports" id="pet-select" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" required>
                        <option value="">Choisis</option>
                        <option value="skate">Le skateboard</option>
                        <option value="avion">L’avion</option>
                        <option value="voiture">La voiture</option>
                        <option value="trottinette">La trottinette</option>
                        <option value="bateau">Le bateau</option>
                        <option value="train">Le train</option>
                        <option value="moto">La moto</option>
                        <option value="velo">Le vélo</option>
                    </select>
                    <br><br>                    
                    <div class="titre">Tu lis quoi en ce moment :</div><br />
                    <input required type="text" name="livre" maxlength="52" value="" placeholder="" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" /><br /><br />
                    <br><br>                    


                    <div class="btn_noir etape_precedente" etape="1">Précédente</div>
                    <div class="btn_noir etape_suivante" etape="1">Suivante</div>

                    <input type="submit" class="btn_noir" value="Générer l'image"></input>
                </div>

                <div id="etape2_recherche" class="div_cache" style="display:none; text-align:center;"><br />
                    <div class="titre">Hashtage de ta journée :</div><br />
                    <input required type="text" name="hashtag" value="" maxlength="12" placeholder="" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" /><br /><br />

                    <div class="titre">Ton sport préféré, ce serait :</div><br />
                    <select required name="sports" id="pet-select" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" required>
                        <option value="">Choisis</option>
                        <option value="bad">Le badminton</option>
                        <option value="volley">Le volleyball</option>
                        <option value="rugby">Le rugby</option>
                        <option value="golf">Le golf</option>
                        <option value="foot">Le football</option>
                        <option value="basket">Le basketball</option>
                        <option value="martial">Les arts martiaux</option>
                        <option value="plongee">La plongée</option>
                        <option value="plongee">La natation</option>
                        <option value="escalade">L’escalade</option>
                        <option value="tennis">Le tennis</option>

                    </select>
                    <br><br>


                    <div class="titre">Là tout de suite si tu devais te faire plaisir avec un dessert tu choisirais :</div><br />
                    <select required name="desserts" id="pet-select" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" required>
                        <option value="">Choisis</option>
                        <option value="eclair">Un éclair</option>
                        <option value="crepe">Une bonne crêpe</option>
                        <option value="gateau">Une tarte au citron</option>
                        <option value="macaron">Des macarons</option>
                        <option value="choux">Des choux à la crème</option>
                        <option value="choux">Des profiteroles</option>
                        <option value="tiramisu">Un tiramisu</option>
                        <option value="cookie">Un cookie aux pépites choco</option>
                        <option value="dango">Un dango</option>
                        <option value="cupcake">Un cupcake</option>
                        <option value="cannele">Des cannelés</option>

                    </select>
                    <br><br>                    
                    <div class="titre">Le dernier film qui t'a retourné :</div><br />
                    <input required type="text" name="film" maxlength="52" value="" placeholder="" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" /><br /><br />
                    <br><br>                    
                    <div class="btn_noir etape_precedente" etape="2">Précédente</div>
                    <div class="btn_noir etape_suivante" etape="2">Suivante</div>
                </div>

                <div id="etape3_recherche" class="div_cache" style="display:none; text-align:center;"><br />
                    <div class="titre">La dernière insulte que tu as prononcé :</div><br />
                    <input required type="text" name="gros_mot" value="" placeholder="" maxlength="25" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" /><br /><br />

                    <div class="titre">Une plante qui te correspond bien :</div><br />
                    <select required name="plante1" id="pet-select" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" required>
                        <option value="">Choisis</option>
                        <option value="pin">Le pin</option>
                        <option value="tropical">Le monstera (plante tropicale)</option>
                        <option value="cactus">Le cactus</option>
                        <option value="chene">Le chene</option>
                        <option value="chanvre">Le chanvre</option>
                        <option value="erable">L’érable</option>
                        <option value="ginkgo">Le ginkgo</option>

                    </select>
                    <br><br>



                    <div class="titre">Ta boisson fétiche du moment :</div><br />
                    <select required name="boissons" id="pet-select" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" required>
                        <option value="">Choisis</option>
                        <option value="cafe">Le café, parce que t’es un adulte, un vrai</option>
                        <option value="choco">Le chocolat chaud, toujours réconfortant</option>
                        <option value="the">Le thé, parce que oui, tu es raffiné</option>

                    </select>
                    <br><br>
                    <div class="titre">Ton chiffre porte-bonheur :</div><br />
                    <select required name="chiffres" id="pet-select" style="width:300px; font-size:16px; padding:5px; margin:0px;" class="champtxt" required>
                        <option value="">Choisis</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                    <br><br>

                    <div class="btn_noir etape_precedente" etape="3">Précédente</div>
                    <div class="btn_noir etape_suivante" etape="3">Suivante</div>
                </div>

                <div id="etape4_recherche" class="div_cache" style="display:none; color:#ffffff;"><br />
                    <div class="titre">Merci ! </div><br />
                    C'est parti pour la génération de l'image !<br /> <br />
                    <div class="btn_noir etape_precedente" etape="4">Précédente</div>
                    <input type="submit" class="btn_noir" value="Générer l'image"></input>
                </div>


            </div>
            <div id="btn_recherche" statut="ferme">On commence ?</div>
        </form>
    </div>
</div>

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
<?php include 'footer.php'; ?>