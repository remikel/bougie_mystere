<?php


// film MAx : 52
// hastag max 12
// Gros mots : 25
//Livre : 52
// TODO Si pas d'espace découper la chaine

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
{
    // creating a cut resource
    $cut = imagecreatetruecolor($src_w, $src_h);

    // copying relevant section from background to the cut resource
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

    // copying relevant section from watermark to the cut resource
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

    // insert cut resource to destination image
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}
function wrap($fontSize, $angle, $fontFace, $string, $width)
{

    $ret = "";

    $arr = explode(' ', $string);

    foreach ($arr as $word) {

        $teststring = $ret . ' ' . $word;
        $testbox = imagettfbbox($fontSize, $angle, $fontFace, $teststring);
        if ($testbox[2] > $width) {
            $ret .= ($ret == "" ? "" : "\n") . $word;
        } else {
            $ret .= ($ret == "" ? "" : ' ') . $word;
        }
    }

    return $ret;
}
// Création des instances d'image
$dest = imagecreatefromjpeg('./images/full.jpg');

$primary = imagecolorallocate($dest, 0, 0, 0);
$fontAmatic = './fonts/AmaticSC-Bold.ttf';
$fontQuick = './fonts/Quicksand-Bold.ttf';



// // Copie et fusionne
//Animaux
$src = imagecreatefrompng('./images/JAUNE/animaux/' . $_POST['animaux'] . '.png');
imagecopymerge_alpha($dest, $src, 830, 1105, 0, 0, 921, 925, 100);

//Boisson
$src = imagecreatefrompng('./images/JAUNE/boissons/' . $_POST['boissons'] . '.png');
imagecopymerge_alpha($dest, $src, 1737, 290, 0, 0, 577, 1101, 100);

//Dessert
$src = imagecreatefrompng('./images/JAUNE/desserts/' . $_POST['desserts'] . '.png');
imagecopymerge_alpha($dest, $src, 690, 2685, 0, 0, 738, 623, 100);

//chiffres
$src = imagecreatefrompng('./images/JAUNE/chiffres/' . $_POST['chiffres'] . '.png');
imagecopymerge_alpha($dest, $src, 370, 2935, 0, 0, 326, 375, 100);

//plante
$src = imagecreatefrompng('./images/JAUNE/plantes1/' . $_POST['plantes'] . '.png');
imagecopymerge_alpha($dest, $src, 10, 895, 0, 0, 1215, 210, 100);
$src = imagecreatefrompng('./images/JAUNE/plantes2/' . $_POST['plantes'] . '.png');
imagecopymerge_alpha($dest, $src, 6, 1657, 0, 0, 496, 554, 100);
$src = imagecreatefrompng('./images/JAUNE/plantes3/' . $_POST['plantes'] . '.png');
imagecopymerge_alpha($dest, $src, 1750, 1385, 0, 0, 573, 380, 100);

//sport
$src = imagecreatefrompng('./images/JAUNE/sport1/' . $_POST['sports'] . '.png');
imagecopymerge_alpha($dest, $src, 805, 300, 0, 0, 1091, 811, 100);
$src = imagecreatefrompng('./images/JAUNE/sport2/' . $_POST['sports'] . '.png');
$src = imagescale($src, 230);
imagecopymerge_alpha($dest, $src, 0, 2057, 0, 0, 230, 368, 100);

//chiffres
$src = imagecreatefrompng('./images/JAUNE/transports/' . $_POST['transports'] . '.png');
imagecopymerge_alpha($dest, $src, 1420, 2800, 0, 0, 892, 504, 100);


//Film
$src = imagecreatefrompng('./images/JAUNE/cinema/Film.png');
imagecopymerge_alpha($dest, $src, 0, 0, 0, 0, 1457, 1102, 100);
$title = $_POST['film'];
if (strlen($title) >= 52) {
    imagettftext($dest, 60, 6, 120, 370, $primary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 610));
} else if (strlen($title) >= 35) {
    imagettftext($dest, 70, 6, 120, 380, $primary, $fontAmatic, wrap(70, 6, $fontAmatic, $title, 610));
} else if (strlen($title) >= 20) {
    imagettftext($dest, 90, 6, 120, 420, $primary, $fontAmatic, wrap(90, 6, $fontAmatic, $title, 610));
} else if (strlen($title) >= 10) {
    imagettftext($dest, 100, 6, 125, 470, $primary, $fontAmatic, $title);
} else {
    imagettftext($dest, 150, 6, 165, 470, $primary, $fontAmatic, $title);
}

//gros mot
$src = imagecreatefrompng('./images/JAUNE/gros_mot/Gros_Mot.png');
imagecopymerge_alpha($dest, $src, 0, 1100, 0, 0, 971, 557, 100);
$title = $_POST['gros_mot'];
if (strlen($title) >= 20) {
    imagettftext($dest, 90, 6, 120, 1380, $primary, $fontAmatic, wrap(90, 6, $fontAmatic, $title, 610));
} else if (strlen($title) >= 10) {
    imagettftext($dest, 100, 6, 70, 1470, $primary, $fontAmatic, $title);
} else {
    imagettftext($dest, 170, 6, 180, 1490, $primary, $fontAmatic, $title);
}

//Livre
$src = imagecreatefrompng('./images/JAUNE/livre/Livre.png');
imagecopymerge_alpha($dest, $src, 1220, 1770, 0, 0, 744, 1033, 100);
$title = $_POST['livre'];
if (strlen($title) >= 52) {
    imagettftext($dest, 60, 21, 1420, 2300, $primary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 400));
} else if (strlen($title) >= 35) {
    imagettftext($dest, 65, 21, 1420, 2300, $primary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 400));
} else if (strlen($title) >= 20) {
    imagettftext($dest, 75, 21, 1420, 2300, $primary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 300));
} else if (strlen($title) >= 10) {
    imagettftext($dest, 75, 21, 1400, 2300, $primary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 300));
} else {
    imagettftext($dest, 85, 21, 1380, 2300, $primary, $fontAmatic, $title);
}

//Musique
$src = imagecreatefrompng('./images/JAUNE/musique/Musique.png');
imagecopymerge_alpha($dest, $src, 1220, 1770, 0, 0, 1213, 1647, 100);
$title = $_POST['chanson'];
if (strlen($title) >= 35) {
    imagettftext($dest, 80, 15, 620, 2400, $primary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 500));
} else if (strlen($title) >= 20) {
    imagettftext($dest, 75, 21, 1420, 2300, $primary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 300));
} else if (strlen($title) >= 10) {
    imagettftext($dest, 75, 21, 1400, 2300, $primary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 300));
} else {
    imagettftext($dest, 85, 21, 1380, 2300, $primary, $fontAmatic, $title);
}

// Date
imagettftext($dest, 180, 0, 1400, 240, $primary, $fontQuick, "88.88.88");

// Hashtag
$hashtag = "#" . $_POST['hashtag'];
if (strlen($hashtag) <= 6) {
    imagettftext($dest, 300, 90, 2280, 2600, $primary, $fontAmatic, $hashtag);
} else if (strlen($hashtag) <= 9) {
    imagettftext($dest, 200, 90, 2230, 2620, $primary, $fontAmatic, $hashtag);
} else if (strlen($hashtag) <= 12) {
    imagettftext($dest, 150, 90, 2200, 2620, $primary, $fontAmatic, $hashtag);
}


// Affichage et libération de la mémoire
header('Content-Type: image/jpeg');
imagejpeg($dest);

imagedestroy($dest);
imagedestroy($src);
