<?php
// Configuration Email
$to = "direction@betna.td"; // Votre email Hostinger
$subject = "Nouveau message depuis le site Betna";

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupérer et nettoyer les données
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $subject_form = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));
    
    // Vérifier que les données ne sont pas vides
    if (empty($name) || empty($email) || empty($subject_form) || empty($message)) {
        http_response_code(400);
        echo "Veuillez remplir tous les champs obligatoires.";
        exit;
    }
    
    // Vérifier que l'email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Adresse email invalide.";
        exit;
    }
    
    // Construire le contenu de l'email
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Téléphone: $phone\n\n";
    $email_content .= "Sujet: $subject_form\n\n";
    $email_content .= "Message:\n$message\n";
    
    // En-têtes de l'email
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // OPTION 1: Envoi simple avec mail() de PHP (Fonctionne avec Hostinger)
    if (mail($to, $subject_form, $email_content, $headers)) {
        http_response_code(200);
        echo "Message envoyé avec succès!";
    } else {
        http_response_code(500);
        echo "Erreur lors de l'envoi du message.";
    }
    
} else {
    http_response_code(403);
    echo "Accès interdit.";
}
?>