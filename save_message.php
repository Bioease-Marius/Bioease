<?php
// Emplacement du fichier JSON
$file = 'messages.json';

// Récupérer les données POST
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

if ($name && $email && $message) {
    // Charger les messages existants
    $messages = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    // Ajouter le nouveau message
    $messages[] = [
        'name' => $name,
        'email' => $email,
        'message' => $message,
        'date' => date('Y-m-d H:i:s')
    ];

    // Enregistrer les messages dans le fichier
    file_put_contents($file, json_encode($messages, JSON_PRETTY_PRINT));

    // Rediriger vers une page de remerciement
    header('Location: thank_you.html');
    exit;
} else {
    echo "Invalid input. Please fill out the form correctly.";
}
