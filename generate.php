<?php
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
// Création des instances d'image
$dest = imagecreatefromjpeg('./images/full.jpg');

// // Copie et fusionne
//Animaux
$src = imagecreatefrompng('./images/animaux/Animal_0009_Ecureuil.png');
imagecopymerge_alpha($dest, $src, 830, 1105, 0, 0, 921, 925, 100);

//Boisson
$src = imagecreatefrompng('./images/boissons/Boisson_0002_Cafe-.png');
imagecopymerge_alpha($dest, $src, 1737, 290, 0, 0, 577, 1101, 100);




// Affichage et libération de la mémoire
header('Content-Type: image/jpeg');
imagejpeg($dest);

imagedestroy($dest);
imagedestroy($src);
