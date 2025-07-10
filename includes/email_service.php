<?php

require_once 'config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use \Mailjet\Resources;
use \Mailjet\Client;

class EmailService {
    
    private $mailjet;
    
    public function __construct() {
        $this->mailjet = new Client(
            Config::get('MAILJET_API_KEY'),
            Config::get('MAILJET_SECRET_KEY'),
            true,
            ['version' => 'v3.1']
        );
    }
    
    public function sendPersonalizedImage($email, $imagePath) {
        try {
            if (!file_exists($imagePath)) {
                throw new Exception("Image file not found: " . $imagePath);
            }
            
            $body = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => Config::get('MAILJET_FROM_EMAIL'),
                            'Name' => Config::get('MAILJET_FROM_NAME')
                        ],
                        'To' => [
                            [
                                'Email' => $email
                            ]
                        ],
                        'Subject' => "Votre image personnalisée !",
                        'HTMLPart' => $this->getEmailTemplate(),
                        'Attachments' => [
                            [
                                'ContentType' => "image/jpeg",
                                'Filename' => "mon-instant-du-" . date('dnyhs') . ".jpg",
                                'Base64Content' => base64_encode(file_get_contents($imagePath))
                            ]
                        ]
                    ]
                ]
            ];
            
            $response = $this->mailjet->post(Resources::$Email, ['body' => $body]);
            
            if (!$response->success()) {
                $errorData = $response->getData();
                error_log("Mailjet error: " . json_encode($errorData));
                throw new Exception("Erreur lors de l'envoi de l'email");
            }
            
            return true;
            
        } catch (Exception $e) {
            error_log("Email sending error: " . $e->getMessage());
            throw new Exception("Erreur lors de l'envoi de l'email: " . $e->getMessage());
        }
    }
    
    private function getEmailTemplate() {
        return "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;'>
            <h2 style='color: #442667; text-align: center;'>Félicitations !</h2>
            
            <p style='font-size: 16px; line-height: 1.6;'>
                Encore félicitations d'avoir résolu la bougie mystère !
            </p>
            
            <p style='font-size: 16px; line-height: 1.6;'>
                Voici ton image personnalisée, j'espère qu'elle te plaît !
            </p>
            
            <div style='background-color: #f9f9f9; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                <p style='margin: 0; font-size: 14px;'>
                    N'hésite pas à t'abonner à mon compte 
                    <a href='https://www.instagram.com/noemie_pulido/' style='color: #442667; text-decoration: none;'>
                        <strong>Instagram @noemie_pulido</strong>
                    </a> 
                    pour suivre mon actualité !
                </p>
            </div>
            
            <p style='font-size: 14px; color: #666;'>
                N'hésite pas à répondre à ce mail si tu as des remarques ou des améliorations à suggérer sur le jeu de la bougie 😉
            </p>
            
            <div style='text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;'>
                <p style='font-size: 12px; color: #999;'>
                    © 2024 Noémie Pulido - Graphiste
                </p>
            </div>
        </div>";
    }
}