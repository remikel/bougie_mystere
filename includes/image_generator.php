<?php

require_once 'config.php';

class ImageGenerator {
    
    private $width = 2315;
    private $height = 3307;
    private $fontPath;
    private $colorSchemes;
    
    public function __construct() {
        $this->fontPath = __DIR__ . '/../fonts/';
        $this->initializeColorSchemes();
    }
    
    private function initializeColorSchemes() {
        $this->colorSchemes = [
            'BLEU' => [
                'primary' => [0, 67, 90],
                'secondary' => [0, 220, 235],
                'tertiary' => [0, 253, 217]
            ],
            'VERT' => [
                'primary' => [0, 185, 107],
                'secondary' => [229, 245, 221],
                'tertiary' => [0, 92, 21]
            ],
            'ROSE' => [
                'primary' => [232, 65, 33],
                'secondary' => [249, 216, 214],
                'tertiary' => [233, 153, 0]
            ],
            'JAUNE' => [
                'primary' => [255, 97, 0],
                'secondary' => [255, 181, 0],
                'tertiary' => [164, 16, 156]
            ],
            'VIOLET' => [
                'primary' => [161, 72, 181],
                'secondary' => [232, 206, 253],
                'tertiary' => [255, 208, 0]
            ]
        ];
    }
    
    public function generateImage($userData) {
        try {
            // Create base canvas
            $canvas = imagecreate($this->width, $this->height);
            $white = imagecolorallocate($canvas, 255, 255, 255);
            
            // Get color scheme
            $colors = $this->getColorScheme($canvas, $userData['color']);
            
            // Add all elements
            $this->addAnimals($canvas, $userData);
            $this->addBeverage($canvas, $userData);
            $this->addDessert($canvas, $userData);
            $this->addNumber($canvas, $userData);
            $this->addPlants($canvas, $userData);
            $this->addSports($canvas, $userData);
            $this->addTransport($canvas, $userData);
            $this->addFilm($canvas, $userData, $colors, $white);
            $this->addGrosMot($canvas, $userData, $colors);
            $this->addBook($canvas, $userData, $colors);
            $this->addMusic($canvas, $userData, $colors);
            $this->addDate($canvas, $colors);
            $this->addHashtag($canvas, $userData, $colors);
            
            // Generate secure filename
            $filename = Security::generateSecureFilename($userData['email']);
            $fullPath = Config::get('GENERATED_IMAGES_PATH') . $filename;
            
            // Save image
            if (!imagejpeg($canvas, $fullPath, 90)) {
                throw new Exception("Failed to save image");
            }
            
            // Cleanup
            imagedestroy($canvas);
            
            return $filename;
            
        } catch (Exception $e) {
            error_log("Image generation error: " . $e->getMessage());
            throw new Exception("Erreur lors de la génération de l'image");
        }
    }
    
    private function getColorScheme($canvas, $colorName) {
        $scheme = $this->colorSchemes[$colorName];
        return [
            'primary' => imagecolorallocate($canvas, ...$scheme['primary']),
            'secondary' => imagecolorallocate($canvas, ...$scheme['secondary']),
            'tertiary' => imagecolorallocate($canvas, ...$scheme['tertiary']),
            'white' => imagecolorallocate($canvas, 255, 255, 255)
        ];
    }
    
    private function addLayerImage($canvas, $imagePath, $x, $y, $width = null, $height = null) {
        if (!file_exists($imagePath)) {
            error_log("Image not found: " . $imagePath);
            return false;
        }
        
        $src = imagecreatefrompng($imagePath);
        if (!$src) {
            error_log("Failed to load image: " . $imagePath);
            return false;
        }
        
        if ($width && $height) {
            $src = imagescale($src, $width, $height);
        }
        
        $srcWidth = imagesx($src);
        $srcHeight = imagesy($src);
        
        $this->imagecopymerge_alpha($canvas, $src, $x, $y, 0, 0, $srcWidth, $srcHeight, 100);
        imagedestroy($src);
        
        return true;
    }
    
    private function addAnimals($canvas, $userData) {
        $imagePath = "./images/{$userData['color']}/animaux/{$userData['animaux']}.png";
        $this->addLayerImage($canvas, $imagePath, 830, 1105);
    }
    
    private function addBeverage($canvas, $userData) {
        $imagePath = "./images/{$userData['color']}/boissons/{$userData['boissons']}.png";
        $this->addLayerImage($canvas, $imagePath, 1737, 290);
    }
    
    private function addDessert($canvas, $userData) {
        $imagePath = "./images/{$userData['color']}/desserts/{$userData['desserts']}.png";
        $this->addLayerImage($canvas, $imagePath, 690, 2685);
    }
    
    private function addNumber($canvas, $userData) {
        $imagePath = "./images/{$userData['color']}/chiffres/{$userData['chiffres']}.png";
        $this->addLayerImage($canvas, $imagePath, 370, 2930);
    }
    
    private function addPlants($canvas, $userData) {
        $plant = $userData['plantes'];
        $this->addLayerImage($canvas, "./images/{$userData['color']}/plantes1/{$plant}.png", 10, 895);
        $this->addLayerImage($canvas, "./images/{$userData['color']}/plantes3/{$plant}.png", 6, 1657);
        $this->addLayerImage($canvas, "./images/{$userData['color']}/plantes2/{$plant}.png", 1750, 1385);
    }
    
    private function addSports($canvas, $userData) {
        $sport = $userData['sports'];
        $this->addLayerImage($canvas, "./images/{$userData['color']}/sports1/{$sport}.png", 805, 300);
        
        // Scale down sports2 image
        $src = imagecreatefrompng("./images/{$userData['color']}/sports2/{$sport}.png");
        if ($src) {
            $scaled = imagescale($src, 230);
            $this->imagecopymerge_alpha($canvas, $scaled, 0, 2057, 0, 0, 230, 368, 100);
            imagedestroy($src);
            imagedestroy($scaled);
        }
    }
    
    private function addTransport($canvas, $userData) {
        $imagePath = "./images/{$userData['color']}/transports/{$userData['transports']}.png";
        $this->addLayerImage($canvas, $imagePath, 1420, 2800);
    }
    
    private function addFilm($canvas, $userData, $colors, $white) {
        $this->addLayerImage($canvas, "./images/{$userData['color']}/film/Film.png", 0, 0);
        
        $title = $userData['film'];
        $fontPath = $this->fontPath . 'AmaticSC-Bold.ttf';
        
        if (strlen($title) >= 52) {
            imagettftext($canvas, 60, 6, 120, 370, $white, $fontPath, $this->wrapText(60, 6, $fontPath, $title, 630));
        } elseif (strlen($title) >= 35) {
            imagettftext($canvas, 70, 6, 120, 380, $white, $fontPath, $this->wrapText(70, 6, $fontPath, $title, 630));
        } elseif (strlen($title) >= 20) {
            imagettftext($canvas, 90, 6, 120, 420, $white, $fontPath, $this->wrapText(90, 6, $fontPath, $title, 630));
        } elseif (strlen($title) >= 10) {
            imagettftext($canvas, 100, 6, 125, 470, $white, $fontPath, $title);
        } else {
            imagettftext($canvas, 150, 6, 165, 470, $white, $fontPath, $title);
        }
    }
    
    private function addGrosMot($canvas, $userData, $colors) {
        $this->addLayerImage($canvas, "./images/{$userData['color']}/gros-mot/Gros_Mot.png", 0, 1100);
        
        $title = $userData['gros_mot'];
        $color = ($userData['color'] == 'VERT') ? $colors['secondary'] : $colors['tertiary'];
        $color = ($userData['color'] == 'VIOLET') ? $colors['primary'] : $color;
        $fontPath = $this->fontPath . 'AmaticSC-Bold.ttf';
        
        if (strlen($title) >= 20) {
            imagettftext($canvas, 90, 6, 120, 1380, $color, $fontPath, $this->wrapText(90, 6, $fontPath, $title, 610));
        } elseif (strlen($title) >= 10) {
            imagettftext($canvas, 120, 6, 140, 1470, $color, $fontPath, $title);
        } else {
            imagettftext($canvas, 170, 6, 180, 1480, $color, $fontPath, $title);
        }
    }
    
    private function addBook($canvas, $userData, $colors) {
        $this->addLayerImage($canvas, "./images/{$userData['color']}/livre/Livre.png", 1220, 1770);
        
        $color = ($userData['color'] == 'VERT') ? $colors['tertiary'] : $colors['primary'];
        $title = $userData['livre'];
        $fontPath = $this->fontPath . 'AmaticSC-Bold.ttf';
        
        if (strlen($title) >= 52) {
            imagettftext($canvas, 60, 26, 1420, 2300, $color, $fontPath, $this->wrapText(60, 6, $fontPath, $title, 300));
        } elseif (strlen($title) >= 35) {
            imagettftext($canvas, 65, 25, 1420, 2300, $color, $fontPath, $this->wrapText(60, 6, $fontPath, $title, 300));
        } elseif (strlen($title) >= 20) {
            imagettftext($canvas, 75, 21, 1420, 2300, $color, $fontPath, $this->wrapText(60, 6, $fontPath, $title, 300));
        } elseif (strlen($title) >= 10) {
            imagettftext($canvas, 75, 21, 1400, 2300, $color, $fontPath, $this->wrapText(60, 6, $fontPath, $title, 300));
        } else {
            imagettftext($canvas, 85, 21, 1380, 2300, $color, $fontPath, $title);
        }
    }
    
    private function addMusic($canvas, $userData, $colors) {
        $this->addLayerImage($canvas, "./images/{$userData['color']}/musique/Musique.png", 0, 1680);
        
        $title = $userData['chanson'];
        $fontPath = $this->fontPath . 'AmaticSC-Bold.ttf';
        
        if (strlen($title) >= 35) {
            imagettftext($canvas, 80, 15, 620, 2400, $colors['tertiary'], $fontPath, $this->wrapText(60, 6, $fontPath, $title, 500));
        } elseif (strlen($title) >= 20) {
            imagettftext($canvas, 75, 21, 700, 2400, $colors['tertiary'], $fontPath, $this->wrapText(60, 6, $fontPath, $title, 500));
        } elseif (strlen($title) >= 10) {
            imagettftext($canvas, 75, 21, 700, 2400, $colors['tertiary'], $fontPath, $this->wrapText(60, 6, $fontPath, $title, 500));
        } else {
            imagettftext($canvas, 125, 21, 740, 2460, $colors['tertiary'], $fontPath, $title);
        }
    }
    
    private function addDate($canvas, $colors) {
        $fontPath = $this->fontPath . 'Quicksand-Bold.ttf';
        imagettftext($canvas, 180, 0, 1385, 240, $colors['tertiary'], $fontPath, date('d.n.y'));
    }
    
    private function addHashtag($canvas, $userData, $colors) {
        $hashtag = "#" . $userData['hashtag'];
        $fontPath = $this->fontPath . 'AmaticSC-Bold.ttf';
        
        if (strlen($hashtag) <= 6) {
            imagettftext($canvas, 320, 90, 2285, 2750, $colors['primary'], $fontPath, $hashtag);
        } elseif (strlen($hashtag) <= 9) {
            imagettftext($canvas, 220, 90, 2230, 2800, $colors['primary'], $fontPath, $hashtag);
        } elseif (strlen($hashtag) <= 15) {
            imagettftext($canvas, 170, 90, 2250, 2800, $colors['primary'], $fontPath, $hashtag);
        }
    }
    
    private function wrapText($fontSize, $angle, $fontFace, $string, $width) {
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
    
    private function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {
        $cut = imagecreatetruecolor($src_w, $src_h);
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
        imagedestroy($cut);
    }
}