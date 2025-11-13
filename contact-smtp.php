<?php
/**
 * OPTION AVANCÉE: Utiliser SMTP de Hostinger avec PHPMailer
 * Cette version est plus fiable pour l'envoi d'emails
 * 
 * Installation de PHPMailer via Composer:
 * composer require phpmailer/phpmailer
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Si vous utilisez Composer

// OU téléchargez PHPMailer manuellement et incluez les fichiers:
// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupérer les données du formulaire
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $subject_form = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));
    
    // Validation
    if (empty($name) || empty($email) || empty($subject_form) || empty($message)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis.']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Email invalide.']);
        exit;
    }
    
    $mail = new PHPMailer(true);
    
    try {
        // Configuration SMTP Hostinger
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';  // Serveur SMTP Hostinger
        $mail->SMTPAuth   = true;
        $mail->Username   = 'direction@betna.td';  // Votre email Hostinger
        $mail->Password   = 'VOTRE_MOT_DE_PASSE';  // ⚠️ IMPORTANT: Remplacer par votre mot de passe
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Encodage
        $mail->CharSet = 'UTF-8';
        
        // Expéditeur et destinataire
        $mail->setFrom('direction@betna.td', 'Site Web Betna');
        $mail->addAddress('direction@betna.td', 'Betna Services');
        $mail->addReplyTo($email, $name);
        
        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message: ' . $subject_form;
        $mail->Body    = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background: #0099E5; color: white; padding: 20px; text-align: center; }
                    .content { background: #f9f9f9; padding: 20px; }
                    .field { margin-bottom: 15px; }
                    .label { font-weight: bold; color: #333; }
                    .value { color: #666; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>Nouveau message depuis le site web</h2>
                    </div>
                    <div class='content'>
                        <div class='field'>
                            <span class='label'>Nom:</span>
                            <span class='value'>{$name}</span>
                        </div>
                        <div class='field'>
                            <span class='label'>Email:</span>
                            <span class='value'>{$email}</span>
                        </div>
                        <div class='field'>
                            <span class='label'>Téléphone:</span>
                            <span class='value'>{$phone}</span>
                        </div>
                        <div class='field'>
                            <span class='label'>Sujet:</span>
                            <span class='value'>{$subject_form}</span>
                        </div>
                        <div class='field'>
                            <span class='label'>Message:</span>
                            <div class='value'>" . nl2br($message) . "</div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
        ";
        
        $mail->AltBody = "Nom: {$name}\nEmail: {$email}\nTéléphone: {$phone}\nSujet: {$subject_form}\n\nMessage:\n{$message}";
        
        $mail->send();
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Message envoyé avec succès!']);
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => "Erreur: {$mail->ErrorInfo}"]);
    }
    
} else {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Accès interdit.']);
}
?>