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
// $dest = imagecreatefromjpeg('./images/full.jpg');
$dest = imagecreate(2315, 3307);
$white = imagecolorallocate($dest, 255, 255, 255);
switch ($_POST['color']) {
    case 'BLEU':
        $primary = imagecolorallocate($dest, 0, 67, 90);
        $secondary = imagecolorallocate($dest, 0, 220, 235);
        $tertiary = imagecolorallocate($dest, 0, 253, 217);
        break;
    case 'VERT':
        $primary = imagecolorallocate($dest, 0, 185, 107);
        $secondary = imagecolorallocate($dest, 229, 245, 221);
        $tertiary = imagecolorallocate($dest, 0, 92, 21);
        break;
    case 'ROSE':
        $primary = imagecolorallocate($dest, 232, 65, 33);
        $secondary = imagecolorallocate($dest, 249, 216, 214);
        $tertiary = imagecolorallocate($dest, 233, 153, 0);
        break;
    case 'JAUNE':
        $primary = imagecolorallocate($dest, 255, 97, 0);
        $secondary = imagecolorallocate($dest, 255, 181, 0);
        $tertiary = imagecolorallocate($dest, 164, 16, 156);
        break;
    case 'VIOLET':
        $primary = imagecolorallocate($dest, 161, 72, 181);
        $secondary = imagecolorallocate($dest, 232, 206, 253);
        $tertiary = imagecolorallocate($dest, 255, 208, 0);
        break;
}
$white = imagecolorallocate($dest, 255, 255, 255);
$fontAmatic = './fonts/AmaticSC-Bold.ttf';
$fontQuick = './fonts/Quicksand-Bold.ttf';



// // Copie et fusionne
//Animaux
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/animaux/' . $_POST['animaux'] . '.png');
imagecopymerge_alpha($dest, $src, 830, 1105, 0, 0, 921, 925, 100);

//Boisson
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/boissons/' . $_POST['boissons'] . '.png');
imagecopymerge_alpha($dest, $src, 1737, 290, 0, 0, 577, 1101, 100);

//Dessert
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/desserts/' . $_POST['desserts'] . '.png');
imagecopymerge_alpha($dest, $src, 690, 2685, 0, 0, 738, 623, 100);

//chiffres
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/chiffres/' . $_POST['chiffres'] . '.png');
imagecopymerge_alpha($dest, $src, 370, 2930, 0, 0, 326, 375, 100);

//plante
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/plantes1/' . $_POST['plantes'] . '.png');
imagecopymerge_alpha($dest, $src, 10, 895, 0, 0, 1215, 210, 100);
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/plantes3/' . $_POST['plantes'] . '.png');
imagecopymerge_alpha($dest, $src, 6, 1657, 0, 0, 496, 554, 100);
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/plantes2/' . $_POST['plantes'] . '.png');
imagecopymerge_alpha($dest, $src, 1750, 1385, 0, 0, 573, 380, 100);

//sport
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/sports1/' . $_POST['sports'] . '.png');
imagecopymerge_alpha($dest, $src, 805, 300, 0, 0, 1091, 811, 100);
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/sports2/' . $_POST['sports'] . '.png');
$src = imagescale($src, 230);
imagecopymerge_alpha($dest, $src, 0, 2057, 0, 0, 230, 368, 100);

//transport
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/transports/' . $_POST['transports'] . '.png');
imagecopymerge_alpha($dest, $src, 1420, 2800, 0, 0, 892, 504, 100);


//Film
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/film/Film.png');
imagecopymerge_alpha($dest, $src, 0, 0, 0, 0, 1457, 1102, 100);
$title = $_POST['film'];
if (strlen($title) >= 52) {
    imagettftext($dest, 60, 6, 120, 370, $white, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 630));
} else if (strlen($title) >= 35) {
    imagettftext($dest, 70, 6, 120, 380, $white, $fontAmatic, wrap(70, 6, $fontAmatic, $title, 630));
} else if (strlen($title) >= 20) {
    imagettftext($dest, 90, 6, 120, 420, $white, $fontAmatic, wrap(90, 6, $fontAmatic, $title, 630));
} else if (strlen($title) >= 10) {
    imagettftext($dest, 100, 6, 125, 470, $white, $fontAmatic, $title);
} else {
    imagettftext($dest, 150, 6, 165, 470, $white, $fontAmatic, $title);
}

//gros mot
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/gros-mot/Gros_Mot.png');
imagecopymerge_alpha($dest, $src, 0, 1100, 0, 0, 971, 557, 100);
$title = $_POST['gros_mot'];
$colorGrosMot = ($_POST['color'] == 'VERT') ? $secondary : $tertiary;
$colorGrosMot = ($_POST['color'] == 'VIOLET') ? $primary : $colorGrosMot;
if (strlen($title) >= 20) {
    imagettftext($dest, 90, 6, 120, 1380, $colorGrosMot, $fontAmatic, wrap(90, 6, $fontAmatic, $title, 610));
} else if (strlen($title) >= 10) {
    imagettftext($dest, 120, 6, 140, 1470, $colorGrosMot, $fontAmatic, $title);
} else {
    imagettftext($dest, 170, 6, 180, 1480, $colorGrosMot, $fontAmatic, $title);
}

//Livre
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/livre/Livre.png');
imagecopymerge_alpha($dest, $src, 1220, 1770, 0, 0, 744, 1033, 100);
$colorLivre = $_POST['color'] == 'VERT' ? $tertiary : $primary;
$title = $_POST['livre'];
if (strlen($title) >= 52) {
    imagettftext($dest, 60, 26, 1420, 2300, $colorLivre, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 300));
} else if (strlen($title) >= 35) {
    imagettftext($dest, 65, 25, 1420, 2300, $colorLivre, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 300));
} else if (strlen($title) >= 20) {
    imagettftext($dest, 75, 21, 1420, 2300, $colorLivre, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 300));
} else if (strlen($title) >= 10) {
    imagettftext($dest, 75, 21, 1400, 2300, $colorLivre, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 300));
} else {
    imagettftext($dest, 85, 21, 1380, 2300, $colorLivre, $fontAmatic, $title);
}

//Musique
$src = imagecreatefrompng('./images/'. $_POST['color'] . '/musique/Musique.png');
imagecopymerge_alpha($dest, $src, 0, 1680, 0, 0, 1329, 1637, 100);
$title = $_POST['chanson'];
if (strlen($title) >= 35) {
    imagettftext($dest, 80, 15, 620, 2400, $tertiary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 500));
} else if (strlen($title) >= 20) {
    imagettftext($dest, 75, 21, 700, 2400, $tertiary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 500));
} else if (strlen($title) >= 10) {
    imagettftext($dest, 75, 21, 700, 2400, $tertiary, $fontAmatic, wrap(60, 6, $fontAmatic, $title, 500));
} else {
    imagettftext($dest, 125, 21, 740, 2460, $tertiary, $fontAmatic, $title);
}

// Date
imagettftext($dest, 180, 0, 1385, 240, $tertiary, $fontQuick, date('d.n.y'));

// Hashtag
$hashtag = "#" . $_POST['hashtag'];
if (strlen($hashtag) <= 6) {
    imagettftext($dest, 320, 90, 2285, 2750, $primary, $fontAmatic, $hashtag);
} else if (strlen($hashtag) <= 9) {
    imagettftext($dest, 220, 90, 2230, 2800, $primary, $fontAmatic, $hashtag);
} else if (strlen($hashtag) <= 15) {
    imagettftext($dest, 170, 90, 2250, 2800, $primary, $fontAmatic, $hashtag);
}


$path = "./images/generated/". $_POST['email'] . date('dnyhs') . ".jpeg";
imagejpeg( $dest, $path);

require './vendor/autoload.php';
use \Mailjet\Resources;
use \Mailjet\Client;
$mj = new Client('a1289d5009ad3b1720e5d4f71fcc0a6b', 'b783a5aa39dfd20b2a3df353c6f58672',true,['version' => 'v3.1']);
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "hello@noemie-pulido.fr",
                'Name' => "Le père Nono"
            ],
            'To' => [
                [
                    'Email' => $_POST['email']
                ]
            ],
            'Subject' => "Votre image personnalisée !",
            'HTMLPart' => "<h3>Encore félicitations d'avoir résolu la bougie mystère !</h3>Voici ton image personnalisée, j'espère qu'elle te plaît !<br>
            N'hésite pas à t'abonner à mon compte <a href='https://www.instagram.com/noemie_pulido/'>Instagram @noemie_pulido</a> pour suivre mon actualité !<br>
            N'hésite pas à répondre à ce mail si tu as des remarques ou des améliorations à suggérer sur le jeu de la bougie ;)",
            'Attachments' => [
                [
                    'ContentType' => "text/plain",
                    'Filename' => "mon-instant-du-" . date('dnyhs') . ".jpg",
                    'Base64Content' => base64_encode(file_get_contents($path))
                ]
            ]
        ]
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success();

// Remove the ./ prefix from the path for fin.php compatibility
$relativePath = ltrim($path, './');
header('Location: fin.php?src='. urlencode($relativePath));

// header('Content-Type: image/jpeg');
// imagejpeg( $dest);

imagedestroy($dest);
imagedestroy($src);
